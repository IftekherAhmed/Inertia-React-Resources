<section id="factory" class="content-section">
                    <div class="page-header">
                        <h1 class="page-title">
                            <i class="bi bi-tools"></i>
                            Factory
                        </h1>
                        <p class="page-subtitle">Factories for generating test data and seeding your database</p>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-code-square"></i> Creating Model Factories
                        </div>
                        <div class="card-body">
                            <div class="definition-box">
                                <h6><i class="bi bi-info-circle"></i> What are Factories?</h6>
                                <p>Factories provide a convenient way to generate fake data for testing or seeding your database with realistic sample data.</p>
                            </div>
                            
                            <div class="info-callout">
                                <h6><i class="bi bi-info-circle"></i> Factory Implementation Details</h6>
                                <p><strong>File Location:</strong> <code>database/factories/PostFactory.php</code><br>
                                <strong>Best Practice:</strong> Define realistic data patterns that match your application's requirements</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Create Factory</h6>
                                    <div class="file-path">database/factories/PostFactory.php</div>
                                    <pre><code>php artisan make:factory PostFactory</code></pre>
                                    
                                    <p>Example factory structure:</p>
                                    <pre><code>&lt;?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory&lt;\App\Models\Post&gt;
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array&lt;string, mixed&gt;
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(3, true),
            'published' => fake()->boolean(),
        ];
    }
}</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>