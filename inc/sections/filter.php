<section id="filter" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-funnel"></i>
                            Filter Operations
                        </h1>
                        <p class="page-subtitle">Implementation patterns for filtering data</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> Filter Implementation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is Filtering?</h6>
                                <p>Filtering allows users to narrow down results based on specific criteria such as status, date ranges, or categories.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Filter Implementation Details</h6>
                                <p><strong>Backend:</strong> <code>app/Models/Post.php</code> scopePublished and scopeDateRange methods<br>
                                <strong>Frontend:</strong> <code>resources/js/pages/Posts/Index.jsx</code> filter handling functions</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR FILTER</h6>
                                <p><strong>Files:</strong> <code>app/Models/Post.php</code> - Boolean and date range filtering</p>
                            </div>
                            <h5>Boolean Filter</h5>
                            <pre><code>public function scopePublished($query, $published)
{
    if (is_null($published)) return $query;
    return $query->where('published', $published);
}</code></pre>
                            
                            <h5>Date Range Filter</h5>
                            <pre><code>public function scopeDateRange($query, $startDate, $endDate)
{
    if ($startDate) $query->whereDate('created_at', '>=', $startDate);
    if ($endDate) $query->whereDate('created_at', '<=', $endDate);
    return $query;
}</code></pre>
                        </div>
                    </div>
                </section>