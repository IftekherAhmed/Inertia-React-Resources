<section id="model" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-table"></i>
                            Model
                        </h1>
                        <p class="page-subtitle">Eloquent models with scopes, traits, and relationships</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code-square"></i> Creating Eloquent Models
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are Eloquent Models?</h6>
                                <p>Eloquent is Laravel's ActiveRecord implementation for working with your database. Each database table has a corresponding "Model" which is used to interact with that table.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Model Implementation Details</h6>
                                <p><strong>File Location:</strong> <code>app/Models/Post.php</code><br>
                                <strong>Best Practice:</strong> Place all query scopes in the corresponding model file for maintainability</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Create Model</h6>
                                    <div class="file-path">app/Models/Post.php</div>
                                    <pre><code>php artisan make:model Models/Post</code></pre>
                                    
                                    <p>Example model structure:</p>
                                    <pre><code>&lt;?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sluggable;
use App\Traits\HasImage;
use App\Traits\Viewable;

class Post extends Model
{
    use HasFactory, Sluggable, HasImage, Viewable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array&lt;int, string&gt;
     */
    protected $fillable = [
        'title',
        'content',
        'image_path',
        'published',
        'slug',
        'views',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array&lt;string, string&gt;
     */
    protected $casts = [
        'published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-search"></i> Model Scopes for Data Operations
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are Model Scopes?</h6>
                                <p>Model scopes are custom query builders that allow you to define common query constraints as methods on your Eloquent models for reusability.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-lightbulb"></i> Scope Implementation Best Practices</h6>
                                <p>Create separate scopes for each operation type (search, filter, sort) to maintain clean, reusable code.</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title">
                                        <i class="bi bi-search"></i> Search Scope
                                    </div>
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR SEARCH</h6>
                                        <p><strong>File:</strong> <code>app/Models/Post.php</code> - Use this scope when you need to search across multiple fields</p>
                                    </div>
                                    <pre><code>// FOR SEARCH: Use this scope when you need to search across multiple fields
public function scopeSearch($query, $search)
{
    if (!$search) return $query;
    
    return $query->where(function($q) use ($search) {
        $q->where('title', 'like', "%{$search}%")
          ->orWhere('content', 'like', "%{$search}%");
    });
}</code></pre>
                                    
                                    <div class="section-title">
                                        <i class="bi bi-funnel"></i> Filter by Published Status
                                    </div>
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR FILTER</h6>
                                        <p><strong>File:</strong> <code>app/Models/Post.php</code> - Use this scope when you need boolean filtering</p>
                                    </div>
                                    <pre><code>// FOR FILTER: Use this scope when you need boolean filtering
public function scopePublished($query, $published)
{
    if (is_null($published)) return $query;
    return $query->where('published', $published);
}</code></pre>
                                </div>
                                <div class="col-md-12">
                                    <div class="section-title">
                                        <i class="bi bi-arrow-down-up"></i> Sort Scope
                                    </div>
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR SORT</h6>
                                        <p><strong>File:</strong> <code>app/Models/Post.php</code> - Use this scope when you need sorting functionality</p>
                                    </div>
                                    <pre><code>// FOR SORT: Use this scope when you need sorting functionality
public function scopeSortBy($query, $sortBy = 'id', $sortDirection = 'desc')
{
    $allowedSorts = ['id', 'title', 'created_at'];
    $sortBy = in_array($sortBy, $allowedSorts) ? $sortBy : 'id';
    $sortDirection = in_array(strtolower($sortDirection), ['asc', 'desc']) ? $sortDirection : 'desc';
    
    return $query->orderBy($sortBy, $sortDirection);
}</code></pre>
                                    
                                    <div class="section-title">
                                        <i class="bi bi-calendar"></i> Date Range Filter
                                    </div>
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR DATE FILTER</h6>
                                        <p><strong>File:</strong> <code>app/Models/Post.php</code> - Use this when you need date range filtering</p>
                                    </div>
                                    <pre><code>// FOR DATE FILTER: Use this when you need date range filtering
public function scopeDateRange($query, $startDate, $endDate)
{
    if ($startDate) $query->whereDate('created_at', '&gt;=', $startDate);
    if ($endDate) $query->whereDate('created_at', '&lt;=', $endDate);
    return $query;
}</code></pre>
                                    
                                    <div class="section-title">
                                        <i class="bi bi-layers"></i> Combined Filter and Sort Scope
                                    </div>
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR COMBINED FILTER & SORT</h6>
                                        <p><strong>File:</strong> <code>app/Models/Post.php</code> - Use this in your index method</p>
                                    </div>
                                    <pre><code>// Combined filter and sort scope - use this in your index method
public function scopeFilteredAndSorted($query, array $filters)
{
    return $query->search($filters['search'] ?? null)
                 ->published($filters['published'] ?? null)
                 ->dateRange($filters['start_date'] ?? null, $filters['end_date'] ?? null)
                 ->sortBy($filters['sort_by'] ?? 'id', $filters['sort_direction'] ?? 'desc');
}

// Additional useful scopes
// FOR TRASHED: Include trashed records in query
public function scopeWithTrashed($query)
{
    return $query->withTrashed();
}

// FOR ONLY TRASHED: Only get trashed records
public function scopeOnlyTrashed($query)
{
    return $query->onlyTrashed();
}

// FOR POPULAR: Get popular posts based on views or other criteria
public function scopePopular($query, $minViews = 100)
{
    return $query->where('views', '>=', $minViews);
}

// FOR RECENT: Get recently created posts
public function scopeRecent($query, $days = 7)
{
    return $query->where('created_at', '>=', now()->subDays($days));
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
    const handleSearch = (value) =&gt; {
        setSearch(value);
        router.get('/posts', { ...filters, search: value, page: 1 }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR FILTER: State and handler for published filter
    const [published, setPublished] = useState(filters.published || '');
    const handlePublishedFilter = (value) =&gt; {
        setPublished(value);
        router.get('/posts', { ...filters, published: value, page: 1 }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR SORT: Handler for sorting
    const handleSort = (field) =&gt; {
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
    const handlePageChange = (page) =&gt; {
        router.get('/posts', { ...filters, page }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR DELETE: Handler with confirmation
    const handleDelete = (id) =&gt; {
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
                onChange={(e) =&gt; handleSearch(e.target.value)}
            /&gt;

            {/* FOR FILTER: Published status filter */}
            &lt;select 
                value={published} 
                onChange={(e) =&gt; handlePublishedFilter(e.target.value)}
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
                                onChange={(e) =&gt; {
                                    if (e.target.checked) {
                                        setSelectedPosts(posts.map(p =&gt; p.id));
                                    } else {
                                        setSelectedPosts([]);
                                    }
                                }}
                            /&gt;
                        &lt;/th&gt;
                        &lt;th onClick={() =&gt; handleSort('title')}&gt;
                            Title {filters.sort_by === 'title' && (
                                filters.sort_direction === 'asc' ? '↑' : '↓'
                            )}
                        &lt;/th&gt;
                        &lt;th onClick={() =&gt; handleSort('created_at')}&gt;
                            Date {filters.sort_by === 'created_at' && (
                                filters.sort_direction === 'asc' ? '↑' : '↓'
                            )}
                        &lt;/th&gt;
                        &lt;th&gt;Status&lt;/th&gt;
                        &lt;th&gt;Actions&lt;/th&gt;
                    &lt;/tr&gt;
                &lt;/thead&gt;
                &lt;tbody&gt;
                    {posts.map((post) =&gt; (
                        &lt;tr key={post.id}&gt;
                            &lt;td&gt;
                                &lt;input 
                                    type="checkbox" 
                                    checked={selectedPosts.includes(post.id)}
                                    onChange={(e) =&gt; {
                                        if (e.target.checked) {
                                            setSelectedPosts([...selectedPosts, post.id]);
                                        } else {
                                            setSelectedPosts(selectedPosts.filter(id =&gt; id !== post.id));
                                        }
                                    }}
                                /&gt;
                            &lt;/td&gt;
                            &lt;td&gt;{post.title}&lt;/td&gt;
                            &lt;td&gt;{new Date(post.created_at).toLocaleDateString()}&lt;/td&gt;
                            &lt;td&gt;
                                &lt;button 
                                    className={`btn btn-sm ${post.published ? 'btn-success' : 'btn-secondary'}`}
                                    onClick={() =&gt; handleTogglePublished(post.id)}
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
                                    onClick={() =&gt; handleClonePost(post.id)}
                                &gt;
                                    &lt;i className="bi bi-copy"&gt;&lt;/i&gt; Clone
                                &lt;/button&gt;
                                &lt;button 
                                    className="btn btn-outline-danger btn-sm"
                                    onClick={() =&gt; handleDelete(post.id)}
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
                {Array.from({ length: pagination.last_page }, (_, i) =&gt; i + 1).map(page =&gt; (
                    &lt;button
                        key={page}
                        onClick={() =&gt; handlePageChange(page)}
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