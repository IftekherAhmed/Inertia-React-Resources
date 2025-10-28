<section id="table-export" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-file-earmark-arrow-down"></i>
            Table Export Functionality
        </h1>
        <p class="page-subtitle">Exporting table data to CSV and other formats</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Table Export Implementation
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is Table Export?</h6>
                <p>Table export functionality allows users to download table data in various formats such as CSV, Excel, or PDF for offline use or further analysis.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Component Details</h6>
                <p><strong>Implementation:</strong> JavaScript functions for frontend export, PHP for backend export<br>
                <strong>Formats:</strong> CSV, Excel (XLSX)<br>
                <strong>Dependencies:</strong> PapaParse (for CSV), SheetJS (for Excel)</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR TABLE EXPORT</h6>
                <p><strong>Files:</strong> Frontend export functions and backend controller methods</p>
            </div>
            
            <h5>Frontend CSV Export Implementation</h5>
            <pre><code>// Utility function to convert array of objects to CSV
function convertToCSV(data) {
    if (!data || data.length === 0) return '';
    
    // Get headers from the first object
    const headers = Object.keys(data[0]);
    
    // Create CSV header row
    const csvHeader = headers.join(',');
    
    // Create CSV data rows
    const csvRows = data.map(row => {
        return headers.map(header => {
            let value = row[header];
            // Escape commas and quotes in values
            if (typeof value === 'string') {
                value = value.replace(/"/g, '""'); // Escape quotes
                if (value.includes(',') || value.includes('"') || value.includes('\n')) {
                    value = `"${value}"`; // Wrap in quotes if needed
                }
            }
            return value;
        }).join(',');
    });
    
    // Combine header and rows
    return [csvHeader, ...csvRows].join('\n');
}

// Function to download CSV file
function downloadCSV(data, filename = 'data.csv') {
    const csvContent = convertToCSV(data);
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', filename);
    link.style.visibility = 'hidden';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// React component with export functionality
import { useState } from 'react';

export default function DataTable({ data, columns }) {
    const [filteredData, setFilteredData] = useState(data);
    
    // Export all data
    const exportAllData = () => {
        downloadCSV(data, 'all-data.csv');
    };
    
    // Export filtered data
    const exportFilteredData = () => {
        downloadCSV(filteredData, 'filtered-data.csv');
    };
    
    // Export visible columns only
    const exportVisibleColumns = () => {
        if (!filteredData.length) return;
        
        // Get only the visible columns
        const visibleData = filteredData.map(row => {
            const filteredRow = {};
            columns.forEach(column => {
                if (column.visible !== false) {
                    filteredRow[column.key] = row[column.key];
                }
            });
            return filteredRow;
        });
        
        downloadCSV(visibleData, 'visible-columns.csv');
    };
    
    return (
        &lt;div className="bg-white rounded-lg shadow"&gt;
            &lt;div className="p-4 border-b border-gray-200 flex justify-between items-center"&gt;
                &lt;h2 className="text-lg font-semibold"&gt;Data Table&lt;/h2&gt;
                &lt;div className="flex space-x-2"&gt;
                    &lt;button
                        onClick={exportAllData}
                        className="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700"
                    &gt;
                        Export All
                    &lt;/button&gt;
                    &lt;button
                        onClick={exportFilteredData}
                        className="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700"
                    &gt;
                        Export Filtered
                    &lt;/button&gt;
                    &lt;button
                        onClick={exportVisibleColumns}
                        className="px-3 py-1 bg-purple-600 text-white rounded text-sm hover:bg-purple-700"
                    &gt;
                        Export Visible
                    &lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
            
            &lt;div className="overflow-x-auto"&gt;
                &lt;table className="min-w-full divide-y divide-gray-200"&gt;
                    &lt;thead className="bg-gray-50"&gt;
                        &lt;tr&gt;
                            {columns.map(column => (
                                &lt;th 
                                    key={column.key} 
                                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                &gt;
                                    {column.label}
                                &lt;/th&gt;
                            ))}
                        &lt;/tr&gt;
                    &lt;/thead&gt;
                    &lt;tbody className="bg-white divide-y divide-gray-200"&gt;
                        {filteredData.map((row, index) => (
                            &lt;tr key={index}&gt;
                                {columns.map(column => (
                                    &lt;td key={column.key} className="px-6 py-4 whitespace-nowrap text-sm text-gray-500"&gt;
                                        {row[column.key]}
                                    &lt;/td&gt;
                                ))}
                            &lt;/tr&gt;
                        ))}
                    &lt;/tbody&gt;
                &lt;/table&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    );
}

// Usage example
const sampleData = [
    { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin', status: 'Active' },
    { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'User', status: 'Active' },
    { id: 3, name: 'Bob Johnson', email: 'bob@example.com', role: 'User', status: 'Inactive' }
];

const columns = [
    { key: 'id', label: 'ID' },
    { key: 'name', label: 'Name' },
    { key: 'email', label: 'Email' },
    { key: 'role', label: 'Role' },
    { key: 'status', label: 'Status' }
];

function App() {
    return (
        &lt;div className="p-6"&gt;
            &lt;DataTable data={sampleData} columns={columns} /&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Using PapaParse Library for Advanced CSV Export</h5>
            <pre><code>// First install PapaParse: npm install papaparse
import Papa from 'papaparse';

// Advanced CSV export with PapaParse
function exportToCSV(data, filename = 'data.csv', options = {}) {
    const csv = Papa.unparse(data, {
        quotes: true, // Wrap all fields in quotes
        quoteChar: '"',
        escapeChar: '"',
        delimiter: ',',
        header: true,
        newline: '\r\n',
        skipEmptyLines: 'greedy',
        columns: null,
        ...options
    });
    
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', filename);
    link.style.visibility = 'hidden';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Export with custom formatting
function exportFormattedCSV(data, filename = 'formatted-data.csv') {
    // Transform data before export
    const formattedData = data.map(item => ({
        'User ID': item.id,
        'Full Name': `${item.firstName} ${item.lastName}`,
        'Email Address': item.email,
        'Account Status': item.active ? 'Active' : 'Inactive',
        'Registration Date': new Date(item.createdAt).toLocaleDateString(),
        'Last Login': item.lastLogin ? new Date(item.lastLogin).toLocaleString() : 'Never'
    }));
    
    exportToCSV(formattedData, filename);
}</code></pre>
            
            <h5>Backend CSV Export with Laravel</h5>
            <pre><code>&lt;?php
// In your Controller
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response as FacadeResponse;

class ExportController extends Controller
{
    /**
     * Export posts to CSV
     */
    public function exportPosts(Request $request)
    {
        // Apply the same filters used in the index method
        $filters = [
            'search' => $request->search,
            'published' => $request->published,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'sort_by' => $request->sort_by ?? 'id',
            'sort_direction' => $request->sort_direction ?? 'desc',
        ];

        $posts = Post::search($filters['search'])
                    ->published($filters['published'])
                    ->dateRange($filters['start_date'], $filters['end_date'])
                    ->sortBy($filters['sort_by'], $filters['sort_direction'])
                    ->get();

        // Convert to CSV format
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="posts-export.csv"',
        ];

        $callback = function() use ($posts) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, ['ID', 'Title', 'Content', 'Published', 'Created At', 'Updated At']);
            
            // Add data rows
            foreach ($posts as $post) {
                fputcsv($file, [
                    $post->id,
                    $post->title,
                    substr($post->content, 0, 100) . '...', // Truncate content
                    $post->published ? 'Yes' : 'No',
                    $post->created_at->format('Y-m-d H:i:s'),
                    $post->updated_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        };

        return FacadeResponse::stream($callback, 200, $headers);
    }
    
    /**
     * Export posts with custom formatting
     */
    public function exportPostsFormatted(Request $request)
    {
        $posts = Post::with('author')->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="posts-detailed-export.csv"',
        ];

        $callback = function() use ($posts) {
            $file = fopen('php://output', 'w');
            
            // Add detailed headers
            fputcsv($file, [
                'Post ID', 
                'Title', 
                'Author Name', 
                'Author Email', 
                'Word Count', 
                'Published Status', 
                'Publication Date', 
                'Tags'
            ]);
            
            // Add data rows
            foreach ($posts as $post) {
                fputcsv($file, [
                    $post->id,
                    $post->title,
                    $post->author->name ?? 'Unknown',
                    $post->author->email ?? 'N/A',
                    str_word_count($post->content),
                    $post->published ? 'Published' : 'Draft',
                    $post->published_at ? $post->published_at->format('Y-m-d') : 'N/A',
                    implode(', ', $post->tags->pluck('name')->toArray() ?? [])
                ]);
            }
            
            fclose($file);
        };

        return FacadeResponse::stream($callback, 200, $headers);
    }
}
?&gt;</code></pre>
            
            <h5>Excel Export with SheetJS (XLSX)</h5>
            <pre><code>// First install SheetJS: npm install xlsx
import * as XLSX from 'xlsx';

// Export to Excel
function exportToExcel(data, filename = 'data.xlsx') {
    // Create a new workbook
    const wb = XLSX.utils.book_new();
    
    // Convert data to worksheet
    const ws = XLSX.utils.json_to_sheet(data);
    
    // Add the worksheet to the workbook
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
    
    // Export the workbook
    XLSX.writeFile(wb, filename);
}

// Export multiple sheets
function exportMultipleSheets(exportData, filename = 'multi-sheet-export.xlsx') {
    const wb = XLSX.utils.book_new();
    
    // Add each dataset as a separate sheet
    Object.keys(exportData).forEach(sheetName => {
        const ws = XLSX.utils.json_to_sheet(exportData[sheetName]);
        XLSX.utils.book_append_sheet(wb, ws, sheetName);
    });
    
    XLSX.writeFile(wb, filename);
}

// React component with Excel export
export default function ExportButtons({ data }) {
    const handleCSVExport = () => {
        downloadCSV(data, 'export.csv');
    };
    
    const handleExcelExport = () => {
        exportToExcel(data, 'export.xlsx');
    };
    
    return (
        &lt;div className="flex space-x-2"&gt;
            &lt;button
                onClick={handleCSVExport}
                className="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
            &gt;
                Export CSV
            &lt;/button&gt;
            &lt;button
                onClick={handleExcelExport}
                className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            &gt;
                Export Excel
            &lt;/button&gt;
        &lt;/div&gt;
    );
}

// Usage example
const dashboardData = {
    'User Data': [
        { id: 1, name: 'John', email: 'john@example.com', role: 'Admin' },
        { id: 2, name: 'Jane', email: 'jane@example.com', role: 'User' }
    ],
    'Product Data': [
        { id: 1, name: 'Laptop', price: 999.99, category: 'Electronics' },
        { id: 2, name: 'Book', price: 19.99, category: 'Education' }
    ],
    'Order Data': [
        { id: 1, userId: 1, productId: 1, amount: 999.99, date: '2023-01-15' },
        { id: 2, userId: 2, productId: 2, amount: 19.99, date: '2023-01-16' }
    ]
};

function Dashboard() {
    return (
        &lt;div className="p-6"&gt;
            &lt;h1 className="text-2xl font-bold mb-4"&gt;Dashboard&lt;/h1&gt;
            &lt;ExportButtons data={dashboardData} /&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Backend Excel Export with Laravel Excel Package</h5>
            <pre><code>&lt;?php
// First install Laravel Excel: composer require maatwebsite/excel

// Create an Export class
namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PostsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Get the data collection
     */
    public function collection()
    {
        return Post::search($this->filters['search'] ?? null)
                  ->published($this->filters['published'] ?? null)
                  ->dateRange($this->filters['start_date'] ?? null, $this->filters['end_date'] ?? null)
                  ->sortBy($this->filters['sort_by'] ?? 'id', $this->filters['sort_direction'] ?? 'desc')
                  ->get();
    }

    /**
     * Define column headings
     */
    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Content',
            'Published',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * Map data to cells
     */
    public function map($post): array
    {
        return [
            $post->id,
            $post->title,
            substr($post->content, 0, 100) . '...',
            $post->published ? 'Yes' : 'No',
            $post->created_at->format('Y-m-d H:i:s'),
            $post->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Style the worksheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}

// In your Controller
namespace App\Http\Controllers;

use App\Exports\PostsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Export posts to Excel
     */
    public function exportPostsExcel(Request $request)
    {
        $filters = $request->only([
            'search', 'published', 'start_date', 'end_date', 'sort_by', 'sort_direction'
        ]);

        return Excel::download(new PostsExport($filters), 'posts-export.xlsx');
    }

    /**
     * Export posts to CSV
     */
    public function exportPostsCsv(Request $request)
    {
        $filters = $request->only([
            'search', 'published', 'start_date', 'end_date', 'sort_by', 'sort_direction'
        ]);

        return Excel::download(new PostsExport($filters), 'posts-export.csv');
    }
}
?&gt;</code></pre>
            
            <h5>Route Definitions</h5>
            <pre><code>&lt;?php
// In routes/web.php
use App\Http\Controllers\ExportController;

// Export routes
Route::get('/posts/export/csv', [ExportController::class, 'exportPostsCsv'])->name('posts.export.csv');
Route::get('/posts/export/excel', [ExportController::class, 'exportPostsExcel'])->name('posts.export.excel');

// In your PostController, add to existing routes
Route::get('/posts/export', [PostController::class, 'export'])->name('posts.export');
?&gt;</code></pre>
        </div>
    </div>
</section>