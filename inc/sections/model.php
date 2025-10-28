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
    return $query->where('views', '&gt;=', $minViews);
}

// FOR RECENT: Get recently created posts
public function scopeRecent($query, $days = 7)
{
    return $query->where('created_at', '&gt;=', now()->subDays($days));
}</code></pre>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-layout-wtf"></i> Frontend Integration with Inertia.js
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is Inertia.js?</h6>
                <p>Inertia.js is a modern approach to building classic server-driven web apps that allows you to create fully client-side rendered, single-page apps without much of the complexity of modern SPAs.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-lightbulb"></i> Inertia.js Implementation Details</h6>
                <p><strong>File Path:</strong> <code>resources/js/pages/Posts/Index.jsx</code><br>
                <strong>Integration:</strong> Laravel controllers pass data to React components via Inertia</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR INERTIA.JS INTEGRATION</h6>
                <p><strong>Files:</strong> <code>app/Http/Controllers/PostController.php</code> and <code>resources/js/pages/Posts/Index.jsx</code> - Data passing between backend and frontend</p>
            </div>
            
            <pre><code>// FOR SERVICE INTEGRATION: Bulk delete using service endpoint
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
};</code></pre>
        </div>
    </div>
</section>