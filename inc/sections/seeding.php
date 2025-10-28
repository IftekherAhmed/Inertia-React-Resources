<section id="seeder" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-arrow-repeat"></i>
                            Seeder
                        </h1>
                        <p class="page-subtitle">Seeders for populating your database with initial data</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code"></i> Creating Database Seeders
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are Seeders?</h6>
                                <p>Seeders are used to populate your database with initial data that's required for your application to function properly.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Seeder Implementation Details</h6>
                                <p><strong>File Location:</strong> <code>database/seeders/PostSeeder.php</code><br>
                                <strong>Best Practice:</strong> Use factories within seeders for consistent and realistic data</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Create Seeder</h6>
                                    <div class="file-path">database/seeders/PostSeeder.php</div>
                                    <pre><code>php artisan make:seeder PostSeeder</code></pre>
                                    
                                    <p>Example seeder structure:</p>
                                    <pre><code>&lt;?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(50)->create();
    }
}</code></pre>
                                    
                                    <h6>Run Migration and Seed</h6>
                                    <pre><code>php artisan migrate --seed</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>