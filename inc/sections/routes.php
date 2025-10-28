<section id="routes" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-signpost"></i>
            Routes
        </h1>
        <p class="page-subtitle">Route definitions for your application endpoints</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Defining Application Routes
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What are Routes?</h6>
                <p>Routes define the URLs that users can access in your application and map those URLs to specific controller methods.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Route Implementation Details</h6>
                <p><strong>File Path:</strong> <code>routes/web.php</code><br>
                <strong>Best Practice:</strong> Use resource routes for standard CRUD operations and additional routes for service endpoints</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR RESOURCE ROUTES</h6>
                <p><strong>File:</strong> <code>routes/web.php</code> - Standard CRUD routes with additional service endpoints</p>
            </div>
            <h5>Resource Routes</h5>
            <div class="file-path">routes/web.php</div>
            <pre><code>&lt;?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Standard resource routes for CRUD operations
Route::resource('posts', PostController::class);

// Additional service endpoints for ShadCN UI integration
Route::post('/posts/bulk-delete', [PostController::class, 'bulkDelete']);
Route::get('/posts/export', [PostController::class, 'export']);
Route::post('/posts/{post}/clone', [PostController::class, 'clonePost']);
Route::put('/posts/{post}/toggle-published', [PostController::class, 'togglePublished']);
Route::get('/posts/stats', [PostController::class, 'stats']);</code></pre>
            
            <p>This route configuration creates all the standard CRUD routes plus additional service endpoints:</p>
            <pre><code>GET    /posts          - Index (list all posts)
GET    /posts/create   - Create form
POST   /posts          - Store new post
GET    /posts/{post}   - Show single post
GET    /posts/{post}/edit - Edit form
PUT    /posts/{post}   - Update post
DELETE /posts/{post}   - Delete post
POST   /posts/bulk-delete - Bulk delete posts
GET    /posts/export   - Export posts to CSV
POST   /posts/{post}/clone - Clone a post
PUT    /posts/{post}/toggle-published - Toggle published status
GET    /posts/stats    - Get post statistics</code></pre>
            
            <h5>API Routes for ShadCN UI Components</h5>
            <p>For more complex ShadCN UI components that require API calls, you might also want to define API routes:</p>
            <div class="file-path">routes/api.php</div>
            <pre><code>&lt;?php

use App\Http\Controllers\Api\PostController as ApiPostController;
use Illuminate\Support\Facades\Route;

// API routes for frontend components
Route::prefix('v1')->group(function () {
    Route::apiResource('posts', ApiPostController::class);
    Route::post('/posts/bulk-delete', [ApiPostController::class, 'bulkDelete']);
    Route::get('/posts/export', [ApiPostController::class, 'export']);
    Route::post('/posts/{post}/clone', [ApiPostController::class, 'clonePost']);
    Route::put('/posts/{post}/toggle-published', [ApiPostController::class, 'togglePublished']);
    Route::get('/posts/stats', [ApiPostController::class, 'stats']);
});</code></pre>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-lightning"></i> Inertia.js Route Configuration
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is Inertia.js Route Handling?</h6>
                <p>Inertia.js handles routing by intercepting link clicks and form submissions, making AJAX requests to your Laravel routes and updating the page dynamically.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Inertia.js Route Details</h6>
                <p><strong>Implementation:</strong> Routes return Inertia responses from controllers<br>
                <strong>Frontend:</strong> React components receive data via Inertia's page props</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR INERTIA.JS ROUTES</h6>
                <p><strong>Files:</strong> <code>routes/web.php</code> and <code>app/Http/Controllers/PostController.php</code> - Routes that return Inertia responses</p>
            </div>
            
            <h5>Inertia.js Controller Methods</h5>
            <p>Controller methods that return Inertia responses for ShadCN UI components:</p>
            <pre><code>// FOR LISTING WITH ALL FEATURES: Use this for index page with search, filter, sort, pagination
public function index(Request $request)
{
    $filters = [
        'search' => $request->search,
        'published' => $request->published,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'sort_by' => $request->sort_by ?? 'id',
        'sort_direction' => $request->sort_direction ?? 'desc',
        'per_page' => $request->per_page ?? 10,
    ];

    try {
        // FOR SEARCH + FILTER + SORT: Apply all operations at once using service
        $posts = $this->postService->getFilteredPosts($filters);

        return Inertia::render('Posts/Index', [
            'posts' => $posts->items(),
            'filters' => $filters,
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Failed to load posts: ' . $e->getMessage());
    }
}

// FOR CREATE: Use this to show create form
public function create()
{
    return Inertia::render('Posts/Create');
}

// FOR EDIT: Use this to show edit form
public function edit(Post $post)
{
    try {
        $postWithDetails = $this->postService->getPostWithDetails($post);
        
        return Inertia::render('Posts/Edit', [
            'post' => $postWithDetails
        ]);
    } catch (Exception $e) {
        return redirect()->route('posts.index')->with('error', 'Failed to load post: ' . $e->getMessage());
    }
}</code></pre>
        </div>
    </div>
</section>