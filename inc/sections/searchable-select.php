<section id="searchable-select" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-menu-button-wide"></i>
            Searchable Select Component
        </h1>
        <p class="page-subtitle">Creating searchable select dropdowns with Tailwind CSS</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Searchable Select Implementation
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is a Searchable Select?</h6>
                <p>A searchable select component allows users to filter options in a dropdown by typing, making it easier to find specific items in large lists.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Component Details</h6>
                <p><strong>Implementation:</strong> React component with useState and filtering<br>
                <strong>Styling:</strong> Tailwind CSS classes<br>
                <strong>Dependencies:</strong> None (custom implementation)</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR SEARCHABLE SELECT</h6>
                <p><strong>Files:</strong> Custom React component - Implementation with search and filtering functionality</p>
            </div>
            
            <h5>React Component Implementation</h5>
            <pre><code>import { useState, useRef, useEffect } from 'react';

export default function SearchableSelect({ options, value, onChange, placeholder = "Select an option..." }) {
    const [isOpen, setIsOpen] = useState(false);
    const [searchTerm, setSearchTerm] = useState('');
    const [highlightedIndex, setHighlightedIndex] = useState(-1);
    const wrapperRef = useRef(null);
    const inputRef = useRef(null);
    
    // Filter options based on search term
    const filteredOptions = options.filter(option => 
        option.label.toLowerCase().includes(searchTerm.toLowerCase())
    );
    
    // Close dropdown when clicking outside
    useEffect(() => {
        function handleClickOutside(event) {
            if (wrapperRef.current && !wrapperRef.current.contains(event.target)) {
                setIsOpen(false);
                setSearchTerm('');
                setHighlightedIndex(-1);
            }
        }
        
        document.addEventListener('mousedown', handleClickOutside);
        return () => {
            document.removeEventListener('mousedown', handleClickOutside);
        };
    }, []);
    
    // Handle keyboard navigation
    const handleKeyDown = (e) => {
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            setHighlightedIndex(prev => 
                prev < filteredOptions.length - 1 ? prev + 1 : 0
            );
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            setHighlightedIndex(prev => 
                prev > 0 ? prev - 1 : filteredOptions.length - 1
            );
        } else if (e.key === 'Enter' && highlightedIndex >= 0) {
            e.preventDefault();
            handleSelect(filteredOptions[highlightedIndex]);
        } else if (e.key === 'Escape') {
            setIsOpen(false);
            setSearchTerm('');
        }
    };
    
    // Handle option selection
    const handleSelect = (option) => {
        onChange(option);
        setIsOpen(false);
        setSearchTerm('');
        setHighlightedIndex(-1);
    };
    
    // Get display value
    const displayValue = value ? value.label : '';
    
    return (
        &lt;div className="relative" ref={wrapperRef}&gt;
            &lt;div 
                className="flex items-center justify-between px-4 py-2 border border-gray-300 rounded-md cursor-pointer bg-white hover:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                onClick={() => {
                    setIsOpen(!isOpen);
                    if (!isOpen) {
                        setTimeout(() => inputRef.current?.focus(), 0);
                    }
                }}
            &gt;
                &lt;span className={displayValue ? "text-gray-900" : "text-gray-500"}&gt;
                    {displayValue || placeholder}
                &lt;/span&gt;
                &lt;svg 
                    className={`w-5 h-5 text-gray-400 transition-transform ${isOpen ? 'rotate-180' : ''}`} 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                &gt;
                    &lt;path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" /&gt;
                &lt;/svg&gt;
            &lt;/div&gt;
            
            {isOpen && (
                &lt;div className="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg"&gt;
                    &lt;input
                        ref={inputRef}
                        type="text"
                        className="w-full px-4 py-2 border-b border-gray-200 focus:outline-none"
                        placeholder="Search..."
                        value={searchTerm}
                        onChange={(e) => setSearchTerm(e.target.value)}
                        onKeyDown={handleKeyDown}
                    /&gt;
                    &lt;div className="max-h-60 overflow-y-auto"&gt;
                        {filteredOptions.length === 0 ? (
                            &lt;div className="px-4 py-2 text-gray-500"&gt;No options found&lt;/div&gt;
                        ) : (
                            filteredOptions.map((option, index) => (
                                &lt;div
                                    key={option.value}
                                    className={`px-4 py-2 cursor-pointer hover:bg-blue-500 hover:text-white ${
                                        highlightedIndex === index ? 'bg-blue-500 text-white' : ''
                                    } ${
                                        value && value.value === option.value ? 'bg-blue-100' : ''
                                    }`}
                                    onClick={() => handleSelect(option)}
                                &gt;
                                    {option.label}
                                &lt;/div&gt;
                            ))
                        )}
                    &lt;/div&gt;
                &lt;/div&gt;
            )}
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Usage Example</h5>
            <pre><code>import SearchableSelect from '@/components/SearchableSelect';

export default function ProductForm() {
    const [selectedCategory, setSelectedCategory] = useState(null);
    
    const categories = [
        { value: 1, label: 'Electronics' },
        { value: 2, label: 'Clothing' },
        { value: 3, label: 'Home & Garden' },
        { value: 4, label: 'Books' },
        { value: 5, label: 'Sports' },
        // ... more categories
    ];
    
    return (
        &lt;div className="max-w-md mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-4"&gt;Product Form&lt;/h2&gt;
            
            &lt;div className="mb-4"&gt;
                &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                    Category
                &lt;/label&gt;
                &lt;SearchableSelect
                    options={categories}
                    value={selectedCategory}
                    onChange={setSelectedCategory}
                    placeholder="Select a category..."
                /&gt;
            &lt;/div&gt;
            
            {selectedCategory && (
                &lt;p className="text-sm text-gray-600 mt-2"&gt;
                    Selected: {selectedCategory.label}
                &lt;/p&gt;
            )}
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Styling with Tailwind CSS</h5>
            <p>The component uses Tailwind CSS classes for styling. You can customize the appearance by modifying these classes:</p>
            <ul>
                <li><code>border-gray-300</code> - Border color</li>
                <li><code>rounded-md</code> - Border radius</li>
                <li><code>hover:border-blue-500</code> - Hover state border color</li>
                <li><code>focus:ring-blue-500</code> - Focus ring color</li>
                <li><code>hover:bg-blue-500</code> - Option hover background</li>
            </ul>
        </div>
    </div>
</section>