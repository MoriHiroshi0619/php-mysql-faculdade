<?php 
    namespace controller;

    require_once(__DIR__.'/../model/DepartmentModel.php');
    use model\DepartmentModel;
    use PDO;

    class DepartmentController{
        private $model;

        function __construct(){
            $this->model = new \model\DepartmentModel();
        }

        public function getAndShowAll(){
            $departments = $this->model->getAll(true);
            $jsonArray = array_map(function($department){
                return $department->toJason();
            }, $departments);
            $de = urlencode(json_encode($jsonArray));
            header("Location:/php-mysql-faculdade/view/Department/showAll.php?objeto={$de}");
            exit();
        }

        public function getById($num){
            $department = $this->model->getById($num);
            if($department){
                $de = urlencode(json_encode($department->toJason()));
                header("Location:/php-mysql-faculdade/view/Department/showDepartment.php?objeto={$de}");
                exit();
            }
        }
    }
?>