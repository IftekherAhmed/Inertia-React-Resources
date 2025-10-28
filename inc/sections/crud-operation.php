<section id="crud" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-pencil-square"></i>
                            CRUD Operations
                        </h1>
                        <p class="page-subtitle">Complete implementation patterns for all operations with file paths</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-file-earmark-plus"></i> Create/Edit Form with Validation
                                </div>
                                <div class="card-body">
                                    <div class="info-callout">
                                        <h6><i class="bi bi-info-circle"></i> Form Component Details</h6>
                                        <p><strong>Create Form Path:</strong> <code>resources/js/pages/Posts/Create.jsx</code><br>
                                        <strong>Edit Form Path:</strong> <code>resources/js/pages/Posts/Edit.jsx</code><br>
                                        <strong>Validation:</strong> Uses <code>PostRequest</code> on backend</p>
                                    </div>
                                    
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR FORM</h6>
                                        <p><strong>Files:</strong> <code>resources/js/pages/Posts/Create.jsx</code> and <code>Edit.jsx</code> - Use form hook for state management and validation</p>
                                    </div>
                                    <pre><code>import { useForm } from '@inertiajs/react';

export default function PostForm({ post = null }) {
    // FOR FORM: Use form hook for form state management
    const { data, setData, post: submitPost, put, processing, errors } = useForm({
        title: post?.title || '',
        content: post?.content || '',
        image: null,
        published: post?.published || false,
    });

    // FOR SUBMIT: Handle form submission with file upload
    const handleSubmit = (e) =&gt; {
        e.preventDefault();
        
        // FOR FILE UPLOAD: Use FormData for file uploads
        const formData = new FormData();
        formData.append('title', data.title);
        formData.append('content', data.content);
        formData.append('published', data.published ? '1' : '0');
        if (data.image) {
            formData.append('image', data.image);
        }

        if (post) {
            // Update existing post
            put(`/posts/${post.id}`, {
                data: formData,
                forceFormData: true,
            });
        } else {
            // Create new post
            submitPost('/posts', {
                data: formData,
                forceFormData: true,
            });
        }
    };

    return (
        &lt;form onSubmit={handleSubmit}&gt;
            {/* FOR VALIDATION: Display validation errors */}
            {errors.title && &lt;div className="error"&gt;{errors.title}&lt;/div&gt;}
            {errors.content && &lt;div className="error"&gt;{errors.content}&lt;/div&gt;}
            {errors.image && &lt;div className="error"&gt;{errors.image}&lt;/div&gt;}

            &lt;input
                type="text"
                value={data.title}
                onChange={(e) =&gt; setData('title', e.target.value)}
                placeholder="Post title"
            /&gt;

            &lt;textarea
                value={data.content}
                onChange={(e) =&gt; setData('content', e.target.value)}
                placeholder="Post content"
            /&gt;

            {/* FOR FILE UPLOAD: File input */}
            &lt;input
                type="file"
                onChange={(e) =&gt; setData('image', e.target.files?.[0] || null)}
            /&gt;

            &lt;label&gt;
                &lt;input
                    type="checkbox"
                    checked={data.published}
                    onChange={(e) =&gt; setData('published', e.target.checked)}
                /&gt;
                Published
            &lt;/label&gt;

            &lt;button type="submit" disabled={processing}&gt;
                {post ? 'Update Post' : 'Create Post'}
            &lt;/button&gt;
        &lt;/form&gt;
    );
}</code></pre>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-cloud-upload"></i>
                                    File Uploading System
                                </div>
                                <div class="card-body">
                                    <div class="info-callout">
                                        <h6><i class="bi bi-info-circle"></i> File Upload Implementation</h6>
                                        <p><strong>Backend Controller:</strong> <code>app/Http/Controllers/PostController.php</code><br>
                                        <strong>Frontend Forms:</strong> <code>resources/js/pages/Posts/Create.jsx</code> and <code>Edit.jsx</code><br>
                                        <strong>Storage Path:</strong> <code>storage/app/public/posts/</code></p>
                                    </div>
                                    
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR FILE UPLOAD</h6>
                                        <p><strong>Files:</strong> <code>app/Http/Controllers/PostController.php</code> - Backend handling with cleanup on deletion</p>
                                    </div>
                                    <h5 class="text-primary">Backend File Handling</h5>
                                    <pre><code>// In Controller
if ($request-&gt;hasFile('image')) {
    $path = $request-&gt;file('image')-&gt;store('posts', 'public');
    $post-&gt;image_path = $path;
}

// For updates with cleanup
if ($request-&gt;hasFile('image')) {
    // Delete old file
    if ($post-&gt;image_path) {
        Storage::disk('public')-&gt;delete($post-&gt;image_path);
    }
    // Store new file
    $path = $request-&gt;file('image')-&gt;store('posts', 'public');
    $post-&gt;image_path = $path;
}

// For deletion with cleanup
if ($post-&gt;image_path) {
    Storage::disk('public')-&gt;delete($post-&gt;image_path);
}</code></pre>
                                    
                                    <div class="alert-pattern mt-3">
                                        <h6><i class="bi bi-lightning"></i> FOR FILE DISPLAY</h6>
                                        <p><strong>Files:</strong> <code>resources/js/pages/Posts/Index.jsx</code> and <code>Show.jsx</code> - Frontend display of uploaded images</p>
                                    </div>
                                    <h5 class="text-primary">Frontend File Display</h5>
                                    <pre><code>// Display uploaded images
{post.image_path && (
    &lt;img 
        src={`/storage/${post.image_path}`} 
        alt={post.title}
        className="img-fluid rounded"
    /&gt;
)}</code></pre>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-window"></i>
                                    Modal View Component
                                </div>
                                <div class="card-body">
                                    <div class="info-callout">
                                        <h6><i class="bi bi-info-circle"></i> Modal Component Details</h6>
                                        <p><strong>File Path:</strong> <code>resources/js/pages/Posts/Show.jsx</code><br>
                                        <strong>Integration:</strong> Called from <code>PostController@show</code> method</p>
                                    </div>
                                    
                                    <div class="alert-pattern">
                                        <h6><i class="bi bi-lightning"></i> FOR MODAL VIEW</h6>
                                        <p><strong>File:</strong> <code>resources/js/pages/Posts/Show.jsx</code> - Implementation for detail views in modal dialogs</p>
                                    </div>
                                    <pre><code>import { Head } from '@inertiajs/react';

export default function PostShow({ post }) {
    return (
        &lt;div&gt;
            &lt;Head title={post.title} /&gt;
            
            &lt;h1&gt;{post.title}&lt;/h1&gt;
            
            {post.image_path && (
                &lt;img 
                    src={`/storage/${post.image_path}`} 
                    alt={post.title}
                    className="img-fluid rounded"
                /&gt;
            )}
            
            &lt;p&gt;{post.content}&lt;/p&gt;
        &lt;/div&gt;
    );
}

</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>