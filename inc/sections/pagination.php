<section id="pagination" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-arrow-repeat"></i>
                            Pagination Operations
                        </h1>
                        <p class="page-subtitle">Implementation patterns for paginating data</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> Pagination Implementation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is Pagination?</h6>
                                <p>Pagination breaks large datasets into smaller pages, improving performance and user experience.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Pagination Implementation Details</h6>
                                <p><strong>Backend:</strong> <code>app/Http/Controllers/PostController.php</code> index method<br>
                                <strong>Frontend:</strong> <code>resources/js/pages/Posts/Index.jsx</code> handlePageChange function</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR PAGINATION</h6>
                                <p><strong>Files:</strong> <code>app/Http/Controllers/PostController.php</code> - Handling with "show all" option</p>
                            </div>
                            <h5>Backend Implementation</h5>
                            <pre><code>public function index(Request $request)
{
    $perPage = $request->input('per_page', 10);
    $page = $request->input('page', 1);
    
    if ($perPage === 'all' || $perPage == 0) {
        $results = Post::filteredAndSorted($filters)->get();
        $pagination = [
            'current_page' => 1,
            'last_page' => 1,
            'per_page' => 'all',
            'total' => $results->count(),
        ];
        $postList = $results;
    } else {
        $results = Post::filteredAndSorted($filters)->paginate($perPage, ['*'], 'page', $page);
        $pagination = [
            'current_page' => $results->currentPage(),
            'last_page' => $results->lastPage(),
            'per_page' => $results->perPage(),
            'total' => $results->total(),
        ];
        $postList = $results->items();
    }
    
    return Inertia::render('Post/Index', [
        'post_list' => $postList,
        'pagination' => $pagination,
    ]);
}</code></pre>
                        </div>
                    </div>
                </section>