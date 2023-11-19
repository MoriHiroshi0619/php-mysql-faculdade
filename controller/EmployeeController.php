<?php
    namespace controller;

    require_once(__DIR__.'/../model/EmployeeModel.php');
    use model\EmployeeModel;
use PDO;

    class EmployeeController{
        private $model;

        function __construct(){
            $this->model = new \model\EmployeeModel();
        }

        public function getAll($view){
            $employees = $this->model->getAll($view);
            if($view){
                //require_once(__DIR__. '/../view/Employee/showAll.php');
                $jsonArray = array_map(function($employee){
                    return $employee->toJason();
                }, $employees);
                $em = urlencode(json_encode($jsonArray));
                header("Location: /php-mysql-faculdade/view/Employee/showAll.php?objeto={$em}");                
            }else{
                return $employees;
            }
        }

        public function getById($cpf){
            $employee = $this->model->getById($cpf);
            //require_once(__DIR__.'/../view/Employee/showEmployee.php');
            $em = urlencode(json_encode($employee->toJason()));
            header("Location: /php-mysql-faculdade/view/Employee/showEmployee.php?objeto={$em}");
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
                $this->getAll(true);
            }else{
                echo "<br><p>#Falha ao deletar funcionario#</p>";
            }

        }
        
    }


?>