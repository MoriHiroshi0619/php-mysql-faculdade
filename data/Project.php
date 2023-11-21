<?php 
    class Project{
        private $pName;
        private $pNumber;
        private $projectLocal;
        private $department;

        public function __construct($pnum){
            $this->pNumber = $pnum;
        }

        public function getPName() {
            return $this->pName;
        }
    
        public function setPName($pName) {
            $this->pName = $pName;
        }
    
        public function getPNumber() {
            return $this->pNumber;
        }
    
        public function setPNumber($pNumber) {
            $this->pNumber = $pNumber;
        }
    
        public function getProjectLocal() {
            return $this->projectLocal;
        }
    
        public function setProjectLocal($projectLocal) {
            $this->projectLocal = $projectLocal;
        }
    
        public function getDepartment() {
            return $this->department;
        }
    
        public function setDepartment($department) {
            $this->department = $department;
        }

        public function getDepartmentNumber(){
            if($this->getDepartment() != null){
                return $this->department->getDNumber();
            }else{
                return null;
            }
        }

        public function getDepartmentName(){
            if($this->getDepartment() != null){
                return $this->department->getDName();
            }else{
                return null;
            }
        }

        public function insertAtributes($project){
            if($project['projnome']){
                $this->setPName($project['projnome']);
            }
            if($project['projlocal']){
                $this->setProjectLocal($project['projlocal']);
            }
        }

        public function toJason(){
            if($this->getDepartment() != null){
                return json_encode(array(
                    'pName' => $this->getPName(),
                    'pNumber' => $this->getPNumber(),
                    'projectLocal' => $this->getProjectLocal(),
                    'deparment' => $this->department->toJason()
                ));
            }else{
                return json_encode(array(
                    'pName' => $this->getPName(),
                    'pNumber' => $this->getPNumber(),
                    'projectLocal' => $this->getProjectLocal(),
                    'deparment' => $this->getDepartment()
                ));
            }
        }
    
    }
?>



