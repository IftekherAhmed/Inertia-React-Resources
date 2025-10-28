<section id="project-structure" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-folder"></i>
                            Project Structure
                        </h1>
                        <p class="page-subtitle">Standard Laravel directory organization with React components</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-diagram-3"></i> Complete Project Structure
                        </div>
                        <div class="card-body">
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Project Organization</h6>
                                <p>Understanding the complete project structure is essential for maintainability and team collaboration.</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Backend Structure (Laravel)</h5>
                                    <div class="file-path">app/</div>
                                    <pre><code>app/
├── Http/
│   ├── Controllers/
│   │   └── PostController.php          # Main controller
│   └── Requests/
│       └── PostRequest.php             # Form validation
├── Models/
│   └── Post.php                        # Eloquent model
├── Providers/
│   └── AppServiceProvider.php          # Service providers
database/
├── factories/
│   └── PostFactory.php                 # Test data generation
├── migrations/
│   └── 2024_01_01_000000_create_posts_table.php
├── seeders/
│   └── PostSeeder.php                  # Database seeding
routes/
└── web.php                             # Route definitions</code></pre>
                                </div>
                                <div class="col-md-12">
                                    <h5>Frontend Structure (React + Inertia)</h5>
                                    <div class="file-path">resources/js/</div>
                                    <pre><code>resources/
├── js/
│   ├── components/
│   │   ├── input-error.jsx             # Error display
│   │   └── link-button.jsx             # Navigation links
│   ├── layouts/
│   │   └── app-layout.jsx              # Base layout
│   ├── pages/
│   │   └── Posts/
│   │       ├── Index.jsx               # List view
│   │       ├── Create.jsx              # Create form
│   │       ├── Edit.jsx                # Edit form
│   │       └── Show.jsx                # Detail view
│   └── types/
│       └── post.d.ts                   # TypeScript types
└── views/
    └── app.blade.php                   # Base Blade template</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>