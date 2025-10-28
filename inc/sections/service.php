<section id="service" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-gear"></i>
                            Service
                        </h1>
                        <p class="page-subtitle">Service classes for complex business logic</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code-square"></i> Creating Service Classes
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are Service Classes?</h6>
                                <p>Service classes are used to encapsulate complex business logic, keeping controllers thin and promoting code reusability.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-lightbulb"></i> When to Use Services</h6>
                                <p>Consider using service classes when you have complex business logic that might be reused across multiple controllers or when your controller methods become too large.</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Example Service Structure</h6>
                                    <div class="file-path">app/Services/PostService.php</div>
                                    <pre><code>&lt;?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Exception;

class PostService
{
    /**
     * Get filtered and sorted posts with error handling
     */
    public function getFilteredPosts(array $filters)
    {
        try {
            return Post::filteredAndSorted($filters);
        } catch (Exception $e) {
            throw new Exception("Failed to fetch posts: " . $e->getMessage());
        }
    }

    /**
     * Create a new post with transaction safety
     */
    public function createPost(array $data)
    {
        try {
            DB::beginTransaction();
            
            $post = Post::create($data);
            
            DB::commit();
            return $post;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to create post: " . $e->getMessage());
        }
    }

    /**
     * Update an existing post with transaction safety
     */
    public function updatePost(Post $post, array $data)
    {
        try {
            DB::beginTransaction();
            
            $post->update($data);
            
            DB::commit();
            return $post;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to update post: " . $e->getMessage());
        }
    }

    /**
     * Delete a post with transaction safety
     */
    public function deletePost(Post $post)
    {
        try {
            DB::beginTransaction();
            
            $result = $post->delete();
            
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to delete post: " . $e->getMessage());
        }
    }
    
    /**
     * Get a single post with related data
     */
    public function getPostWithDetails(Post $post)
    {
        try {
            return $post->load('author', 'comments');
        } catch (Exception $e) {
            throw new Exception("Failed to load post details: " . $e->getMessage());
        }
    }
    
    /**
     * Bulk delete posts with transaction safety
     */
    public function bulkDeletePosts(array $ids)
    {
        try {
            DB::beginTransaction();
            
            $deletedCount = Post::whereIn('id', $ids)->delete();
            
            DB::commit();
            return $deletedCount;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to bulk delete posts: " . $e->getMessage());
        }
    }
    
    /**
     * Clone a post
     */
    public function clonePost(Post $post)
    {
        try {
            DB::beginTransaction();
            
            $clonedPost = $post->replicate();
            $clonedPost->title = $post->title . ' (Copy)';
            $clonedPost->created_at = now();
            $clonedPost->updated_at = now();
            $clonedPost->save();
            
            DB::commit();
            return $clonedPost;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to clone post: " . $e->getMessage());
        }
    }
    
    /**
     * Toggle post published status
     */
    public function togglePublished(Post $post)
    {
        try {
            DB::beginTransaction();
            
            $post->published = !$post->published;
            $post->save();
            
            DB::commit();
            return $post;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Failed to toggle post status: " . $e->getMessage());
        }
    }
    
    /**
     * Get post statistics
     */
    public function getPostStats()
    {
        try {
            return [
                'total' => Post::count(),
                'published' => Post::where('published', true)->count(),
                'draft' => Post::where('published', false)->count(),
                'this_month' => Post::whereMonth('created_at', now()->month)->count(),
            ];
        } catch (Exception $e) {
            throw new Exception("Failed to fetch post statistics: " . $e->getMessage());
        }
    }
}


</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-layout-wtf"></i> Frontend Page Components
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
    const [selectedPosts, setSelectedPosts] = useState([]);
    
    // FOR SERVICE INTEGRATION: Bulk delete using service endpoint
    const handleBulkDelete = () => {
        if (selectedPosts.length === 0) return;
        
        if (confirm(`Delete ${selectedPosts.length} posts?`)) {
            router.post('/posts/bulk-delete', {
                ids: selectedPosts
            }, {
                onSuccess: () => {
                    setSelectedPosts([]);
                    // Refresh the page data
                    router.reload({ only: ['posts', 'pagination'] });
                }
            });
        }
    };
    
    // FOR SERVICE INTEGRATION: Export posts using service endpoint
    const handleExport = () => {
        router.get('/posts/export', {
            ...filters
        }, {
            preserveState: true
        });
    };
    
    // FOR SERVICE INTEGRATION: Clone a post
    const handleClonePost = (postId) => {
        router.post(`/posts/${postId}/clone`, {}, {
            onSuccess: () => {
                // Refresh the page data
                router.reload({ only: ['posts', 'pagination'] });
            }
        });
    };
    
    // FOR SERVICE INTEGRATION: Toggle published status
    const handleTogglePublished = (postId) => {
        router.put(`/posts/${postId}/toggle-published`, {}, {
            onSuccess: () => {
                // Refresh the page data
                router.reload({ only: ['posts'] });
            }
        });
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
            
            {/* Action buttons using service endpoints */}
            &lt;div className="d-flex gap-2 mb-3"&gt;
                &lt;button 
                    className="btn btn-danger"
                    onClick={handleBulkDelete}
                    disabled={selectedPosts.length === 0}
                &gt;
                    Delete Selected ({selectedPosts.length})
                &lt;/button&gt;
                &lt;button 
                    className="btn btn-outline-primary"
                    onClick={handleExport}
                &gt;
                    &lt;i className="bi bi-download"&gt;&lt;/i&gt; Export
                &lt;/button&gt;
            &lt;/div&gt;
            
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
                        &lt;th&gt;
                            &lt;input 
                                type="checkbox" 
                                onChange={(e) => {
                                    if (e.target.checked) {
                                        setSelectedPosts(posts.map(p => p.id));
                                    } else {
                                        setSelectedPosts([]);
                                    }
                                }}
                            /&gt;
                        &lt;/th&gt;
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
                                &lt;input 
                                    type="checkbox" 
                                    checked={selectedPosts.includes(post.id)}
                                    onChange={(e) => {
                                        if (e.target.checked) {
                                            setSelectedPosts([...selectedPosts, post.id]);
                                        } else {
                                            setSelectedPosts(selectedPosts.filter(id => id !== post.id));
                                        }
                                    }}
                                /&gt;
                            &lt;/td&gt;
                            &lt;td&gt;{post.title}&lt;/td&gt;
                            &lt;td&gt;{new Date(post.created_at).toLocaleDateString()}&lt;/td&gt;
                            &lt;td&gt;
                                &lt;button 
                                    className={`btn btn-sm ${post.published ? 'btn-success' : 'btn-secondary'}`}
                                    onClick={() => handleTogglePublished(post.id)}
                                &gt;
                                    {post.published ? 'Published' : 'Draft'}
                                &lt;/button&gt;
                            &lt;/td&gt;
                            &lt;td&gt;
                                &lt;a href={`/posts/${post.id}/edit`} className="btn btn-outline-primary btn-sm me-1"&gt;
                                    &lt;i className="bi bi-pencil"&gt;&lt;/i&gt; Edit
                                &lt;/a&gt;
                                &lt;button 
                                    className="btn btn-outline-secondary btn-sm me-1"
                                    onClick={() => handleClonePost(post.id)}
                                &gt;
                                    &lt;i className="bi bi-copy"&gt;&lt;/i&gt; Clone
                                &lt;/button&gt;
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
        &lt;/div&gt;
    );
}</code></pre>
                        </div>
                    </div>
                </section>