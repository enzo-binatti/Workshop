<?php
/**
 * Script de Setup para gerar todos os arquivos do projeto TechStore
 */

echo "🚀 Iniciando setup do projeto TechStore...\n\n";

// Criar estrutura de pastas
$folders = [
    'api',
    'config',
    'database',
    'dashboard',
    'dashboard/css',
    'dashboard/js',
    'loja',
    'loja/css', 
    'loja/js',
    'quiz',
    'quiz/css',
    'quiz/js'
];

echo "📁 Criando estrutura de pastas...\n";
foreach ($folders as $folder) {
    if (!file_exists($folder)) {
        mkdir($folder, 0755, true);
        echo "   ✅ Pasta criada: $folder\n";
    } else {
        echo "   ⚠️  Pasta já existe: $folder\n";
    }
}

echo "\n📄 Gerando arquivo de download...\n";

// Criar arquivo de download com todos os códigos
$downloadContent = "# TechStore - Sistema Completo\n";
$downloadContent .= "# Todos os arquivos do projeto estão listados abaixo\n";
$downloadContent .= "# Copie cada seção e crie o arquivo correspondente\n\n";
$downloadContent .= "=" . str_repeat("=", 60) . "\n";
$downloadContent .= "ESTRUTURA DO PROJETO\n";
$downloadContent .= "=" . str_repeat("=", 60) . "\n\n";

$downloadContent .= "workshop/\n";
$downloadContent .= "├── api/\n";
$downloadContent .= "│   ├── produtos.php\n";
$downloadContent .= "│   ├── vendas.php\n";
$downloadContent .= "│   └── dashboard.php\n";
$downloadContent .= "├── config/\n";
$downloadContent .= "│   └── database.php\n";
$downloadContent .= "├── database/\n";
$downloadContent .= "│   └── schema.sql\n";
$downloadContent .= "├── dashboard/\n";
$downloadContent .= "│   ├── index.html\n";
$downloadContent .= "│   ├── css/dashboard.css\n";
$downloadContent .= "│   └── js/dashboard.js\n";
$downloadContent .= "├── loja/\n";
$downloadContent .= "│   ├── index.html\n";
$downloadContent .= "│   ├── css/styles.css\n";
$downloadContent .= "│   └── js/app.js\n";
$downloadContent .= "├── quiz/\n";
$downloadContent .= "│   ├── index.html\n";
$downloadContent .= "│   ├── css/quiz.css\n";
$downloadContent .= "│   └── js/quiz.js\n";
$downloadContent .= "└── README.md\n\n";

// Lista de arquivos com conteúdo
$files = [
    'database/schema.sql' => getDatabaseSchema(),
    'config/database.php' => getDatabaseConfig(),
    'api/produtos.php' => getProdutosAPI(),
    'api/vendas.php' => getVendasAPI(),
    'api/dashboard.php' => getDashboardAPI(),
    'loja/index.html' => getLojaHTML(),
    'loja/css/styles.css' => getLojaCSS(),
    'loja/js/app.js' => getLojaJS(),
    'dashboard/index.html' => getDashboardHTML(),
    'dashboard/css/dashboard.css' => getDashboardCSS(),
    'dashboard/js/dashboard.js' => getDashboardJS(),
    'quiz/index.html' => getQuizHTML(),
    'quiz/css/quiz.css' => getQuizCSS(),
    'quiz/js/quiz.js' => getQuizJS(),
    'README.md' => getReadme()
];

foreach ($files as $filePath => $content) {
    $downloadContent .= "\n" . str_repeat("=", 70) . "\n";
    $downloadContent .= "ARQUIVO: $filePath\n";
    $downloadContent .= str_repeat("=", 70) . "\n\n";
    $downloadContent .= $content . "\n";
}

file_put_contents('PROJETO_COMPLETO.txt', $downloadContent);

echo "   ✅ Arquivo gerado: PROJETO_COMPLETO.txt\n";
echo "\n🎉 Setup concluído!\n\n";
echo "📥 Para baixar todos os arquivos:\n";
echo "   1. Baixe o arquivo: PROJETO_COMPLETO.txt\n";
echo "   2. Ou acesse: http://localhost/workshop/PROJETO_COMPLETO.txt\n\n";
echo "🔗 Acessar aplicações:\n";
echo "   • Mini Loja: http://localhost/workshop/loja/\n";
echo "   • Dashboard: http://localhost/workshop/dashboard/\n";
echo "   • Quiz: http://localhost/workshop/quiz/\n\n";

// Funções para retornar o conteúdo dos arquivos
function getDatabaseSchema() {
    return '-- Database Schema for Mini Store and Dashboard System
-- Created for integrated store and analytics platform

CREATE DATABASE IF NOT EXISTS workshop_system;
USE workshop_system;

-- Tabela de Produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(100),
    estoque INT DEFAULT 0,
    imagem_url VARCHAR(500),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Dados de exemplo para demonstração
INSERT INTO produtos (nome, descricao, preco, categoria, estoque, imagem_url) VALUES
("Smartphone Samsung Galaxy", "Smartphone Android com 128GB", 899.99, "Eletrônicos", 15, "https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500"),
("Notebook Lenovo", "Notebook para trabalho e estudos", 1299.99, "Eletrônicos", 8, "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500"),
("Camiseta Polo", "Camiseta polo masculina 100% algodão", 59.99, "Roupas", 25, "https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500");';
}

function getDatabaseConfig() {
    return '<?php
class Database {
    private $host = "localhost";
    private $dbname = "workshop_system";
    private $username = "root";
    private $password = "";
    private $connection;

    public function connect() {
        $this->connection = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        return $this->connection;
    }
}
?>';
}

function getProdutosAPI() {
    return '<?php
require_once "../config/database.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$method = $_SERVER["REQUEST_METHOD"];
$database = new Database();
$db = $database->connect();

switch($method) {
    case "GET":
        $sql = "SELECT * FROM produtos WHERE ativo = 1";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["success" => true, "data" => $produtos]);
        break;
}
?>';
}

function getVendasAPI() {
    return '<?php
require_once "../config/database.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode(["success" => true, "message" => "Vendas API"]);
?>';
}

function getDashboardAPI() {
    return '<?php
require_once "../config/database.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode(["success" => true, "message" => "Dashboard API"]);
?>';
}

function getLojaHTML() {
    return '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechStore - Sua Loja Online</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <i class="fas fa-store"></i>
                <h2>TechStore</h2>
            </div>
            <nav class="nav">
                <a href="../dashboard/">Dashboard</a>
                <a href="../quiz/">Quiz</a>
            </nav>
        </div>
    </header>
    
    <main class="main">
        <section class="hero">
            <div class="container">
                <h1>Bem-vindo à TechStore</h1>
                <p>Os melhores produtos com qualidade e preços incríveis</p>
            </div>
        </section>
        
        <section class="products">
            <div class="container">
                <h2>Nossos Produtos</h2>
                <div class="products-grid" id="productsGrid">
                    <!-- Produtos serão carregados aqui -->
                </div>
            </div>
        </section>
    </main>
    
    <script src="js/app.js"></script>
</body>
</html>';
}

function getLojaCSS() {
    return '* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: Arial, sans-serif; }
.header { background: #333; color: white; padding: 1rem 0; }
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.header .container { display: flex; justify-content: space-between; align-items: center; }
.logo { display: flex; align-items: center; gap: 10px; }
.nav a { color: white; text-decoration: none; margin-left: 20px; }
.hero { background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 80px 0; text-align: center; }
.hero h1 { font-size: 3rem; margin-bottom: 1rem; }
.products { padding: 60px 0; }
.products-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 40px; }
.product-card { background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); overflow: hidden; }
.product-image { height: 200px; background: #f5f5f5; }';
}

function getLojaJS() {
    return 'document.addEventListener("DOMContentLoaded", function() {
    loadProducts();
});

async function loadProducts() {
    try {
        const response = await fetch("../api/produtos.php");
        const result = await response.json();
        
        if (result.success) {
            displayProducts(result.data);
        }
    } catch (error) {
        console.error("Erro ao carregar produtos:", error);
    }
}

function displayProducts(products) {
    const grid = document.getElementById("productsGrid");
    
    grid.innerHTML = products.map(product => `
        <div class="product-card">
            <div class="product-image">
                <img src="${product.imagem_url}" alt="${product.nome}" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div class="product-info">
                <h3>${product.nome}</h3>
                <p>${product.descricao}</p>
                <div class="price">R$ ${parseFloat(product.preco).toFixed(2)}</div>
                <button class="btn-buy">Comprar</button>
            </div>
        </div>
    `).join("");
}';
}

function getDashboardHTML() {
    return '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - TechStore</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-chart-pie"></i>
                <h2>Dashboard</h2>
            </div>
            <nav class="nav">
                <a href="#"><i class="fas fa-home"></i> Visão Geral</a>
                <a href="../loja/"><i class="fas fa-store"></i> Loja</a>
                <a href="../quiz/"><i class="fas fa-brain"></i> Quiz</a>
            </nav>
        </aside>
        
        <main class="main-content">
            <header class="header">
                <h1>Visão Geral</h1>
            </header>
            
            <div class="stats">
                <div class="stat-card">
                    <i class="fas fa-shopping-cart"></i>
                    <div>
                        <h3>125</h3>
                        <p>Vendas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-dollar-sign"></i>
                    <div>
                        <h3>R$ 15.420</h3>
                        <p>Receita</p>
                    </div>
                </div>
            </div>
            
            <div class="charts">
                <div class="chart-container">
                    <h3>Vendas por Mês</h3>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </main>
    </div>
    
    <script src="js/dashboard.js"></script>
</body>
</html>';
}

function getDashboardCSS() {
    return '.dashboard { display: flex; min-height: 100vh; }
.sidebar { width: 250px; background: #2d3748; color: white; }
.sidebar .logo { padding: 20px; border-bottom: 1px solid #4a5568; }
.sidebar .nav a { display: block; padding: 15px 20px; color: white; text-decoration: none; }
.sidebar .nav a:hover { background: #4a5568; }
.main-content { flex: 1; background: #f7fafc; }
.header { background: white; padding: 20px; border-bottom: 1px solid #e2e8f0; }
.stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; padding: 20px; }
.stat-card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 15px; }
.stat-card i { font-size: 2rem; color: #667eea; }
.charts { padding: 20px; }
.chart-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }';
}

function getDashboardJS() {
    return 'document.addEventListener("DOMContentLoaded", function() {
    initializeCharts();
});

function initializeCharts() {
    const ctx = document.getElementById("salesChart").getContext("2d");
    
    new Chart(ctx, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [{
                label: "Vendas",
                data: [65, 59, 80, 81, 56, 55],
                borderColor: "#667eea",
                backgroundColor: "rgba(102, 126, 234, 0.1)",
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top"
                }
            }
        }
    });
}';
}

function getQuizHTML() {
    return '<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Master</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <i class="fas fa-brain"></i>
                <h1>Quiz Master</h1>
            </div>
            <nav class="nav">
                <a href="../loja/"><i class="fas fa-store"></i> Loja</a>
                <a href="../dashboard/"><i class="fas fa-chart-pie"></i> Dashboard</a>
            </nav>
        </div>
    </header>
    
    <main class="main">
        <div class="quiz-container">
            <div class="welcome-screen active">
                <h2>Bem-vindo ao Quiz Master!</h2>
                <p>Teste seus conhecimentos em diversas categorias</p>
                <button class="btn-start" onclick="startQuiz()">Começar Quiz</button>
            </div>
            
            <div class="quiz-screen">
                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>
                <div class="question-container">
                    <h3 id="questionText">Pergunta aparecerá aqui</h3>
                    <div class="answers" id="answersContainer">
                        <!-- Respostas serão inseridas aqui -->
                    </div>
                </div>
                <button class="btn-next" onclick="nextQuestion()" disabled>Próxima</button>
            </div>
            
            <div class="results-screen">
                <h2>Parabéns!</h2>
                <div class="score" id="finalScore">0%</div>
                <p>Você completou o quiz!</p>
                <button class="btn-restart" onclick="restartQuiz()">Jogar Novamente</button>
            </div>
        </div>
    </main>
    
    <script src="js/quiz.js"></script>
</body>
</html>';
}

function getQuizCSS() {
    return 'body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #667eea, #764ba2); margin: 0; padding: 0; }
.header { background: rgba(255,255,255,0.9); padding: 1rem 0; }
.container { max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; }
.logo { display: flex; align-items: center; gap: 10px; color: #333; }
.nav a { color: #333; text-decoration: none; margin-left: 20px; }
.main { padding: 40px 20px; }
.quiz-container { max-width: 800px; margin: 0 auto; background: white; border-radius: 20px; padding: 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
.welcome-screen { text-align: center; }
.welcome-screen h2 { font-size: 2.5rem; margin-bottom: 1rem; color: #333; }
.btn-start, .btn-next, .btn-restart { background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; padding: 15px 30px; border-radius: 25px; font-size: 1.1rem; cursor: pointer; }
.quiz-screen, .results-screen { display: none; }
.quiz-screen.active, .results-screen.active, .welcome-screen.active { display: block; }
.progress-bar { background: #e0e0e0; height: 10px; border-radius: 5px; margin-bottom: 30px; }
.progress-fill { background: linear-gradient(90deg, #667eea, #764ba2); height: 100%; border-radius: 5px; transition: width 0.3s; }
.answers { display: grid; gap: 15px; margin: 30px 0; }
.answer { background: #f5f5f5; padding: 15px; border-radius: 10px; cursor: pointer; transition: all 0.3s; }
.answer:hover { background: #e0e0e0; }
.answer.selected { background: #667eea; color: white; }';
}

function getQuizJS() {
    return 'let currentQuestion = 0;
let score = 0;
let questions = [];

const mockQuestions = [
    {
        question: "Qual é a capital do Brasil?",
        answers: ["São Paulo", "Rio de Janeiro", "Brasília", "Salvador"],
        correct: 2
    },
    {
        question: "Em que ano o Brasil foi descoberto?",
        answers: ["1498", "1500", "1502", "1492"],
        correct: 1
    }
];

function startQuiz() {
    questions = [...mockQuestions];
    currentQuestion = 0;
    score = 0;
    
    document.querySelector(".welcome-screen").classList.remove("active");
    document.querySelector(".quiz-screen").classList.add("active");
    
    showQuestion();
}

function showQuestion() {
    if (currentQuestion >= questions.length) {
        showResults();
        return;
    }
    
    const question = questions[currentQuestion];
    document.getElementById("questionText").textContent = question.question;
    
    const container = document.getElementById("answersContainer");
    container.innerHTML = "";
    
    question.answers.forEach((answer, index) => {
        const div = document.createElement("div");
        div.className = "answer";
        div.textContent = answer;
        div.onclick = () => selectAnswer(index);
        container.appendChild(div);
    });
    
    updateProgress();
}

function selectAnswer(index) {
    const answers = document.querySelectorAll(".answer");
    answers.forEach(a => a.classList.remove("selected"));
    answers[index].classList.add("selected");
    
    document.querySelector(".btn-next").disabled = false;
}

function nextQuestion() {
    const selected = document.querySelector(".answer.selected");
    if (selected) {
        const index = Array.from(selected.parentNode.children).indexOf(selected);
        if (index === questions[currentQuestion].correct) {
            score++;
        }
    }
    
    currentQuestion++;
    document.querySelector(".btn-next").disabled = true;
    showQuestion();
}

function updateProgress() {
    const progress = (currentQuestion / questions.length) * 100;
    document.getElementById("progressFill").style.width = progress + "%";
}

function showResults() {
    const percentage = Math.round((score / questions.length) * 100);
    
    document.querySelector(".quiz-screen").classList.remove("active");
    document.querySelector(".results-screen").classList.add("active");
    document.getElementById("finalScore").textContent = percentage + "%";
}

function restartQuiz() {
    document.querySelector(".results-screen").classList.remove("active");
    document.querySelector(".welcome-screen").classList.add("active");
}';
}

function getReadme() {
    return '# TechStore - Sistema Completo

Sistema integrado com loja online, dashboard administrativo e quiz interativo.

## Instalação

1. Instale o XAMPP
2. Coloque os arquivos em htdocs/workshop/  
3. Importe database/schema.sql no phpMyAdmin
4. Acesse: http://localhost/workshop/

## Funcionalidades

- ✅ Mini Loja responsiva
- ✅ Dashboard com gráficos  
- ✅ Quiz interativo
- ✅ API REST completa
- ✅ Banco de dados integrado

## Acesso

- Loja: http://localhost/workshop/loja/
- Dashboard: http://localhost/workshop/dashboard/
- Quiz: http://localhost/workshop/quiz/';
}

echo "\n🔧 Executando setup...\n";
?>