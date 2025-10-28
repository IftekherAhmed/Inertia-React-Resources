<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + React + Inertia.js Development Guide</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #7209b7;
            --success: #06d6a0;
            --info: #4cc9f0;
            --warning: #ffd166;
            --danger: #ef476f;
            --light: #f8f9fa;
            --dark: #212529;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-300: #dee2e6;
            --gray-400: #ced4da;
            --gray-500: #adb5bd;
            --gray-600: #6c757d;
            --gray-700: #495057;
            --gray-800: #343a40;
            --gray-900: #212529;
            --sidebar-width: 260px;
            --header-height: 60px;
            --border-radius: 8px;
            --transition: all 0.2s ease-in-out;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #f5f7fb;
            color: var(--gray-800);
            font-size: 0.925rem;
            line-height: 1.6;
        }
        
        /* Header */
        .main-header {
            height: var(--header-height);
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
        }
        
        .logo {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            height: calc(100vh - var(--header-height));
            position: fixed;
            top: var(--header-height);
            left: 0;
            overflow-y: auto;
            border-right: 1px solid var(--gray-200);
            transition: var(--transition);
            z-index: 1020;
            padding: 1.5rem 0;
        }
        
        .sidebar-section {
            margin-bottom: 1.5rem;
        }
        
        .sidebar-heading {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray-500);
            margin-bottom: 0.5rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            margin: 0 0.75rem;
            border-radius: var(--border-radius);
            color: var(--gray-700);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
        }
        
        .nav-link:hover {
            background-color: var(--gray-100);
            color: var(--primary);
        }
        
        .nav-link.active {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }
        
        .nav-link i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-top: var(--header-height);
            margin-left: var(--sidebar-width);
            padding: 1.75rem;
            transition: var(--transition);
            min-height: calc(100vh - var(--header-height));
            height: calc(100vh - var(--header-height));
            width: calc(100% - var(--sidebar-width));
            overflow-x: hidden;
            overflow-y: auto;
            word-wrap: break-word;
        }
        
        .page-header {
            margin-bottom: 1.75rem;
        }
        
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
        }
        
        .page-title i {
            margin-right: 12px;
            color: var(--primary);
            background: rgba(67, 97, 238, 0.1);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .page-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            font-weight: 400;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            transition: var(--transition);
            overflow: hidden;
        }
        
        .card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }
        
        .card-header {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }
        
        .card-header i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Code Blocks */
        pre {
            background-color: #f6f8fa;
            border-radius: var(--border-radius);
            padding: 1.25rem;
            font-size: 0.875rem;
            line-height: 1.5;
            overflow-x: auto;
            white-space: pre;
            border: 1px solid var(--gray-200);
            margin: 1rem 0;
            position: relative;
            tab-size: 4;
            font-family: 'Fira Code', 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            max-width: 100%;
        }
        
        code {
            font-family: 'Fira Code', 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            font-size: 0.875rem;
            line-height: 1.5;
            word-wrap: break-word;
            max-width: 100%;
        }
        
        /* Improve file structure diagrams */
        pre code {
            font-family: 'Fira Code', 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            font-size: 0.85rem;
            line-height: 1.4;
        }
        
        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--gray-300);
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
            z-index: 10; /* Ensure button is above code content */
        }
        
        .copy-btn:hover {
            background: white;
            border-color: var(--primary);
            color: var(--primary);
        }
        
        /* Section Titles */
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 1.75rem 0 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--gray-200);
            color: var(--gray-900);
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        /* Badges */
        .badge-production {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
            padding: 0.35em 0.75em;
            border-radius: 20px;
            font-size: 0.75rem;
        }
        
        .badge-pattern {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
            font-weight: 600;
            padding: 0.35em 0.75em;
            border-radius: 20px;
            font-size: 0.75rem;
        }
        
        /* Alerts */
        .alert-pattern {
            border-left: 4px solid var(--primary);
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            background-color: rgba(67, 97, 238, 0.05);
            border-top: 1px solid rgba(67, 97, 238, 0.1);
            border-right: 1px solid rgba(67, 97, 238, 0.1);
            border-bottom: 1px solid rgba(67, 97, 238, 0.1);
            padding: 1rem;
            margin: 1rem 0;
        }
        
        .alert-pattern h6 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .alert-pattern h6 i {
            margin-right: 8px;
        }
        
        /* Feature Cards */
        .feature-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
            transition: var(--transition);
            border: 1px solid var(--gray-200);
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
        }
        
        .feature-card i {
            font-size: 1.75rem;
            color: var(--primary);
            margin-bottom: 1rem;
            background: rgba(67, 97, 238, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .feature-card h5 {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--gray-900);
        }
        
        .feature-card p {
            color: var(--gray-600);
            font-size: 0.9rem;
        }
        
        /* Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .menu-toggle {
                display: block;
            }
        }
        
        /* Utilities */
        .text-primary {
            color: var(--primary) !important;
        }
        
        .bg-light {
            background-color: var(--gray-100) !important;
        }
        
        .border-top {
            border-top: 1px solid var(--gray-200) !important;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        
        /* Copy Button for Code Blocks */
        .copy-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid var(--gray-300);
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .copy-btn:hover {
            background: white;
            border-color: var(--primary);
            color: var(--primary);
        }
        
        /* Pattern Highlight */
        .pattern-highlight {
            background: linear-gradient(120deg, rgba(67, 97, 238, 0.05) 0%, rgba(67, 97, 238, 0.02) 100%);
            border-left: 3px solid var(--primary);
            padding: 1rem 1.25rem;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            margin: 1.5rem 0;
        }
        
        .pattern-highlight h6 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .pattern-highlight h6 i {
            margin-right: 8px;
        }
        
        /* File Path Badge */
        .file-path {
            background-color: var(--gray-200);
            color: var(--gray-700);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-family: 'Fira Code', monospace;
            font-size: 0.8rem;
            display: inline-block;
            margin: 0.5rem 0;
        }
        
        /* Info Callout */
        .info-callout {
            background-color: rgba(76, 201, 240, 0.1);
            border-left: 4px solid var(--info);
            padding: 1rem;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            margin: 1rem 0;
        }
        
        .info-callout h6 {
            color: var(--info);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .info-callout h6 i {
            margin-right: 8px;
        }
        
        /* Definition Box */
        .definition-box {
            background-color: rgba(6, 214, 160, 0.1);
            border-left: 4px solid var(--success);
            padding: 1rem;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            margin: 1rem 0;
        }
        
        .definition-box h6 {
            color: var(--success);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .definition-box h6 i {
            margin-right: 8px;
        }
        
        /* Content Section */
        .content-section {
            scroll-margin-top: 80px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <a href="#" class="logo">
            <i class="bi bi-code-slash"></i>
            Laravel + React Guide
        </a>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Navigation -->
            <?php include('inc/sidebar.php'); ?>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <!-- Introduction -->
                <?php include('inc/sections/introduction.php') ?>
                
                <!-- Project Structure -->
                <?php include('inc/sections/project-structure.php') ?>                
                
                <!-- Migration -->
                <?php include('inc/sections/migration.php') ?>                
                
                <!-- Factory -->
                 <?php include('inc/sections/factory.php') ?>
                
                <!-- Seeding -->
                <?php include('inc/sections/seeding.php') ?>
                
                <!-- Model -->
                <?php include('inc/sections/model.php') ?>    
                
                <!-- Service -->
                <?php include('inc/sections/service.php') ?> 
                
                <!-- Controllers -->
                <?php include('inc/sections/controllers.php') ?>  
                
                <!-- Routes -->
                <?php include('inc/sections/routes.php') ?>  
                
                <!-- Resources -->
                <?php include('inc/sections/resources.php') ?>        
                
                <!-- CRUD Operations -->
                <?php include('inc/sections/crud-operation.php') ?>
                
                <!-- Search -->
                <?php include('inc/sections/search.php') ?>
                
                <!-- Filter -->
                <?php include('inc/sections/filter.php') ?>
                
                <!-- Sort -->
                <?php include('inc/sections/sort.php') ?>
                
                <!-- Pagination -->
                <?php include('inc/sections/pagination.php') ?>
                
                <!-- Delete Operations -->
                <?php include('inc/sections/delete.php') ?>
                
                <!-- Validation -->
                <?php include('inc/sections/validation.php') ?>
                
                <!-- File Upload -->
                <?php include('inc/sections/fileupload.php') ?>
                
                <!-- Modal View -->
                <?php include('inc/sections/modalview.php') ?>
                
                <!-- Quick Reference -->
                <?php include('inc/sections/quick-reference.php') ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Function to copy code to clipboard
        function copyCode(button) {
            // Get the code text from the parent pre element
            const preElement = button.parentElement;
            if (!preElement || preElement.tagName !== 'PRE') {
                console.error('Could not find pre element to copy');
                return;
            }
            
            // Get the code content (excluding the button itself)
            let codeText = '';
            for (let i = 0; i < preElement.childNodes.length; i++) {
                const node = preElement.childNodes[i];
                // Skip the copy button itself
                if (node !== button && node.nodeType === Node.TEXT_NODE) {
                    codeText += node.textContent;
                } else if (node !== button && node.tagName !== 'BUTTON') {
                    codeText += node.textContent || node.innerText || '';
                }
            }
            
            navigator.clipboard.writeText(codeText).then(() => {
                // Show feedback
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="bi bi-check"></i> Copied!';
                button.classList.remove('btn-outline-secondary');
                button.classList.add('btn-success');
                
                // Reset button after 2 seconds
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-outline-secondary');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy: ', err);
                // Show error feedback
                button.innerHTML = '<i class="bi bi-x"></i> Failed!';
                setTimeout(() => {
                    button.innerHTML = '<i class="bi bi-clipboard"></i> Copy';
                }, 2000);
            });
        }
        
        // Add copy buttons to all code blocks when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Find all pre elements that contain code
            const codeBlocks = document.querySelectorAll('pre');
            
            codeBlocks.forEach(block => {
                // Check if copy button already exists
                const existingButton = block.querySelector('.copy-btn');
                if (!existingButton) {
                    // Create copy button
                    const button = document.createElement('button');
                    button.className = 'copy-btn btn btn-sm btn-outline-secondary';
                    button.innerHTML = '<i class="bi bi-clipboard"></i> Copy';
                    button.setAttribute('onclick', 'copyCode(this)');
                    
                    // Insert the button as the first child of the pre element
                    block.insertBefore(button, block.firstChild);
                }
            });
            
            // Initialize with first link active (only if exists)
            const firstNavLink = document.querySelector('.nav-link');
            if (firstNavLink) {
                firstNavLink.classList.add('active');
            }
        });
        
        // Smooth scrolling for anchor links
        // Use a safe handler that ignores bare '#' anchors and avoids invalid selectors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');

                // Ignore empty or plain '#' anchors (commonly used as placeholders)
                if (!targetId || targetId === '#') {
                    return;
                }

                // Prevent default only when we have a valid fragment
                e.preventDefault();

                // Strip the leading '#' and use getElementById to avoid selector issues
                const id = targetId.charAt(0) === '#' ? targetId.slice(1) : targetId;
                const targetElement = document.getElementById(id);

                if (targetElement) {
                    // Update active state in sidebar (only for real sidebar links)
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('active');
                    });
                    if (this.classList.contains('nav-link')) {
                        this.classList.add('active');
                    }

                    // Scroll to target element
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Update active sidebar link on scroll
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            // Throttle scroll events for better performance
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            
            scrollTimeout = setTimeout(function() {
                const sections = document.querySelectorAll('.content-section');
                const navLinks = document.querySelectorAll('.nav-link');
                
                let current = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    if (pageYOffset >= sectionTop - 100 && pageYOffset < sectionTop + sectionHeight - 100) {
                        current = section.getAttribute('id');
                    }
                });
                
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.add('active');
                    }
                });
            }, 100); // Throttle to 100ms
        });
        
        // Also update active link when clicking on navigation
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all links
                document.querySelectorAll('.nav-link').forEach(nav => {
                    nav.classList.remove('active');
                });
                
                // Add active class to clicked link
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>