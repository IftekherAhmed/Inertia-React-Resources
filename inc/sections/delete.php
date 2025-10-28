<section id="delete" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-trash"></i>
                            Delete Operations
                        </h1>
                        <p class="page-subtitle">Implementation patterns for deleting data</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> Delete Implementation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is Delete?</h6>
                                <p>Delete functionality allows users to remove records from the database, with proper cleanup of associated files.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Delete Implementation Details</h6>
                                <p><strong>Backend:</strong> <code>app/Http/Controllers/PostController.php</code> destroy method<br>
                                <strong>Frontend:</strong> <code>resources/js/pages/Posts/Index.jsx</code> handleDelete function</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR DELETE</h6>
                                <p><strong>Files:</strong> <code>app/Http/Controllers/PostController.php</code> - Safe deletion with file cleanup</p>
                            </div>
                            <h5>Backend Implementation</h5>
                            <pre><code>// FOR DELETE: Use this to delete resource with file cleanup
public function destroy(Post $post)
{
    // FOR FILE CLEANUP: Delete associated file
    if ($post->image_path) {
        Storage::disk('public')->delete($post->image_path);
    }
    
    $post->delete();
    return redirect()->route('posts.index')->with('success', 'Post deleted!');
}</code></pre>
                            
                            <h5>Frontend Implementation</h5>
                            <pre><code>// FOR DELETE: Handler with confirmation
const handleDelete = (id) => {
    if (confirm('Are you sure?')) {
        router.delete(`/posts/${id}`);
    }
};</code></pre>
                        </div>
                    </div>
                </section>