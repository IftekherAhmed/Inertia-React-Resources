<section id="modalview" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-window"></i>
                            Modal View
                        </h1>
                        <p class="page-subtitle">Dynamic modal views with data loading</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> Modal View Implementation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is a Modal View?</h6>
                                <p>Modal views are popup dialogs that display detailed information without navigating away from the current page. They provide a better user experience by keeping users in context.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Modal View Implementation Details</h6>
                                <p><strong>Backend:</strong> <code>app/Http/Controllers/PostController.php</code> show method<br>
                                <strong>Frontend:</strong> <code>resources/js/pages/Posts/Show.jsx</code> modal component</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR MODAL VIEW</h6>
                                <p><strong>Files:</strong> <code>app/Http/Controllers/PostController.php</code> and <code>resources/js/pages/Posts/Show.jsx</code> - Dynamic data loading in modal dialogs</p>
                            </div>
                            <h5>Backend Implementation</h5>
                            <pre><code>// FOR MODAL VIEW: Use this to show single resource in a modal
public function show(Post $post)
{
    // Load related data if needed
    $post->load('author', 'comments');
    
    // Return data for modal view
    return Inertia::render('Posts/Show', [
        'post' => $post
    ]);
}</code></pre>
                            
                            <h5>Frontend Modal Component</h5>
                            <pre><code>import { Head } from '@inertiajs/react';
import { useState, useEffect } from 'react';

export default function PostModal({ post, isOpen, onClose }) {
    const [loading, setLoading] = useState(false);
    
    // FOR DYNAMIC DATA: Load additional data if needed
    useEffect(() => {
        if (isOpen && post) {
            setLoading(true);
            // Load additional data if needed
            // Example: fetchComments(post.id)
            setLoading(false);
        }
    }, [isOpen, post]);
    
    if (!isOpen) return null;
    
    return (
        &lt;div className="modal-overlay" onClick={onClose}&gt;
            &lt;div className="modal-content" onClick={e =&gt; e.stopPropagation()}&gt;
                &lt;Head title={post.title} /&gt;
                
                &lt;div className="modal-header"&gt;
                    &lt;h2&gt;{post.title}&lt;/h2&gt;
                    &lt;button className="close-button" onClick={onClose}&gt;&amp;times;&lt;/button&gt;
                &lt;/div&gt;
                
                &lt;div className="modal-body"&gt;
                    {loading ? (
                        &lt;div className="loading"&gt;Loading...&lt;/div&gt;
                    ) : (
                        &lt;&gt;
                            {post.image_path && (
                                &lt;img 
                                    src={`/storage/${post.image_path}`} 
                                    alt={post.title}
                                    className="img-fluid rounded"
                                /&gt;
                            )}
                            
                            &lt;div className="post-content"&gt;
                                &lt;p&gt;{post.content}&lt;/p&gt;
                            &lt;/div&gt;
                            
                            &lt;div className="post-meta"&gt;
                                &lt;p&gt;&lt;strong&gt;Status:&lt;/strong&gt; {post.published ? 'Published' : 'Draft'}&lt;/p&gt;
                                &lt;p&gt;&lt;strong&gt;Created:&lt;/strong&gt; {new Date(post.created_at).toLocaleDateString()}&lt;/p&gt;
                            &lt;/div&gt;
                        &lt;/&gt;
                    )}
                &lt;/div&gt;
                
                &lt;div className="modal-footer"&gt;
                    &lt;button className="btn btn-secondary" onClick={onClose}&gt;
                        Close
                    &lt;/button&gt;
                    &lt;a href={`/posts/${post.id}/edit`} className="btn btn-primary"&gt;
                        Edit Post
                    &lt;/a&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    );
}</code></pre>
                            
                            <h5>Using Modal in Index Page</h5>
                            <pre><code>import { Head, router, usePage } from '@inertiajs/react';
import { useState } from 'react';
import PostModal from './Show';

export default function PostIndex() {
    const { posts, filters, pagination } = usePage().props;
    const [selectedPost, setSelectedPost] = useState(null);
    const [isModalOpen, setIsModalOpen] = useState(false);
    
    // FOR MODAL VIEW: Open modal with selected post
    const openModal = (post) => {
        setSelectedPost(post);
        setIsModalOpen(true);
    };
    
    // FOR MODAL VIEW: Close modal
    const closeModal = () => {
        setIsModalOpen(false);
        setSelectedPost(null);
    };
    
    // FOR SEARCH: State and handler for search
    const [search, setSearch] = useState(filters.search || '');
    const handleSearch = (value) => {
        setSearch(value);
        router.get('/posts', { ...filters, search: value, page: 1 }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR FILTER: State and handler for published filter
    const [published, setPublished] = useState(filters.published || '');
    const handlePublishedFilter = (value) => {
        setPublished(value);
        router.get('/posts', { ...filters, published: value, page: 1 }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR SORT: Handler for sorting
    const handleSort = (field) => {
        const direction = filters.sort_by === field && filters.sort_direction === 'asc' ? 'desc' : 'asc';
        router.get('/posts', { 
            ...filters, 
            sort_by: field, 
            sort_direction: direction 
        }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR PAGINATION: Handler for page change
    const handlePageChange = (page) => {
        router.get('/posts', { ...filters, page }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR DELETE: Handler with confirmation
    const handleDelete = (id) => {
        if (confirm('Are you sure?')) {
            router.delete(`/posts/${id}`);
        }
    };

    return (
        &lt;div&gt;
            &lt;Head title="Posts" /&gt;
            
            {/* FOR SEARCH: Search input */}
            &lt;input
                type="text"
                placeholder="Search posts..."
                value={search}
                onChange={(e) => handleSearch(e.target.value)}
            /&gt;

            {/* FOR FILTER: Published status filter */}
            &lt;select 
                value={published} 
                onChange={(e) => handlePublishedFilter(e.target.value)}
            &gt;
                &lt;option value=""&gt;All Status&lt;/option&gt;
                &lt;option value="1"&gt;Published&lt;/option&gt;
                &lt;option value="0"&gt;Draft&lt;/option&gt;
            &lt;/select&gt;

            {/* FOR SORT: Sortable table headers */}
            &lt;table&gt;
                &lt;thead&gt;
                    &lt;tr&gt;
                        &lt;th onClick={() => handleSort('title')}&gt;
                            Title {filters.sort_by === 'title' && (
                                filters.sort_direction === 'asc' ? '↑' : '↓'
                            )}
                        &lt;/th&gt;
                        &lt;th onClick={() => handleSort('created_at')}&gt;
                            Date {filters.sort_by === 'created_at' && (
                                filters.sort_direction === 'asc' ? '↑' : '↓'
                            )}
                        &lt;/th&gt;
                        &lt;th&gt;Status&lt;/th&gt;
                        &lt;th&gt;Actions&lt;/th&gt;
                    &lt;/tr&gt;
                &lt;/thead&gt;
                &lt;tbody&gt;
                    {posts.map((post) => (
                        &lt;tr key={post.id}&gt;
                            &lt;td&gt;
                                &lt;button 
                                    className="btn btn-link" 
                                    onClick={() => openModal(post)}
                                &gt;
                                    {post.title}
                                &lt;/button&gt;
                            &lt;/td&gt;
                            &lt;td&gt;{new Date(post.created_at).toLocaleDateString()}&lt;/td&gt;
                            &lt;td&gt;{post.published ? 'Published' : 'Draft'}&lt;/td&gt;
                            &lt;td&gt;
                                &lt;button 
                                    className="btn btn-outline-primary btn-sm me-1"
                                    onClick={() => openModal(post)}
                                &gt;
                                    &lt;i className="bi bi-eye"&gt;&lt;/i&gt; View
                                &lt;/button&gt;
                                &lt;a href={`/posts/${post.id}/edit`} className="btn btn-outline-primary btn-sm me-1"&gt;
                                    &lt;i className="bi bi-pencil"&gt;&lt;/i&gt; Edit
                                &lt;/a&gt;
                                &lt;button 
                                    className="btn btn-outline-danger btn-sm"
                                    onClick={() => handleDelete(post.id)}
                                &gt;
                                    &lt;i className="bi bi-trash"&gt;&lt;/i&gt; Delete
                                &lt;/button&gt;
                            &lt;/td&gt;
                        &lt;/tr&gt;
                    ))}
                &lt;/tbody&gt;
            &lt;/table&gt;

            {/* FOR PAGINATION: Pagination controls */}
            &lt;div&gt;
                {Array.from({ length: pagination.last_page }, (_, i) => i + 1).map(page => (
                    &lt;button
                        key={page}
                        onClick={() => handlePageChange(page)}
                        disabled={page === pagination.current_page}
                    &gt;
                        {page}
                    &lt;/button&gt;
                ))}
            &lt;/div&gt;
            
            {/* FOR MODAL VIEW: Dynamic modal with data */}
            &lt;PostModal 
                post={selectedPost} 
                isOpen={isModalOpen} 
                onClose={closeModal} 
            /&gt;
        &lt;/div&gt;
    );
}</code></pre>                         
                        </div>
                    </div>
                </section>