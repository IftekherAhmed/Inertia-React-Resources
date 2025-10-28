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