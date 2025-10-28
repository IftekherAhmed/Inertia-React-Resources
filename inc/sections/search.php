<section id="search" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-search"></i>
                            Search Operations
                        </h1>
                        <p class="page-subtitle">Implementation patterns for text-based searching</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> Search Implementation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is Search?</h6>
                                <p>Search functionality allows users to find specific records by searching across multiple fields in your database.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Search Implementation Details</h6>
                                <p><strong>Backend:</strong> <code>app/Models/Post.php</code> scopeSearch method<br>
                                <strong>Frontend:</strong> <code>resources/js/pages/Posts/Index.jsx</code> handleSearch function</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR SEARCH</h6>
                                <p><strong>Files:</strong> <code>app/Models/Post.php</code> and <code>resources/js/pages/Posts/Index.jsx</code> - Backend and frontend implementation</p>
                            </div>
                            <h5>Backend Implementation</h5>
                            <pre><code>// Search scope - use when you need to search across multiple fields
public function scopeSearch($query, $search)
{
    if (!$search) return $query;
    
    return $query->where(function($q) use ($search) {
        $q->where('title', 'like', "%{$search}%")
          ->orWhere('content', 'like', "%{$search}%");
    });
}</code></pre>
                            
                            <h5>Frontend Implementation</h5>
                            <pre><code>const [search, setSearch] = useState(filters.search || '');

const handleSearch = (value) => {
    setSearch(value);
    router.get('/posts', { ...filters, search: value, page: 1 }, {
        preserveState: true,
        replace: true
    });
};</code></pre>
                        </div>
                    </div>
                </section>