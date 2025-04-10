<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['cep'])) {
    echo json_encode(['erro' => true, 'mensagem' => 'CEP não fornecido']);
    exit;
}

$cep = preg_replace('/[^0-9]/', '', $_GET['cep']);

if (strlen($cep) !== 8) {
    echo json_encode(['erro' => true, 'mensagem' => 'CEP inválido']);
    exit;
}

if (!function_exists('curl_init')) {
    echo json_encode(['erro' => true, 'mensagem' => 'cURL não está instalado no servidor']);
    exit;
}

$url = "https://viacep.com.br/ws/{$cep}/json/";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$error = curl_error($ch);
$info = curl_getinfo($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode([
        'erro' => true, 
        'mensagem' => 'Erro ao consultar o CEP',
        'debug_info' => [
            'curl_error' => $error,
            'http_code' => $info['http_code']
        ]
    ]);
    exit;
}

$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        'erro' => true,
        'mensagem' => 'Erro ao processar resposta do servidor',
        'debug_info' => json_last_error_msg()
    ]);
    exit;
}

echo json_encode($data); 