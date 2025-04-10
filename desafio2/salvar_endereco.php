<?php
header('Content-Type: application/json');
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO enderecos (cep, logradouro, bairro, localidade, uf) VALUES (?, ?, ?, ?, ?)");
    
    $stmt->execute([
        $data['cep'],
        $data['logradouro'],
        $data['bairro'],
        $data['localidade'],
        $data['uf']
    ]);

    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar o endereço']);
} 