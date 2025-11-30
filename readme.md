# CRUD_GP - Sistema de Cadastro Fullstack

## Meu site: https://gabrielmustacheprogrammer.github.io/My_landing_page/

## Descrição do Projeto

CRUD_GP é um sistema de cadastro de pessoas desenvolvido para treinar operações **Fullstack** com front-end e back-end separados, utilizando **HTML, CSS, JavaScript e PHP**, seguindo a arquitetura **MVC (Model-View-Controller)**.  

O objetivo deste projeto é treinar a lógica de desenvolvimento de sistemas completos sem utilizar frameworks, focando em conceitos de **API RESTful**, separação de camadas e boas práticas de segurança.

### Tecnologias utilizadas
- **Front-end:** HTML, CSS, JavaScript
- **Back-end:** PHP
- **Banco de dados:** MariaDB (MySQL)
- **Servidor local:** XAMPP (Apache + MySQL)

### Segurança implementada
- Uso de **PDO** para consultas seguras ao banco de dados.
- **Validação de entradas** com detecção de SQL Injection.
- Proteção contra **XSS (Cross-Site Scripting)**.
- Sanitização de dados via `sanitizeInput()`.
- Uso de **token de sessão** para validação das requisições.
- Não foi utilizado `.htaccess` para evitar problemas de compatibilidade com a API; utilizamos **resources** no router para mapear rotas.

---

## Estrutura do Projeto
CRUD_GP/
│
├── back/ # Back-end
│ ├── api/
│ │ └── router/
│ │ └── router.php # Ponto de entrada da API
│ ├── controllers/
│ │ └── PessoaController.php
│ ├── models/
│ │ └── Crud_data_base.php
│ └── security/
│ ├── detectsqlinjection.php
│ ├── detectxss.php
│ └── sanitizeinput.php
│
├── front/ # Front-end
│ ├── public/
│ │ ├── index.php
│ │ ├── css/
│ │ │ └── styles.css
│ │ └── js/
│ │ ├── app.js
│ │ └── front.js


---

### Para funcionar o projeto leia o arquivo "how_to_run" em pdf pois o mesmo é mais detalhado por conter imagens.

## Criação do Banco de Dados

1. Foi selecionado o **MariaDB** pela facilidade de hospedagem, integrado via **XAMPP**.  

2. Para rodar o sistema, primeiro instale o XAMPP:  
   [https://www.apachefriends.org/pt_br/index.html](https://www.apachefriends.org/pt_br/index.html)

3. Inicialize o **XAMPP Control Panel** e inicie os serviços:
   - **Apache**  
   - **MySQL**  

   > OBS: Se o Apache ou MySQL não funcionar, tente alterar as portas de serviço. Sugestão:
   > - Apache: 8080  
   > - MySQL: 3307  

4. Após iniciar os serviços, crie o banco ou importe o arquivo fornecido:  
   - Nome do banco: `crud_gp`  
   - Tabela: `pessoas`  
     - Colunas:  
       - `id` (INT, auto_increment, primary key)  
       - `nome` (VARCHAR)  
       - `cpf` (VARCHAR)  
       - `idade` (INT)  
       - `data_criacao` (DATETIME)  

   > **Exemplo SQL para criar tabela:**
   ```sql
   CREATE TABLE pessoas (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(255) NOT NULL,
       cpf VARCHAR(20) NOT NULL UNIQUE,
       idade INT NOT NULL,
       data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
   );

5. Coloque a pasta CRUD_GP dentro do htdocs do XAMPP:

xampp/htdocs/CRUD_GP



> **OBS:** O `htdocs` possui arquivos padrão do XAMPP; criando uma pasta separada e colocando o projeto dentro, ao acessar `http://localhost/CRUD_GP/front/public` você verá o site corretamente.

## Uso do Sistema

### Cadastrar Pessoa

1. Preencha os campos **nome**, **CPF** e **idade**.  
2. O sistema valida se o CPF já existe antes de inserir.  
3. Após o cadastro, a tabela é atualizada automaticamente via **fetch API**.

### Atualizar Pessoa

1. Informe o **ID** da pessoa que deseja atualizar.  
2. Preencha apenas os campos que deseja alterar; campos em branco permanecem inalterados.  
3. O sistema verifica se o novo CPF informado já existe.

### Excluir Pessoa

1. Informe o **ID** da pessoa que deseja excluir.  
2. Confirme a exclusão no pop-up de confirmação.  
3. A tabela de pessoas é atualizada automaticamente a cada 5 segundos, sem necessidade de recarregar a página.

## Observações

- O projeto foi feito sem frameworks, com foco em **entender a lógica MVC**, **API RESTful** e segurança.  
- O **router** utiliza `resources` no lugar de `.htaccess` para compatibilidade.  
- Todas as requisições são validadas com **token de sessão** para evitar ataques CSRF.  
- Foram implementadas funções de **detecção de XSS**, **SQL Injection** e **sanitização de entrada**.  

## Contato

- Feito por: Gabriel Antonio Duarte Sales  
- E-mail: https://gabrielmustacheprogrammer.github.io/My_landing_page/

## Referências

- [PHP PDO - Manual](https://www.php.net/manual/pt_BR/book.pdo.php)  
- [XAMPP Official Site](https://www.apachefriends.org/pt_br/index.html)  
- [MariaDB Documentation](https://mariadb.com/kb/en/documentation/)

