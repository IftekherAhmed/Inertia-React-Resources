<section id="sort" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-arrow-down-up"></i>
                            Sort Operations
                        </h1>
                        <p class="page-subtitle">Implementation patterns for sorting data</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> Sort Implementation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is Sorting?</h6>
                                <p>Sorting allows users to arrange data in ascending or descending order based on specific fields.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Sort Implementation Details</h6>
                                <p><strong>Backend:</strong> <code>app/Models/Post.php</code> scopeSortBy method<br>
                                <strong>Frontend:</strong> <code>resources/js/pages/Posts/Index.jsx</code> handleSort function</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR SORT</h6>
                                <p><strong>Files:</strong> <code>app/Models/Post.php</code> and <code>resources/js/pages/Posts/Index.jsx</code> - Implementation with validation</p>
                            </div>
                            <h5>Backend Implementation</h5>
                            <pre><code>public function scopeSortBy($query, $sortBy = 'id', $sortDirection = 'desc')
{
    $allowedSorts = ['id', 'title', 'created_at'];
    $sortBy = in_array($sortBy, $allowedSorts) ? $sortBy : 'id';
    $sortDirection = in_array(strtolower($sortDirection), ['asc', 'desc']) ? $sortDirection : 'desc';
    
    return $query->orderBy($sortBy, $sortDirection);
}</code></pre>
                            
                            <h5>Frontend Implementation</h5>
                            <pre><code>// In your component:
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
};</code></pre>
                        </div>
                    </div>
                </section>