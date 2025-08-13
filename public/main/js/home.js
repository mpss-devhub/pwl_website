   document.addEventListener('DOMContentLoaded', function() {
            // Get all elements with scroll-animate class
            const animatedElements = document.querySelectorAll('.scroll-animate');

            // Create Intersection Observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Get delay from data attribute or default to 0
                        const delay = entry.target.dataset.delay || 0;

                        // Add animated class after delay
                        setTimeout(() => {
                            entry.target.classList.add('animated');
                        }, delay * 1000);

                        // Stop observing this element
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1, // Trigger when 10% of element is visible
                rootMargin: '0px 0px -50px 0px' // Adjust trigger point
            });

            // Observe each animated element
            animatedElements.forEach(element => {
                // Set initial transform based on animation type
                if (element.classList.contains('fade-up')) {
                    element.style.transform = 'translateY(20px)';
                } else if (element.classList.contains('fade-right') || element.classList.contains('slide-right')) {
                    element.style.transform = 'translateX(20px)';
                } else if (element.classList.contains('slide-left')) {
                    element.style.transform = 'translateX(-30px)';
                }

                observer.observe(element);
            });

            // Continuous animations for elements that should always animate
            const alwaysAnimate = document.querySelectorAll('.animate-float, .animate-pulse-slow, .animate-bounce-slow');
            alwaysAnimate.forEach(element => {
                element.classList.add('animated');
            });
        });
