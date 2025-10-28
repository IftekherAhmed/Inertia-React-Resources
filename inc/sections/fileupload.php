<section id="fileupload" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-cloud-upload"></i>
                            File Upload
                        </h1>
                        <p class="page-subtitle">Implementation patterns for handling file uploads</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> File Upload Implementation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is File Upload?</h6>
                                <p>File upload functionality allows users to attach files to records, with proper storage and cleanup.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> File Upload Implementation Details</h6>
                                <p><strong>Backend:</strong> <code>app/Http/Controllers/PostController.php</code> store/update methods<br>
                                <strong>Frontend:</strong> <code>resources/js/pages/Posts/Create.jsx</code> and <code>Edit.jsx</code> form components</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR FILE UPLOAD</h6>
                                <p><strong>Files:</strong> <code>app/Http/Controllers/PostController.php</code> - Secure file handling with cleanup</p>
                            </div>
                            <h5>Backend Implementation</h5>
                            <pre><code>// FOR FILE UPLOAD: Handle file upload if present
if ($request->hasFile('image')) {
    $path = $request->file('image')->store('posts', 'public');
    $post->image_path = $path;
}

// FOR FILE UPLOAD UPDATE: Handle new file and delete old one
if ($request->hasFile('image')) {
    // Delete old file
    if ($post->image_path) {
        Storage::disk('public')->delete($post->image_path);
    }
    // Store new file
    $path = $request->file('image')->store('posts', 'public');
    $post->image_path = $path;
}</code></pre>
                            
                            <h5>Frontend Implementation</h5>
                            <pre><code>// FOR FILE UPLOAD: Use FormData for file uploads
const formData = new FormData();
formData.append('title', data.title);
formData.append('content', data.content);
formData.append('published', data.published ? '1' : '0');
if (data.image) {
    formData.append('image', data.image);
}

submitPost('/posts', {
    data: formData,
    forceFormData: true,
});</code></pre>
                        </div>
                    </div>
                </section>