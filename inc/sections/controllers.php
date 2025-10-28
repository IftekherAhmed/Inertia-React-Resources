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
                <strong>Dependencies:</strong> Requires <code>Post</code> model, <code>PostRequest</code> for validation, and <code>PostService</code> for business logic</p>
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
use App\Services\PostService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

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

        try {
            // FOR SEARCH + FILTER + SORT: Apply all operations at once using service
            $posts = $this->postService->getFilteredPosts($filters);

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
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to load posts: ' . $e->getMessage());
        }
    }

    // FOR CREATE: Use this to show create form
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    // FOR STORE: Use this to create new resource with file upload through service
    public function store(PostRequest $request)
    {
        try {
            $postData = $request->validated();
            
            // FOR FILE UPLOAD: Handle file upload if present through service
            if ($request->hasFile('image')) {
                $postData['image'] = $request->file('image');
            }
            
            $post = $this->postService->createPost($postData);

            return redirect()->route('posts.index')->with('success', 'Post created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to create post: ' . $e->getMessage())->withInput();
        }
    }

    // FOR EDIT: Use this to show edit form
    public function edit(Post $post)
    {
        try {
            $postWithDetails = $this->postService->getPostWithDetails($post);
            
            return Inertia::render('Posts/Edit', [
                'post' => $postWithDetails
            ]);
        } catch (Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Failed to load post: ' . $e->getMessage());
        }
    }

    // FOR UPDATE: Use this to update resource with file upload through service
    public function update(PostRequest $request, Post $post)
    {
        try {
            $postData = $request->validated();
            
            // FOR FILE UPLOAD UPDATE: Handle new file if present through service
            if ($request->hasFile('image')) {
                $postData['image'] = $request->file('image');
            }
            
            $updatedPost = $this->postService->updatePost($post, $postData);

            return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to update post: ' . $e->getMessage())->withInput();
        }
    }

    // FOR DELETE: Use this to delete resource with file cleanup through service
    public function destroy(Post $post)
    {
        try {
            $this->postService->deletePost($post);
            
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete post: ' . $e->getMessage());
        }
    }

    // FOR MODAL VIEW: Use this to show single resource
    public function show(Post $post)
    {
        try {
            $postWithDetails = $this->postService->getPostWithDetails($post);
            
            return Inertia::render('Posts/Show', [
                'post' => $postWithDetails
            ]);
        } catch (Exception $e) {
            return redirect()->route('posts.index')->with('error', 'Failed to load post: ' . $e->getMessage());
        }
    }

    // FOR BULK DELETE: Use service to handle bulk operations
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:posts,id'
        ]);

        try {
            $deletedCount = $this->postService->bulkDeletePosts($request->ids);
            
            return response()->json([
                'message' => "Successfully deleted {$deletedCount} posts"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to delete posts: ' . $e->getMessage()
            ], 500);
        }
    }

    // FOR EXPORT: Use service to handle export operations
    public function export(Request $request)
    {
        $filters = [
            'search' => $request->search,
            'published' => $request->published,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'sort_by' => $request->sort_by ?? 'id',
            'sort_direction' => $request->sort_direction ?? 'desc',
        ];

        try {
            return $this->postService->exportPosts($filters);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to export posts: ' . $e->getMessage());
        }
    }

    // FOR CLONE: Use service to handle cloning operations
    public function clonePost(Post $post)
    {
        try {
            $clonedPost = $this->postService->clonePost($post);
            
            return response()->json([
                'message' => 'Post cloned successfully',
                'post' => $clonedPost
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to clone post: ' . $e->getMessage()
            ], 500);
        }
    }

    // FOR TOGGLE PUBLISHED: Use service to handle status toggle
    public function togglePublished(Post $post)
    {
        try {
            $updatedPost = $this->postService->togglePublished($post);
            
            return response()->json([
                'message' => 'Post status updated successfully',
                'post' => $updatedPost
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to update post status: ' . $e->getMessage()
            ], 500);
        }
    }

    // FOR STATS: Use service to get post statistics
    public function stats()
    {
        try {
            $stats = $this->postService->getPostStats();
            
            return response()->json($stats);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch statistics: ' . $e->getMessage()
            ], 500);
        }
    }
}</code></pre>
        </div>
    </div>
</section>