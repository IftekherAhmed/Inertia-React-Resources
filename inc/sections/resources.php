<section id="resources" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-code-slash"></i>
            Resources
        </h1>
        <p class="page-subtitle">Frontend components and file structure with ShadCN UI</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-folder"></i> React Resources Structure
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What are React Resources?</h6>
                <p>React resources are the frontend components that make up your application's user interface, organized by feature or entity.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Frontend Component Details</h6>
                <p><strong>File Path:</strong> <code>resources/js/pages/Posts/Index.jsx</code><br>
                <strong>Dependencies:</strong> Requires Inertia.js hooks, React state management, and ShadCN UI components</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR LISTING WITH ALL FEATURES</h6>
                <p><strong>File:</strong> <code>resources/js/pages/Posts/Index.jsx</code> - Complete implementation with search, filter, sort, pagination using ShadCN UI</p>
            </div>
            
            <h5>ShadCN UI Installation</h5>
            <p>Before using ShadCN UI components, you need to install and configure them in your project:</p>
            <pre><code>// Install required dependencies
npm install tailwindcss postcss autoprefixer
npm install @radix-ui/react-slot
npm install class-variance-authority
npm install clsx tailwind-merge
npm install lucide-react

// Initialize Tailwind CSS
npx tailwindcss init -p

// Configure tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.js",
    "./resources/**/*.jsx",
    "./resources/**/*.ts",
    "./resources/**/*.tsx",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

// Configure CSS file (resources/css/app.css)
@tailwind base;
@tailwind components;
@tailwind utilities;</code></pre>
            
            <h5>ShadCN UI Component Installation</h5>
            <p>Install ShadCN UI components using the CLI or manually:</p>
            <pre><code>// Using the ShadCN UI CLI
npx shadcn-ui@latest init
npx shadcn-ui@latest add button
npx shadcn-ui@latest add input
npx shadcn-ui@latest add table
npx shadcn-ui@latest add select
npx shadcn-ui@latest add dropdown-menu
npx shadcn-ui@latest add badge
npx shadcn-ui@latest add card
npx shadcn-ui@latest add checkbox
npx shadcn-ui@latest add pagination
npx shadcn-ui@latest add dialog
npx shadcn-ui@latest add label</code></pre>
            
            <h5>Posts Index Component with ShadCN UI</h5>
            <pre><code>import { Head, router, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { 
  Table, 
  TableBody, 
  TableCell, 
  TableHead, 
  TableHeader, 
  TableRow 
} from "@/components/ui/table";
import { 
  Select, 
  SelectContent, 
  SelectItem, 
  SelectTrigger, 
  SelectValue 
} from "@/components/ui/select";
import { 
  DropdownMenu, 
  DropdownMenuContent, 
  DropdownMenuItem, 
  DropdownMenuTrigger 
} from "@/components/ui/dropdown-menu";
import { Badge } from "@/components/ui/badge";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Checkbox } from "@/components/ui/checkbox";
import { 
  Pagination, 
  PaginationContent, 
  PaginationItem, 
  PaginationLink, 
  PaginationNext, 
  PaginationPrevious 
} from "@/components/ui/pagination";
import { 
  Dialog, 
  DialogContent, 
  DialogDescription, 
  DialogFooter, 
  DialogHeader, 
  DialogTitle 
} from "@/components/ui/dialog";
import { Label } from "@/components/ui/label";

export default function PostIndex() {
    const { posts, filters, pagination } = usePage().props;
    const [selectedPosts, setSelectedPosts] = useState([]);
    const [showDeleteDialog, setShowDeleteDialog] = useState(false);
    const [postToDelete, setPostToDelete] = useState(null);
    
    // FOR SEARCH: State and handler for search
    const [search, setSearch] = useState(filters.search || '');
    const handleSearch = (value) => {
        setSearch(value);
        router.get('/posts', { ...filters, search: value, page: 1 }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR FILTER: State and handler for published filter
    const [published, setPublished] = useState(filters.published || '');
    const handlePublishedFilter = (value) => {
        setPublished(value);
        router.get('/posts', { ...filters, published: value, page: 1 }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR SORT: Handler for sorting
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
    };

    // FOR PAGINATION: Handler for page change
    const handlePageChange = (page) => {
        router.get('/posts', { ...filters, page }, {
            preserveState: true,
            replace: true
        });
    };

    // FOR DELETE: Handler with confirmation
    const handleDeleteClick = (post) => {
        setPostToDelete(post);
        setShowDeleteDialog(true);
    };

    const confirmDelete = () => {
        if (postToDelete) {
            router.delete(`/posts/${postToDelete.id}`, {
                onSuccess: () => {
                    setShowDeleteDialog(false);
                    setPostToDelete(null);
                }
            });
        }
    };

    // FOR BULK DELETE: Handler with confirmation
    const handleBulkDelete = () => {
        if (selectedPosts.length === 0) return;
        
        if (confirm(`Delete ${selectedPosts.length} posts?`)) {
            router.post('/posts/bulk-delete', {
                ids: selectedPosts
            }, {
                onSuccess: () => {
                    setSelectedPosts([]);
                }
            });
        }
    };

    // FOR EXPORT: Handler for export
    const handleExport = () => {
        router.get('/posts/export', {
            ...filters
        }, {
            preserveState: true
        });
    };

    // FOR CLONE: Handler for cloning
    const handleClonePost = (postId) => {
        router.post(`/posts/${postId}/clone`, {}, {
            onSuccess: () => {
                router.reload({ only: ['posts', 'pagination'] });
            }
        });
    };

    // FOR TOGGLE PUBLISHED: Handler for toggling published status
    const handleTogglePublished = (postId) => {
        router.put(`/posts/${postId}/toggle-published`, {}, {
            onSuccess: () => {
                router.reload({ only: ['posts'] });
            }
        });
    };

    return (
        &lt;div className="container mx-auto py-6"&gt;
            &lt;Head title="Posts" /&gt;
            
            {/* Action buttons using service endpoints */}
            &lt;div className="flex gap-2 mb-6"&gt;
                &lt;Button 
                    variant="destructive"
                    onClick={handleBulkDelete}
                    disabled={selectedPosts.length === 0}
                &gt;
                    Delete Selected ({selectedPosts.length})
                &lt;/Button&gt;
                &lt;Button 
                    variant="outline"
                    onClick={handleExport}
                &gt;
                    Export
                &lt;/Button&gt;
            &lt;/div&gt;
            
            &lt;Card className="mb-6"&gt;
                &lt;CardHeader&gt;
                    &lt;CardTitle&gt;Posts&lt;/CardTitle&gt;
                &lt;/CardHeader&gt;
                &lt;CardContent&gt;
                    &lt;div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4"&gt;
                        {/* FOR SEARCH: Search input */}
                        &lt;div className="space-y-2"&gt;
                            &lt;Label htmlFor="search"&gt;Search&lt;/Label&gt;
                            &lt;Input
                                id="search"
                                type="text"
                                placeholder="Search posts..."
                                value={search}
                                onChange={(e) => handleSearch(e.target.value)}
                            /&gt;
                        &lt;/div&gt;

                        {/* FOR FILTER: Published status filter */}
                        &lt;div className="space-y-2"&gt;
                            &lt;Label htmlFor="published"&gt;Status&lt;/Label&gt;
                            &lt;Select 
                                value={published} 
                                onValueChange={handlePublishedFilter}
                            &gt;
                                &lt;SelectTrigger id="published"&gt;
                                    &lt;SelectValue placeholder="All Status" /&gt;
                                &lt;/SelectTrigger&gt;
                                &lt;SelectContent&gt;
                                    &lt;SelectItem value=""&gt;All Status&lt;/SelectItem&gt;
                                    &lt;SelectItem value="1"&gt;Published&lt;/SelectItem&gt;
                                    &lt;SelectItem value="0"&gt;Draft&lt;/SelectItem&gt;
                                &lt;/SelectContent&gt;
                            &lt;/Select&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;

                    {/* FOR SORT: Sortable table headers */}
                    &lt;Table&gt;
                        &lt;TableHeader&gt;
                            &lt;TableRow&gt;
                                &lt;TableHead className="w-12"&gt;
                                    &lt;Checkbox 
                                        checked={selectedPosts.length === posts.length && posts.length > 0}
                                        onCheckedChange={(checked) => {
                                            if (checked) {
                                                setSelectedPosts(posts.map(p => p.id));
                                            } else {
                                                setSelectedPosts([]);
                                            }
                                        }}
                                    /&gt;
                                &lt;/TableHead&gt;
                                &lt;TableHead 
                                    className="cursor-pointer"
                                    onClick={() => handleSort('title')}
                                &gt;
                                    Title {filters.sort_by === 'title' && (
                                        filters.sort_direction === 'asc' ? '↑' : '↓'
                                    )}
                                &lt;/TableHead&gt;
                                &lt;TableHead 
                                    className="cursor-pointer"
                                    onClick={() => handleSort('created_at')}
                                &gt;
                                    Date {filters.sort_by === 'created_at' && (
                                        filters.sort_direction === 'asc' ? '↑' : '↓'
                                    )}
                                &lt;/TableHead&gt;
                                &lt;TableHead&gt;Status&lt;/TableHead&gt;
                                &lt;TableHead&gt;Actions&lt;/TableHead&gt;
                            &lt;/TableRow&gt;
                        &lt;/TableHeader&gt;
                        &lt;TableBody&gt;
                            {posts.map((post) => (
                                &lt;TableRow key={post.id}&gt;
                                    &lt;TableCell&gt;
                                        &lt;Checkbox 
                                            checked={selectedPosts.includes(post.id)}
                                            onCheckedChange={(checked) => {
                                                if (checked) {
                                                    setSelectedPosts([...selectedPosts, post.id]);
                                                } else {
                                                    setSelectedPosts(selectedPosts.filter(id => id !== post.id));
                                                }
                                            }}
                                        /&gt;
                                    &lt;/TableCell&gt;
                                    &lt;TableCell className="font-medium"&gt;{post.title}&lt;/TableCell&gt;
                                    &lt;TableCell&gt;{new Date(post.created_at).toLocaleDateString()}&lt;/TableCell&gt;
                                    &lt;TableCell&gt;
                                        &lt;Badge 
                                            variant={post.published ? "default" : "secondary"}
                                            onClick={() => handleTogglePublished(post.id)}
                                            className="cursor-pointer"
                                        &gt;
                                            {post.published ? 'Published' : 'Draft'}
                                        &lt;/Badge&gt;
                                    &lt;/TableCell&gt;
                                    &lt;TableCell&gt;
                                        &lt;DropdownMenu&gt;
                                            &lt;DropdownMenuTrigger asChild&gt;
                                                &lt;Button variant="ghost"&gt;Actions&lt;/Button&gt;
                                            &lt;/DropdownMenuTrigger&gt;
                                            &lt;DropdownMenuContent&gt;
                                                &lt;DropdownMenuItem 
                                                    onClick={() => router.get(`/posts/${post.id}/edit`)}
                                                &gt;
                                                    Edit
                                                &lt;/DropdownMenuItem&gt;
                                                &lt;DropdownMenuItem 
                                                    onClick={() => handleClonePost(post.id)}
                                                &gt;
                                                    Clone
                                                &lt;/DropdownMenuItem&gt;
                                                &lt;DropdownMenuItem 
                                                    onClick={() => handleDeleteClick(post)}
                                                    className="text-red-600"
                                                &gt;
                                                    Delete
                                                &lt;/DropdownMenuItem&gt;
                                            &lt;/DropdownMenuContent&gt;
                                        &lt;/DropdownMenu&gt;
                                    &lt;/TableCell&gt;
                                &lt;/TableRow&gt;
                            ))}
                        &lt;/TableBody&gt;
                    &lt;/Table&gt;

                    {/* FOR PAGINATION: Pagination controls */}
                    &lt;div className="mt-6"&gt;
                        &lt;Pagination&gt;
                            &lt;PaginationContent&gt;
                                &lt;PaginationItem&gt;
                                    &lt;PaginationPrevious 
                                        href="#"
                                        onClick={(e) => {
                                            e.preventDefault();
                                            if (pagination.current_page > 1) {
                                                handlePageChange(pagination.current_page - 1);
                                            }
                                        }}
                                        className={pagination.current_page === 1 ? "pointer-events-none opacity-50" : ""}
                                    /&gt;
                                &lt;/PaginationItem&gt;
                                
                                {Array.from({ length: pagination.last_page }, (_, i) => i + 1).map(page => (
                                    &lt;PaginationItem key={page}&gt;
                                        &lt;PaginationLink
                                            href="#"
                                            onClick={(e) => {
                                                e.preventDefault();
                                                handlePageChange(page);
                                            }}
                                            isActive={page === pagination.current_page}
                                        &gt;
                                            {page}
                                        &lt;/PaginationLink&gt;
                                    &lt;/PaginationItem&gt;
                                ))}
                                
                                &lt;PaginationItem&gt;
                                    &lt;PaginationNext 
                                        href="#"
                                        onClick={(e) => {
                                            e.preventDefault();
                                            if (pagination.current_page &lt; pagination.last_page) {
                                                handlePageChange(pagination.current_page + 1);
                                            }
                                        }}
                                        className={pagination.current_page === pagination.last_page ? "pointer-events-none opacity-50" : ""}
                                    /&gt;
                                &lt;/PaginationItem&gt;
                            &lt;/PaginationContent&gt;
                        &lt;/Pagination&gt;
                    &lt;/div&gt;
                &lt;/CardContent&gt;
            &lt;/Card&gt;

            {/* Delete Confirmation Dialog */}
            &lt;Dialog open={showDeleteDialog} onOpenChange={setShowDeleteDialog}&gt;
                &lt;DialogContent&gt;
                    &lt;DialogHeader&gt;
                        &lt;DialogTitle&gt;Confirm Delete&lt;/DialogTitle&gt;
                        &lt;DialogDescription&gt;
                            Are you sure you want to delete "{postToDelete?.title}"? This action cannot be undone.
                        &lt;/DialogDescription&gt;
                    &lt;/DialogHeader&gt;
                    &lt;DialogFooter&gt;
                        &lt;Button variant="outline" onClick={() => setShowDeleteDialog(false)}&gt;
                            Cancel
                        &lt;/Button&gt;
                        &lt;Button variant="destructive" onClick={confirmDelete}&gt;
                            Delete
                        &lt;/Button&gt;
                    &lt;/DialogFooter&gt;
                &lt;/DialogContent&gt;
            &lt;/Dialog&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Create Post Form with ShadCN UI</h5>
            <pre><code>import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Label } from "@/components/ui/label";
import { Checkbox } from "@/components/ui/checkbox";
import { 
  Form, 
  FormControl, 
  FormDescription, 
  FormField, 
  FormItem, 
  FormLabel, 
  FormMessage 
} from "@/components/ui/form";

export default function PostCreate() {
    const [title, setTitle] = useState('');
    const [content, setContent] = useState('');
    const [published, setPublished] = useState(false);
    const [image, setImage] = useState(null);
    const [errors, setErrors] = useState({});
    
    const handleSubmit = (e) => {
        e.preventDefault();
        
        const formData = new FormData();
        formData.append('title', title);
        formData.append('content', content);
        formData.append('published', published);
        if (image) {
            formData.append('image', image);
        }
        
        router.post('/posts', formData, {
            onError: (errors) => {
                setErrors(errors);
            }
        });
    };
    
    return (
        &lt;div className="container mx-auto py-6"&gt;
            &lt;Head title="Create Post" /&gt;
            
            &lt;Card className="max-w-2xl mx-auto"&gt;
                &lt;CardHeader&gt;
                    &lt;CardTitle&gt;Create New Post&lt;/CardTitle&gt;
                &lt;/CardHeader&gt;
                &lt;CardContent&gt;
                    &lt;form onSubmit={handleSubmit} className="space-y-6"&gt;
                        &lt;div className="space-y-2"&gt;
                            &lt;Label htmlFor="title"&gt;Title&lt;/Label&gt;
                            &lt;Input
                                id="title"
                                value={title}
                                onChange={(e) => setTitle(e.target.value)}
                                placeholder="Enter post title"
                            /&gt;
                            {errors.title && &lt;p className="text-red-500 text-sm"&gt;{errors.title}&lt;/p&gt;}
                        &lt;/div&gt;
                        
                        &lt;div className="space-y-2"&gt;
                            &lt;Label htmlFor="content"&gt;Content&lt;/Label&gt;
                            &lt;Textarea
                                id="content"
                                value={content}
                                onChange={(e) => setContent(e.target.value)}
                                placeholder="Enter post content"
                                rows={6}
                            /&gt;
                            {errors.content && &lt;p className="text-red-500 text-sm"&gt;{errors.content}&lt;/p&gt;}
                        &lt;/div&gt;
                        
                        &lt;div className="space-y-2"&gt;
                            &lt;Label htmlFor="image"&gt;Image&lt;/Label&gt;
                            &lt;Input
                                id="image"
                                type="file"
                                onChange={(e) => setImage(e.target.files[0])}
                            /&gt;
                            {errors.image && &lt;p className="text-red-500 text-sm"&gt;{errors.image}&lt;/p&gt;}
                        &lt;/div&gt;
                        
                        &lt;div className="flex items-center space-x-2"&gt;
                            &lt;Checkbox 
                                id="published"
                                checked={published}
                                onCheckedChange={setPublished}
                            /&gt;
                            &lt;Label htmlFor="published"&gt;Published&lt;/Label&gt;
                        &lt;/div&gt;
                        
                        &lt;div className="flex gap-2"&gt;
                            &lt;Button type="submit"&gt;Create Post&lt;/Button&gt;
                            &lt;Button 
                                type="button" 
                                variant="outline"
                                onClick={() => router.get('/posts')}
                            &gt;
                                Cancel
                            &lt;/Button&gt;
                        &lt;/div&gt;
                    &lt;/form&gt;
                &lt;/CardContent&gt;
            &lt;/Card&gt;
        &lt;/div&gt;
    );
}</code></pre>
        </div>
    </div>
</section>