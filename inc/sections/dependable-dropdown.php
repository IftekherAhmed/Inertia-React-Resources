<section id="dependable-dropdown" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-diagram-3"></i>
            Dependable Dropdown Component
        </h1>
        <p class="page-subtitle">Creating dependent dropdowns where options depend on another selection</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Dependable Dropdown Implementation
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is a Dependable Dropdown?</h6>
                <p>A dependable dropdown (also known as a dependent or cascading dropdown) is a UI component where the options in one dropdown depend on the selection made in another dropdown.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Component Details</h6>
                <p><strong>Implementation:</strong> React component with useEffect for data fetching<br>
                <strong>Styling:</strong> Tailwind CSS classes<br>
                <strong>Dependencies:</strong> None (custom implementation)</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR DEPENDABLE DROPDOWN</h6>
                <p><strong>Files:</strong> Custom React component - Implementation with dependent data loading</p>
            </div>
            
            <h5>React Component Implementation</h5>
            <pre><code>import { useState, useEffect } from 'react';

export default function DependableDropdown({ 
    parentOptions, 
    childOptions, 
    parentValue, 
    childValue, 
    onParentChange, 
    onChildChange,
    parentLabel = "Parent",
    childLabel = "Child",
    parentPlaceholder = "Select...",
    childPlaceholder = "Select...",
    loading = false
}) {
    const [filteredChildOptions, setFilteredChildOptions] = useState([]);
    
    // Filter child options based on parent selection
    useEffect(() => {
        if (parentValue && childOptions) {
            const filtered = childOptions.filter(option => 
                option.parentId === parentValue.value
            );
            setFilteredChildOptions(filtered);
            
            // Reset child selection if it's no longer valid
            if (childValue && !filtered.some(opt => opt.value === childValue.value)) {
                onChildChange(null);
            }
        } else {
            setFilteredChildOptions([]);
            onChildChange(null);
        }
    }, [parentValue, childOptions, childValue, onChildChange]);
    
    return (
        &lt;div className="grid grid-cols-1 md:grid-cols-2 gap-4"&gt;
            &lt;div&gt;
                &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                    {parentLabel}
                &lt;/label&gt;
                &lt;select
                    value={parentValue ? parentValue.value : ''}
                    onChange={(e) => {
                        const selected = parentOptions.find(opt => opt.value === e.target.value);
                        onParentChange(selected || null);
                    }}
                    className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    disabled={loading}
                &gt;
                    &lt;option value=""&gt;{parentPlaceholder}&lt;/option&gt;
                    {parentOptions.map(option => (
                        &lt;option key={option.value} value={option.value}&gt;
                            {option.label}
                        &lt;/option&gt;
                    ))}
                &lt;/select&gt;
            &lt;/div&gt;
            
            &lt;div&gt;
                &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                    {childLabel}
                &lt;/label&gt;
                &lt;select
                    value={childValue ? childValue.value : ''}
                    onChange={(e) => {
                        const selected = filteredChildOptions.find(opt => opt.value === e.target.value);
                        onChildChange(selected || null);
                    }}
                    className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    disabled={!parentValue || loading}
                &gt;
                    &lt;option value=""&gt;{childPlaceholder}&lt;/option&gt;
                    {filteredChildOptions.map(option => (
                        &lt;option key={option.value} value={option.value}&gt;
                            {option.label}
                        &lt;/option&gt;
                    ))}
                &lt;/select&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Usage Example with API Data</h5>
            <pre><code>import { useState, useEffect } from 'react';
import DependableDropdown from '@/components/DependableDropdown';

export default function LocationForm() {
    const [countries, setCountries] = useState([]);
    const [states, setStates] = useState([]);
    const [selectedCountry, setSelectedCountry] = useState(null);
    const [selectedState, setSelectedState] = useState(null);
    const [loading, setLoading] = useState(false);
    
    // Fetch countries on component mount
    useEffect(() => {
        fetchCountries();
    }, []);
    
    const fetchCountries = async () => {
        try {
            setLoading(true);
            // Example API call
            const response = await fetch('/api/countries');
            const data = await response.json();
            setCountries(data.map(country => ({
                value: country.id,
                label: country.name
            })));
        } catch (error) {
            console.error('Error fetching countries:', error);
        } finally {
            setLoading(false);
        }
    };
    
    // Fetch states when country changes
    useEffect(() => {
        if (selectedCountry) {
            fetchStates(selectedCountry.value);
        } else {
            setStates([]);
        }
    }, [selectedCountry]);
    
    const fetchStates = async (countryId) => {
        try {
            setLoading(true);
            // Example API call
            const response = await fetch(`/api/countries/${countryId}/states`);
            const data = await response.json();
            setStates(data.map(state => ({
                value: state.id,
                label: state.name,
                parentId: countryId
            })));
        } catch (error) {
            console.error('Error fetching states:', error);
        } finally {
            setLoading(false);
        }
    };
    
    const handleSubmit = (e) => {
        e.preventDefault();
        console.log('Selected:', { country: selectedCountry, state: selectedState });
    };
    
    return (
        &lt;form onSubmit={handleSubmit} className="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-4"&gt;Location Form&lt;/h2&gt;
            
            &lt;DependableDropdown
                parentOptions={countries}
                childOptions={states}
                parentValue={selectedCountry}
                childValue={selectedState}
                onParentChange={setSelectedCountry}
                onChildChange={setSelectedState}
                parentLabel="Country"
                childLabel="State/Province"
                parentPlaceholder="Select a country..."
                childPlaceholder="Select a state..."
                loading={loading}
            /&gt;
            
            &lt;div className="mt-6"&gt;
                &lt;button
                    type="submit"
                    className="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    disabled={!selectedCountry || !selectedState || loading}
                &gt;
                    {loading ? 'Loading...' : 'Submit'}
                &lt;/button&gt;
            &lt;/div&gt;
        &lt;/form&gt;
    );
}</code></pre>
            
            <h5>Static Data Example</h5>
            <pre><code>import { useState } from 'react';
import DependableDropdown from '@/components/DependableDropdown';

export default function CategoryForm() {
    const [selectedCategory, setSelectedCategory] = useState(null);
    const [selectedSubcategory, setSelectedSubcategory] = useState(null);
    
    // Static data example
    const categories = [
        { value: 1, label: 'Electronics' },
        { value: 2, label: 'Clothing' },
        { value: 3, label: 'Home & Garden' }
    ];
    
    const subcategories = [
        // Electronics
        { value: 101, label: 'Smartphones', parentId: 1 },
        { value: 102, label: 'Laptops', parentId: 1 },
        { value: 103, label: 'Tablets', parentId: 1 },
        // Clothing
        { value: 201, label: 'Shirts', parentId: 2 },
        { value: 202, label: 'Pants', parentId: 2 },
        { value: 203, label: 'Shoes', parentId: 2 },
        // Home & Garden
        { value: 301, label: 'Furniture', parentId: 3 },
        { value: 302, label: 'Garden Tools', parentId: 3 }
    ];
    
    return (
        &lt;div className="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-4"&gt;Product Category&lt;/h2&gt;
            
            &lt;DependableDropdown
                parentOptions={categories}
                childOptions={subcategories}
                parentValue={selectedCategory}
                childValue={selectedSubcategory}
                onParentChange={setSelectedCategory}
                onChildChange={setSelectedSubcategory}
                parentLabel="Category"
                childLabel="Subcategory"
                parentPlaceholder="Select a category..."
                childPlaceholder="Select a subcategory..."
            /&gt;
            
            {selectedCategory && selectedSubcategory && (
                &lt;div className="mt-4 p-3 bg-green-50 rounded-md"&gt;
                    &lt;p className="text-green-800"&gt;
                        Selected: {selectedCategory.label} &gt; {selectedSubcategory.label}
                    &lt;/p&gt;
                &lt;/div&gt;
            )}
        &lt;/div&gt;
    );
}</code></pre>
        </div>
    </div>
</section>