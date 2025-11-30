<?php
require_once __DIR__ . '/../models/Crud_data_base.php';
require_once '../security/detectsqlinjection.php';
require_once '../security/detectxss.php';
require_once '../security/sanitizeinput.php';

class PessoaController
{
    private $crud;

    public function __construct()
    {
        $this->crud = new Crud_data_base();
    }

    private function validateInput($input)
    {
        $input = sanitizeInput($input);
        if (detectSqlInjection($input)) {
            http_response_code(400);
            echo json_encode(['error' => 'Entrada inválida']);
            return false;
        }

        if (detectXSS($input)) {
            http_response_code(400);
            echo json_encode(['error' => 'Entrada inválida (XSS detectado)']);
            return false;
        }
        return true;
    }

    public function index() 
    {
        $usuarios = $this->crud->read_all_users();
        echo json_encode($usuarios);
    }

    public function create($data)
    {
        if (!$this->validateInput($data)) return;
        $result = $this->crud->create_user($data['nome'], $data['cpf'], $data['idade']);
        echo json_encode($result);
        exit;
    }

    public function update($id, $data)
    {
        if (!$this->validateInput($id) || !$this->validateInput($data)) return;
        $dataToUpdate = [
            'nome'  => $data['nome']  ?? null,
            'cpf'   => $data['cpf']   ?? null,
            'idade' => $data['idade'] ?? null
        ];

        $result = $this->crud->update_user($id, $dataToUpdate);
        echo json_encode($result);
        exit;
    }

    public function delete($id) 
    {
        if (!$this->validateInput($id)) return;
        $result = $this->crud->delete_user($id);
        echo json_encode($result);
        exit;
    }

}
