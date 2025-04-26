
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar modal con datos del producto
            const productoModal = document.getElementById('productoModal');
            if (productoModal) {
                productoModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const name = button.getAttribute('data-name');
                    const price = button.getAttribute('data-price');
                    const img = button.getAttribute('data-img');
                    
                    const modalTitle = productoModal.querySelector('.modal-title');
                    const modalBodyTitle = productoModal.querySelector('#modal-title');
                    const modalPrice = productoModal.querySelector('#modal-price');
                    const modalImg = productoModal.querySelector('#modal-image');
                    
                    modalTitle.textContent = name;
                    modalBodyTitle.textContent = name;
                    modalPrice.textContent = price;
                    modalImg.src = img;
                    modalImg.alt = name;
                });
            }
            
            // Funcionalidad Ver Más/Ver Menos
            const verMasBtn = document.getElementById('verMasBtn');
            const verMenosBtn = document.getElementById('verMenosBtn');
            const productosContainer = document.getElementById('productosContainer');
            
            if (verMasBtn && verMenosBtn && productosContainer) {
                // Ocultar botón Ver Menos inicialmente
                verMenosBtn.style.display = 'none';
                
                // Clonar productos para simular más elementos
                const originalProducts = productosContainer.innerHTML;
                
                verMasBtn.addEventListener('click', function() {
                    // Agregar más productos (en un caso real sería una petición AJAX)
                    productosContainer.innerHTML += originalProducts;
                    verMasBtn.style.display = 'none';
                    verMenosBtn.style.display = 'inline-block';
                });
                
                verMenosBtn.addEventListener('click', function() {
                    // Mostrar solo los primeros productos
                    const firstProducts = productosContainer.querySelectorAll('.col');
                    firstProducts.forEach((product, index) => {
                        if (index >= 8) {
                            product.remove();
                        }
                    });
                    verMenosBtn.style.display = 'none';
                    verMasBtn.style.display = 'inline-block';
                });
            }
            
            // Funcionalidad de búsqueda
            const searchBar = document.getElementById('searchBar');
            if (searchBar) {
                searchBar.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const products = document.querySelectorAll('.product-card');
                    
                    products.forEach(product => {
                        const name = product.querySelector('.card-title').textContent.toLowerCase();
                        if (name.includes(searchTerm)) {
                            product.closest('.col').style.display = 'block';
                        } else {
                            product.closest('.col').style.display = 'none';
                        }
                    });
                });
            }
        });
    