<?php 
    namespace model;

    require_once(__DIR__.'/../config/ConexaoMySql.php');
    require_once(__DIR__.'/../data/Employee.php');
    require_once(__DIR__.'/./DepartmentModel.php');

    class EmployeeModel extends \ConexaoMySql{
        private $table;

        function __construct(){
            parent::__construct();
            $this->table = 'funcionario';
        }

        public function getAll($view){
            try{
                $sql = " SELECT * FROM $this->table ;";
                $result = $this->bd->execute_query($sql);
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $employees = array();
                while($e = $result->fetch_assoc()){
                    $employee = new \Employee($e['cpf']);
                    $employee->insertAtributes($e);
                    if($e['cpf_supervisor'] != null){
                        $supervisor = $this->getById($e['cpf_supervisor'], false);
                        $employee->setSupervisor($supervisor);
                    } 
                    if($e['dnr'] != null){
                        $dm = new DepartmentModel();
                        $dnr = $dm->getById($e['dnr'], false);
                        $employee->setDepartment($dnr);
                    }

                    array_push($employees, $employee);
                }
                if($view){
                    $this->bd->close();
                }
                return $employees;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getById($cpf, $view){
            try{
                $sql = " SELECT * FROM $this->table WHERE cpf = ?;";

                $stmt = $this->bd->prepare($sql);
                $stmt->bind_param("s", $cpf);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $employee = false;
                $e = $result->fetch_assoc();
                //var_dump($e);
                if($e != null){
                    $employee = new \Employee($e['cpf']);
                    $employee->insertAtributes($e);
                    if($e['cpf_supervisor'] != null){
                        $supervisor = $this->getById($e['cpf_supervisor'], false);
                        $employee->setSupervisor($supervisor);
                    } 
                    if($e['dnr'] != null){
                        $dm = new DepartmentModel();
                        $dnr = $dm->getById($e['dnr'], false);
                        $employee->setDepartment($dnr);
                    }
                }
                if($view){
                    $stmt->close();
                    $this->bd->close();
                }
                return $employee;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function add($employee){
            try{
                $sql = "INSERT INTO funcionario (pnome, minicial, unome, cpf, datanasc, endereco, sexo, salario, cpf_supervisor)
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt = $this->bd->prepare($sql);

                $pnome = $employee->getFirstName();
                $minicial = $employee->getMiddleName();
                $unome = $employee->getLastName();
                $cpf = $employee->getCpf();
                $data = $employee->getBirthDate();
                $endereco = $employee->getAddress();
                $sexo = $employee->getSex();
                $salario = $employee->getSalary();

                if($employee->getSupervisor() != null){
                    $supervisor = $employee->getSupervisorCpf();
                }else{
                    $supervisor = null;
                }
                $stmt->bind_param("sssssssds",
                                $pnome,
                                $minicial,
                                $unome,
                                $cpf,
                                $data,
                                $endereco,
                                $sexo,
                                $salario,
                                $supervisor);
                $insert = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $insert;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function delete($employees){
            try{
                $sql0 = "DELETE FROM dependente WHERE fcpf = ?";
                $sql1 = "DELETE FROM trabalha_em WHERE fcpf = ?";
                $sql2 = "DELETE FROM funcionario WHERE cpf = ?";
                foreach($employees as $e){
                    $stmt0 = $this->bd->prepare($sql0);
                    $cpf = $e->getCpf();
                    $stmt0->bind_param("s", $cpf);
                    $delete = $stmt0->execute();

                    $stmt1 = $this->bd->prepare($sql1);
                    $stmt1->bind_param("s", $cpf);
                    $delete = $stmt1->execute();
                    
                    $stmt2 = $this->bd->prepare($sql2);
                    $stmt2->bind_param("s", $cpf);
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

        public function update($employee){
            try{
                $sql = "UPDATE $this->table
                        SET pnome = ?, minicial = ?, unome = ?, datanasc = ?, endereco = ?, sexo = ?, salario = ?, cpf_supervisor = ?
                        WHERE cpf = ? ;";

                $stmt = $this->bd->prepare($sql);

                $pnome = $employee->getFirstName();
                $minicial = $employee->getMiddleName();
                $unome = $employee->getLastName();
                $datanasc = $employee->getBirthDate();
                $endereco = $employee->getAddress();
                $sexo = $employee->getSex();
                $salario = $employee->getSalary();
                $cpf = $employee->getCpf();
                if($employee->getSupervisor() == false || $employee->getSupervisor() == null){
                    $supervisor = null;
                }else{
                    $supervisor = $employee->getSupervisorCpf();
                }
                $stmt->bind_param("ssssssdss",
                                $pnome,
                                $minicial,
                                $unome,
                                $datanasc,
                                $endereco,
                                $sexo,
                                $salario,
                                $supervisor,
                                $cpf);
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