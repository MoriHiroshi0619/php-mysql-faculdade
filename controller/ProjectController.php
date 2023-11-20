<?php 
    namespace controller;

    require_once(__DIR__.'/../model/ProjectModel.php');
    use model\ProjectModel;
    use PDO;

    class ProjectController{
        private $model;

        function __construct(){
            $this->model = new \model\ProjectModel();
        }

        public function getAndShowAll(){
            $projects = $this->model->getAll(true);
            $jsonArray = array_map(function($project){
                return $project->toJason();
            }, $projects);
            $pr = urldecode(json_encode($jsonArray));
            header("Location:/php-mysql-faculdade/view/Project/showAll.php?objeto={$pr}");
            exit();
        }

        public function getById($num){
            $project = $this->model->getById($num, true);
            if($project){
                $pr = urlencode(json_encode($project->toJason()));
                header("Location:/php-mysql-faculdade/view/Project/showProject.php?objeto={$pr}");
                exit();
            }
        }

        public function getMaxIdNumber(){
            return ($this->model->getMaxIdNumber() + 1);
        }

        public function addProject($project){
            $insert = $this->model->add($project);
            if($insert){
                $this->getById($project->getPNumber());
            }else{
                echo "<br><p>#Falha ao adicionar projeto#</p>";
            }

        }
    }
?>














