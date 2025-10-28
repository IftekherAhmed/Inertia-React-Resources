<section id="price-calculation" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-calculator"></i>
            Product Price Calculation
        </h1>
        <p class="page-subtitle">Dynamic price calculation based on quantity and other factors</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Price Calculation Implementation
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is Price Calculation?</h6>
                <p>Price calculation functionality dynamically computes product prices based on quantity, discounts, taxes, and other variables in real-time as users interact with forms.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Component Details</h6>
                <p><strong>Implementation:</strong> React component with useEffect for calculations<br>
                <strong>Styling:</strong> Tailwind CSS classes<br>
                <strong>Dependencies:</strong> None (custom implementation)</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR PRICE CALCULATION</h6>
                <p><strong>Files:</strong> Custom React component - Implementation with dynamic calculations</p>
            </div>
            
            <h5>Basic Quantity-Based Price Calculation</h5>
            <pre><code>import { useState, useEffect } from 'react';

export default function ProductCalculator() {
    const [quantity, setQuantity] = useState(1);
    const [unitPrice, setUnitPrice] = useState(29.99);
    const [discountRate, setDiscountRate] = useState(0);
    const [taxRate, setTaxRate] = useState(0.08);
    const [subtotal, setSubtotal] = useState(0);
    const [discountAmount, setDiscountAmount] = useState(0);
    const [taxAmount, setTaxAmount] = useState(0);
    const [total, setTotal] = useState(0);
    
    // Calculate prices when inputs change
    useEffect(() => {
        // Calculate subtotal
        const calculatedSubtotal = quantity * unitPrice;
        setSubtotal(calculatedSubtotal);
        
        // Calculate discount
        const calculatedDiscount = calculatedSubtotal * (discountRate / 100);
        setDiscountAmount(calculatedDiscount);
        
        // Calculate taxable amount
        const taxableAmount = calculatedSubtotal - calculatedDiscount;
        
        // Calculate tax
        const calculatedTax = taxableAmount * taxRate;
        setTaxAmount(calculatedTax);
        
        // Calculate total
        const calculatedTotal = taxableAmount + calculatedTax;
        setTotal(calculatedTotal);
    }, [quantity, unitPrice, discountRate, taxRate]);
    
    return (
        &lt;div className="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-4"&gt;Product Price Calculator&lt;/h2&gt;
            
            &lt;div className="grid grid-cols-1 md:grid-cols-2 gap-6"&gt;
                &lt;div&gt;
                    &lt;h3 className="text-lg font-medium mb-3"&gt;Product Details&lt;/h3&gt;
                    
                    &lt;div className="mb-4"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Quantity
                        &lt;/label&gt;
                        &lt;input
                            type="number"
                            min="1"
                            value={quantity}
                            onChange={(e) => setQuantity(parseInt(e.target.value) || 1)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        /&gt;
                    &lt;/div&gt;
                    
                    &lt;div className="mb-4"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Unit Price ($)
                        &lt;/label&gt;
                        &lt;input
                            type="number"
                            step="0.01"
                            min="0"
                            value={unitPrice}
                            onChange={(e) => setUnitPrice(parseFloat(e.target.value) || 0)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        /&gt;
                    &lt;/div&gt;
                    
                    &lt;div className="mb-4"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Discount (%)
                        &lt;/label&gt;
                        &lt;input
                            type="number"
                            min="0"
                            max="100"
                            value={discountRate}
                            onChange={(e) => setDiscountRate(parseFloat(e.target.value) || 0)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        /&gt;
                    &lt;/div&gt;
                    
                    &lt;div className="mb-4"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Tax Rate (%)
                        &lt;/label&gt;
                        &lt;input
                            type="number"
                            step="0.01"
                            min="0"
                            value={taxRate * 100}
                            onChange={(e) => setTaxRate((parseFloat(e.target.value) || 0) / 100)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        /&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
                
                &lt;div&gt;
                    &lt;h3 className="text-lg font-medium mb-3"&gt;Price Breakdown&lt;/h3&gt;
                    
                    &lt;div className="space-y-2"&gt;
                        &lt;div className="flex justify-between"&gt;
                            &lt;span&gt;Subtotal:&lt;/span&gt;
                            &lt;span&gt;${subtotal.toFixed(2)}&lt;/span&gt;
                        &lt;/div&gt;
                        
                        &lt;div className="flex justify-between"&gt;
                            &lt;span&gt;Discount ({discountRate}%):&lt;/span&gt;
                            &lt;span className="text-red-600"&gt;-${discountAmount.toFixed(2)}&lt;/span&gt;
                        &lt;/div&gt;
                        
                        &lt;div className="flex justify-between pt-2 border-t border-gray-200"&gt;
                            &lt;span&gt;Taxable Amount:&lt;/span&gt;
                            &lt;span&gt;${(subtotal - discountAmount).toFixed(2)}&lt;/span&gt;
                        &lt;/div&gt;
                        
                        &lt;div className="flex justify-between"&gt;
                            &lt;span&gt;Tax ({taxRate * 100}%):&lt;/span&gt;
                            &lt;span&gt;${taxAmount.toFixed(2)}&lt;/span&gt;
                        &lt;/div&gt;
                        
                        &lt;div className="flex justify-between pt-2 border-t border-gray-200 font-semibold text-lg"&gt;
                            &lt;span&gt;Total:&lt;/span&gt;
                            &lt;span&gt;${total.toFixed(2)}&lt;/span&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                    
                    &lt;div className="mt-6 p-4 bg-blue-50 rounded-lg"&gt;
                        &lt;p className="text-center text-blue-800"&gt;
                            Unit Price: ${unitPrice.toFixed(2)} × Quantity: {quantity} = ${subtotal.toFixed(2)}
                        &lt;/p&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Advanced Price Calculation with Tiered Pricing</h5>
            <pre><code>import { useState, useEffect } from 'react';

export default function TieredPricingCalculator() {
    const [quantity, setQuantity] = useState(1);
    const [selectedProduct, setSelectedProduct] = useState(null);
    const [totalPrice, setTotalPrice] = useState(0);
    
    // Product data with tiered pricing
    const products = [
        {
            id: 1,
            name: 'Premium Widget',
            tiers: [
                { min: 1, max: 10, price: 25.00 },
                { min: 11, max: 50, price: 22.50 },
                { min: 51, max: 100, price: 20.00 },
                { min: 101, max: Infinity, price: 18.00 }
            ]
        },
        {
            id: 2,
            name: 'Standard Gadget',
            tiers: [
                { min: 1, max: 5, price: 15.00 },
                { min: 6, max: 20, price: 13.50 },
                { min: 21, max: 50, price: 12.00 },
                { min: 51, max: Infinity, price: 10.00 }
            ]
        }
    ];
    
    // Calculate price based on quantity and selected product
    useEffect(() => {
        if (selectedProduct && quantity > 0) {
            // Find applicable tier
            const tier = selectedProduct.tiers.find(t => 
                quantity >= t.min && quantity <= t.max
            );
            
            if (tier) {
                setTotalPrice(tier.price * quantity);
            } else {
                setTotalPrice(0);
            }
        } else {
            setTotalPrice(0);
        }
    }, [quantity, selectedProduct]);
    
    // Get pricing information for display
    const getPricingInfo = () => {
        if (!selectedProduct || quantity <= 0) return null;
        
        const tier = selectedProduct.tiers.find(t => 
            quantity >= t.min && quantity <= t.max
        );
        
        if (!tier) return null;
        
        return {
            tier,
            unitPrice: tier.price,
            totalPrice: tier.price * quantity,
            nextTier: selectedProduct.tiers.find(t => t.min > tier.max)
        };
    };
    
    const pricingInfo = getPricingInfo();
    
    return (
        &lt;div className="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-4"&gt;Tiered Pricing Calculator&lt;/h2&gt;
            
            &lt;div className="grid grid-cols-1 md:grid-cols-3 gap-6"&gt;
                &lt;div className="md:col-span-1"&gt;
                    &lt;div className="mb-4"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Product
                        &lt;/label&gt;
                        &lt;select
                            value={selectedProduct?.id || ''}
                            onChange={(e) => {
                                const product = products.find(p => p.id === parseInt(e.target.value));
                                setSelectedProduct(product || null);
                            }}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        &gt;
                            &lt;option value=""&gt;Select a product&lt;/option&gt;
                            {products.map(product => (
                                &lt;option key={product.id} value={product.id}&gt;
                                    {product.name}
                                &lt;/option&gt;
                            ))}
                        &lt;/select&gt;
                    &lt;/div&gt;
                    
                    &lt;div className="mb-4"&gt;
                        &lt;label className="block text-sm font-medium text-gray-700 mb-1"&gt;
                            Quantity
                        &lt;/label&gt;
                        &lt;input
                            type="number"
                            min="1"
                            value={quantity}
                            onChange={(e) => setQuantity(parseInt(e.target.value) || 1)}
                            className="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            disabled={!selectedProduct}
                        /&gt;
                    &lt;/div&gt;
                    
                    {pricingInfo && (
                        &lt;div className="p-4 bg-green-50 rounded-lg"&gt;
                            &lt;h3 className="font-medium text-green-800 mb-2"&gt;Savings Information&lt;/h3&gt;
                            &lt;p className="text-sm text-green-700"&gt;
                                You're getting the {pricingInfo.tier.min}-{pricingInfo.tier.max === Infinity ? '∞' : pricingInfo.tier.max} quantity discount!
                            &lt;/p&gt;
                            {pricingInfo.nextTier && (
                                &lt;p className="text-sm text-green-700 mt-1"&gt;
                                    Order {pricingInfo.nextTier.min - quantity} more to save ${(pricingInfo.nextTier.price * (pricingInfo.nextTier.min - quantity)).toFixed(2)}!
                                &lt;/p&gt;
                            )}
                        &lt;/div&gt;
                    )}
                &lt;/div&gt;
                
                &lt;div className="md:col-span-2"&gt;
                    {selectedProduct ? (
                        &lt;div&gt;
                            &lt;h3 className="text-lg font-medium mb-3"&gt;{selectedProduct.name} Pricing Tiers&lt;/h3&gt;
                            
                            &lt;div className="overflow-x-auto"&gt;
                                &lt;table className="min-w-full divide-y divide-gray-200"&gt;
                                    &lt;thead className="bg-gray-50"&gt;
                                        &lt;tr&gt;
                                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Quantity&lt;/th&gt;
                                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Unit Price&lt;/th&gt;
                                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Total for {quantity}&lt;/th&gt;
                                            &lt;th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"&gt;Status&lt;/th&gt;
                                        &lt;/tr&gt;
                                    &lt;/thead&gt;
                                    &lt;tbody className="bg-white divide-y divide-gray-200"&gt;
                                        {selectedProduct.tiers.map((tier, index) => (
                                            &lt;tr 
                                                key={index} 
                                                className={quantity >= tier.min && quantity <= tier.max ? 'bg-blue-50' : ''}
                                            &gt;
                                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                                    {tier.min} - {tier.max === Infinity ? '∞' : tier.max}
                                                &lt;/td&gt;
                                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                                    ${tier.price.toFixed(2)}
                                                &lt;/td&gt;
                                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                                    ${(tier.price * quantity).toFixed(2)}
                                                &lt;/td&gt;
                                                &lt;td className="px-6 py-4 whitespace-nowrap"&gt;
                                                    {quantity >= tier.min && quantity <= tier.max ? (
                                                        &lt;span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"&gt;
                                                            Current Tier
                                                        &lt;/span&gt;
                                                    ) : quantity &lt; tier.min ? (
                                                        &lt;span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800"&gt;
                                                            Next Tier
                                                        &lt;/span&gt;
                                                    ) : (
                                                        &lt;span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800"&gt;
                                                            Past Tier
                                                        &lt;/span&gt;
                                                    )}
                                                &lt;/td&gt;
                                            &lt;/tr&gt;
                                        ))}
                                    &lt;/tbody&gt;
                                &lt;/table&gt;
                            &lt;/div&gt;
                            
                            {pricingInfo && (
                                &lt;div className="mt-6 p-4 bg-blue-50 rounded-lg"&gt;
                                    &lt;div className="flex justify-between items-center"&gt;
                                        &lt;div&gt;
                                            &lt;h4 className="font-medium text-blue-800"&gt;Order Summary&lt;/h4&gt;
                                            &lt;p className="text-sm text-blue-700"&gt;
                                                {quantity} × ${pricingInfo.unitPrice.toFixed(2)} = ${pricingInfo.totalPrice.toFixed(2)}
                                            &lt;/p&gt;
                                        &lt;/div&gt;
                                        &lt;div className="text-right"&gt;
                                            &lt;div className="text-2xl font-bold text-blue-900"&gt;
                                                ${pricingInfo.totalPrice.toFixed(2)}
                                            &lt;/div&gt;
                                            &lt;p className="text-sm text-blue-700"&gt;Total Price&lt;/p&gt;
                                        &lt;/div&gt;
                                    &lt;/div&gt;
                                &lt;/div&gt;
                            )}
                        &lt;/div&gt;
                    ) : (
                        &lt;div className="text-center py-12 text-gray-500"&gt;
                            &lt;p&gt;Select a product to view pricing information&lt;/p&gt;
                        &lt;/div&gt;
                    )}
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    );
}</code></pre>
        </div>
    </div>
</section>