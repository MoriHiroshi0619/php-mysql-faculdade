<?php 
    namespace model;

    use PDO;

    require_once(__DIR__.'/../config/ConexaoMySql.php');
    require_once(__DIR__.'/../data/Project.php');

    class ProjectModel extends \ConexaoMySql{
        private $table;

        function __construct(){
            parent::__construct();
            $this->table = 'projeto';
        }

        public function getAll($view){
            try{
                $sql = " SELECT * FROM $this->table ;";
                $result = $this->bd->execute_query($sql);
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $projects = array();
                while($p = $result->fetch_assoc()){
                    $project = new \Project($p['projnumero']);
                    $project->insertAtributes($p);
                    array_push($projects, $project);
                }
                if($view){
                    $this->bd->close();
                }
                return $projects;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getById($num, $view){
            try{
                $sql = " SELECT * FROM $this->table WHERE projnumero = ?;";

                $stmt = $this->bd->prepare($sql);
                $stmt->bind_param("i", $num);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $project = false;
                $e = $result->fetch_assoc();
                if($e != null){
                    $project = new \Project($e['projnumero']);
                    $project->insertAtributes($e);
                }
                if($view){
                    $stmt->close();
                    $this->bd->close();
                }
                return $project;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getMaxIdNumber(){
            try{
                $sql = " SELECT MAX(projnumero) FROM $this->table ;";
                $result = $this->bd->execute_query($sql);
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $d = $result->fetch_assoc();
                $num = $d['MAX(projnumero)'];
                return $num;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function add($project){
            try{
                $sql = "INSERT INTO $this->table (projnome, projnumero, projlocal)
                        VALUES(?, ?, ?);";
                $stmt = $this->bd->prepare($sql);

                $pName = $project->getPName();
                $pNum = $project->getPNumber();
                $plocal = $project->getProjectLocal();
                $stmt->bind_param("sis",
                                $pName,
                                $pNum,
                                $plocal);
                $insert = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $insert;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }
    }
?>







