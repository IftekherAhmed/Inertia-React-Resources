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

// Additional service endpoints
Route::post('/posts/bulk-delete', [PostController::class, 'bulkDelete']);
Route::get('/posts/export', [PostController::class, 'export']);
Route::post('/posts/import', [PostController::class, 'import']);
Route::post('/posts/{post}/clone', [PostController::class, 'clonePost']);
Route::put('/posts/{post}/toggle-published', [PostController::class, 'togglePublished']);</code></pre>
                            
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
POST   /posts/import   - Import posts from CSV
POST   /posts/{post}/clone - Clone a post
PUT    /posts/{post}/toggle-published - Toggle published status</code></pre>
                        </div>
                    </div>
                </section>