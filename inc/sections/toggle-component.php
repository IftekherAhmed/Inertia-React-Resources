<section id="toggle-component" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-toggle-on"></i>
            Toggle Switch Component
        </h1>
        <p class="page-subtitle">Custom toggle switches with Tailwind CSS styling</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Toggle Switch Implementation
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What is a Toggle Switch?</h6>
                <p>A toggle switch is a UI control that allows users to switch between two states (on/off, true/false, enabled/disabled) with a single click or tap.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Component Details</h6>
                <p><strong>Implementation:</strong> React component with useState for state management<br>
                <strong>Styling:</strong> Tailwind CSS classes<br>
                <strong>Dependencies:</strong> None (custom implementation)</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR TOGGLE SWITCH</h6>
                <p><strong>Files:</strong> Custom React component - Implementation with smooth transitions</p>
            </div>
            
            <h5>Basic Toggle Switch Implementation</h5>
            <pre><code>import { useState } from 'react';

export default function ToggleSwitch({ 
    checked = false, 
    onChange, 
    label = "", 
    disabled = false,
    size = "md" // "sm", "md", "lg"
}) {
    const [isChecked, setIsChecked] = useState(checked);
    
    const handleToggle = () => {
        if (disabled) return;
        
        const newValue = !isChecked;
        setIsChecked(newValue);
        if (onChange) {
            onChange(newValue);
        }
    };
    
    // Size classes
    const sizeClasses = {
        sm: {
            switch: "w-8 h-4",
            toggle: "w-3 h-3",
            translate: "translate-x-4"
        },
        md: {
            switch: "w-12 h-6",
            toggle: "w-5 h-5",
            translate: "translate-x-6"
        },
        lg: {
            switch: "w-16 h-8",
            toggle: "w-7 h-7",
            translate: "translate-x-8"
        }
    };
    
    const sizes = sizeClasses[size] || sizeClasses.md;
    
    return (
        &lt;div className="flex items-center"&gt;
            &lt;button
                type="button"
                role="switch"
                aria-checked={isChecked}
                disabled={disabled}
                onClick={handleToggle}
                className={`
                    relative inline-flex flex-shrink-0 cursor-pointer border-2 border-transparent rounded-full 
                    transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                    ${sizes.switch}
                    ${isChecked ? 'bg-blue-600' : 'bg-gray-200'}
                    ${disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'}
                `}
            &gt;
                &lt;span
                    aria-hidden="true"
                    className={`
                        pointer-events-none inline-block bg-white rounded-full shadow transform ring-0 
                        transition ease-in-out duration-200
                        ${sizes.toggle}
                        ${isChecked ? sizes.translate : 'translate-x-0'}
                    `}
                /&gt;
            &lt;/button&gt;
            {label && (
                &lt;span 
                    className={`ml-3 ${disabled ? 'text-gray-400' : 'text-gray-700'}`}
                    onClick={() => !disabled && handleToggle()}
                &gt;
                    {label}
                &lt;/span&gt;
            )}
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Usage Examples</h5>
            <pre><code>import { useState } from 'react';
import ToggleSwitch from '@/components/ToggleSwitch';

export default function SettingsForm() {
    const [notifications, setNotifications] = useState(true);
    const [darkMode, setDarkMode] = useState(false);
    const [autoSave, setAutoSave] = useState(true);
    
    return (
        &lt;div className="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow"&gt;
            &lt;h2 className="text-xl font-semibold mb-6"&gt;Settings&lt;/h2&gt;
            
            &lt;div className="space-y-6"&gt;
                &lt;div className="flex items-center justify-between p-4 border border-gray-200 rounded-lg"&gt;
                    &lt;div&gt;
                        &lt;h3 className="font-medium text-gray-900"&gt;Email Notifications&lt;/h3&gt;
                        &lt;p className="text-sm text-gray-500"&gt;Receive email notifications for important updates&lt;/p&gt;
                    &lt;/div&gt;
                    &lt;ToggleSwitch
                        checked={notifications}
                        onChange={setNotifications}
                        size="md"
                    /&gt;
                &lt;/div&gt;
                
                &lt;div className="flex items-center justify-between p-4 border border-gray-200 rounded-lg"&gt;
                    &lt;div&gt;
                        &lt;h3 className="font-medium text-gray-900"&gt;Dark Mode&lt;/h3&gt;
                        &lt;p className="text-sm text-gray-500"&gt;Enable dark theme for the application&lt;/p&gt;
                    &lt;/div&gt;
                    &lt;ToggleSwitch
                        checked={darkMode}
                        onChange={setDarkMode}
                        size="md"
                    /&gt;
                &lt;/div&gt;
                
                &lt;div className="flex items-center justify-between p-4 border border-gray-200 rounded-lg"&gt;
                    &lt;div&gt;
                        &lt;h3 className="font-medium text-gray-900"&gt;Auto Save&lt;/h3&gt;
                        &lt;p className="text-sm text-gray-500"&gt;Automatically save changes as you type&lt;/p&gt;
                    &lt;/div&gt;
                    &lt;ToggleSwitch
                        checked={autoSave}
                        onChange={setAutoSave}
                        size="md"
                    /&gt;
                &lt;/div&gt;
                
                &lt;div className="pt-4"&gt;
                    &lt;h3 className="font-medium text-gray-900 mb-4"&gt;Size Variations&lt;/h3&gt;
                    &lt;div className="flex items-center space-x-6"&gt;
                        &lt;div className="flex items-center"&gt;
                            &lt;ToggleSwitch size="sm" /&gt;
                            &lt;span className="ml-2 text-sm text-gray-600"&gt;Small&lt;/span&gt;
                        &lt;/div&gt;
                        &lt;div className="flex items-center"&gt;
                            &lt;ToggleSwitch size="md" /&gt;
                            &lt;span className="ml-2 text-sm text-gray-600"&gt;Medium&lt;/span&gt;
                        &lt;/div&gt;
                        &lt;div className="flex items-center"&gt;
                            &lt;ToggleSwitch size="lg" /&gt;
                            &lt;span className="ml-2 text-sm text-gray-600"&gt;Large&lt;/span&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
                
                &lt;div className="pt-4"&gt;
                    &lt;h3 className="font-medium text-gray-900 mb-4"&gt;With Labels&lt;/h3&gt;
                    &lt;div className="space-y-4"&gt;
                        &lt;ToggleSwitch
                            checked={notifications}
                            onChange={setNotifications}
                            label="Enable notifications"
                        /&gt;
                        &lt;ToggleSwitch
                            checked={darkMode}
                            onChange={setDarkMode}
                            label="Dark mode"
                        /&gt;
                        &lt;ToggleSwitch
                            checked={false}
                            onChange={() => {}}
                            label="Disabled toggle"
                            disabled={true}
                        /&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Product Status Toggle Implementation</h5>
            <pre><code>import { useState } from 'react';
import ToggleSwitch from '@/components/ToggleSwitch';

export default function ProductStatusToggle({ product, onStatusChange }) {
    const [isPublished, setIsPublished] = useState(product.published || false);
    const [isLoading, setIsLoading] = useState(false);
    
    const handleToggle = async (newStatus) => {
        setIsLoading(true);
        try {
            // Simulate API call
            await new Promise(resolve => setTimeout(resolve, 500));
            
            // Update local state
            setIsPublished(newStatus);
            
            // Call parent handler if provided
            if (onStatusChange) {
                onStatusChange(product.id, newStatus);
            }
        } catch (error) {
            console.error('Failed to update product status:', error);
            // Revert to previous state on error
            setIsPublished(!newStatus);
        } finally {
            setIsLoading(false);
        }
    };
    
    return (
        &lt;div className="flex items-center"&gt;
            {isLoading ? (
                &lt;div className="w-12 h-6 flex items-center justify-center"&gt;
                    &lt;div className="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-600"&gt;&lt;/div&gt;
                &lt;/div&gt;
            ) : (
                &lt;&gt;
                    &lt;ToggleSwitch
                        checked={isPublished}
                        onChange={handleToggle}
                        disabled={isLoading}
                    /&gt;
                    &lt;span className={`ml-2 text-sm font-medium ${
                        isPublished ? 'text-green-600' : 'text-gray-500'
                    }`}&gt;
                        {isPublished ? 'Published' : 'Draft'}
                    &lt;/span&gt;
                &lt;/&gt;
            )}
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Styling with Tailwind CSS</h5>
            <p>The toggle switch uses Tailwind CSS utility classes for styling. You can customize the appearance by modifying these classes:</p>
            <ul>
                <li><code>bg-blue-600</code> - Active state background color</li>
                <li><code>bg-gray-200</code> - Inactive state background color</li>
                <li><code>rounded-full</code> - Circular shape</li>
                <li><code>transition-colors</code> - Smooth color transition</li>
                <li><code>focus:ring-blue-500</code> - Focus ring color</li>
            </ul>
        </div>
    </div>
</section>