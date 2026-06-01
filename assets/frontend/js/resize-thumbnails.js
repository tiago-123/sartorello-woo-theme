"use strict";

// Main function that handles the resizing of thumbnail images in the product gallery
// Triggered when the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', resizeThumbnails);

/**
 * Handles responsive resizing of thumbnail images in the product gallery
 * - Gets the relevant DOM elements
 * - Uses ResizeObserver to watch for changes to the featured image size
 * - Adjusts thumbnail size and layout based on viewport width
 * - Calculates and sets thumbnail dimensions dynamically
 */
function resizeThumbnails() {
    const featuredImage = document.getElementById('featured-image');
    const container = document.getElementById('thumbnail-slider-container');
    const slider = document.getElementById('thumbnail-slider');
    const slides = document.querySelectorAll('.thumbnail-slide');

    // Exit if required elements are not found
    if (!featuredImage || !container || !slider || !slides) return;

    // Initialize variables for gap and slides per view
    let gap, slidesPerView;

    // Create observer to watch featured image size changes
    const resizeObserver = new ResizeObserver(entries => {
        for (let entry of entries) {
            // Desktop layout (>= 640px)
            if (window.innerWidth >= 640) {
                gap = 15;
                slidesPerView = 5;
                container.style.marginTop = '';
                container.style.marginRight = gap + 'px';
                slider.style.gap = gap + 'px';
                // Prevent infinite resize loop
                if (Math.round(entry.borderBoxSize[0].blockSize) !== container.offsetHeight) {
                    container.style.height = entry.borderBoxSize[0].blockSize + 'px';
                }
            }
            // Mobile layout (< 640px)
            else {
                gap = 12;
                slidesPerView = 4;
                container.style.marginTop = gap + 'px';
                container.style.marginRight = '';
                container.style.height = '';
                slider.style.gap = gap + 'px';
            }

            // Calculate and set thumbnail dimensions
            const slideSize = (entry.borderBoxSize[0].blockSize - (gap * (slidesPerView - 1))) / slidesPerView;
            for (let slide of slides) {
                slide.style.width = slideSize + 'px';
                slide.style.height = slideSize + 'px';
            }
        }
    });

    // Start observing the featured image
    resizeObserver.observe(featuredImage);
}