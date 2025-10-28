<section id="migration" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-database"></i>
                            Migration
                        </h1>
                        <p class="page-subtitle">Database schema definitions for your application resources</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-terminal"></i> Creating Database Migrations
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are Migrations?</h6>
                                <p>Migrations are like version control for your database, allowing your team to define and share the application's database schema definition.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-exclamation-triangle"></i> Prerequisites</h6>
                                <p>Ensure you have Laravel properly installed and configured in your project.</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>1. Create Migration</h6>
                                    <div class="file-path">database/migrations/2024_01_01_000000_create_posts_table.php</div>
                                    <pre><code>php artisan make:migration create_posts_table</code></pre>
                                    
                                    <p>Example migration structure:</p>
                                    <pre><code>&lt;?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>