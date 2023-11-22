<?php 
    namespace model;

    use PDO;

    require_once(__DIR__.'/../config/ConexaoMySql.php');
    require_once(__DIR__.'/../data/Department.php');
    require_once(__DIR__.'/./EmployeeModel.php');

    class DepartmentModel extends \ConexaoMySql{
        private $table;

        function __construct(){
            $this->table = 'departamento';
        }

        public function getAll($view){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = " SELECT * FROM $this->table ;";
                $result = $conexao->execute_query($sql);
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $departments = array();
                while($d = $result->fetch_assoc()){
                    $department = new \Department($d['dnumero']);
                    $department->insertAtributes($d);

                    if($d['cpf_gerente'] != null){
                        $em = new EmployeeModel();
                        $manager = $em->getById($d['cpf_gerente'], false, true);
                        $department->setManager($manager);
                        $department->setManagerStartDate($d['data_inicio_gerente']);
                    }

                    array_push($departments, $department);
                }
                if($view){
                    $conexao->close();
                }
                return $departments;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getById($num, $view){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = " SELECT * FROM $this->table WHERE dnumero = ?;";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("s", $num);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $department = null;
                $d = $result->fetch_assoc();
                if($d != null){
                    $department = new \Department($d['dnumero']);
                    $department->insertAtributes($d);
                    //ESSA condicional tá causando problemas de memoria...
                    if($d['cpf_gerente'] != null){
                        $em = new EmployeeModel();
                        $manager = $em->getById($d['cpf_gerente'], false, true);
                        $department->setManager($manager);
                        $department->setManagerStartDate($d['data_inicio_gerente']);
                    }
                }
                if($view){
                    $stmt->close();
                    $conexao->close();
                }
                return $department;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getMaxIdNumber(){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = " SELECT MAX(dnumero) FROM $this->table ;";
                $result = $conexao->execute_query($sql);
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
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = "INSERT INTO $this->table (dnome, dnumero, cpf_gerente, data_inicio_gerente)
                        VALUES(?, ?, ?, ?);";
                $stmt = $conexao->prepare($sql);

                $dName = $department->getDName();
                $dNumber = $department->getDNumber();
                $manager = $department->getManagerCpf();
                $managerDate = $department->getManagerStartDate();
                $stmt->bind_param("siss",
                                $dName,
                                $dNumber,
                                $manager,
                                $managerDate);
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
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql1 = "UPDATE funcionario SET dnr = NULL WHERE dnr = ?";
                $sql2 = "DELETE FROM $this->table WHERE dnumero = ?";
                foreach($departments as $d){ 
                    $stmt1 = $conexao->prepare($sql1);
                    $stmt1->bind_param("i", $d->getDNumber());
                    $delete = $stmt1->execute(); 
                    
                    $stmt2 = $conexao->prepare($sql2);
                    $stmt2->bind_param("i", $d->getDNumber());
                    $delete = $stmt2->execute();
                }
                //$stmt1->close();
                //$conexao->close();
                return $delete;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function update($department){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = "UPDATE $this->table
                        SET dnome = ?, cpf_gerente = ?, data_inicio_gerente = ?
                        WHERE dnumero = ? ;";

                $stmt = $conexao->prepare($sql);

                $dName = $department->getDName();
                $dNumber = $department->getDNumber();
                if($department->getManager() != null || $department->getManager() != false){
                    $manager = $department->getManagerCpf();
                    $managerDate = $department->getManagerStartDate();
                }else{
                    $manager = null;
                    $managerDate = null;
                }
                $stmt->bind_param("sssi",
                                $dName,
                                $manager,
                                $managerDate,
                                $dNumber);
                $update = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $update;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }
    }
?>