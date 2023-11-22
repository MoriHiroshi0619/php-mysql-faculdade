<?php
    namespace controller;
    session_start();

    require_once(__DIR__.'/../model/EmployeeModel.php');
    use model\EmployeeModel;
    use PDO;

    class EmployeeController{
        private $model;

        function __construct(){
            $this->model = new \model\EmployeeModel();
        }

        public function getAll(){
            $employees = $this->model->getAll(false);
            return $employees;
        }

        public function getAndShowAll(){
            $employees = $this->model->getAll(true);
            $_SESSION['employees'] = $employees;
            /* $jsonArray = array_map(function($employee){
                return $employee->toJason();
            }, $employees);
            $em = urlencode(json_encode($jsonArray)); 
            header("Location:/php-mysql-faculdade/view/Employee/showAll.php?objeto={$em}");*/  
            header("Location:/php-mysql-faculdade/view/Employee/showAll.php");    
            exit();            
        }

        public function getById($cpf){
            $employee = $this->model->getById($cpf, true, false);
            //require_once(__DIR__.'/../view/Employee/showEmployee.php');
            if($employee){
                //var_dump($employee);
                $em = urlencode(json_encode($employee->toJason()));
                header("Location:/php-mysql-faculdade/view/Employee/showEmployee.php?objeto={$em}");
                exit();
            }
        }

        public function getEmployee($cpf){
            return $this->model->getById($cpf, false, false);
        }

        public function addEmployee($employee){
            $insert = $this->model->add($employee);
            if($insert){
                $this->getById($employee->getCpf());
            }else{
                echo "<br><p>#Falha ao adicionar funcionario#</p>";
            }
        }

        public function delete($employees){
            $delete = $this->model->delete($employees);
            if($delete){
                $this->getAndShowAll();
            }else{
                echo "<br><p>#Falha ao deletar funcionario#</p>";
            }
        }

        public function update($employee){
            $update = $this->model->update($employee);
            if($update){
                $this->getById($employee->getCpf());
            }else{
                echo "<br><p>#Falha ao editar Funcionario#</p>";
            }
        }
        
    }
?>



















