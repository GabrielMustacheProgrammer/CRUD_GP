<?php 
    session_start();
    if(!isset($_SESSION['token_name'])){
        $_SESSION['token_name'] = bin2hex(random_bytes(32));
    }
    $token = $_SESSION['token_name'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD_GP - Sistema CRUD</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>CRUD_GP</h1>
            <p class="subtitle">Sistema de Cadastro de Pessoas</p>
            &copy; <span id="year"></span> Criado por <a target='blank' href="https://gabrielmustacheprogrammer.github.io/My_landing_page/">Gabriel Antonio Duarte Sales</a>
        </header>

        <div class="card">
            <h2 class="card-title">Formulário de Dados</h2>
            <form id="crud-form">

                <input type="hidden" name="token_name" value="<?=$token?>">
                <div class="btn-group">
                    <button type="button" class="btn btn-create" data-type="create">Cadastrar</button>
                    <button type="button" class="btn btn-update" data-type="update">Atualizar</button>
                    <button type="button" class="btn btn-delete" data-type="delete">Excluir</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h2 class="card-title">Registros Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Idade</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody id="date_table">
                </tbody>
            </table>
        </div>
    </div>
    <script defer src="js/front.js"></script>
    <script defer src="js/app.js"></script>
</body>

</html>