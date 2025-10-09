<?php
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();
$database->jsonHeader();

$method = $_SERVER["REQUEST_METHOD"];

switch($method) {
    case "GET":
        try {
            $sql = "SELECT * FROM produtos WHERE ativo = 1 ORDER BY data_cadastro DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                "success" => true,
                "data" => $produtos,
                "total" => count($produtos)
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Erro ao buscar produtos: " . $e->getMessage()
            ]);
        }
        break;
        
    case "POST":
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            
            $sql = "INSERT INTO produtos (nome, descricao, preco, categoria, estoque, imagem_url) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $data['nome'],
                $data['descricao'],
                $data['preco'],
                $data['categoria'],
                $data['estoque'],
                $data['imagem_url'] ?? null
            ]);
            
            echo json_encode([
                "success" => true,
                "message" => "Produto criado com sucesso",
                "id" => $db->lastInsertId()
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Erro ao criar produto: " . $e->getMessage()
            ]);
        }
        break;
        
    case "PUT":
        try {
            $data = json_decode(file_get_contents("php://input"), true);
            $id = $_GET['id'] ?? null;
            
            if (!$id) {
                throw new Exception("ID do produto é obrigatório");
            }
            
            $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, categoria = ?, estoque = ?, imagem_url = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                $data['nome'],
                $data['descricao'],
                $data['preco'],
                $data['categoria'],
                $data['estoque'],
                $data['imagem_url'] ?? null,
                $id
            ]);
            
            echo json_encode([
                "success" => true,
                "message" => "Produto atualizado com sucesso"
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Erro ao atualizar produto: " . $e->getMessage()
            ]);
        }
        break;
        
    case "DELETE":
        try {
            $id = $_GET['id'] ?? null;
            
            if (!$id) {
                throw new Exception("ID do produto é obrigatório");
            }
            
            $sql = "UPDATE produtos SET ativo = 0 WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$id]);
            
            echo json_encode([
                "success" => true,
                "message" => "Produto removido com sucesso"
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => "Erro ao remover produto: " . $e->getMessage()
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