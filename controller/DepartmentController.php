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

        public function getAll(){
            $departments = $this->model->getAll(false);
            return $departments;
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
            $department = $this->model->getById($num, true);
            if($department){
                $de = urlencode(json_encode($department->toJason()));
                header("Location:/php-mysql-faculdade/view/Department/showDepartment.php?objeto={$de}");
                exit();
            }
        }

        public function getDepartment($num){
            return $department = $this->model->getById($num, false);
        }

        public function getMaxIdNumber(){
            return ($this->model->getMaxIdNumber() + 1);
        }

        public function addDepartment($department){
            $insert = $this->model->add($department);
            if($insert){
                $this->getById($department->getDNumber());
            }else{
                echo "<br><p>#Falha ao adicionar departamento#</p>";
            }
        }

        public function delete($departments){
            $delete = $this->model->delete($departments);
            if($delete){
                $this->getAndShowAll();
            }else{
                echo "<br><p>#Falha ao deletar departamento#</p>";
            }
        }

        public function update($department){
            $update = $this->model->update($department);
            if($update){
                $this->getById($department->getDNumber());
            }else{
                echo "<br><p>#Falha ao editar departamento#</p>";
            }
        }
    }
?>












