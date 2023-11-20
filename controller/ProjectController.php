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
            
        }

    }
?>