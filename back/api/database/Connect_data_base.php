<?php
    class Connect_data_base{
        private $server = 'localhost'; 
        private $db_name = 'crud_gp'; 
        private $user = 'admin'; 
        private $password = '*/fiK8sX/d]O8pib'; 

        public function connect_db(){
            return new PDO("mysql:host=$this->server;dbname=$this->db_name",$this->user,$this->password);
        }  
    }




?>
