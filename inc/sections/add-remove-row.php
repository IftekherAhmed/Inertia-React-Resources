<section id="add-remove-row" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-plus-square"></i>
            Add/Remove Row Functionality
        </h1>
        <p class="page-subtitle">Dynamic form rows with add and remove capabilities</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Add/Remove Row Implementation
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is Add/Remove Row?</h6>
                <p>Add/Remove Row functionality allows users to dynamically add or remove form fields or table rows, commonly used in forms where users need to enter multiple similar items.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Component Details</h6>
                <p><strong>Implementation:</strong> React component with useState for managing dynamic rows<br>
                <strong>Styling:</strong> Tailwind CSS classes<br>
                <strong>Dependencies:</strong> None (custom implementation)</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR ADD/REMOVE ROW</h6>
                <p><strong>Files:</strong> Custom React component - Implementation with dynamic state management</p>
            </div>
            
            <h5>Basic Add/Remove Row Implementation</h5>
            <pre><code>import { useState } from 'react';

export default function DynamicForm() {
    const [rows, setRows] = useState([{ id: Date.now(), name: '', email: '' }]);
    
    const addRow = () => {
        setRows([...rows, { id: Date.now(), name: '', email: '' }]);
    };
    
    const removeRow = (id) => {
        if (rows.length > 1) {
            setRows(rows.filter(row => row.id !== id));
        }
    };
    
    const updateRow = (id, field, value) => {
        setRows(rows.map(row => 
            row.id === id ? { ...row, [field]: value } : row
        ));
    };
    
    const handleSubmit = (e) => {
        e.preventDefault();
        console.log('Submitted rows:', rows);
    };
    
    return (
        &lt;form onSubmit={handleSubmit} className="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-4"&gt;Contact Information&lt;/h2&gt;
            
            {rows.map((row, index) => (
                &lt;div key={row.id} className="grid grid-cols-1 md:grid-cols-12 gap-4 mb-4 p-4 border border-gray-200 rounded-lg"&gt;
                    &lt;div className="md:col-span-5"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Name
                        &lt;/label&gt;
                        &lt;input
                            type="text"
                            value={row.name}
                            onChange={(e) => updateRow(row.id, 'name', e.target.value)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter name"
                        /&gt;
                    &lt;/div&gt;
                    
                    &lt;div className="md:col-span-5"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Email
                        &lt;/label&gt;
                        &lt;input
                            type="email"
                            value={row.email}
                            onChange={(e) => updateRow(row.id, 'email', e.target.value)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter email"
                        /&gt;
                    &lt;/div&gt;
                    
                    &lt;div className="md:col-span-2 flex items-end"&gt;
                        {rows.length > 1 && (
                            &lt;button
                                type="button"
                                onClick={() => removeRow(row.id)}
                                className="w-full px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                            &gt;
                                Remove
                            &lt;/button&gt;
                        )}
                    &lt;/div&gt;
                &lt;/div&gt;
            ))}
            
            &lt;div className="flex justify-between mt-6"&gt;
                &lt;button
                    type="button"
                    onClick={addRow}
                    className="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                &gt;
                    + Add Row
                &lt;/button&gt;
                
                &lt;button
                    type="submit"
                    className="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                &gt;
                    Submit
                &lt;/button&gt;
            &lt;/div&gt;
        &lt;/form&gt;
    );
}</code></pre>
            
            <h5>Product Order Form with Price Calculation</h5>
            <pre><code>import { useState, useEffect } from 'react';

export default function ProductOrderForm() {
    const [rows, setRows] = useState([
        { id: Date.now(), product: '', quantity: 1, price: 0, total: 0 }
    ]);
    const [grandTotal, setGrandTotal] = useState(0);
    
    // Sample product data with prices
    const products = [
        { id: 1, name: 'Laptop', price: 999.99 },
        { id: 2, name: 'Mouse', price: 29.99 },
        { id: 3, name: 'Keyboard', price: 79.99 },
        { id: 4, name: 'Monitor', price: 299.99 },
        { id: 5, name: 'Headphones', price: 149.99 }
    ];
    
    // Calculate total when rows change
    useEffect(() => {
        const total = rows.reduce((sum, row) => sum + row.total, 0);
        setGrandTotal(total);
    }, [rows]);
    
    const addRow = () => {
        setRows([
            ...rows, 
            { id: Date.now(), product: '', quantity: 1, price: 0, total: 0 }
        ]);
    };
    
    const removeRow = (id) => {
        if (rows.length > 1) {
            setRows(rows.filter(row => row.id !== id));
        }
    };
    
    const updateRow = (id, field, value) => {
        setRows(rows.map(row => {
            if (row.id === id) {
                const updatedRow = { ...row, [field]: value };
                
                // If product changes, update price
                if (field === 'product') {
                    const selectedProduct = products.find(p => p.id === parseInt(value));
                    updatedRow.price = selectedProduct ? selectedProduct.price : 0;
                    updatedRow.total = updatedRow.price * updatedRow.quantity;
                }
                
                // If quantity changes, update total
                if (field === 'quantity') {
                    updatedRow.total = updatedRow.price * parseInt(value);
                }
                
                return updatedRow;
            }
            return row;
        }));
    };
    
    const handleSubmit = (e) => {
        e.preventDefault();
        console.log('Order submitted:', rows);
    };
    
    return (
        &lt;form onSubmit={handleSubmit} className="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-4"&gt;Product Order Form&lt;/h2&gt;
            
            &lt;div className="overflow-x-auto"&gt;
                &lt;table className="min-w-full divide-y divide-gray-200"&gt;
                    &lt;thead className="bg-gray-50"&gt;
                        &lt;tr&gt;
                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Product&lt;/th&gt;
                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Quantity&lt;/th&gt;
                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Price&lt;/th&gt;
                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Total&lt;/th&gt;
                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Actions&lt;/th&gt;
                        &lt;/tr&gt;
                    &lt;/thead&gt;
                    &lt;tbody className="bg-white divide-y divide-gray-200"&gt;
                        {rows.map((row, index) => (
                            &lt;tr key={row.id}&gt;
                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                    &lt;select
                                        value={row.product}
                                        onChange={(e) => updateRow(row.id, 'product', e.target.value)}
                                        className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    &gt;
                                        &lt;option value=""&gt;Select a product&lt;/option&gt;
                                        {products.map(product => (
                                            &lt;option key={product.id} value={product.id}&gt;
                                                {product.name}
                                            &lt;/option&gt;
                                        ))}
                                    &lt;/select&gt;
                                &lt;/td&gt;
                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                    &lt;input
                                        type="number"
                                        min="1"
                                        value={row.quantity}
                                        onChange={(e) => updateRow(row.id, 'quantity', parseInt(e.target.value) || 1)}
                                        className="w-20 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    /&gt;
                                &lt;/td&gt;
                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                    ${row.price.toFixed(2)}
                                &lt;/td&gt;
                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                    ${row.total.toFixed(2)}
                                &lt;/td&gt;
                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                    {rows.length > 1 && (
                                        &lt;button
                                            type="button"
                                            onClick={() => removeRow(row.id)}
                                            className="text-red-600 hover:text-red-900"
                                        &gt;
                                            Remove
                                        &lt;/button&gt;
                                    )}
                                &lt;/td&gt;
                            &lt;/tr&gt;
                        ))}
                    &lt;/tbody&gt;
                &lt;/table&gt;
            &lt;/div&gt;
            
            &lt;div className="flex justify-between items-center mt-6"&gt;
                &lt;button
                    type="button"
                    onClick={addRow}
                    className="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                &gt;
                    + Add Product
                &lt;/button&gt;
                
                &lt;div className="text-right"&gt;
                    &lt;div className="text-lg font-semibold"&gt;
                        Grand Total: ${grandTotal.toFixed(2)}
                    &lt;/div&gt;
                    &lt;button
                        type="submit"
                        className="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    &gt;
                        Place Order
                    &lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/form&gt;
    );
}</code></pre>
        </div>
    </div>
</section>