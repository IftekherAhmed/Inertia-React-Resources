<section id="programming-concepts" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-code-square"></i>
            Programming Concepts
        </h1>
        <p class="page-subtitle">Essential programming concepts with practical examples</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-book"></i> Control Flow and Logic
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What are Programming Concepts?</h6>
                <p>Programming concepts are fundamental building blocks that help developers control the flow of their applications, make decisions, and repeat operations efficiently.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Concept Details</h6>
                <p><strong>Implementation:</strong> JavaScript/PHP control structures<br>
                <strong>Usage:</strong> Conditional logic, loops, and decision making<br>
                <strong>Applications:</strong> Form validation, data processing, UI rendering</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR PROGRAMMING CONCEPTS</h6>
                <p><strong>Files:</strong> Examples of if/else, switch, loops, and other control structures</p>
            </div>
            
            <h5>If/Else Statements</h5>
            <p>If/else statements allow you to execute different code paths based on conditions.</p>
            
            <h6>JavaScript Example</h6>
            <pre><code>// Basic if/else
const userRole = 'admin';

if (userRole === 'admin') {
    console.log('Access granted to admin panel');
} else if (userRole === 'user') {
    console.log('Access granted to user dashboard');
} else {
    console.log('Access denied');
}

// Multiple conditions
const age = 25;
const hasLicense = true;

if (age >= 18 && hasLicense) {
    console.log('Eligible to drive');
} else if (age >= 18 && !hasLicense) {
    console.log('Need to get a license');
} else {
    console.log('Not eligible to drive');
}

// Ternary operator (shorthand if/else)
const isLoggedIn = true;
const message = isLoggedIn ? 'Welcome back!' : 'Please log in';
console.log(message);

// Complex conditions in React components
function UserStatus({ user }) {
    return (
        &lt;div&gt;
            {user ? (
                &lt;div className="user-logged-in"&gt;
                    &lt;h2&gt;Welcome, {user.name}!&lt;/h2&gt;
                    &lt;button onClick={logout}&gt;Logout&lt;/button&gt;
                &lt;/div&gt;
            ) : (
                &lt;div className="user-logged-out"&gt;
                    &lt;h2&gt;Please log in&lt;/h2&gt;
                    &lt;button onClick={login}&gt;Login&lt;/button&gt;
                &lt;/div&gt;
            )}
        &lt;/div&gt;
    );
}</code></pre>
            
            <h6>PHP Example</h6>
            <pre><code>&lt;?php
// Basic if/else
$userRole = 'admin';

if ($userRole === 'admin') {
    echo 'Access granted to admin panel';
} elseif ($userRole === 'user') {
    echo 'Access granted to user dashboard';
} else {
    echo 'Access denied';
}

// Multiple conditions
$age = 25;
$hasLicense = true;

if ($age >= 18 && $hasLicense) {
    echo 'Eligible to drive';
} elseif ($age >= 18 && !$hasLicense) {
    echo 'Need to get a license';
} else {
    echo 'Not eligible to drive';
}

// Ternary operator
$isLoggedIn = true;
$message = $isLoggedIn ? 'Welcome back!' : 'Please log in';
echo $message;

// Null coalescing operator (PHP 7+)
$username = $_GET['user'] ?? 'Guest';
echo "Hello, " . $username;

// In Laravel controllers
public function show(Post $post)
{
    if (!$post->published && !auth()->user()->can('view-drafts')) {
        abort(403, 'Unauthorized access to draft post');
    }
    
    return view('posts.show', compact('post'));
}
?&gt;</code></pre>
            
            <h5>Switch Statements</h5>
            <p>Switch statements provide a cleaner way to handle multiple conditions compared to long if/else chains.</p>
            
            <h6>JavaScript Example</h6>
            <pre><code>// Basic switch statement
const day = 'Monday';
let message;

switch (day) {
    case 'Monday':
        message = 'Start of the work week';
        break;
    case 'Friday':
        message = 'End of the work week';
        break;
    case 'Saturday':
    case 'Sunday':
        message = 'Weekend!';
        break;
    default:
        message = 'Mid-week day';
}

console.log(message);

// Switch in React components
function StatusBadge({ status }) {
    let badgeClass, badgeText;
    
    switch (status) {
        case 'draft':
            badgeClass = 'bg-gray-200 text-gray-800';
            badgeText = 'Draft';
            break;
        case 'published':
            badgeClass = 'bg-green-200 text-green-800';
            badgeText = 'Published';
            break;
        case 'archived':
            badgeClass = 'bg-red-200 text-red-800';
            badgeText = 'Archived';
            break;
        default:
            badgeClass = 'bg-blue-200 text-blue-800';
            badgeText = 'Unknown';
    }
    
    return (
        &lt;span className={`px-2 py-1 rounded-full text-xs font-medium ${badgeClass}`}&gt;
            {badgeText}
        &lt;/span&gt;
    );
}

// Switch with early returns (alternative pattern)
function getPriorityColor(priority) {
    switch (priority) {
        case 'high': return 'text-red-600';
        case 'medium': return 'text-yellow-600';
        case 'low': return 'text-green-600';
        default: return 'text-gray-600';
    }
}</code></pre>
            
            <h6>PHP Example</h6>
            <pre><code>&lt;?php
// Basic switch statement
$day = 'Monday';
$message = '';

switch ($day) {
    case 'Monday':
        $message = 'Start of the work week';
        break;
    case 'Friday':
        $message = 'End of the work week';
        break;
    case 'Saturday':
    case 'Sunday':
        $message = 'Weekend!';
        break;
    default:
        $message = 'Mid-week day';
}

echo $message;

// Switch in Laravel controllers
public function updateStatus(Request $request, Post $post)
{
    $status = $request->input('status');
    
    switch ($status) {
        case 'publish':
            $post->published_at = now();
            $post->status = 'published';
            break;
        case 'draft':
            $post->published_at = null;
            $post->status = 'draft';
            break;
        case 'archive':
            $post->archived_at = now();
            $post->status = 'archived';
            break;
        default:
            return response()->json(['error' => 'Invalid status'], 400);
    }
    
    $post->save();
    return response()->json(['message' => 'Status updated successfully']);
}

// Switch for HTTP response codes
public function handleApiResponse($response)
{
    switch ($response->status()) {
        case 200:
        case 201:
            return $response->json();
        case 401:
            throw new UnauthorizedException('Authentication required');
        case 403:
            throw new ForbiddenException('Access denied');
        case 404:
            throw new NotFoundException('Resource not found');
        case 500:
            throw new ServerException('Server error');
        default:
            throw new Exception('Unexpected response');
    }
}
?&gt;</code></pre>
            
            <h5>Loop Statements</h5>
            <p>Loops allow you to repeat operations multiple times, which is essential for processing collections of data.</p>
            
            <h6>JavaScript Examples</h6>
            <pre><code>// For loop
const numbers = [1, 2, 3, 4, 5];
let sum = 0;

for (let i = 0; i &lt; numbers.length; i++) {
    sum += numbers[i];
}
console.log('Sum:', sum);

// For...of loop (ES6) - for arrays
const fruits = ['apple', 'banana', 'orange'];
for (const fruit of fruits) {
    console.log(fruit);
}

// For...in loop - for object properties
const user = { name: 'John', age: 30, city: 'New York' };
for (const key in user) {
    console.log(`${key}: ${user[key]}`);
}

// While loop
let count = 0;
while (count &lt; 5) {
    console.log('Count:', count);
    count++;
}

// Do...while loop
let attempts = 0;
do {
    console.log('Attempt:', attempts);
    attempts++;
} while (attempts &lt; 3);

// Array methods (functional programming approach)
const products = [
    { name: 'Laptop', price: 999.99, category: 'electronics' },
    { name: 'Phone', price: 599.99, category: 'electronics' },
    { name: 'Book', price: 19.99, category: 'education' }
];

// Map - transform each element
const productNames = products.map(product => product.name);
console.log('Product names:', productNames);

// Filter - get elements that match a condition
const expensiveProducts = products.filter(product => product.price > 100);
console.log('Expensive products:', expensiveProducts);

// Reduce - combine elements into a single value
const totalPrice = products.reduce((sum, product) => sum + product.price, 0);
console.log('Total price:', totalPrice);

// Find - get the first element that matches a condition
const laptop = products.find(product => product.name === 'Laptop');
console.log('Found laptop:', laptop);

// forEach - execute a function for each element
products.forEach(product => {
    console.log(`${product.name}: $${product.price}`);
});

// In React components
function ProductList({ products }) {
    return (
        &lt;div&gt;
            {products.map((product, index) => (
                &lt;div key={product.id} className="product-item"&gt;
                    &lt;h3&gt;{product.name}&lt;/h3&gt;
                    &lt;p&gt;${product.price}&lt;/p&gt;
                    {index &lt; products.length - 1 && &lt;hr /&gt;}
                &lt;/div&gt;
            ))}
        &lt;/div&gt;
    );
}

// Conditional rendering with loops
function UserPermissions({ permissions }) {
    return (
        &lt;div&gt;
            &lt;h3&gt;User Permissions:&lt;/h3&gt;
            {permissions.length > 0 ? (
                &lt;ul&gt;
                    {permissions.map((permission, index) => (
                        &lt;li key={index}&gt;{permission}&lt;/li&gt;
                    ))}
                &lt;/ul&gt;
            ) : (
                &lt;p&gt;No permissions assigned&lt;/p&gt;
            )}
        &lt;/div&gt;
    );
}</code></pre>
            
            <h6>PHP Examples</h6>
            <pre><code>&lt;?php
// For loop
$numbers = [1, 2, 3, 4, 5];
$sum = 0;

for ($i = 0; $i &lt; count($numbers); $i++) {
    $sum += $numbers[$i];
}
echo "Sum: " . $sum . "\n";

// Foreach loop - for arrays
$fruits = ['apple', 'banana', 'orange'];
foreach ($fruits as $fruit) {
    echo $fruit . "\n";
}

// Foreach with key and value
$user = ['name' => 'John', 'age' => 30, 'city' => 'New York'];
foreach ($user as $key => $value) {
    echo "$key: $value\n";
}

// While loop
$count = 0;
while ($count &lt; 5) {
    echo "Count: " . $count . "\n";
    $count++;
}

// Do...while loop
$attempts = 0;
do {
    echo "Attempt: " . $attempts . "\n";
    $attempts++;
} while ($attempts &lt; 3);

// In Laravel with Eloquent collections
$users = User::all();

// Each method (similar to forEach)
$users->each(function ($user) {
    echo $user->name . "\n";
});

// Map method
$userNames = $users->map(function ($user) {
    return $user->name;
});

// Filter method
$activeUsers = $users->filter(function ($user) {
    return $user->active;
});

// In Blade templates
/*
&lt;!-- Loop through products --&gt;
@foreach ($products as $product)
    &lt;div class="product"&gt;
        &lt;h3&gt;{{ $product->name }}&lt;/h3&gt;
        &lt;p&gt;${{ $product->price }}&lt;/p&gt;
    &lt;/div&gt;
@endforeach

&lt;!-- Conditional loop --&gt;
@forelse ($products as $product)
    &lt;div class="product"&gt;
        &lt;h3&gt;{{ $product->name }}&lt;/h3&gt;
        &lt;p&gt;${{ $product->price }}&lt;/p&gt;
    &lt;/div&gt;
@empty
    &lt;p&gt;No products available&lt;/p&gt;
@endforelse
*/
?&gt;</code></pre>
        </div>
    </div>
</section>