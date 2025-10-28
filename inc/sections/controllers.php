<section id="controller" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-server"></i>
                            Controller
                        </h1>
                        <p class="page-subtitle">Laravel controllers with all CRUD operations</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code-square"></i> Creating Controllers
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are Controllers?</h6>
                                <p>Controllers handle incoming HTTP requests, process data, and return appropriate responses. They act as intermediaries between models and views.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Controller Implementation Details</h6>
                                <p><strong>File Path:</strong> <code>app/Http/Controllers/PostController.php</code><br>
                                <strong>Dependencies:</strong> Requires <code>Post</code> model and <code>PostRequest</code> for validation</p>
                            </div>
                            
                            <div class="alert-pattern">
                                <h6><i class="bi bi-lightning"></i> FOR LISTING WITH ALL FEATURES</h6>
                                <p><strong>File:</strong> <code>app/Http/Controllers/PostController.php</code> - Complete implementation with search, filter, sort, pagination</p>
                            </div>
                            <h5>Controller Structure</h5>
                            <div class="file-path">app/Http/Controllers/PostController.php</div>
                            <pre><code>&lt;?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // FOR LISTING WITH ALL FEATURES: Use this for index page with search, filter, sort, pagination
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

        // FOR SEARCH + FILTER + SORT: Apply all operations at once
        $posts = Post::search($filters['search'])
                    ->published($filters['published'])
                    ->dateRange($filters['start_date'], $filters['end_date'])
                    ->sortBy($filters['sort_by'], $filters['sort_direction'])
                    ->paginate($filters['per_page']);

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
    }

    // FOR CREATE: Use this to show create form
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    // FOR STORE: Use this to create new resource with file upload
    public function store(PostRequest $request)
    {
        $post = new Post();
        
        // FOR FILE UPLOAD: Handle file upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->image_path = $path;
        }
        
        $post->title = $request->title;
        $post->content = $request->content;
        $post->published = $request->published ?? false;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    // FOR EDIT: Use this to show edit form
    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }

    // FOR UPDATE: Use this to update resource with file upload
    public function update(PostRequest $request, Post $post)
    {
        // FOR FILE UPLOAD UPDATE: Handle new file and delete old one
        if ($request->hasFile('image')) {
            // Delete old file
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            // Store new file
            $path = $request->file('image')->store('posts', 'public');
            $post->image_path = $path;
        }
        
        $post->title = $request->title;
        $post->content = $request->content;
        $post->published = $request->published ?? false;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    // FOR DELETE: Use this to delete resource with file cleanup
    public function destroy(Post $post)
    {
        // FOR FILE CLEANUP: Delete associated file
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted!');
    }

    // FOR MODAL VIEW: Use this to show single resource
    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            'post' => $post
        ]);
    }
}</code></pre>
                        </div>
                    </div>
                </section>