<?php
header('Content-Type: application/json');
require_once 'config.php';

$field = isset($_GET['field']) ? $_GET['field'] : 'cidade';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

// Map frontend field names to database column names
$fieldMap = [
    'cidade' => 'localidade',
    'bairro' => 'bairro',
    'estado' => 'uf'
];

// Validate and sanitize the field name
$field = isset($fieldMap[$field]) ? $fieldMap[$field] : 'localidade';
$order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

try {
    $stmt = $pdo->prepare("SELECT * FROM enderecos ORDER BY $field $order");
    $stmt->execute();
    $enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($enderecos);
} catch(PDOException $e) {
    echo json_encode(['erro' => true, 'mensagem' => 'Erro ao buscar endereços']);
} 