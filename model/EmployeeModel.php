<?php 
    namespace model;

use Employee;

    require_once(__DIR__.'/../config/ConexaoMySql.php');
    require_once(__DIR__.'/../data/Employee.php');
    require_once(__DIR__.'/./DepartmentModel.php');

    class EmployeeModel extends \ConexaoMySql{
        private $table;

        function __construct(){
            $this->table = 'funcionario';
        }

        public function getAll($view){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = " SELECT * FROM $this->table ;";
                $result = $conexao->execute_query($sql);
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
                    $conexao->close();
                }
                return $employees;

            }catch (\Exception $e) {
                echo 'Error MDS '. $e->getMessage();
                return null;
            }
        }

        public function getById($cpf, $view){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = " SELECT * FROM $this->table WHERE cpf = ?;";

                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("s", $cpf);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $employee = null;
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
                    $conexao->close();
                }

                return $employee;
            }catch (\Exception $e) {
                echo 'Error MDS'. $e->getMessage();
                return null;
            }
        }

        public function add($employee){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = "INSERT INTO funcionario (pnome, minicial, unome, cpf, datanasc, endereco, sexo, salario, cpf_supervisor, dnr)
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt = $conexao->prepare($sql);

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

                if($employee->getDepartment() != null){
                    $dnr = $employee->getDepartmentNumber();
                }else{
                    $dnr = null;
                }
                $stmt->bind_param("sssssssdsi",
                                $pnome,
                                $minicial,
                                $unome,
                                $cpf,
                                $data,
                                $endereco,
                                $sexo,
                                $salario,
                                $supervisor,
                                $dnr);
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
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql  = "UPDATE $this->table SET cpf_supervisor = NULL WHERE cpf_supervisor = ?;";
                $sql1 =  "UPDATE departamento SET cpf_gerente = NULL WHERE cpf_gerente = ?;";
                $sql2 = "DELETE FROM dependente WHERE fcpf = ?";
                $sql3 = "DELETE FROM trabalha_em WHERE fcpf = ?";
                $sql4 = "DELETE FROM $this->table WHERE cpf = ?";
                foreach($employees as $e){
                    $cpf = $e->getCpf();

                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("s", $cpf);
                    $delete = $stmt->execute();

                    $stmt1 = $conexao->prepare($sql1);
                    $stmt1->bind_param("s", $cpf);
                    $delete = $stmt1->execute();

                    $stmt2 = $conexao->prepare($sql2);
                    $stmt2->bind_param("s", $cpf);
                    $delete = $stmt2->execute();

                    $stmt3 = $conexao->prepare($sql3);
                    $stmt3->bind_param("s", $cpf);
                    $delete = $stmt3->execute();
                    
                    $stmt4 = $conexao->prepare($sql4);
                    $stmt4->bind_param("s", $cpf);
                    $delete = $stmt4->execute();
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
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = "UPDATE $this->table
                        SET pnome = ?, minicial = ?, unome = ?, datanasc = ?, endereco = ?, sexo = ?, salario = ?, cpf_supervisor = ?, dnr = ?
                        WHERE cpf = ? ;";

                $stmt = $conexao->prepare($sql);

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

                if($employee->getDepartment() == false || $employee->getDepartment() == null){
                    $dnr = null;
                }else{
                    $dnr = $employee->getDepartmentNumber();
                }

                $stmt->bind_param("ssssssdsis",
                                $pnome,
                                $minicial,
                                $unome,
                                $datanasc,
                                $endereco,
                                $sexo,
                                $salario,
                                $supervisor,
                                $dnr,
                                $cpf);
                $update = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $update;
            }catch (\Exception $e) {
                echo 'Error '. $e->getMessage();
                return null;
            }
        }
    }
?>