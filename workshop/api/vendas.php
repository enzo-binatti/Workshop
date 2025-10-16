<?php
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();
$database->jsonHeader();

$method = $_SERVER["REQUEST_METHOD"];

switch($method) {
    case "GET":
        try {
            // Listar vendas
            $stmt = $db->query("
                SELECT v.*, 
                       DATE_FORMAT(v.data_venda, '%d/%m/%Y %H:%i') as data_formatada
                FROM vendas v 
                ORDER BY v.data_venda DESC 
                LIMIT 50
            ");
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                "success" => true,
                "data" => $vendas
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Erro ao buscar vendas: " . $e->getMessage()
            ]);
        }
        break;
        
    case "POST":
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            if (!$data || !isset($data['customer']) || !isset($data['items'])) {
                throw new Exception("Dados incompletos");
            }
            
            $customer = $data['customer'];
            $items = $data['items'];
            $total = $data['total'] ?? 0;
            
            // Validações básicas
            if (empty($customer['name']) || empty($customer['email'])) {
                throw new Exception("Nome e email são obrigatórios");
            }
            
            if (empty($items)) {
                throw new Exception("Nenhum item no pedido");
            }
            
            // Iniciar transação
            $db->beginTransaction();
            
            try {
                // Inserir venda
                $stmt = $db->prepare("
                    INSERT INTO vendas (cliente_nome, cliente_email, total) 
                    VALUES (?, ?, ?)
                ");
                $stmt->execute([
                    $customer['name'],
                    $customer['email'],
                    $total
                ]);
                
                $vendaId = $db->lastInsertId();
                
                // Inserir itens da venda
                $stmtItem = $db->prepare("
                    INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco_unitario) 
                    VALUES (?, ?, ?, ?)
                ");
                
                foreach ($items as $item) {
                    // Verificar se o produto existe e tem estoque
                    $stmtProduto = $db->prepare("SELECT estoque FROM produtos WHERE id = ? AND ativo = 1");
                    $stmtProduto->execute([$item['id']]);
                    $produto = $stmtProduto->fetch(PDO::FETCH_ASSOC);
                    
                    if (!$produto) {
                        throw new Exception("Produto {$item['nome']} não encontrado");
                    }
                    
                    if ($produto['estoque'] < $item['quantity']) {
                        throw new Exception("Estoque insuficiente para {$item['nome']}");
                    }
                    
                    // Inserir item
                    $stmtItem->execute([
                        $vendaId,
                        $item['id'],
                        $item['quantity'],
                        $item['preco']
                    ]);
                    
                    // Atualizar estoque
                    $stmtEstoque = $db->prepare("UPDATE produtos SET estoque = estoque - ? WHERE id = ?");
                    $stmtEstoque->execute([$item['quantity'], $item['id']]);
                }
                
                // Confirmar transação
                $db->commit();
                
                echo json_encode([
                    "success" => true,
                    "message" => "Venda realizada com sucesso",
                    "venda_id" => $vendaId,
                    "total" => $total
                ]);
                
            } catch (Exception $e) {
                // Rollback em caso de erro
                $db->rollback();
                throw $e;
            }
            
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Erro ao processar venda: " . $e->getMessage()
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
?>