<?php 
    namespace model;

use PDO;

    require_once(__DIR__.'/../config/ConexaoMySql.php');
    require_once(__DIR__.'/../data/Department.php');

    class DepartmentModel extends \ConexaoMySql{
        private $table;

        function __construct(){
            parent::__construct();
            $this->table = 'departamento';
        }

        public function getAll($view){
            try{
                $sql = " SELECT * FROM $this->table ;";
                $result = $this->bd->execute_query($sql);
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $departments = array();
                while($d = $result->fetch_assoc()){
                    $department = new \Department($d['dnumero']);
                    $department->insertAtributes($d);
                    array_push($departments, $department);
                }
                if($view){
                    $this->bd->close();
                }
                return $departments;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getById($num){
            try{
                $sql = " SELECT * FROM $this->table WHERE dnumero = ?;";

                $stmt = $this->bd->prepare($sql);
                $stmt->bind_param("s", $num);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $department = false;
                $e = $result->fetch_assoc();
                if($e != null){
                    $department = new \Department($e['dnumero']);
                    $department->insertAtributes($e);
                }
                $stmt->close();
                $this->bd->close();
                return $department;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getMaxIdNumber(){
            try{
                $sql = " SELECT MAX(dnumero) FROM $this->table ;";
                $result = $this->bd->execute_query($sql);
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $d = $result->fetch_assoc();
                $num = $d['MAX(dnumero)'];
                return $num;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function add($department){
            try{
                $sql = "INSERT INTO $this->table (dnome, dnumero)
                        VALUES(?, ?);";
                $stmt = $this->bd->prepare($sql);

                $dName = $department->getDName();
                $dNumber = $department->getDNumber();
                $stmt->bind_param("si",
                                $dName,
                                $dNumber);
                $insert = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $insert;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function delete($departments){
            try{
                
                $sql1 = "UPDATE funcionario SET dnr = NULL WHERE dnr = ?";
                $sql2 = "DELETE FROM $this->table WHERE dnumero = ?";
                foreach($departments as $d){ 
                    $stmt1 = $this->bd->prepare($sql1);
                    $stmt1->bind_param("i", $d->getDNumber());
                    $delete = $stmt1->execute(); 
                    
                    $stmt2 = $this->bd->prepare($sql2);
                    $stmt2->bind_param("i", $d->getDNumber());
                    $delete = $stmt2->execute();
                }
                //$stmt1->close();
                //$this->bd->close();
                return $delete;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }
    }
?>