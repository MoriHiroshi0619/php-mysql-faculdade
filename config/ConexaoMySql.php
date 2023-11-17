<?php 
    class ConexaoMySql {
        private $host = "127.0.0.1";
        private $dbName = "company";
        private $user = "root";
        private $password = "hiroshi19*";
        protected $bd;

        public function __construct(){
            $this->bd = new mysqli($this->host, $this->user, $this->password, $this->dbName);
            if ($this->bd->connect_error) {
                die('Erro na conexão com o banco de dados: ' . $this->bd->connect_error);
            }
        } 
    }
?>