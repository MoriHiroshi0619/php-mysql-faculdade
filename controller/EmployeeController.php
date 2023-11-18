<?php
    namespace controller;

    require_once(__DIR__.'/../model/EmployeeModel.php');
    use model\EmployeeModel;

    class EmployeeController{
        private $model;

        function __construct(){
            $this->model = new \model\EmployeeModel();
        }

        public function getAll(){
            $employees = $this->model->getAll();
            //print_r($employees);
            require_once('./view/Employee/showAll.php');
        }

        public function getById($cpf){
            $employee = $this->model->getById($cpf);
            //require_once(__DIR__.'/../view/Employee/showEmployee.php');
            $em = urlencode(json_encode($employee));
            var_dump($employee);
            var_dump($em);
            //header("Location: showEmployee.php?objeto={$em}");
        }
        
    }


?>