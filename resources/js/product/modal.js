export function initProductModal() {
    const modal = document.getElementById('product-modal');
    if (!modal) return; // Guard clause

    const modalBody = document.getElementById('modal-body');
    const closeBtn = document.getElementById('close-modal');

    // Handle Modal Clicks (Event Delegation for AJAX compatibility)
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-details');
        if (btn) {
            e.preventDefault();
            openModal(btn);
        }
    });

    function openModal(btn) {
        if (!btn) return;

        const name = btn.getAttribute('data-name') || 'Product Details';
        const cat = btn.getAttribute('data-category') || 'Category';
        const desc = btn.getAttribute('data-description') || 'No description available.';
        const price = btn.getAttribute('data-price') || 'Rp -';
        const tags = btn.getAttribute('data-tags') || '';
        const img = btn.getAttribute('data-image') || '';
        const catSlug = btn.getAttribute('data-category-slug') || '';

        // Populate Modal safely
        const modalImg = document.getElementById('modal-img');
        const modalName = document.getElementById('modal-name');
        const modalCat = document.getElementById('modal-cat');
        const modalDesc = document.getElementById('modal-desc');
        const modalPrice = document.getElementById('modal-price');
        const modalWa = document.getElementById('modal-wa');
        const tagContainer = document.getElementById('modal-tags');
        const portfolioLink = document.getElementById('modal-portfolio-link');

        if (portfolioLink) {
            if (catSlug) {
                portfolioLink.href = `/portfolio?category=${catSlug}`;
            } else {
                portfolioLink.href = '/portfolio';
            }
        }

        if (modalImg) modalImg.src = img;
        if (modalName) modalName.textContent = name;
        if (modalCat) modalCat.textContent = cat;
        if (modalDesc) modalDesc.textContent = desc;
        if (modalPrice) modalPrice.textContent = price;
        
        // Tags handling with safety
        if (tagContainer) {
            tagContainer.innerHTML = '';
            if (tags.length > 0) {
                tags.split(', ').forEach(tag => {
                    const span = document.createElement('span');
                    span.className = 'text-[10px] font-bold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-md';
                    span.textContent = `#${tag}`;
                    tagContainer.appendChild(span);
                });
            }
        }

        // WhatsApp Link Safety
        if (modalWa) {
            const waMsg = encodeURIComponent(`Hello, I am interested in ${name} from the ${cat} category. Can you give me more info?`);
            modalWa.href = `https://wa.me/6289519929891?text=${waMsg}`;
        }

        // Show Modal with Animation
        console.log('Attempting to show modal', modal);
        
        // Remove hidden and force display
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        
        // Force reflow before applying opacity transition
        void modal.offsetWidth;
        
        modal.classList.remove('opacity-0');
        if (modalBody) modalBody.classList.remove('scale-95', 'opacity-0');
        console.log('Modal classes updated');
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        if (modalBody) modalBody.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }, 300);
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // Support escape key to close
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}
