<?php 
    namespace model;
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
    }
?>