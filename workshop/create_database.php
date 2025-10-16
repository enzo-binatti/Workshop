<?php
echo "🔧 Criando banco de dados TechStore...\n\n";

// Configurações do banco
$host = "localhost";
$username = "root";
$password = "";
$database = "workshop_system";

try {
    // Conectar ao MySQL (sem especificar banco)
    echo "📡 Conectando ao MySQL...\n";
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexão estabelecida!\n\n";

    // Criar banco de dados
    echo "🗄️ Criando banco de dados '$database'...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $database");
    echo "✅ Banco de dados criado!\n\n";

    // Usar o banco
    $pdo->exec("USE $database");
    echo "📋 Usando banco '$database'\n\n";

    // Ler e executar o schema
    echo "📜 Executando schema SQL...\n";
    $schema = file_get_contents('database/schema.sql');
    
    if (!$schema) {
        throw new Exception("Não foi possível ler o arquivo schema.sql");
    }

    // Dividir o schema em comandos separados
    $commands = array_filter(array_map('trim', explode(';', $schema)));
    
    $successCount = 0;
    foreach ($commands as $command) {
        if (empty($command) || strpos($command, '--') === 0) {
            continue;
        }
        
        try {
            $pdo->exec($command);
            $successCount++;
            
            // Identificar o tipo de comando
            if (stripos($command, 'CREATE DATABASE') !== false) {
                echo "  ✅ Banco de dados criado\n";
            } elseif (stripos($command, 'CREATE TABLE') !== false) {
                preg_match('/CREATE TABLE.*?(\w+)/i', $command, $matches);
                $table = $matches[1] ?? 'tabela';
                echo "  ✅ Tabela '$table' criada\n";
            } elseif (stripos($command, 'INSERT') !== false) {
                preg_match('/INSERT INTO\s+(\w+)/i', $command, $matches);
                $table = $matches[1] ?? 'tabela';
                echo "  ✅ Dados inseridos na tabela '$table'\n";
            }
            
        } catch (PDOException $e) {
            echo "  ⚠️ Aviso: " . $e->getMessage() . "\n";
        }
    }

    echo "\n📊 Verificando tabelas criadas...\n";
    $result = $pdo->query("SHOW TABLES");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($tables as $table) {
        echo "  ✅ Tabela: $table\n";
    }

    echo "\n🔢 Verificando dados inseridos...\n";
    
    // Verificar produtos
    if (in_array('produtos', $tables)) {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM produtos");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        echo "  📦 Produtos cadastrados: $count\n";
    }
    
    // Verificar vendas
    if (in_array('vendas', $tables)) {
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM vendas");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        echo "  💰 Vendas registradas: $count\n";
    }

    echo "\n🎉 Banco de dados criado com sucesso!\n";
    echo "🌐 Agora você pode acessar: http://localhost/workshop/loja/\n\n";

} catch (PDOException $e) {
    echo "❌ Erro de conexão: " . $e->getMessage() . "\n\n";
    echo "💡 Soluções possíveis:\n";
    echo "   1. Verifique se o XAMPP está rodando\n";
    echo "   2. Inicie o Apache e MySQL no painel do XAMPP\n";
    echo "   3. Verifique se a porta 3306 está livre\n";
    echo "   4. Tente acessar: http://localhost/phpmyadmin/\n\n";
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
?>