<?php 
    class ConexaoMySql {
        private static $instancia;
        private $host = "127.0.0.1";
        private $dbName = "company";
        private $user = "root";
        private $password = "A senha pode colocar aqui";
        protected $bd;

        public function __construct(){
            $this->bd = new mysqli($this->host, $this->user, $this->password, $this->dbName);
            if ($this->bd->connect_error) {
                die('Erro na conexão com o banco de dados: ' . $this->bd->connect_error);
            }
        } 

        public static function getInstancia() {
            if (!self::$instancia) {
                self::$instancia = new self();
            }
            return self::$instancia;
        }
    
        public function getConexao() {
            return $this->bd;
        }

    }
?>