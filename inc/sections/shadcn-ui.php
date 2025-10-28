<section id="shadcn-ui" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-palette"></i>
            ShadCN UI Components
        </h1>
        <p class="page-subtitle">Implementing beautiful UI components with ShadCN UI and Tailwind CSS</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code-square"></i> ShadCN UI Installation and Setup
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is ShadCN UI?</h6>
                <p>ShadCN UI is a collection of reusable components built with Radix UI and Tailwind CSS that you can copy and paste into your apps. It provides accessible, customizable components that follow best practices.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-lightbulb"></i> ShadCN UI Benefits</h6>
                <p>
                    <strong>Accessibility:</strong> Built with Radix UI primitives for full accessibility<br>
                    <strong>Customizable:</strong> Easily styled with Tailwind CSS classes<br>
                    <strong>Lightweight:</strong> Copy only what you need<br>
                    <strong>TypeScript Support:</strong> Full TypeScript support out of the box
                </p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR SHADCN UI SETUP</h6>
                <p><strong>Files:</strong> Installation and configuration steps for ShadCN UI in Laravel + React projects</p>
            </div>
            
            <h5>Prerequisites</h5>
            <p>Before installing ShadCN UI, ensure you have the following dependencies:</p>
            <pre><code>// Install required dependencies
npm install tailwindcss postcss autoprefixer
npm install @radix-ui/react-slot
npm install class-variance-authority
npm install clsx tailwind-merge
npm install lucide-react

// Initialize Tailwind CSS
npx tailwindcss init -p</code></pre>
            
            <h5>Tailwind CSS Configuration</h5>
            <div class="file-path">tailwind.config.js</div>
            <pre><code>/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: ["class"],
  content: [
    './pages/**/*.{ts,tsx}',
    './components/**/*.{ts,tsx}',
    './app/**/*.{ts,tsx}',
    './src/**/*.{ts,tsx}',
    './resources/**/*.{ts,tsx,js,jsx}',
  ],
  theme: {
    container: {
      center: true,
      padding: "2rem",
      screens: {
        "2xl": "1400px",
      },
    },
    extend: {
      colors: {
        border: "hsl(var(--border))",
        input: "hsl(var(--input))",
        ring: "hsl(var(--ring))",
        background: "hsl(var(--background))",
        foreground: "hsl(var(--foreground))",
        primary: {
          DEFAULT: "hsl(var(--primary))",
          foreground: "hsl(var(--primary-foreground))",
        },
        secondary: {
          DEFAULT: "hsl(var(--secondary))",
          foreground: "hsl(var(--secondary-foreground))",
        },
        destructive: {
          DEFAULT: "hsl(var(--destructive))",
          foreground: "hsl(var(--destructive-foreground))",
        },
        muted: {
          DEFAULT: "hsl(var(--muted))",
          foreground: "hsl(var(--muted-foreground))",
        },
        accent: {
          DEFAULT: "hsl(var(--accent))",
          foreground: "hsl(var(--accent-foreground))",
        },
        popover: {
          DEFAULT: "hsl(var(--popover))",
          foreground: "hsl(var(--popover-foreground))",
        },
        card: {
          DEFAULT: "hsl(var(--card))",
          foreground: "hsl(var(--card-foreground))",
        },
      },
      borderRadius: {
        lg: "var(--radius)",
        md: "calc(var(--radius) - 2px)",
        sm: "calc(var(--radius) - 4px)",
      },
      keyframes: {
        "accordion-down": {
          from: { height: 0 },
          to: { height: "var(--radix-accordion-content-height)" },
        },
        "accordion-up": {
          from: { height: "var(--radix-accordion-content-height)" },
          to: { height: 0 },
        },
      },
      animation: {
        "accordion-down": "accordion-down 0.2s ease-out",
        "accordion-up": "accordion-up 0.2s ease-out",
      },
    },
  },
  plugins: [require("tailwindcss-animate")],
}</code></pre>
            
            <h5>CSS Configuration</h5>
            <div class="file-path">resources/css/app.css</div>
            <pre><code>@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
  :root {
    --background: 0 0% 100%;
    --foreground: 222.2 47.4% 11.2%;

    --muted: 210 40% 96.1%;
    --muted-foreground: 215.4 16.3% 46.9%;

    --popover: 0 0% 100%;
    --popover-foreground: 222.2 47.4% 11.2%;

    --border: 214.3 31.8% 91.4%;
    --input: 214.3 31.8% 91.4%;

    --card: 0 0% 100%;
    --card-foreground: 222.2 47.4% 11.2%;

    --primary: 222.2 47.4% 11.2%;
    --primary-foreground: 210 40% 98%;

    --secondary: 210 40% 96.1%;
    --secondary-foreground: 222.2 47.4% 11.2%;

    --accent: 210 40% 96.1%;
    --accent-foreground: 222.2 47.4% 11.2%;

    --destructive: 0 100% 50%;
    --destructive-foreground: 210 40% 98%;

    --ring: 215 20.2% 65.1%;

    --radius: 0.5rem;
  }

  .dark {
    --background: 224 71% 4%;
    --foreground: 213 31% 91%;

    --muted: 223 47% 11%;
    --muted-foreground: 215.4 16.3% 56.9%;

    --accent: 216 34% 17%;
    --accent-foreground: 210 40% 98%;

    --popover: 224 71% 4%;
    --popover-foreground: 215 20.2% 65.1%;

    --border: 216 34% 17%;
    --input: 216 34% 17%;

    --card: 224 71% 4%;
    --card-foreground: 213 31% 91%;

    --primary: 210 40% 98%;
    --primary-foreground: 222.2 47.4% 1.2%;

    --secondary: 222.2 47.4% 11.2%;
    --secondary-foreground: 210 40% 98%;

    --destructive: 0 63% 31%;
    --destructive-foreground: 210 40% 98%;

    --ring: 216 34% 17%;

    --radius: 0.5rem;
  }
}

@layer base {
  * {
    @apply border-border;
  }
  body {
    @apply bg-background text-foreground;
    font-feature-settings: "rlig" 1, "calt" 1;
  }
}</code></pre>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-components"></i> Essential ShadCN UI Components for Laravel Projects
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> Core Components</h6>
                <p>These are the essential ShadCN UI components that work well with Laravel + Inertia.js + React projects.</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR CORE COMPONENTS</h6>
                <p><strong>Files:</strong> Implementation examples for Button, Input, Table, and other core components</p>
            </div>
            
            <h5>Button Component</h5>
            <div class="file-path">resources/js/components/ui/button.jsx</div>
            <pre><code>import * as React from "react"
import { Slot } from "@radix-ui/react-slot"
import { cva } from "class-variance-authority";

import { cn } from "@/lib/utils"

const buttonVariants = cva(
  "inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50",
  {
    variants: {
      variant: {
        default: "bg-primary text-primary-foreground hover:bg-primary/90",
        destructive:
          "bg-destructive text-destructive-foreground hover:bg-destructive/90",
        outline:
          "border border-input bg-background hover:bg-accent hover:text-accent-foreground",
        secondary:
          "bg-secondary text-secondary-foreground hover:bg-secondary/80",
        ghost: "hover:bg-accent hover:text-accent-foreground",
        link: "text-primary underline-offset-4 hover:underline",
      },
      size: {
        default: "h-10 px-4 py-2",
        sm: "h-9 rounded-md px-3",
        lg: "h-11 rounded-md px-8",
        icon: "h-10 w-10",
      },
    },
    defaultVariants: {
      variant: "default",
      size: "default",
    },
  }
)

const Button = React.forwardRef(({ className, variant, size, asChild = false, ...props }, ref) => {
  const Comp = asChild ? Slot : "button"
  return (
    (&lt;Comp
      className={cn(buttonVariants({ variant, size, className }))}
      ref={ref}
      {...props} /&gt;)
  );
})
Button.displayName = "Button"

export { Button, buttonVariants }</code></pre>
            
            <h5>Table Component</h5>
            <div class="file-path">resources/js/components/ui/table.jsx</div>
            <pre><code>import * as React from "react"

import { cn } from "@/lib/utils"

const Table = React.forwardRef(({ className, ...props }, ref) => (
  &lt;div className="relative w-full overflow-auto"&gt;
    &lt;table
      ref={ref}
      className={cn("w-full caption-bottom text-sm", className)}
      {...props} /&gt;
  &lt;/div&gt;
))
Table.displayName = "Table"

const TableHeader = React.forwardRef(({ className, ...props }, ref) => (
  &lt;thead ref={ref} className={cn("[&_tr]:border-b", className)} {...props} /&gt;
))
TableHeader.displayName = "TableHeader"

const TableBody = React.forwardRef(({ className, ...props }, ref) => (
  &lt;tbody
    ref={ref}
    className={cn("[&_tr:last-child]:border-0", className)}
    {...props} /&gt;
))
TableBody.displayName = "TableBody"

const TableFooter = React.forwardRef(({ className, ...props }, ref) => (
  &lt;tfoot
    ref={ref}
    className={cn("bg-primary font-medium text-primary-foreground", className)}
    {...props} /&gt;
))
TableFooter.displayName = "TableFooter"

const TableRow = React.forwardRef(({ className, ...props }, ref) => (
  &lt;tr
    ref={ref}
    className={cn(
      "border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted",
      className
    )}
    {...props} /&gt;
))
TableRow.displayName = "TableRow"

const TableHead = React.forwardRef(({ className, ...props }, ref) => (
  &lt;th
    ref={ref}
    className={cn(
      "h-12 px-4 text-left align-middle font-medium text-muted-foreground [&:has([role=checkbox])]:pr-0",
      className
    )}
    {...props} /&gt;
))
TableHead.displayName = "TableHead"

const TableCell = React.forwardRef(({ className, ...props }, ref) => (
  &lt;td
    ref={ref}
    className={cn("p-4 align-middle [&:has([role=checkbox])]:pr-0", className)}
    {...props} /&gt;
))
TableCell.displayName = "TableCell"

const TableCaption = React.forwardRef(({ className, ...props }, ref) => (
  &lt;caption
    ref={ref}
    className={cn("mt-4 text-sm text-muted-foreground", className)}
    {...props} /&gt;
))
TableCaption.displayName = "TableCaption"

export {
  Table,
  TableHeader,
  TableBody,
  TableFooter,
  TableHead,
  TableRow,
  TableCell,
  TableCaption,
}</code></pre>
            
            <h5>Input Component</h5>
            <div class="file-path">resources/js/components/ui/input.jsx</div>
            <pre><code>import * as React from "react"

import { cn } from "@/lib/utils"

const Input = React.forwardRef(({ className, type, ...props }, ref) => {
  return (
    (&lt;input
      type={type}
      className={cn(
        "flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50",
        className
      )}
      ref={ref}
      {...props} /&gt;)
  )
})
Input.displayName = "Input"

export { Input }</code></pre>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-layout-wtf"></i> ShadCN UI Integration with Laravel + Inertia.js
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> Integration Patterns</h6>
                <p>Best practices for integrating ShadCN UI components with Laravel backend and Inertia.js frontend.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-lightbulb"></i> Integration Best Practices</h6>
                <p>
                    <strong>Data Flow:</strong> Use Inertia's page props to pass data to components<br>
                    <strong>State Management:</strong> Leverage React's useState and Inertia's router for state<br>
                    <strong>Error Handling:</strong> Display validation errors using ShadCN UI components<br>
                    <strong>Responsive Design:</strong> Use Tailwind's responsive classes with ShadCN UI
                </p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR INTEGRATION PATTERNS</h6>
                <p><strong>Files:</strong> Examples of integrating ShadCN UI with Laravel controllers and Inertia.js</p>
            </div>
            
            <h5>Posts Index Page with ShadCN UI</h5>
            <div class="file-path">resources/js/pages/Posts/Index.jsx</div>
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
        </div>
    </div>
</section>