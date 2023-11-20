<?php 
    class Department{
        private $dName;
        private $dNumber;
        private $manager;
        private $managerStartDate;
        
        public function __construct($number){
            $this->dNumber = $number;
        }

        public function getDName() {
            return $this->dName;
        }
    
        public function setDName($name) {
            $this->dName = $name;
        }
    
        public function getDNumber() {
            return $this->dNumber;
        }
    
        public function setDNumber($number) {
            $this->dNumber = $number;
        }
    
        public function getManager() {
            return $this->manager;
        }
    
        public function setManager($manager) {
            $this->manager = $manager;
        }
    
        public function getManagerStartDate() {
            return $this->managerStartDate;
        }
    
        public function setManagerStartDate($startDate) {
            $this->managerStartDate = $startDate;
        }

        public function insertAtributes($department){
            if($department['dnome']){
                $this->setDName($department['dnome']);
            }
        }

        public function toJason(){
            return json_encode(array(
                'dName' => $this->getDName(),
                'dNumber' => $this->getDNumber(),
                'manager' => $this->getManager(),
                'managerStartDate' => $this->getManagerStartDate(),
            ));
        }

    }
?>