<?php
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();
$database->jsonHeader();

$method = $_SERVER["REQUEST_METHOD"];

switch($method) {
    case "GET":
        try {
            $action = $_GET['action'] ?? 'overview';
            
            switch($action) {
                case 'overview':
                    echo json_encode(getOverviewData($db));
                    break;
                case 'sales':
                    echo json_encode(getSalesData($db));
                    break;
                case 'products':
                    echo json_encode(getProductsData($db));
                    break;
                case 'charts':
                    echo json_encode(getChartsData($db));
                    break;
                default:
                    echo json_encode(getOverviewData($db));
            }
            
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Erro: " . $e->getMessage()
            ]);
        }
        break;
        
    default:
        echo json_encode([
            "success" => false,
            "message" => "Método não permitido"
        ]);
        break;
}

function getOverviewData($db) {
    // Estatísticas gerais
    $totalProdutos = $db->query("SELECT COUNT(*) FROM produtos WHERE ativo = 1")->fetchColumn();
    $totalVendas = $db->query("SELECT COUNT(*) FROM vendas")->fetchColumn();
    $receitaTotal = $db->query("SELECT SUM(total) FROM vendas")->fetchColumn() ?? 0;
    $estoqueTotal = $db->query("SELECT SUM(estoque) FROM produtos WHERE ativo = 1")->fetchColumn();
    
    // Produtos com estoque baixo
    $stmt = $db->query("SELECT nome, estoque FROM produtos WHERE estoque < 10 AND ativo = 1");
    $estoqueBaixo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Top produtos
    $stmt = $db->query("
        SELECT p.nome, SUM(iv.quantidade) as vendido 
        FROM produtos p 
        JOIN itens_venda iv ON p.id = iv.produto_id 
        GROUP BY p.id 
        ORDER BY vendido DESC 
        LIMIT 5
    ");
    $topProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Vendas recentes
    $stmt = $db->query("
        SELECT v.*, 
               DATE_FORMAT(v.data_venda, '%d/%m/%Y %H:%i') as data_formatada
        FROM vendas v 
        ORDER BY v.data_venda DESC 
        LIMIT 10
    ");
    $vendasRecentes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return [
        "success" => true,
        "data" => [
            "stats" => [
                "totalProdutos" => $totalProdutos,
                "totalVendas" => $totalVendas,
                "receitaTotal" => number_format($receitaTotal, 2, ',', '.'),
                "estoqueTotal" => $estoqueTotal
            ],
            "estoqueBaixo" => $estoqueBaixo,
            "topProdutos" => $topProdutos,
            "vendasRecentes" => $vendasRecentes
        ]
    ];
}

function getSalesData($db) {
    // Vendas por mês
    $stmt = $db->query("
        SELECT 
            MONTH(data_venda) as mes,
            MONTHNAME(data_venda) as nome_mes,
            COUNT(*) as quantidade,
            SUM(total) as valor
        FROM vendas 
        WHERE YEAR(data_venda) = YEAR(CURDATE())
        GROUP BY MONTH(data_venda)
        ORDER BY mes
    ");
    $vendasMes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Vendas por dia (últimos 30 dias)
    $stmt = $db->query("
        SELECT 
            DATE(data_venda) as data,
            COUNT(*) as vendas,
            SUM(total) as receita
        FROM vendas 
        WHERE data_venda >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        GROUP BY DATE(data_venda)
        ORDER BY data
    ");
    $vendasDia = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return [
        "success" => true,
        "data" => [
            "vendasMes" => $vendasMes,
            "vendasDia" => $vendasDia
        ]
    ];
}

function getProductsData($db) {
    // Produtos por categoria
    $stmt = $db->query("
        SELECT 
            categoria,
            COUNT(*) as quantidade,
            SUM(estoque) as estoque_total
        FROM produtos 
        WHERE ativo = 1
        GROUP BY categoria
    ");
    $produtosPorCategoria = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Produtos mais vendidos
    $stmt = $db->query("
        SELECT 
            p.nome,
            p.categoria,
            SUM(iv.quantidade) as total_vendido,
            SUM(iv.quantidade * iv.preco_unitario) as receita
        FROM produtos p
        JOIN itens_venda iv ON p.id = iv.produto_id
        GROUP BY p.id
        ORDER BY total_vendido DESC
        LIMIT 10
    ");
    $produtosMaisVendidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return [
        "success" => true,
        "data" => [
            "produtosPorCategoria" => $produtosPorCategoria,
            "produtosMaisVendidos" => $produtosMaisVendidos
        ]
    ];
}

function getChartsData($db) {
    // Dados para gráfico de vendas mensais
    $vendasMensais = [];
    for ($i = 1; $i <= 12; $i++) {
        $stmt = $db->query("
            SELECT COALESCE(SUM(total), 0) as total 
            FROM vendas 
            WHERE MONTH(data_venda) = $i AND YEAR(data_venda) = YEAR(CURDATE())
        ");
        $total = $stmt->fetchColumn();
        $vendasMensais[] = [
            'mes' => $i,
            'nome' => date('F', mktime(0, 0, 0, $i, 1)),
            'total' => $total
        ];
    }
    
    // Dados para gráfico de categorias
    $stmt = $db->query("
        SELECT 
            categoria,
            COUNT(*) as produtos,
            SUM(estoque * preco) as valor_estoque
        FROM produtos 
        WHERE ativo = 1
        GROUP BY categoria
    ");
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return [
        "success" => true,
        "data" => [
            "vendasMensais" => $vendasMensais,
            "categorias" => $categorias
        ]
    ];
}
?>