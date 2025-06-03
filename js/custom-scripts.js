document.addEventListener('DOMContentLoaded', function () {
    // 1. Smooth Scrolling for Anchor Links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');

    anchorLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const hrefAttribute = this.getAttribute('href');

            // Ensure it's not just a lone "#" or an empty href
            if (hrefAttribute.length > 1) {
                const targetId = hrefAttribute.substring(1); // Remove '#'
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    e.preventDefault(); // Prevent default jump only if target exists
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                } else {
                    // Optional: Handle cases where the target doesn't exist,
                    // e.g., if it's a link to another page or a placeholder.
                    // For now, let the default behavior occur if targetId is not found.
                    console.warn('Smooth scroll target not found for id:', targetId);
                }
            } else if (hrefAttribute === '#') {
                // If it's just '#', prevent default to avoid jump to top if not handled by scroll-to-top
                e.preventDefault();
            }
        });
    });

    // 2. "Scroll to Top" Button
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');
    const scrollThreshold = 300; // Pixels from top to show button

    if (scrollToTopBtn) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function () {
            if (window.scrollY > scrollThreshold) {
                scrollToTopBtn.style.display = 'block'; // Or add a class to control visibility
            } else {
                scrollToTopBtn.style.display = 'none'; // Or remove the class
            }
        });

        // Scroll to top on button click
        scrollToTopBtn.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    } else {
        console.warn('"Scroll to Top" button with ID "scrollToTopBtn" not found in the DOM.');
    }
});
