// State Management
let products = [];
let filteredProducts = [];
let categories = new Set();
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// DOM Elements - with null checks
let productsGrid, loading, searchInput, categoryFilter, sortBy;
let cartCount, cartSidebar, cartItems, cartTotal, checkoutModal, overlay;

function initializeElements() {
    productsGrid = document.getElementById('productsGrid');
    loading = document.getElementById('loading');
    searchInput = document.getElementById('searchInput');
    categoryFilter = document.getElementById('categoryFilter');
    sortBy = document.getElementById('sortBy');
    cartCount = document.getElementById('cartCount');
    cartSidebar = document.getElementById('cartSidebar');
    cartItems = document.getElementById('cartItems');
    cartTotal = document.getElementById('cartTotal');
    checkoutModal = document.getElementById('checkoutModal');
    overlay = document.getElementById('overlay');
}

// Initialize App
document.addEventListener('DOMContentLoaded', function() {
    initializeElements();
    loadProducts();
    updateCartUI();
    initializeEventListeners();
});

// Event Listeners
function initializeEventListeners() {
    // Search functionality
    searchInput.addEventListener('input', debounce(searchProducts, 300));
    
    // Checkout form
    const checkoutForm = document.getElementById('checkoutForm');
    checkoutForm.addEventListener('submit', handleCheckout);
    
    // Close modals with escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModals();
        }
    });
}

// API Functions
async function loadProducts() {
    try {
        showLoading(true);
        const response = await fetch('../api/produtos.php');
        const result = await response.json();
        
        if (result.success) {
            products = result.data;
            filteredProducts = [...products];
            extractCategories();
            displayProducts();
            populateCategoryFilter();
        } else {
            showNotification('Erro ao carregar produtos: ' + result.message, 'error');
        }
    } catch (error) {
        console.error('Erro ao carregar produtos:', error);
        showNotification('Erro ao conectar com o servidor', 'error');
        showEmptyState();
    } finally {
        showLoading(false);
    }
}

// Product Display
function displayProducts() {
    if (filteredProducts.length === 0) {
        showEmptyState();
        return;
    }
    
    productsGrid.innerHTML = filteredProducts.map(product => `
        <div class="product-card" data-aos="fade-up">
            <div class="product-image">
                <img src="${product.imagem_url}" alt="${product.nome}" 
                     onerror="this.src='https://via.placeholder.com/300x250?text=Sem+Imagem'">
            </div>
            <div class="product-info">
                <h3>${product.nome}</h3>
                <p>${product.descricao}</p>
                <div class="product-price">R$ ${formatPrice(product.preco)}</div>
                <div class="product-stock">
                    ${product.estoque > 0 ? 
                        `<span class="in-stock"><i class="fas fa-check-circle"></i> ${product.estoque} em estoque</span>` :
                        '<span class="out-of-stock"><i class="fas fa-times-circle"></i> Fora de estoque</span>'
                    }
                </div>
                <button class="btn-add-cart" 
                        onclick="addToCart(${product.id})" 
                        ${product.estoque === 0 ? 'disabled' : ''}>
                    <i class="fas fa-shopping-cart"></i>
                    ${product.estoque > 0 ? 'Adicionar ao Carrinho' : 'Indisponível'}
                </button>
            </div>
        </div>
    `).join('');
}

function showEmptyState() {
    productsGrid.innerHTML = `
        <div class="empty-products">
            <i class="fas fa-search"></i>
            <h3>Nenhum produto encontrado</h3>
            <p>Tente ajustar os filtros de busca</p>
        </div>
    `;
}

function showLoading(show) {
    loading.style.display = show ? 'block' : 'none';
    productsGrid.style.display = show ? 'none' : 'grid';
}

// Search and Filter Functions
function searchProducts() {
    const query = searchInput.value.toLowerCase().trim();
    
    filteredProducts = products.filter(product => 
        product.nome.toLowerCase().includes(query) ||
        product.descricao.toLowerCase().includes(query) ||
        product.categoria.toLowerCase().includes(query)
    );
    
    applyFilters();
}

function filterProducts() {
    const selectedCategory = categoryFilter.value;
    
    filteredProducts = products.filter(product => {
        const matchesSearch = searchInput.value === '' || 
            product.nome.toLowerCase().includes(searchInput.value.toLowerCase()) ||
            product.descricao.toLowerCase().includes(searchInput.value.toLowerCase());
        
        const matchesCategory = selectedCategory === '' || product.categoria === selectedCategory;
        
        return matchesSearch && matchesCategory;
    });
    
    displayProducts();
}

function sortProducts() {
    const sortValue = sortBy.value;
    
    switch(sortValue) {
        case 'name':
            filteredProducts.sort((a, b) => a.nome.localeCompare(b.nome));
            break;
        case 'price-asc':
            filteredProducts.sort((a, b) => parseFloat(a.preco) - parseFloat(b.preco));
            break;
        case 'price-desc':
            filteredProducts.sort((a, b) => parseFloat(b.preco) - parseFloat(a.preco));
            break;
    }
    
    displayProducts();
}

function applyFilters() {
    filterProducts();
    sortProducts();
}

function extractCategories() {
    categories.clear();
    products.forEach(product => {
        categories.add(product.categoria);
    });
}

function populateCategoryFilter() {
    const currentValue = categoryFilter.value;
    categoryFilter.innerHTML = '<option value="">Todas</option>';
    
    [...categories].sort().forEach(category => {
        const option = document.createElement('option');
        option.value = category;
        option.textContent = category;
        if (category === currentValue) {
            option.selected = true;
        }
        categoryFilter.appendChild(option);
    });
}

// Cart Functions
function addToCart(productId) {
    const product = products.find(p => p.id == productId);
    if (!product || product.estoque === 0) {
        showNotification('Produto indisponível', 'error');
        return;
    }
    
    const existingItem = cart.find(item => item.id == productId);
    
    if (existingItem) {
        if (existingItem.quantity < product.estoque) {
            existingItem.quantity++;
            showNotification(`${product.nome} adicionado ao carrinho`, 'success');
        } else {
            showNotification('Quantidade máxima atingida', 'error');
            return;
        }
    } else {
        cart.push({
            id: product.id,
            nome: product.nome,
            preco: product.preco,
            imagem_url: product.imagem_url,
            quantity: 1
        });
        showNotification(`${product.nome} adicionado ao carrinho`, 'success');
    }
    
    saveCart();
    updateCartUI();
    animateCartIcon();
}

function removeFromCart(productId) {
    cart = cart.filter(item => item.id != productId);
    saveCart();
    updateCartUI();
    displayCartItems();
}

function updateCartQuantity(productId, change) {
    const item = cart.find(item => item.id == productId);
    const product = products.find(p => p.id == productId);
    
    if (!item || !product) return;
    
    const newQuantity = item.quantity + change;
    
    if (newQuantity <= 0) {
        removeFromCart(productId);
        return;
    }
    
    if (newQuantity > product.estoque) {
        showNotification('Quantidade máxima atingida', 'error');
        return;
    }
    
    item.quantity = newQuantity;
    saveCart();
    updateCartUI();
    displayCartItems();
}

function updateCartUI() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const totalPrice = cart.reduce((sum, item) => sum + (item.preco * item.quantity), 0);
    
    if (cartCount) {
        cartCount.textContent = totalItems;
    }
    
    if (cartTotal) {
        cartTotal.textContent = formatPrice(totalPrice);
    }
    
    // Update checkout modal total
    const finalTotal = document.getElementById('finalTotal');
    if (finalTotal) {
        finalTotal.textContent = formatPrice(totalPrice);
    }
}

function displayCartItems() {
    if (!cartItems) {
        console.error('Cart items element not found');
        return;
    }
    
    if (cart.length === 0) {
        cartItems.innerHTML = `
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h4>Seu carrinho está vazio</h4>
                <p>Adicione alguns produtos para começar</p>
            </div>
        `;
        return;
    }
    
    cartItems.innerHTML = cart.map(item => `
        <div class="cart-item">
            <div class="cart-item-image">
                <img src="${item.imagem_url}" alt="${item.nome}"
                     onerror="this.src='https://via.placeholder.com/80x80?text=Sem+Imagem'">
            </div>
            <div class="cart-item-info">
                <h4>${item.nome}</h4>
                <div class="cart-item-price">R$ ${formatPrice(item.preco)}</div>
                <div class="cart-item-controls">
                    <button class="qty-btn" onclick="updateCartQuantity(${item.id}, -1)">-</button>
                    <span class="qty-display">${item.quantity}</span>
                    <button class="qty-btn" onclick="updateCartQuantity(${item.id}, 1)">+</button>
                    <button class="remove-item" onclick="removeFromCart(${item.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function clearCart() {
    cart = [];
    saveCart();
    updateCartUI();
    displayCartItems();
}

// Cart UI Functions
function toggleCart() {
    if (!cartSidebar || !overlay) {
        console.error('Cart elements not found');
        return;
    }
    
    const isActive = cartSidebar.classList.contains('active');
    
    if (!isActive) {
        cartSidebar.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        displayCartItems();
    } else {
        cartSidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function animateCartIcon() {
    cartCount.style.transform = 'scale(1.3)';
    setTimeout(() => {
        cartCount.style.transform = 'scale(1)';
    }, 200);
}

// Checkout Functions
function checkout() {
    if (cart.length === 0) {
        showNotification('Seu carrinho está vazio', 'error');
        return;
    }
    
    if (!checkoutModal || !overlay) {
        console.error('Checkout elements not found');
        return;
    }
    
    // Close cart sidebar
    if (cartSidebar) {
        cartSidebar.classList.remove('active');
    }
    
    // Show checkout modal
    checkoutModal.classList.add('active');
    overlay.classList.add('active');
    
    // Display order summary
    displayOrderSummary();
}

function displayOrderSummary() {
    const orderSummary = document.getElementById('orderSummary');
    const totalPrice = cart.reduce((sum, item) => sum + (item.preco * item.quantity), 0);
    
    orderSummary.innerHTML = cart.map(item => `
        <div class="order-item">
            <span>${item.nome} x${item.quantity}</span>
            <span>R$ ${formatPrice(item.preco * item.quantity)}</span>
        </div>
    `).join('');
    
    document.getElementById('finalTotal').textContent = formatPrice(totalPrice);
}

async function handleCheckout(e) {
    e.preventDefault();
    
    const customerName = document.getElementById('customerName').value;
    const customerEmail = document.getElementById('customerEmail').value;
    const customerPhone = document.getElementById('customerPhone').value;
    
    if (!customerName || !customerEmail) {
        showNotification('Preencha todos os campos obrigatórios', 'error');
        return;
    }
    
    const orderData = {
        customer: {
            name: customerName,
            email: customerEmail,
            phone: customerPhone
        },
        items: cart,
        total: cart.reduce((sum, item) => sum + (item.preco * item.quantity), 0)
    };
    
    try {
        showNotification('Processando pedido...', 'info');
        
        // Call real checkout API
        const response = await fetch('../api/vendas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(orderData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            showNotification('Pedido realizado com sucesso!', 'success');
            clearCart();
            closeCheckoutModal();
            
            // Reset form
            document.getElementById('checkoutForm').reset();
        } else {
            showNotification('Erro: ' + result.message, 'error');
        }
        
    } catch (error) {
        console.error('Erro no checkout:', error);
        showNotification('Erro ao processar pedido. Tente novamente.', 'error');
    }
}

// Modal Functions
function closeCheckoutModal() {
    checkoutModal.classList.remove('active');
    overlay.classList.remove('active');
    document.body.style.overflow = '';
}

function closeModals() {
    checkoutModal.classList.remove('active');
    cartSidebar.classList.remove('active');
    overlay.classList.remove('active');
    document.body.style.overflow = '';
}

// Utility Functions
function formatPrice(price) {
    return parseFloat(price).toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <i class="fas fa-${getNotificationIcon(type)}"></i>
        <span>${message}</span>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => notification.classList.add('show'), 100);
    
    // Auto remove
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

function getNotificationIcon(type) {
    switch(type) {
        case 'success': return 'check-circle';
        case 'error': return 'exclamation-circle';
        case 'warning': return 'exclamation-triangle';
        default: return 'info-circle';
    }
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function simulateAPICall(delay) {
    return new Promise(resolve => setTimeout(resolve, delay));
}

// Add some CSS for stock status
const style = document.createElement('style');
style.textContent = `
    .product-stock {
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
    
    .in-stock {
        color: #48bb78;
        font-weight: 500;
    }
    
    .out-of-stock {
        color: #e53e3e;
        font-weight: 500;
    }
    
    .btn-add-cart:disabled {
        background: #a0aec0;
        cursor: not-allowed;
        transform: none;
    }
    
    .btn-add-cart:disabled:hover {
        transform: none;
        box-shadow: none;
    }
`;
document.head.appendChild(style);