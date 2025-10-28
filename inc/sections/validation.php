<section id="validation" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-shield-check"></i>
                            Validation
                        </h1>
                        <p class="page-subtitle">Form validation and security measures</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-file-earmark-check"></i> Form Validation
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What is Validation?</h6>
                                <p>Validation ensures that user-submitted data meets specific criteria before being processed or stored.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Validation Implementation Details</h6>
                                <p><strong>File Path:</strong> <code>app/Http/Requests/PostRequest.php</code><br>
                                <strong>Usage:</strong> Imported in <code>PostController</code> methods</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR VALIDATION</h6>
                                <p><strong>File:</strong> <code>app/Http/Requests/PostRequest.php</code> - Form Request classes for validation</p>
                            </div>
                            <h5>Create Form Request</h5>
                            <div class="file-path">app/Http/Requests/PostRequest.php</div>
                            <pre><code>php artisan make:request PostRequest</code></pre>
                            
                            <h5>Form Request Implementation</h5>
                            <pre><code>&lt;?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array&lt;string, \Illuminate\Contracts\Validation\ValidationRule|array|string&gt;
     */
    // FOR VALIDATION: Use these rules for store and update
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean',
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array&lt;string, string&gt;
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A post title is required',
            'content.required' => 'Post content is required',
            'image.image' => 'The file must be an image',
            'image.max' => 'The image may not be greater than 2MB',
        ];
    }
}</code></pre>
                        </div>
                    </div>
                </section>