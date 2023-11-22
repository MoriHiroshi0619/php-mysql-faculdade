<?php 
    namespace model;

    use PDO;

    require_once(__DIR__.'/../config/ConexaoMySql.php');
    require_once(__DIR__.'/../data/Project.php');
    require_once(__DIR__.'/./DepartmentModel.php');

    class ProjectModel extends \ConexaoMySql{
        private $table;

        function __construct(){
            $this->table = 'projeto';
        }

        public function getAll($view){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = " SELECT * FROM $this->table ;";
                $result = $conexao->execute_query($sql);
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $projects = array();
                while($p = $result->fetch_assoc()){
                    $project = new \Project($p['projnumero']);
                    $project->insertAtributes($p);
                    if($p['dnum'] != null){
                        $dm = new DepartmentModel();
                        $department = $dm->getById($p['dnum'], false);
                        $project->setDepartment($department);
                    }

                    array_push($projects, $project);
                }
                if($view){
                    $conexao->close();
                }
                return $projects;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getById($num, $view){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = " SELECT * FROM $this->table WHERE projnumero = ?;";

                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("i", $num);
                $stmt->execute();
                $result = $stmt->get_result();
                if(!$result){
                    throw new \Exception('Erro na consulta'. $this->bd->error);
                }
                $project = null;
                $e = $result->fetch_assoc();
                if($e != null){
                    $project = new \Project($e['projnumero']);
                    $project->insertAtributes($e);
                    if($e['dnum'] != null){
                        $dm = new DepartmentModel();
                        $department = $dm->getById($e['dnum'], false);
                        $project->setDepartment($department);
                    }
                }
                if($view){
                    $stmt->close();
                    $conexao->close();
                }
                return $project;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function getMaxIdNumber(){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
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
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = "INSERT INTO $this->table (projnome, projnumero, projlocal, dnum)
                        VALUES(?, ?, ?, ?);";
                $stmt = $conexao->prepare($sql);

                $pName = $project->getPName();
                $pNum = $project->getPNumber();
                $plocal = $project->getProjectLocal();
                $dnum = $project->getDepartmentNumber();
                $stmt->bind_param("sisi",
                                $pName,
                                $pNum,
                                $plocal,
                                $dnum);
                $insert = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $insert;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function delete($projects){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql1 = "UPDATE trabalha_em SET pnr = NULL WHERE pnr = ?";
                $sql2 = "DELETE FROM $this->table WHERE projnumero = ?";
                foreach($projects as $p){ 
                    $stmt1 = $conexao->prepare($sql1);
                    $stmt1->bind_param("i", $p->getPNumber());
                    $delete = $stmt1->execute(); 
                    
                    $stmt2 = $conexao->prepare($sql2);
                    $stmt2->bind_param("i", $p->getPNumber());
                    $delete = $stmt2->execute();
                }
                //$stmt1->close();
                //$conexao->close();
                return $delete;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }

        public function update($project){
            try{
                $conexao =  \ConexaoMySql::getInstancia()->getConexao();
                $sql = "UPDATE $this->table
                        SET projnome = ?, projlocal = ?, dnum = ?
                        WHERE projnumero = ? ;";
                $stmt = $conexao->prepare($sql);

                $pName = $project->getPName();
                $pLocal = $project->getProjectLocal();
                $pNumber = $project->getPNumber();
                if($project->getDepartment() != null || $project->getDepartment() != false){
                    $dnum = $project->getDepartmentNumber();
                }else{
                    $dnum = null;
                }
                $stmt->bind_param("ssii",
                                $pName,
                                $pLocal,
                                $dnum,
                                $pNumber);
                $update = $stmt->execute();
                //$stmt->close();
                //$this->bd->close();
                return $update;
            }catch (\Exception $e) {
                echo 'Error'. $e->getMessage();
                return null;
            }
        }
    }
?>







