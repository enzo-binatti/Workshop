<?php
echo "🔧 Criando banco de dados e tabelas...\n\n";

// Configurações do banco
$host = "localhost";
$username = "root";
$password = "";
$dbname = "workshop_system";

try {
    // Conectar ao MySQL 
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conectado ao MySQL com sucesso!\n\n";
    
    // Criar o banco de dados
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $pdo->exec($sql);
    echo "✅ Banco de dados '$dbname' criado!\n\n";
    
    // Conectar ao banco recém-criado
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🔄 Criando tabelas...\n";
    
    // Criar tabela de produtos
    $sql = "CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        descricao TEXT,
        preco DECIMAL(10,2) NOT NULL,
        categoria VARCHAR(100),
        estoque INT DEFAULT 0,
        imagem_url VARCHAR(500),
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        ativo BOOLEAN DEFAULT TRUE
    )";
    $pdo->exec($sql);
    echo "  ✅ Tabela 'produtos' criada\n";
    
    // Criar tabela de vendas
    $sql = "CREATE TABLE IF NOT EXISTS vendas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_nome VARCHAR(255),
        cliente_email VARCHAR(255),
        total DECIMAL(10,2) NOT NULL,
        data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "  ✅ Tabela 'vendas' criada\n";
    
    // Criar tabela de itens de venda
    $sql = "CREATE TABLE IF NOT EXISTS itens_venda (
        id INT AUTO_INCREMENT PRIMARY KEY,
        venda_id INT,
        produto_id INT,
        quantidade INT NOT NULL,
        preco_unitario DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (venda_id) REFERENCES vendas(id),
        FOREIGN KEY (produto_id) REFERENCES produtos(id)
    )";
    $pdo->exec($sql);
    echo "  ✅ Tabela 'itens_venda' criada\n\n";
    
    // Inserir produtos de exemplo
    echo "🔄 Inserindo dados de exemplo...\n";
    
    // Verificar se já existem produtos
    $stmt = $pdo->query("SELECT COUNT(*) FROM produtos");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        $sql = "INSERT INTO produtos (nome, descricao, preco, categoria, estoque, imagem_url) VALUES
            ('Smartphone Samsung Galaxy', 'Smartphone Android com 128GB de armazenamento', 899.99, 'Eletrônicos', 15, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500'),
            ('Notebook Lenovo ThinkPad', 'Notebook para trabalho e estudos com 8GB RAM', 1299.99, 'Eletrônicos', 8, 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500'),
            ('Camiseta Polo Masculina', 'Camiseta polo masculina 100% algodão', 59.99, 'Roupas', 25, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=500'),
            ('Tênis Esportivo Nike', 'Tênis para corrida e atividades físicas', 199.99, 'Calçados', 12, 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500'),
            ('Relógio Digital Casio', 'Relógio digital resistente à água', 89.99, 'Acessórios', 18, 'https://images.unsplash.com/photo-1524805444973-83be71b9cccb?w=500'),
            ('Mochila Executiva', 'Mochila para laptop e documentos', 129.99, 'Acessórios', 20, 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=500')";
        $pdo->exec($sql);
        echo "  ✅ 6 produtos inseridos\n";
    } else {
        echo "  ℹ️ Produtos já existem na tabela\n";
    }
    
    // Verificar se já existem vendas
    $stmt = $pdo->query("SELECT COUNT(*) FROM vendas");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        $sql = "INSERT INTO vendas (cliente_nome, cliente_email, total) VALUES
            ('João Silva', 'joao@email.com', 1399.98),
            ('Maria Santos', 'maria@email.com', 259.98),
            ('Pedro Costa', 'pedro@email.com', 899.99)";
        $pdo->exec($sql);
        echo "  ✅ 3 vendas inseridas\n";
        
        $sql = "INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco_unitario) VALUES
            (1, 1, 1, 899.99),
            (1, 3, 2, 59.99),
            (2, 4, 1, 199.99),
            (3, 1, 1, 899.99)";
        $pdo->exec($sql);
        echo "  ✅ Itens de venda inseridos\n";
    } else {
        echo "  ℹ️ Vendas já existem na tabela\n";
    }
    
    // Verificar se deu certo
    echo "\n📊 Verificando tabelas...\n";
    
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        $count = $pdo->query("SELECT COUNT(*) FROM $table")->fetchColumn();
        echo "  • $table: $count registros\n";
    }
    
    echo "\n🎉 Banco de dados configurado com sucesso!\n";
    echo "🌐 Agora você pode acessar: http://localhost/workshop/loja/\n";
    
} catch (PDOException $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n\n";
    echo "📋 Instruções para resolver o problema:\n";
    echo "1. Verifique se o MySQL está rodando no XAMPP\n";
    echo "2. Certifique-se que o usuário 'root' não tem senha\n";
    echo "3. Tente acessar: http://localhost/phpmyadmin/\n";
}
?>