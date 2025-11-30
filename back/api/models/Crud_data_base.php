<?php
require_once '../database/Connect_data_base.php'; 

class Crud_data_base
{
    private $connect; 

    public function __construct() 
    {
        $this->connect = (new Connect_data_base())->connect_db(); 
    } 

    public function exists_cpf($cpf)
    {
        $sql = "SELECT COUNT(*) FROM pessoas WHERE cpf = :cpf";
        $stmt = $this->connect->prepare($sql);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function create_user($nome, $cpf, $idade) 
    {

        if ($this->exists_cpf($cpf)) {
            return ['success' => false, 'message' => 'CPF já cadastrado!'];
        }

        $sql_command = "INSERT INTO pessoas (nome, cpf, idade) VALUES (:nome, :cpf, :idade)"; 
        $stmt = $this->connect->prepare($sql_command);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':idade', $idade, PDO::PARAM_INT);

        if($stmt->execute()){
            return ['success' => true, 'message' => 'Cadastro criado com sucesso!'];
        } else {
            return ['success' => false, 'message' => 'Erro no cadastro!'];
        }
    }

    public function update_user($id, $data)
    {
        $fields = [];

        if (!empty($data['nome'])) $fields['nome'] = $data['nome'];
        if (!empty($data['cpf'])) $fields['cpf'] = $data['cpf'];
        if (!empty($data['idade'])) $fields['idade'] = $data['idade'];

        if (empty($fields)) {
            return ['success' => false, 'message' => 'Nenhum dado para atualizar'];
        }

        
        if (isset($fields['cpf']) && $this->exists_cpf($fields['cpf'])) {
            return ['success' => false, 'message' => 'CPF já cadastrado!'];
        }

        $set = [];
        foreach ($fields as $key => $value) {
            $set[] = "$key = :$key";
        }

        $sql_command = "UPDATE pessoas SET " . implode(', ', $set) . " WHERE id = :id";
        $stmt = $this->connect->prepare($sql_command);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Cadastro atualizado com sucesso!'];
        } else {
            return ['success' => false, 'message' => 'Erro ao atualizar o cadastro!'];
        }
    }


    public function read_all_users()
    {
        $sql_command = "SELECT * FROM pessoas ORDER BY id ASC";
        $stmt = $this->connect->prepare($sql_command);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_user($id)
    {
        $sql_command = "DELETE FROM pessoas WHERE id = :id";
        $stmt = $this->connect->prepare($sql_command);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()){
            return ['success' => true, 'message' => 'Usuário excluído!'];
        } else {
            return ['success' => false, 'message' => 'Não foi possível excluir!'];
        }
    }

    public function close_connection()
    {
        $this->connect = null;
    }
}
