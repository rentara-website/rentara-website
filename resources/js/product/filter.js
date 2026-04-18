export function initProductFilters() {
    const searchInput = document.getElementById('search-input');
    const clearBtn = document.getElementById('clear-search');
    const container = document.getElementById('product-list-container');
    
    if (!searchInput || !container) return; // Guard clause

    let debounceTimer;

    // Handle Search Input
    searchInput.addEventListener('input', (e) => {
        const val = e.target.value;
        
        if (clearBtn) {
            if (val.length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }
        }

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            updateResults();
        }, 400);
    });

    // Handle Clear Search
    if (clearBtn) {
        clearBtn.addEventListener('click', () => {
            searchInput.value = '';
            clearBtn.classList.add('hidden');
            updateResults();
            searchInput.focus();
        });
    }

    // Handle AJAX updates
    function updateResults(url = null) {
        if (!url) {
            const params = new URLSearchParams(window.location.search);
            const searchVal = searchInput.value;
            
            if (searchVal) {
                params.set('search', searchVal);
            } else {
                params.delete('search');
            }
            
            // Delete specific filters if they are not in the URL anymore
            url = `${window.location.pathname}?${params.toString()}`;
        }

        container.style.opacity = '0.5';

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
            container.style.opacity = '1';
            
            window.history.pushState({}, '', url);
            
            // Update active states after fetch
            updateActiveStates(url);
            
            // Dispatch event for other components (like Lucide)
            document.dispatchEvent(new CustomEvent('products:updated', { detail: { url } }));
        })
        .catch(error => {
            console.error('Filtering failed:', error);
            container.style.opacity = '1';
        });
    }

    // Event Delegation: Global listener for all filter links
    document.addEventListener('click', (e) => {
        const link = e.target.closest('.filter-link');
        if (!link) return;

        e.preventDefault();
        const url = link.getAttribute('data-url') || link.href;
        
        // Sync search input if the clicked link has a search param
        const urlParams = new URL(url, window.location.origin).searchParams;
        if (urlParams.has('search')) {
            searchInput.value = urlParams.get('search');
            if (clearBtn) clearBtn.classList.remove('hidden');
        }

        updateResults(url);
    });

    function updateActiveStates(url) {
        const urlParams = new URL(url, window.location.origin).searchParams;
        const cat = urlParams.get('category'); // Can be null or string
        const tag = urlParams.get('tag'); // Can be null or string

        // Update Category Buttons
        document.querySelectorAll('.cat-link').forEach(btn => {
            const slug = btn.getAttribute('data-cat-slug'); // "" for All Categories, else slug
            
            let isActive = false;
            if (slug === "") {
                // "All Categories" is active if cat param is missing or empty
                isActive = (cat === null || cat === '');
            } else {
                // Other buttons active only if slug matches cat param exactly
                isActive = (cat !== null && cat !== '' && slug === cat);
            }
            
            btn.classList.toggle('filter-active', isActive);
        });

        // Update Tag Buttons
        document.querySelectorAll('.tag-link').forEach(btn => {
            const slug = btn.getAttribute('data-tag-slug') || '';
            // Tags ONLY highlight if there is a matching tag param
            const isActive = (tag !== null && tag !== '' && slug === tag);
            btn.classList.toggle('filter-active', isActive);
        });
    }

    // Initial state sync based on current URL
    updateActiveStates(window.location.href);
}
