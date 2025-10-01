<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Online - Tech Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: #111;
            border-bottom: 1px solid #222;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .search-bar {
            flex: 1;
            max-width: 500px;
        }

        .search-bar input {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #667eea;
            background: #222;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-cart {
            position: relative;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-cart:hover {
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
        }

        .btn-dashboard {
            padding: 0.75rem 1.5rem;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .btn-dashboard:hover {
            background: #222;
            border-color: #667eea;
        }

        /* Main Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Filters */
        .filters {
            background: #111;
            border: 1px solid #222;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .filters h3 {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .filter-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .filter-btn:hover {
            background: #222;
            border-color: #667eea;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .product-card {
            background: #111;
            border: 1px solid #222;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-4px);
            border-color: #667eea;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.2);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            border-bottom: 1px solid #222;
        }

        .product-info {
            padding: 1.25rem;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .product-category {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 0.75rem;
            text-transform: capitalize;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .product-stock {
            font-size: 0.85rem;
            color: #888;
        }

        .stock-low {
            color: #ef4444;
        }

        .stock-out {
            color: #ef4444;
            font-weight: 600;
        }

        .btn-add-cart {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-add-cart:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-add-cart:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Cart Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #111;
            border: 1px solid #222;
            border-radius: 16px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #222;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 1.5rem;
        }

        .btn-close {
            background: none;
            border: none;
            color: #888;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .btn-close:hover {
            color: #fff;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .cart-empty {
            text-align: center;
            padding: 3rem 1rem;
            color: #888;
        }

        .cart-item {
            display: flex;
            gap: 1rem;
            padding: 1rem;
            background: #1a1a1a;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-name {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .cart-item-price {
            color: #667eea;
            font-weight: 600;
        }

        .cart-item-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .btn-qty {
            width: 32px;
            height: 32px;
            background: #222;
            border: 1px solid #333;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-qty:hover {
            background: #2a2a2a;
            border-color: #667eea;
        }

        .qty-display {
            min-width: 40px;
            text-align: center;
            font-weight: 600;
        }

        .btn-remove {
            margin-left: auto;
            padding: 0.5rem 1rem;
            background: #ef4444;
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
        }

        .btn-remove:hover {
            background: #dc2626;
        }

        .cart-summary {
            border-top: 1px solid #222;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }

        .summary-row.total {
            font-size: 1.25rem;
            font-weight: 700;
            color: #667eea;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #222;
        }

        .btn-checkout {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        /* Checkout Form */
        .checkout-form {
            display: none;
        }

        .checkout-form.active {
            display: block;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            background: #222;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-back {
            width: 100%;
            padding: 0.75rem;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 0.5rem;
        }

        .btn-back:hover {
            background: #222;
            border-color: #667eea;
        }

        /* Success Message */
        .success-message {
            display: none;
            text-align: center;
            padding: 3rem 1rem;
        }

        .success-message.active {
            display: block;
        }

        .success-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .success-message h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .success-message p {
            color: #888;
            margin-bottom: 2rem;
        }

        .order-number {
            background: #1a1a1a;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
            font-family: monospace;
            font-size: 1.1rem;
            color: #667eea;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #888;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .search-bar {
                max-width: 100%;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .filter-buttons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <div class="logo">🛒 Tech Store</div>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Buscar produtos...">
            </div>
            <div class="header-actions">
                <button class="btn-cart" onclick="toggleCart()">
                    🛒 Carrinho
                    <span class="cart-badge" id="cartBadge">0</span>
                </button>
                <a href="../03-dashboard/index.php" class="btn-dashboard">📊 Dashboard</a>
            </div>
        </div>
    </header>
    <main class="container">
        <div class="filters">
            <div class="filter-buttons">
            </div>
        </div>

        <div class="products-grid" id="productsGrid">
             Products will be loaded here 
        </div>

        <div class="empty-state" id="emptyState" style="display: none;">
            <div class="empty-state-icon">📦</div>
            <h3>Nenhum produto encontrado</h3>
            <p>Tente ajustar os filtros ou buscar por outro termo</p>
        </div>
    </main>

    <div class="modal" id="cartModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>🛒 Seu Carrinho</h2>
                <button class="btn-close" onclick="toggleCart()">×</button>
            </div>
            <div class="modal-body">
                 Cart View 
                <div id="cartView">
                    <div class="cart-empty" id="cartEmpty">
                        <p style="font-size: 3rem; margin-bottom: 1rem;">🛒</p>
                        <p>Seu carrinho está vazio</p>
                    </div>
                    <div id="cartItems"></div>
                    <div class="cart-summary" id="cartSummary" style="display: none;">
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span id="subtotal">R$ 0,00</span>
                        </div>
                        <div class="summary-row">
                            <span>Frete:</span>
                            <span id="shipping">R$ 0,00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span id="total">R$ 0,00</span>
                        </div>
                        <button class="btn-checkout" onclick="showCheckout()">Finalizar Pedido</button>
                    </div>
                </div>

                <div class="checkout-form" id="checkoutForm">
                    <h3 style="margin-bottom: 1.5rem;">Dados de Entrega</h3>
                    <form id="orderForm" onsubmit="submitOrder(event)">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input type="text" id="customerName" required>
                            </div>
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" id="customerEmail" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Telefone *</label>
                                <input type="tel" id="customerPhone" required>
                            </div>
                            <div class="form-group">
                                <label>CEP *</label>
                                <input type="text" id="customerZip" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Endereço *</label>
                            <input type="text" id="customerAddress" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Cidade *</label>
                                <input type="text" id="customerCity" required>
                            </div>
                            <div class="form-group">
                                <label>Estado *</label>
                                <input type="text" id="customerState" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Observações</label>
                            <textarea id="customerNotes" rows="3" placeholder="Informações adicionais sobre a entrega"></textarea>
                        </div>
                        <button type="submit" class="btn-checkout">Confirmar Pedido</button>
                        <button type="button" class="btn-back" onclick="showCart()">Voltar ao Carrinho</button>
                    </form>
                </div>

                <div class="success-message" id="successMessage">
                    <div class="success-icon">✅</div>
                    <h3>Pedido Realizado com Sucesso!</h3>
                    <p>Seu pedido foi confirmado e está sendo processado.</p>
                    <div class="order-number" id="orderNumber">#ORD-0000</div>
                    <p style="font-size: 0.9rem;">Você receberá um email com os detalhes do pedido.</p>
                    <button class="btn-checkout" onclick="closeCartAndReset()">Continuar Comprando</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cart state
        let cart = [];
        let products = [];
        let currentFilter = 'all';

        // Load products from localStorage or use defaults
        function loadProducts() {
            const savedProducts = localStorage.getItem('dashboardProducts');
            if (savedProducts) {
                products = JSON.parse(savedProducts);
            } else {
                products = [
                    // Eletrônicos
                    { id: 1, name: 'Notebook Dell Inspiron 15', category: 'electronics', price: 3499.90, stock: 15, sales: 234, image: 'Notebook Dell Inspiron 15.webp' },
                    { id: 2, name: 'Mouse Logitech MX Master 3', category: 'electronics', price: 349.90, stock: 45, sales: 567, image: 'Mouse Logitech MX Master 3.webp' },
                    { id: 3, name: 'Teclado Mecânico RGB Gamer', category: 'electronics', price: 599.90, stock: 3, sales: 189, image: 'Teclado Mecânico RGB Gamer.webp' },
                    { id: 4, name: 'Monitor LG UltraWide 27"', category: 'electronics', price: 1299.90, stock: 8, sales: 145, image: 'Monitor LG UltraWide 27.webp' },
                    { id: 5, name: 'Webcam Logitech C920 HD', category: 'electronics', price: 449.90, stock: 0, sales: 298, image: 'Webcam Logitech C920 HD.webp' },
                    { id: 6, name: 'Headset HyperX Cloud II', category: 'electronics', price: 399.90, stock: 22, sales: 412, image: 'Headset HyperX Cloud II.webp' },
                    { id: 7, name: 'SSD Samsung 1TB NVMe', category: 'electronics', price: 599.90, stock: 34, sales: 523, image: 'SSD Samsung 1TB NVMe.webp' },
                    { id: 8, name: 'Memória RAM Corsair 16GB', category: 'electronics', price: 299.90, stock: 2, sales: 678, image: 'Memória RAM Corsair 16GB.png' },
                    { id: 9, name: 'Smartphone Samsung Galaxy S23', category: 'electronics', price: 2899.90, stock: 12, sales: 345, image: 'Smartphone Samsung Galaxy S23.jpg' },
                    { id: 10, name: 'Tablet iPad Air 10.9"', category: 'electronics', price: 4299.90, stock: 7, sales: 156, image: 'Tablet iPad Air 10.9.webp' },
                    { id: 11, name: 'Smartwatch Apple Watch Series 8', category: 'electronics', price: 2499.90, stock: 18, sales: 289, image: 'Smartwatch Apple Watch Series 8.webp' },
                    { id: 12, name: 'Fone Bluetooth AirPods Pro', category: 'electronics', price: 1899.90, stock: 25, sales: 567, image: 'Fone Bluetooth AirPods Pro.webp' },
                ];
            }
            renderProducts();
        }

        // Render products
        function renderProducts() {
            const grid = document.getElementById('productsGrid');
            const emptyState = document.getElementById('emptyState');
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            let filteredProducts = products.filter(p => {
                const matchesCategory = currentFilter === 'all' || p.category === currentFilter;
                const matchesSearch = p.name.toLowerCase().includes(searchTerm);
                return matchesCategory && matchesSearch;
            });

            if (filteredProducts.length === 0) {
                grid.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            grid.style.display = 'grid';
            emptyState.style.display = 'none';

            grid.innerHTML = filteredProducts.map(product => `
                <div class="product-card">
                    <div class="product-image">
                        <img src="${product.image || ''}" 
                             alt="${product.name}" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="product-info">
                        <div class="product-name">${product.name}</div>
                        <div class="product-category">${getCategoryName(product.category)}</div>
                        <div class="product-footer">
                            <div class="product-price">R$ ${product.price.toFixed(2)}</div>
                            <div class="product-stock ${product.stock === 0 ? 'stock-out' : product.stock < 10 ? 'stock-low' : ''}">
                                ${product.stock === 0 ? 'Esgotado' : product.stock < 10 ? `Apenas ${product.stock}` : `${product.stock} disponíveis`}
                            </div>
                        </div>
                        <button class="btn-add-cart" onclick="addToCart(${product.id})" ${product.stock === 0 ? 'disabled' : ''}>
                            ${product.stock === 0 ? 'Indisponível' : 'Adicionar ao Carrinho'}
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Get product icon based on category
        function getProductIcon(category) {
            const icons = {
                electronics: '💻',
                clothing: '👕',
                books: '📚',
                home: '🏠'
            };
            return icons[category] || '📦';
        }

        // Get category name
        function getCategoryName(category) {
            const names = {
                electronics: 'Eletrônicos',
                clothing: 'Roupas',
                books: 'Livros',
                home: 'Casa'
            };
            return names[category] || category;
        }

        // Filter by category
        function filterByCategory(category) {
            currentFilter = category;
            
            // Update active button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            renderProducts();
        }

        // Search products
        document.getElementById('searchInput').addEventListener('input', () => {
            renderProducts();
        });

        // Add to cart
        function addToCart(productId) {
            const product = products.find(p => p.id === productId);
            if (!product || product.stock === 0) return;

            const cartItem = cart.find(item => item.id === productId);
            if (cartItem) {
                if (cartItem.quantity < product.stock) {
                    cartItem.quantity++;
                } else {
                    alert('Quantidade máxima em estoque atingida!');
                    return;
                }
            } else {
                cart.push({ ...product, quantity: 1 });
            }

            updateCartBadge();
            renderCart();
            
            // Show feedback
            event.target.textContent = '✓ Adicionado!';
            setTimeout(() => {
                event.target.textContent = 'Adicionar ao Carrinho';
            }, 1000);
        }

        // Update cart badge
        function updateCartBadge() {
            const badge = document.getElementById('cartBadge');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            badge.textContent = totalItems;
        }

        // Toggle cart modal
        function toggleCart() {
            const modal = document.getElementById('cartModal');
            modal.classList.toggle('active');
            if (modal.classList.contains('active')) {
                renderCart();
            }
        }

        // Render cart
        function renderCart() {
            const cartEmpty = document.getElementById('cartEmpty');
            const cartItems = document.getElementById('cartItems');
            const cartSummary = document.getElementById('cartSummary');

            if (cart.length === 0) {
                cartEmpty.style.display = 'block';
                cartItems.innerHTML = '';
                cartSummary.style.display = 'none';
                return;
            }

            cartEmpty.style.display = 'none';
            cartSummary.style.display = 'block';

            cartItems.innerHTML = cart.map(item => `
                <div class="cart-item">
                    <div class="cart-item-image">
                        <img src="${item.image || '/placeholder.svg?height=80&width=80'}" 
                             alt="${item.name}" 
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                    </div>
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">R$ ${item.price.toFixed(2)}</div>
                        <div class="cart-item-controls">
                            <button class="btn-qty" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span class="qty-display">${item.quantity}</span>
                            <button class="btn-qty" onclick="updateQuantity(${item.id}, 1)">+</button>
                            <button class="btn-remove" onclick="removeFromCart(${item.id})">Remover</button>
                        </div>
                    </div>
                </div>
            `).join('');

            updateCartSummary();
        }

        // Update quantity
        function updateQuantity(productId, change) {
            const cartItem = cart.find(item => item.id === productId);
            const product = products.find(p => p.id === productId);
            
            if (!cartItem || !product) return;

            const newQuantity = cartItem.quantity + change;
            
            if (newQuantity <= 0) {
                removeFromCart(productId);
                return;
            }

            if (newQuantity > product.stock) {
                alert('Quantidade máxima em estoque atingida!');
                return;
            }

            cartItem.quantity = newQuantity;
            updateCartBadge();
            renderCart();
        }

        // Remove from cart
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartBadge();
            renderCart();
        }

        // Update cart summary
        function updateCartSummary() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const shipping = subtotal > 500 ? 0 : 29.90;
            const total = subtotal + shipping;

            document.getElementById('subtotal').textContent = `R$ ${subtotal.toFixed(2)}`;
            document.getElementById('shipping').textContent = shipping === 0 ? 'Grátis' : `R$ ${shipping.toFixed(2)}`;
            document.getElementById('total').textContent = `R$ ${total.toFixed(2)}`;
        }

        // Show checkout
        function showCheckout() {
            document.getElementById('cartView').style.display = 'none';
            document.getElementById('checkoutForm').classList.add('active');
        }

        // Show cart
        function showCart() {
            document.getElementById('cartView').style.display = 'block';
            document.getElementById('checkoutForm').classList.remove('active');
            document.getElementById('successMessage').classList.remove('active');
        }

        // Submit order
        function submitOrder(event) {
            event.preventDefault();

            // Get form data
            const orderData = {
                id: `ORD-${Date.now()}`,
                customer: {
                    name: document.getElementById('customerName').value,
                    email: document.getElementById('customerEmail').value,
                    phone: document.getElementById('customerPhone').value,
                    address: document.getElementById('customerAddress').value,
                    city: document.getElementById('customerCity').value,
                    state: document.getElementById('customerState').value,
                    zip: document.getElementById('customerZip').value,
                    notes: document.getElementById('customerNotes').value
                },
                items: cart.map(item => ({
                    id: item.id,
                    name: item.name,
                    price: item.price,
                    quantity: item.quantity
                })),
                subtotal: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0),
                shipping: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) > 500 ? 0 : 29.90,
                total: cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) + (cart.reduce((sum, item) => sum + (item.price * item.quantity), 0) > 500 ? 0 : 29.90),
                date: new Date().toLocaleDateString('pt-BR'),
                status: 'Pendente'
            };

            // Save order to localStorage
            let orders = JSON.parse(localStorage.getItem('dashboardOrders') || '[]');
            orders.unshift(orderData);
            localStorage.setItem('dashboardOrders', JSON.stringify(orders));

            // Update product stock
            cart.forEach(cartItem => {
                const product = products.find(p => p.id === cartItem.id);
                if (product) {
                    product.stock -= cartItem.quantity;
                    product.sales += cartItem.quantity;
                }
            });
            localStorage.setItem('dashboardProducts', JSON.stringify(products));

            // Show success message
            document.getElementById('checkoutForm').classList.remove('active');
            document.getElementById('successMessage').classList.add('active');
            document.getElementById('orderNumber').textContent = orderData.id;

            // Clear cart
            cart = [];
            updateCartBadge();
        }

        // Close cart and reset
        function closeCartAndReset() {
            toggleCart();
            document.getElementById('successMessage').classList.remove('active');
            document.getElementById('cartView').style.display = 'block';
            document.getElementById('orderForm').reset();
            loadProducts();
        }

        // Initialize
        loadProducts();
        updateCartBadge();
    </script>
</body>
</html>
