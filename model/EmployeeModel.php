<?php 
    namespace model;

    require_once(__DIR__.'/../config/ConexaoMySql.php');
    require_once(__DIR__.'/../data/Employee.php');

    class EmployeeModel extends \ConexaoMySql{
        private $table;

        function __construct(){
            parent::__construct();
            $this->table = 'funcionario';
        }

        public function getAll(){
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
                    array_push($employees, $employee);
                }
                
                $this->bd->close();
                return $employees;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getById($cpf){
            try{
                $sql = " SELECT * FROM $this->table WHERE cpf = ?;";

                $stmt = $this->bd->prepare($sql);
                $stmt->bind_param("s", $cpf);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $e = $result->fetch_assoc();
                $employee = new \Employee($e['cpf']);
                $employee->insertAtributes($e);
                $stmt->close();
                $this->bd->close();
                return $employee;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function add($employee){
            try{
                $sql = "INSERT INTO funcionario (pnome, minicial, unome, cpf, datanasc, endereco, sexo, salario)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt = $this->bd->prepare($sql);

                $pnome = $employee->getFirstName();
                $minicial = $employee->getMiddleName();
                $unome = $employee->getLastName();
                $cpf = $employee->getCpf();
                $data = $employee->getBirthDate();
                $endereco = $employee->getAddress();
                $sexo = $employee->getSex();
                $salario = $employee->getSalary();
                $stmt->bind_param("sssssssd",
                                $pnome,
                                $minicial,
                                $unome,
                                $cpf,
                                $data,
                                $endereco,
                                $sexo,
                                $salario);
                $insert = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $insert;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }
    }
?>