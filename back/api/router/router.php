<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../controllers/PessoaController.php';

session_start();

$method = $_SERVER['REQUEST_METHOD'];


$input = null;
if ($method !== 'GET') {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['token_name']) || $input['token_name'] !== $_SESSION['token_name']) {
        http_response_code(403);
        echo json_encode(['error' => 'INVALID TOKEN']);
        exit;
    }
}

$resource = $_GET['resource'] ?? null;
$id = $_GET['id'] ?? null;

if ($resource !== 'pessoa') {
    http_response_code(404);
    echo json_encode(['error' => 'Recurso não encontrado']);
    exit;
}

$controller = new PessoaController();

switch ($method) {

    case 'GET':
        $controller->index();
        break;

    case 'POST':
        $controller->create($input);
        break;

    case 'PUT':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID necessário para atualizar']);
            exit;
        }
        $controller->update($id, $input);
        break;

    case 'DELETE':
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID necessário para deletar']);
            exit;
        }
        $controller->delete($id);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
        break;
}
