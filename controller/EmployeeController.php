<?php
    require_once('../model/EmployeeModel.php');
    
    class EmployeeController{
        private $model;

        function __construct(){
            $this->model = new EmployeeModel();
        }

        public function getAll(){
            $employees = $this->model->getAll();
            //print_r($employees);
            require_once('./view/Employee/showAll.php');
        }

        public function getById($cpf){
            $employee = $this->model->getById($cpf);
            require_once('./view/Employee/showEmployee.php');
        }
        
    }


?>