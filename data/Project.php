<?php 
    class Project{
        private $pName;
        private $pNumber;
        private $projectLocal;
        private $department;

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

        public function insertAtributes($project){
            if($project['projnome']){
                $this->setPName($project['projnome']);
            }
            if($project['projlocal']){
                $this->setProjectLocal($project['projlocal']);
            }
        }

        public function toJason(){
            return json_encode(array(
                'pName' => $this->getPName(),
                'pNumber' => $this->getPNumber(),
                'projectLocal' => $this->getProjectLocal(),
                'deparment' => $this->getDepartment()
            ));
        }
    
    }
?>



