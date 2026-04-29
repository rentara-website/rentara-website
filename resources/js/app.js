import './bootstrap';

import { createIcons, icons } from 'lucide';

document.addEventListener('DOMContentLoaded', () => {
    createIcons({ 
        icons,
        attrs: {
            'stroke-width': 2,
            'stroke': 'currentColor',
            'fill': 'none',
        }
    });
});

import Alpine from 'alpinejs'
window.alpine = Alpine
Alpine.start()

// Custom Modules
import { initProductFilters } from './product/filter';

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    try {
        initProductFilters();
    } catch (e) {
        console.error('Filter initialization failed:', e);
    }

    // try {
    //     initProductModal();
    // } catch (e) {
    //     console.error('Modal initialization failed:', e);
    // }
});

// Re-initialize Lucide Icons on AJAX updates
document.addEventListener('products:updated', () => {
    try {
        createIcons({ icons });
    } catch (e) {
        console.warn('Lucide re-init failed:', e);
    }
});

const categoryName = document.querySelector('.category-name'); // Get the first element
const categorySlug = document.querySelector('.category-slug'); // Get the first element

categoryName.addEventListener('keyup', function() {
    const slug = categoryName.value.toLowerCase().split(' ').join('-').replace(/[^\w-]+/g, '');
    categorySlug.value = slug;
});