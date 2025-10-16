// Dashboard State
let dashboardData = {
    overview: null,
    sales: null,
    products: null,
    charts: null
};

let charts = {};

// DOM Elements
const sidebar = document.getElementById('sidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const pageTitle = document.getElementById('pageTitle');
const loadingOverlay = document.getElementById('loadingOverlay');
const notification = document.getElementById('notification');
const notificationMessage = document.getElementById('notificationMessage');

// Initialize Dashboard
document.addEventListener('DOMContentLoaded', function() {
    initializeEventListeners();
    loadDashboardData();
    setupNavigation();
});

// Event Listeners
function initializeEventListeners() {
    // Sidebar toggle
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleSidebar);
    }
    
    // Navigation items
    document.querySelectorAll('.nav-item[data-section]').forEach(item => {
        item.addEventListener('click', handleNavigation);
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', handleKeyboardShortcuts);
    
    // Auto refresh every 5 minutes
    setInterval(loadDashboardData, 5 * 60 * 1000);
}

// Navigation
function setupNavigation() {
    const currentSection = window.location.hash.substring(1) || 'overview';
    showSection(currentSection);
}

function handleNavigation(e) {
    e.preventDefault();
    const section = e.target.closest('.nav-item').dataset.section;
    
    if (section) {
        showSection(section);
        window.location.hash = section;
        
        // Update active state
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active');
        });
        e.target.closest('.nav-item').classList.add('active');
    }
}

function showSection(sectionName) {
    // Hide all sections
    document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
    });
    
    // Show target section
    const targetSection = document.getElementById(`${sectionName}-section`);
    if (targetSection) {
        targetSection.classList.add('active');
    }
    
    // Update page title
    const titles = {
        overview: 'Dashboard - Visão Geral',
        sales: 'Dashboard - Vendas',
        products: 'Dashboard - Produtos',
        analytics: 'Dashboard - Análises'
    };
    
    if (pageTitle) {
        pageTitle.textContent = titles[sectionName] || 'Dashboard';
    }
    
    // Load section-specific data
    loadSectionData(sectionName);
}

function loadSectionData(section) {
    switch(section) {
        case 'sales':
            loadSalesData();
            break;
        case 'products':
            loadProductsData();
            break;
        case 'analytics':
            loadAnalyticsData();
            break;
        default:
            // Overview data is loaded by default
            break;
    }
}

// Sidebar Functions
function toggleSidebar() {
    if (sidebar) {
        sidebar.classList.toggle('collapsed');
        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    }
}

// Data Loading Functions
async function loadDashboardData() {
    showLoading(true);
    
    try {
        const response = await fetch('../api/dashboard.php?action=overview');
        const result = await response.json();
        
        if (result.success) {
            dashboardData.overview = result.data;
            updateOverviewUI();
            loadChartsData();
            showNotification('Dados atualizados com sucesso!', 'success');
        } else {
            showNotification('Erro ao carregar dados: ' + result.message, 'error');
        }
    } catch (error) {
        console.error('Erro ao carregar dashboard:', error);
        showNotification('Erro de conexão com o servidor', 'error');
    } finally {
        showLoading(false);
    }
}

async function loadSalesData() {
    try {
        const response = await fetch('../api/dashboard.php?action=sales');
        const result = await response.json();
        
        if (result.success) {
            dashboardData.sales = result.data;
            updateSalesCharts();
        }
    } catch (error) {
        console.error('Erro ao carregar dados de vendas:', error);
    }
}

async function loadProductsData() {
    try {
        const response = await fetch('../api/dashboard.php?action=products');
        const result = await response.json();
        
        if (result.success) {
            dashboardData.products = result.data;
            updateProductsCharts();
        }
    } catch (error) {
        console.error('Erro ao carregar dados de produtos:', error);
    }
}

async function loadChartsData() {
    try {
        const response = await fetch('../api/dashboard.php?action=charts');
        const result = await response.json();
        
        if (result.success) {
            dashboardData.charts = result.data;
            updateOverviewCharts();
        }
    } catch (error) {
        console.error('Erro ao carregar dados dos gráficos:', error);
    }
}

// UI Update Functions
function updateOverviewUI() {
    const data = dashboardData.overview;
    if (!data) return;
    
    // Update stats cards
    const totalProdutos = document.getElementById('totalProdutos');
    const totalVendas = document.getElementById('totalVendas');
    const receitaTotal = document.getElementById('receitaTotal');
    const estoqueTotal = document.getElementById('estoqueTotal');
    
    if (totalProdutos) totalProdutos.textContent = data.stats.totalProdutos;
    if (totalVendas) totalVendas.textContent = data.stats.totalVendas;
    if (receitaTotal) receitaTotal.textContent = 'R$ ' + data.stats.receitaTotal;
    if (estoqueTotal) estoqueTotal.textContent = data.stats.estoqueTotal;
    
    // Update tables
    updateTopProductsTable(data.topProdutos);
    updateRecentSalesTable(data.vendasRecentes);
    
    // Update alerts
    updateAlerts(data.estoqueBaixo);
}

function updateTopProductsTable(products) {
    const tbody = document.querySelector('#topProductsTable tbody');
    if (!tbody) return;
    
    if (!products || products.length === 0) {
        tbody.innerHTML = '<tr><td colspan="2" style="text-align: center;">Nenhum dado disponível</td></tr>';
        return;
    }
    
    tbody.innerHTML = products.map(product => `
        <tr>
            <td>${product.nome}</td>
            <td><strong>${product.vendido}</strong></td>
        </tr>
    `).join('');
}

function updateRecentSalesTable(sales) {
    const tbody = document.querySelector('#recentSalesTable tbody');
    if (!tbody) return;
    
    if (!sales || sales.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" style="text-align: center;">Nenhuma venda registrada</td></tr>';
        return;
    }
    
    tbody.innerHTML = sales.map(sale => `
        <tr>
            <td>${sale.cliente_nome}</td>
            <td><strong>R$ ${parseFloat(sale.total).toFixed(2).replace('.', ',')}</strong></td>
            <td>${sale.data_formatada}</td>
        </tr>
    `).join('');
}

function updateAlerts(lowStock) {
    const alertsList = document.getElementById('alertsList');
    if (!alertsList) return;
    
    if (!lowStock || lowStock.length === 0) {
        alertsList.innerHTML = `
            <div class="alert-item success">
                <i class="fas fa-check-circle"></i>
                <span>Todos os produtos com estoque adequado</span>
            </div>
        `;
        return;
    }
    
    const alerts = lowStock.map(product => `
        <div class="alert-item warning">
            <i class="fas fa-exclamation-triangle"></i>
            <span><strong>${product.nome}</strong> com estoque baixo (${product.estoque} unidades)</span>
        </div>
    `).join('');
    
    alertsList.innerHTML = alerts;
}

// Charts Functions
function updateOverviewCharts() {
    if (!dashboardData.charts) return;
    
    createSalesChart();
    createCategoryChart();
}

function createSalesChart() {
    const ctx = document.getElementById('salesChart');
    if (!ctx) return;
    
    // Destroy existing chart
    if (charts.salesChart) {
        charts.salesChart.destroy();
    }
    
    const data = dashboardData.charts.vendasMensais || [];
    
    charts.salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(item => item.nome),
            datasets: [{
                label: 'Vendas (R$)',
                data: data.map(item => parseFloat(item.total)),
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [2, 2]
                    },
                    ticks: {
                        callback: function(value) {
                            return 'R$ ' + value.toLocaleString('pt-BR');
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}

function createCategoryChart() {
    const ctx = document.getElementById('categoryChart');
    if (!ctx) return;
    
    // Destroy existing chart
    if (charts.categoryChart) {
        charts.categoryChart.destroy();
    }
    
    const data = dashboardData.charts.categorias || [];
    
    const colors = [
        '#667eea',
        '#764ba2',
        '#f093fb',
        '#f5576c',
        '#4facfe',
        '#00f2fe'
    ];
    
    charts.categoryChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: data.map(item => item.categoria),
            datasets: [{
                data: data.map(item => item.produtos),
                backgroundColor: colors.slice(0, data.length),
                borderWidth: 0,
                hoverBorderWidth: 2,
                hoverBorderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 12
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
}

function updateSalesCharts() {
    if (!dashboardData.sales) return;
    
    createMonthlySalesChart();
    createDailySalesChart();
}

function createMonthlySalesChart() {
    const ctx = document.getElementById('monthlySalesChart');
    if (!ctx) return;
    
    // Destroy existing chart
    if (charts.monthlySalesChart) {
        charts.monthlySalesChart.destroy();
    }
    
    const data = dashboardData.sales.vendasMes || [];
    
    charts.monthlySalesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.nome_mes || item.mes),
            datasets: [{
                label: 'Vendas',
                data: data.map(item => parseInt(item.quantidade)),
                backgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderColor: '#667eea',
                borderWidth: 1,
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function createDailySalesChart() {
    const ctx = document.getElementById('dailySalesChart');
    if (!ctx) return;
    
    // Destroy existing chart
    if (charts.dailySalesChart) {
        charts.dailySalesChart.destroy();
    }
    
    const data = dashboardData.sales.vendasDia || [];
    
    charts.dailySalesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(item => new Date(item.data).toLocaleDateString('pt-BR')),
            datasets: [{
                label: 'Receita (R$)',
                data: data.map(item => parseFloat(item.receita)),
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'R$ ' + value.toLocaleString('pt-BR');
                        }
                    }
                }
            }
        }
    });
}

function updateProductsCharts() {
    if (!dashboardData.products) return;
    
    createProductsCategoryChart();
    updateBestSellersTable();
}

function createProductsCategoryChart() {
    const ctx = document.getElementById('productsCategoryChart');
    if (!ctx) return;
    
    // Destroy existing chart
    if (charts.productsCategoryChart) {
        charts.productsCategoryChart.destroy();
    }
    
    const data = dashboardData.products.produtosPorCategoria || [];
    
    const colors = [
        '#667eea',
        '#764ba2',
        '#f093fb',
        '#f5576c',
        '#4facfe',
        '#00f2fe'
    ];
    
    charts.productsCategoryChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.map(item => item.categoria),
            datasets: [{
                data: data.map(item => item.quantidade),
                backgroundColor: colors.slice(0, data.length),
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

function updateBestSellersTable() {
    const tbody = document.querySelector('#bestSellersTable tbody');
    if (!tbody) return;
    
    const products = dashboardData.products.produtosMaisVendidos || [];
    
    if (products.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">Nenhum dado disponível</td></tr>';
        return;
    }
    
    tbody.innerHTML = products.map(product => `
        <tr>
            <td>${product.nome}</td>
            <td>${product.categoria}</td>
            <td><strong>${product.total_vendido}</strong></td>
            <td><strong>R$ ${parseFloat(product.receita).toFixed(2).replace('.', ',')}</strong></td>
        </tr>
    `).join('');
}

function loadAnalyticsData() {
    // Simulated analytics data - you can replace with real API calls
    createPerformanceChart();
    createTrendsChart();
}

function createPerformanceChart() {
    const ctx = document.getElementById('performanceChart');
    if (!ctx) return;
    
    // Destroy existing chart
    if (charts.performanceChart) {
        charts.performanceChart.destroy();
    }
    
    charts.performanceChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: ['Vendas', 'Produtos', 'Clientes', 'Receita', 'Estoque', 'Satisfação'],
            datasets: [{
                label: 'Performance Atual',
                data: [85, 92, 78, 88, 95, 82],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.2)',
                borderWidth: 2,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        stepSize: 20
                    }
                }
            }
        }
    });
}

function createTrendsChart() {
    const ctx = document.getElementById('trendsChart');
    if (!ctx) return;
    
    // Destroy existing chart
    if (charts.trendsChart) {
        charts.trendsChart.destroy();
    }
    
    charts.trendsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Crescimento (%)',
                data: [12, 18, 15, 22, 28, 32],
                borderColor: '#4facfe',
                backgroundColor: 'rgba(79, 172, 254, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }, {
                label: 'Meta (%)',
                data: [15, 20, 20, 25, 30, 35],
                borderColor: '#f5576c',
                backgroundColor: 'transparent',
                borderWidth: 2,
                borderDash: [5, 5],
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            }
        }
    });
}

// Utility Functions
function showLoading(show) {
    if (loadingOverlay) {
        if (show) {
            loadingOverlay.classList.add('active');
        } else {
            loadingOverlay.classList.remove('active');
        }
    }
}

function showNotification(message, type = 'info') {
    if (notificationMessage && notification) {
        notificationMessage.textContent = message;
        notification.className = `notification ${type}`;
        
        // Show notification
        notification.classList.add('show');
        
        // Auto hide after 3 seconds
        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }
}

function handleKeyboardShortcuts(e) {
    // Ctrl/Cmd + R - Refresh data
    if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
        e.preventDefault();
        loadDashboardData();
    }
    
    // Escape - Close sidebar on mobile
    if (e.key === 'Escape' && window.innerWidth <= 768 && sidebar) {
        sidebar.classList.remove('open');
    }
}

// Initialize sidebar state from localStorage
if (sidebar && localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
}

// Mobile sidebar handling
if (window.innerWidth <= 768 && sidebar && sidebarToggle) {
    document.addEventListener('click', function(e) {
        if (!sidebar.contains(e.target) && !e.target.matches('.sidebar-toggle')) {
            sidebar.classList.remove('open');
        }
    });
    
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
    });
}