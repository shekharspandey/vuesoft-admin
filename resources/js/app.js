// Custom JS code can be added here

// Header scroll behavior
document.addEventListener("DOMContentLoaded", function () {
    // Header scroll behavior
    const setupHeaderScroll = () => {
        let lastScrollTop = 0;
        const header = document.getElementById("site-header");
        if (!header) return;

        const scrollThreshold = 50; // Only hide header after scrolling this many pixels
        const minScrollBeforeHide = 100; // Only start hiding after this much scrolling

        window.addEventListener("scroll", function () {
            let scrollTop =
                window.pageYOffset || document.documentElement.scrollTop;

            // Only implement header hiding when we've scrolled enough
            if (scrollTop > minScrollBeforeHide) {
                // Only change header visibility if we've scrolled more than threshold
                if (Math.abs(scrollTop - lastScrollTop) > scrollThreshold) {
                    if (scrollTop > lastScrollTop) {
                        // Scrolling down - hide header
                        header.style.transform = "translateY(-100%)";
                    } else {
                        // Scrolling up - show header
                        header.style.transform = "translateY(0)";
                    }
                    lastScrollTop = scrollTop;
                }
            } else {
                // Always show header at the top of the page
                header.style.transform = "translateY(0)";
            }
        });
    };

    // Mobile menu toggle functionality
    const setupMobileMenu = () => {
        const menuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");

        if (!menuButton || !mobileMenu) return;

        menuButton.addEventListener("click", function () {
            const isOpen = mobileMenu.classList.toggle("h-auto");
            mobileMenu.classList.toggle("hidden");

            // Change button icon when menu is open
            if (isOpen) {
                menuButton.innerHTML =
                    '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            } else {
                menuButton.innerHTML =
                    '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>';
            }
        });
    };

    // Mobile dropdown menus functionality
    const setupMobileDropdowns = () => {
        const toggleButtons = document.querySelectorAll(
            ".mobile-dropdown-toggle"
        );
        const closeButtons = document.querySelectorAll(
            ".mobile-dropdown-close"
        );

        // Function to close all dropdowns
        const closeAllDropdowns = () => {
            document
                .querySelectorAll(".mobile-dropdown-content")
                .forEach((content) => {
                    content.classList.remove("show");
                });
            document
                .querySelectorAll(".mobile-dropdown-toggle")
                .forEach((toggle) => {
                    toggle.classList.remove("active");
                });
        };

        // Toggle dropdown when clicking the toggle button
        toggleButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                e.stopPropagation();
                const targetId = button.getAttribute("data-target");
                const targetDropdown = document.getElementById(targetId);

                if (!targetDropdown) return; // Safety check

                // Check if this dropdown is already open
                const isOpen = targetDropdown.classList.contains("show");

                // Close all dropdowns first
                closeAllDropdowns();

                // If target wasn't open, open it (if it was open, it's now closed by closeAllDropdowns)
                if (!isOpen) {
                    targetDropdown.classList.add("show");
                    targetDropdown.style.display = "block"; // Force display
                    button.classList.add("active");

                    // Special handling for Our Story dropdown to ensure it's fully visible
                    if (targetId === "story-dropdown") {
                        // Force proper display and positioning
                        targetDropdown.style.position = "relative";
                        targetDropdown.style.zIndex = "40";

                        // Expand the mobile menu container to accommodate
                        const mobileMenu =
                            document.getElementById("mobile-menu");
                        if (mobileMenu) {
                            mobileMenu.style.overflow = "visible";
                            mobileMenu.style.paddingBottom = "150px";
                        }

                        // Ensure all items are visible with scroll and enough space
                        setTimeout(() => {
                            const storyItems =
                                targetDropdown.querySelectorAll("a");
                            if (storyItems.length) {
                                // Add extra space to ensure visibility
                                storyItems[0].scrollIntoView({
                                    behavior: "smooth",
                                    block: "nearest",
                                });
                            }
                        }, 100);
                    } else {
                        // Regular dropdown behavior for other dropdowns
                        const mobileMenu =
                            document.getElementById("mobile-menu");
                        if (mobileMenu) {
                            mobileMenu.style.overflow = "visible";
                        }

                        // Scroll to ensure toggle button is visible
                        setTimeout(() => {
                            button.scrollIntoView({
                                behavior: "smooth",
                                block: "start",
                            });
                        }, 50);
                    }

                    // Log for debugging
                    console.log("Opening dropdown:", targetId);
                }
            });
        });

        // Close dropdown when clicking close button
        closeButtons.forEach((button) => {
            button.addEventListener("click", (e) => {
                e.stopPropagation();
                const dropdown = button.closest(".mobile-dropdown-content");
                if (dropdown) {
                    dropdown.classList.remove("show");
                    // Find and deactivate the toggle button
                    const toggleButton = document.querySelector(
                        `.mobile-dropdown-toggle[data-target="${dropdown.id}"]`
                    );
                    if (toggleButton) {
                        toggleButton.classList.remove("active");
                    }
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener("click", (e) => {
            // If click is inside a dropdown or toggle, don't close
            if (
                e.target.closest(".mobile-dropdown-content") ||
                e.target.closest(".mobile-dropdown-toggle")
            ) {
                return;
            }
            closeAllDropdowns();
        });

        // Add scroll handling to dropdown content
        document
            .querySelectorAll(".mobile-dropdown-content")
            .forEach((content) => {
                content.addEventListener("scroll", (e) => {
                    e.stopPropagation(); // Prevent body scroll when scrolling dropdown
                });
            });
    };

    // Initialize all header functionality
    setupHeaderScroll();
    setupMobileMenu();
    setupMobileDropdowns();

    // Services page - Load More functionality
    const setupServicesLoadMore = () => {
        const loadMoreBtn = document.getElementById("loadMore");
        if (!loadMoreBtn) return;

        const services = document.querySelectorAll(".service-item");
        let visibleCount = 5;

        loadMoreBtn.addEventListener("click", function () {
            let hiddenServices = Array.from(services).slice(
                visibleCount,
                visibleCount + 5
            );

            // Staggered animation for smoother appearance
            hiddenServices.forEach((service, index) => {
                service.style.display = "flex";

                // Set initial state
                service.style.opacity = "0";
                service.style.transform = "translateY(30px)";

                // Apply staggered animation with delay based on index
                setTimeout(() => {
                    service.style.transition =
                        "opacity 0.8s ease, transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)";
                    service.style.opacity = "1";
                    service.style.transform = "translateY(0)";
                }, 100 * index); // Stagger by 100ms per item
            });

            visibleCount += 5;
            if (visibleCount >= services.length) {
                // Fade out the button instead of abrupt disappearance
                loadMoreBtn.style.transition =
                    "opacity 0.5s ease, transform 0.5s ease";
                loadMoreBtn.style.opacity = "0";
                loadMoreBtn.style.transform = "translateY(20px)";

                setTimeout(() => {
                    loadMoreBtn.style.display = "none";
                }, 500);
            }
        });
    };

    // Initialize services page functionality
    setupServicesLoadMore();
});
