<?php 
    class Employee{
        private $firstName;
        private $middleName;
        private $lastName;
        private $cpf;
        private $birthDate;
        private $address;
        private $salary;
        private $sex;
        private $supervisor;

        public function __construct($cpf){
            $this->cpf = $cpf;
        }

        public function getFirstName(){
            return $this->firstName;
        }

        public function setFirstName($fn){
            $this->firstName = $fn;
        }
        
        public function getMiddleName(){
            return $this->middleName;
        }
    
        public function setMiddleName($mn){
            $this->middleName = $mn;
        }
    
        public function getLastName(){
            return $this->lastName;
        }
    
        public function setLastName($ln){
            $this->lastName = $ln;
        }
    
        public function getCpf(){
            return $this->cpf;
        }
    
        public function setCpf($cpf){
            $this->cpf = $cpf;
        }
    
        public function getBirthDate(){
            return $this->birthDate;
        }
    
        public function setBirthDate($bd){
            $this->birthDate = $bd;
        }
        
        public function getAddress() {
            return $this->address;
        }
        
        public function setAddress($ad){
            $this->address = $ad;
        }
        
        public function getSalary() {
            return $this->salary;
        }
        
        public function setSalary($sa){
            $this->salary = $sa;
        }

        public function getSex(){
            return $this->sex;
        }
        
        public function setSex($s){
            $this->sex = $s;
        }

        public function getSupervisor(){
            return $this->supervisor;
        }

        public function setSupervisor($supervisor){
            $this->supervisor = $supervisor;
        }

        public function insertAtributes($employee){
            if($employee['pnome']){
                $this->setFirstName($employee['pnome']);
            }
            if($employee['minicial']){
                $this->setMiddleName($employee['minicial']);
            }
            if($employee['unome']){
                $this->setLastName($employee['unome']);
            }
            if($employee['cpf']){
                $this->setCpf($employee['cpf']);
            }
            if($employee['datanasc']){
                $this->setBirthDate($employee['datanasc']);
            }
            if($employee['endereco']){
                $this->setAddress($employee['endereco']);
            }
            if($employee['sexo']){
                $this->setSex($employee['sexo']);
            }
            if($employee['salario']){
                $this->setSalary($employee['salario']);
            }
        }

        public function toJason(){
            if($this->getSupervisor() != null){
                return json_encode(array(
                    'firstName' => $this->getFirstName(),
                    'middleName' => $this->getMiddleName(),
                    'lastName' => $this->getLastName(),
                    'cpf' => $this->getCpf(),
                    'birthDate' => $this->getBirthDate(),
                    'address' => $this->getAddress(),
                    'salary' => $this->getSalary(),
                    'sex' => $this->getSex(),
                    'supervisor' => $this->supervisor->toJason()
                ));
            }else{
                return json_encode(array(
                    'firstName' => $this->getFirstName(),
                    'middleName' => $this->getMiddleName(),
                    'lastName' => $this->getLastName(),
                    'cpf' => $this->getCpf(),
                    'birthDate' => $this->getBirthDate(),
                    'address' => $this->getAddress(),
                    'salary' => $this->getSalary(),
                    'sex' => $this->getSex()
                ));
            }
        }
    }
?>