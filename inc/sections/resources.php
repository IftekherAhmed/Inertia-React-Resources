<section id="resources" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-code-slash"></i>
                            Resources
                        </h1>
                        <p class="page-subtitle">Frontend components and file structure</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-folder"></i> React Resources Structure
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are React Resources?</h6>
                                <p>React resources are the frontend components that make up your application's user interface, organized by feature or entity.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Frontend Component Details</h6>
                                <p><strong>File Path:</strong> <code>resources/js/pages/Posts/Index.jsx</code><br>
                                <strong>Dependencies:</strong> Requires Inertia.js hooks and React state management</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR LISTING WITH ALL FEATURES</h6>
                                <p><strong>File:</strong> <code>resources/js/pages/Posts/Index.jsx</code> - Complete implementation with search, filter, sort, pagination</p>
                            </div>
                            <pre><code>import { Head, router, usePage } from '@inertiajs/react';
import { useState } from 'react';

export default function PostIndex() {
    const { posts, filters, pagination } = usePage().props;
    const [search, setSearch] = useState(filters.search || '');
    
    // FOR SEARCH: State and handler for search
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
                            &lt;td&gt;{post.title}&lt;/td&gt;
                            &lt;td&gt;{new Date(post.created_at).toLocaleDateString()}&lt;/td&gt;
                            &lt;td&gt;{post.published ? 'Published' : 'Draft'}&lt;/td&gt;
                            &lt;td&gt;
                                &lt;a href={`/posts/${post.id}/edit`}&gt;Edit&lt;/a&gt;
                                &lt;button onClick={() => handleDelete(post.id)}&gt;Delete&lt;/button&gt;
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
        &lt;/div&gt;
    );
}</code></pre>
                        </div>
                    </div>
                </section>