<section id="custom-layouts" class="content-section">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-layout-sidebar"></i>
            Custom Layouts
        </h1>
        <p class="page-subtitle">Creating custom layouts for login, register, and other special pages</p>
    </div>
    
    <div class="card">
        <div class="card-header">
            <i class="bi bi-code"></i> Custom Layout Implementation
        </div>
        <div class="card-body">
            <div class="definition-box">
                <h6><i class="bi bi-info-circle"></i> What are Custom Layouts?</h6>
                <p>Custom layouts are specialized page structures that differ from the main application layout, typically used for authentication pages, landing pages, or other unique sections of an application.</p>
            </div>
            
            <div class="info-callout">
                <h6><i class="bi bi-info-circle"></i> Layout Details</h6>
                <p><strong>Implementation:</strong> React components with different structural approaches<br>
                <strong>Styling:</strong> Tailwind CSS classes<br>
                <strong>Integration:</strong> Inertia.js layout system</p>
            </div>
            
            <div class="alert-pattern">
                <h6><i class="bi bi-lightning"></i> FOR CUSTOM LAYOUTS</h6>
                <p><strong>Files:</strong> Custom layout components and page implementations</p>
            </div>
            
            <h5>Basic Custom Layout Structure</h5>
            <pre><code>// resources/js/layouts/GuestLayout.jsx
import { Head } from '@inertiajs/react';

export default function GuestLayout({ children, title }) {
    return (
        &lt;div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"&gt;
            &lt;Head title={title} /&gt;
            
            &lt;div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"&gt;
                {children}
            &lt;/div&gt;
            
            &lt;footer className="mt-8 text-center text-sm text-gray-500"&gt;
                &copy; {new Date().getFullYear()} Your Application. All rights reserved.
            &lt;/footer&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Login Page with Custom Layout</h5>
            <pre><code>// resources/js/pages/Auth/Login.jsx
import { useEffect } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import GuestLayout from '@/layouts/GuestLayout';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    useEffect(() => {
        return () => {
            reset('password');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route('login'));
    };

    return (
        &lt;GuestLayout title="Log in"&gt;
            &lt;div className="mb-4 text-sm text-gray-600"&gt;
                Sign in to your account
            &lt;/div&gt;

            {status && &lt;div className="mb-4 font-medium text-sm text-green-600"&gt;{status}&lt;/div&gt;}

            &lt;form onSubmit={submit}&gt;
                &lt;div&gt;
                    &lt;label className="block font-medium text-sm text-gray-700"&gt;Email&lt;/label&gt;
                    &lt;input
                        type="email"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        className="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required
                        autoComplete="username"
                    /&gt;
                    {errors.email && &lt;div className="mt-1 text-sm text-red-600"&gt;{errors.email}&lt;/div&gt;}
                &lt;/div&gt;

                &lt;div className="mt-4"&gt;
                    &lt;label className="block font-medium text-sm text-gray-700"&gt;Password&lt;/label&gt;
                    &lt;input
                        type="password"
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        className="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required
                        autoComplete="current-password"
                    /&gt;
                    {errors.password && &lt;div className="mt-1 text-sm text-red-600"&gt;{errors.password}&lt;/div&gt;}
                &lt;/div&gt;

                &lt;div className="block mt-4"&gt;
                    &lt;label className="flex items-center"&gt;
                        &lt;input
                            type="checkbox"
                            checked={data.remember}
                            onChange={(e) => setData('remember', e.target.checked)}
                            className="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                        /&gt;
                        &lt;span className="ml-2 text-sm text-gray-600"&gt;Remember me&lt;/span&gt;
                    &lt;/label&gt;
                &lt;/div&gt;

                &lt;div className="flex items-center justify-end mt-4"&gt;
                    {canResetPassword && (
                        &lt;Link
                            href={route('password.request')}
                            className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        &gt;
                            Forgot your password?
                        &lt;/Link&gt;
                    )}

                    &lt;button
                        type="submit"
                        className="ml-4 px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        disabled={processing}
                    &gt;
                        Log in
                    &lt;/button&gt;
                &lt;/div&gt;
            &lt;/form&gt;
            
            &lt;div className="mt-6 text-center"&gt;
                &lt;Link
                    href={route('register')}
                    className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                &gt;
                    Don't have an account? Register
                &lt;/Link&gt;
            &lt;/div&gt;
        &lt;/GuestLayout&gt;
    );
}</code></pre>
            
            <h5>Register Page with Custom Layout</h5>
            <pre><code>// resources/js/pages/Auth/Register.jsx
import { useEffect } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import GuestLayout from '@/layouts/GuestLayout';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    useEffect(() => {
        return () => {
            reset('password', 'password_confirmation');
        };
    }, []);

    const submit = (e) => {
        e.preventDefault();
        post(route('register'));
    };

    return (
        &lt;GuestLayout title="Register"&gt;
            &lt;div className="mb-4 text-sm text-gray-600"&gt;
                Create a new account
            &lt;/div&gt;

            &lt;form onSubmit={submit}&gt;
                &lt;div&gt;
                    &lt;label className="block font-medium text-sm text-gray-700"&gt;Name&lt;/label&gt;
                    &lt;input
                        type="text"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        className="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required
                        autoComplete="name"
                        autoFocus
                    /&gt;
                    {errors.name && &lt;div className="mt-1 text-sm text-red-600"&gt;{errors.name}&lt;/div&gt;}
                &lt;/div&gt;

                &lt;div className="mt-4"&gt;
                    &lt;label className="block font-medium text-sm text-gray-700"&gt;Email&lt;/label&gt;
                    &lt;input
                        type="email"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        className="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required
                        autoComplete="username"
                    /&gt;
                    {errors.email && &lt;div className="mt-1 text-sm text-red-600"&gt;{errors.email}&lt;/div&gt;}
                &lt;/div&gt;

                &lt;div className="mt-4"&gt;
                    &lt;label className="block font-medium text-sm text-gray-700"&gt;Password&lt;/label&gt;
                    &lt;input
                        type="password"
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        className="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required
                        autoComplete="new-password"
                    /&gt;
                    {errors.password && &lt;div className="mt-1 text-sm text-red-600"&gt;{errors.password}&lt;/div&gt;}
                &lt;/div&gt;

                &lt;div className="mt-4"&gt;
                    &lt;label className="block font-medium text-sm text-gray-700"&gt;Confirm Password&lt;/label&gt;
                    &lt;input
                        type="password"
                        value={data.password_confirmation}
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        className="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        required
                        autoComplete="new-password"
                    /&gt;
                &lt;/div&gt;

                &lt;div className="flex items-center justify-end mt-4"&gt;
                    &lt;Link
                        href={route('login')}
                        className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    &gt;
                        Already registered?
                    &lt;/Link&gt;

                    &lt;button
                        type="submit"
                        className="ml-4 px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        disabled={processing}
                    &gt;
                        Register
                    &lt;/button&gt;
                &lt;/div&gt;
            &lt;/form&gt;
        &lt;/GuestLayout&gt;
    );
}</code></pre>
            
            <h5>Advanced Custom Layout with Branding</h5>
            <pre><code>// resources/js/layouts/MarketingLayout.jsx
import { Head } from '@inertiajs/react';

export default function MarketingLayout({ children, title }) {
    return (
        &lt;div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100"&gt;
            &lt;Head title={title} /&gt;
            
            &lt;header className="bg-white shadow-sm"&gt;
                &lt;div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"&gt;
                    &lt;div className="flex justify-between h-16"&gt;
                        &lt;div className="flex"&gt;
                            &lt;div className="flex-shrink-0 flex items-center"&gt;
                                &lt;div className="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center"&gt;
                                    &lt;span className="text-white font-bold"&gt;A&lt;/span&gt;
                                &lt;/div&gt;
                                &lt;span className="ml-2 text-xl font-bold text-gray-900"&gt;AppName&lt;/span&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                        &lt;nav className="hidden sm:ml-6 sm:flex sm:space-x-8"&gt;
                            &lt;a href="#" className="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"&gt;
                                Home
                            &lt;/a&gt;
                            &lt;a href="#" className="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"&gt;
                                Features
                            &lt;/a&gt;
                            &lt;a href="#" className="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"&gt;
                                Pricing
                            &lt;/a&gt;
                            &lt;a href="#" className="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"&gt;
                                Contact
                            &lt;/a&gt;
                        &lt;/nav&gt;
                        &lt;div className="flex items-center"&gt;
                            &lt;a 
                                href="/login" 
                                className="ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            &gt;
                                Sign in
                            &lt;/a&gt;
                            &lt;a 
                                href="/register" 
                                className="ml-4 px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            &gt;
                                Get started
                            &lt;/a&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/header&gt;
            
            &lt;main&gt;
                {children}
            &lt;/main&gt;
            
            &lt;footer className="bg-white"&gt;
                &lt;div className="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8"&gt;
                    &lt;div className="grid grid-cols-2 md:grid-cols-4 gap-8"&gt;
                        &lt;div&gt;
                            &lt;h3 className="text-sm font-semibold text-gray-500 tracking-wider uppercase"&gt;Product&lt;/h3&gt;
                            &lt;ul className="mt-4 space-y-4"&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Features&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Pricing&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Templates&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;h3 className="text-sm font-semibold text-gray-500 tracking-wider uppercase"&gt;Company&lt;/h3&gt;
                            &lt;ul className="mt-4 space-y-4"&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;About&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Blog&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Careers&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;h3 className="text-sm font-semibold text-gray-500 tracking-wider uppercase"&gt;Resources&lt;/h3&gt;
                            &lt;ul className="mt-4 space-y-4"&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Documentation&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Support&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;API Status&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/div&gt;
                        &lt;div&gt;
                            &lt;h3 className="text-sm font-semibold text-gray-500 tracking-wider uppercase"&gt;Legal&lt;/h3&gt;
                            &lt;ul className="mt-4 space-y-4"&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Privacy&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Terms&lt;/a&gt;&lt;/li&gt;
                                &lt;li&gt;&lt;a href="#" className="text-base text-gray-500 hover:text-gray-900"&gt;Cookie Policy&lt;/a&gt;&lt;/li&gt;
                            &lt;/ul&gt;
                        &lt;/div&gt;
                    &lt;/div&gt;
                    &lt;div className="mt-12 border-t border-gray-200 pt-8"&gt;
                        &lt;p className="text-base text-gray-400 text-center"&gt;
                            &copy; {new Date().getFullYear()} AppName. All rights reserved.
                        &lt;/p&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/footer&gt;
        &lt;/div&gt;
    );
}</code></pre>
            
            <h5>Using Different Layouts in Pages</h5>
            <pre><code>// In your Inertia.js pages, you can specify which layout to use

// Using GuestLayout for authentication pages
import GuestLayout from '@/layouts/GuestLayout';

export default function LoginPage() {
    // ... page content
}

LoginPage.layout = (page) => &lt;GuestLayout children={page} title="Login" /&gt;;

// Using MarketingLayout for landing pages
import MarketingLayout from '@/layouts/MarketingLayout';

export default function HomePage() {
    // ... page content
}

HomePage.layout = (page) => &lt;MarketingLayout children={page} title="Home" /&gt;;

// Using AppLayout for authenticated app pages (default)
import AppLayout from '@/layouts/AppLayout';

export default function DashboardPage() {
    // ... page content
}

DashboardPage.layout = (page) => &lt;AppLayout children={page} title="Dashboard" /&gt;;

// You can also create layouts without specifying them in each page
// by using Inertia's persistent layout feature

// In your app.js or main entry point
import { createInertiaApp } from '@inertiajs/react';
import GuestLayout from '@/layouts/GuestLayout';
import AppLayout from '@/layouts/AppLayout';

createInertiaApp({
    // ... other config
    resolve: (name) => {
        const pages = import.meta.glob('./pages/**/*.jsx', { eager: true });
        let page = pages[`./pages/${name}.jsx`];
        
        // Automatically apply layouts based on route name or page location
        if (name.startsWith('Auth/')) {
            page.default.layout = page.default.layout || (page => &lt;GuestLayout children={page} /&gt;);
        } else if (name.startsWith('Admin/')) {
            page.default.layout = page.default.layout || (page => &lt;AdminLayout children={page} /&gt;);
        } else {
            page.default.layout = page.default.layout || (page => &lt;AppLayout children={page} /&gt;);
        }
        
        return page;
    },
});
</code></pre>
            
            <h5>Responsive Custom Layout</h5>
            <pre><code>// resources/js/layouts/ResponsiveAuthLayout.jsx
import { Head } from '@inertiajs/react';

export default function ResponsiveAuthLayout({ children, title, showLogo = true }) {
    return (
        &lt;div className="min-h-screen flex flex-col sm:flex-row"&gt;
            &lt;Head title={title} /&gt;
            
            {/* Left side - Branding (hidden on mobile) */}
            &lt;div className="hidden sm:flex sm:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-12 flex-col justify-between"&gt;
                &lt;div&gt;
                    {showLogo && (
                        &lt;div className="flex items-center"&gt;
                            &lt;div className="h-10 w-10 rounded-full bg-white flex items-center justify-center"&gt;
                                &lt;span className="text-blue-600 font-bold text-xl"&gt;A&lt;/span&gt;
                            &lt;/div&gt;
                            &lt;span className="ml-3 text-2xl font-bold"&gt;AppName&lt;/span&gt;
                        &lt;/div&gt;
                    )}
                &lt;/div&gt;
                
                &lt;div className="max-w-md"&gt;
                    &lt;h1 className="text-3xl font-bold mb-4"&gt;Welcome to AppName&lt;/h1&gt;
                    &lt;p className="text-blue-100 text-lg"&gt;
                        The most powerful platform for managing your business operations efficiently.
                    &lt;/p&gt;
                &lt;/div&gt;
                
                &lt;div className="text-blue-200 text-sm"&gt;
                    &copy; {new Date().getFullYear()} AppName. All rights reserved.
                &lt;/div&gt;
            &lt;/div&gt;
            
            {/* Right side - Form */}
            &lt;div className="w-full sm:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-gray-50"&gt;
                &lt;div className="w-full max-w-md"&gt;
                    {/* Mobile logo */}
                    {showLogo && (
                        &lt;div className="sm:hidden flex justify-center mb-8"&gt;
                            &lt;div className="flex items-center"&gt;
                                &lt;div className="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center"&gt;
                                    &lt;span className="text-white font-bold text-xl"&gt;A&lt;/span&gt;
                                &lt;/div&gt;
                                &lt;span className="ml-3 text-2xl font-bold text-gray-900"&gt;AppName&lt;/span&gt;
                            &lt;/div&gt;
                        &lt;/div&gt;
                    )}
                    
                    &lt;div className="bg-white p-8 rounded-lg shadow-md"&gt;
                        {children}
                    &lt;/div&gt;
                    
                    &lt;div className="mt-8 text-center text-sm text-gray-500"&gt;
                        &copy; {new Date().getFullYear()} AppName. All rights reserved.
                    &lt;/div&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    );
}</code></pre>
        </div>
    </div>
</section>