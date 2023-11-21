<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição</title>
</head>
<body>
    <?php 
        require(__DIR__.'/../../controller/ProjectController.php');
        require(__DIR__.'/../../controller/DepartmentController.php');
        use controller\ProjectController;
        use controller\DepartmentControllerl;
        $controller = new ProjectController();
        $dc = new controller\DepartmentController();
    ?>
    <header>
        <h1>Insira os dados novos do projeto</h1>
    </header>
    <main>
        <table border="1">
            <caption>Projeto que será editado</caption>
            <tr>
                <th>Nome Projeto</th>
                <th>Numero Projeto</th>
                <th>Local Projeto</th>
                <th>Departamento</th>
            </tr>
            <?php 
                $num = $_REQUEST['id'];
                $project = $controller->getProject($num);
                if($project->getDepartment() != null){
                    echo <<<HTML
                        <tr>
                            <td>{$project->getPName()}</td>
                            <td>{$project->getPNumber()}</td>
                            <td>{$project->getProjectLocal()}</td>
                            <td>{$project->getDepartmentNumber()}</td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$project->getPName()}</td>
                            <td>{$project->getPNumber()}</td>
                            <td>{$project->getProjectLocal()}</td>
                            <td>NULL</td>
                        </tr>
                    HTML;
                }
            ?>
        </table>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de edição</h2>
            <label for="pnome">Nome do projeto</label>
            <input type="text" id="pnome" name="pnome" placeholder="Nome do departamento">
            <label for="projlocal">Local do projeto</label>
            <input type="text" id="projlocal" name="plocal" placeholder="Local do projeto">
            <br>
            <label for="dnum">Departamento [ID / NOME]</label>
            <select name="dnum" id="dnum">
                <?php 
                    if($project->getDepartment() != null){
                        echo <<<HTML
                            <option value="{$project->getDepartmentNumber()}">{$project->getDepartmentNumber()} / {$project->getDepartmentName()}</option>
                        HTML;
                    }
                ?>
                <option value="null">Nenhum</option>
                <?php 
                    $departments = $dc->getAll();
                    if($project->getDepartment() != null){
                        foreach($departments as $d){
                            if($project->getDepartmentNumber() != $d->getDNumber()){
                                echo <<<HTML
                                    <option value="{$d->getDNumber()}">{$d->getDNumber()} / {$d->getDName()}</option>
                                HTML;
                            }
                        }
                    }else{
                        foreach($departments as $d){
                            echo <<<HTML
                                <option value="{$d->getDNumber()}">{$d->getDNumber()} / {$d->getDName()}</option>
                            HTML;
                        }
                    }
                ?>
            </select>
            <input type="hidden" name="id" value="<?=$num?>">
            <input type="submit" name="submit" value="Editar">
        </form>   
        <button><a href="./askEdit.php">voltar</a></button>   
        <?php 
            if(isset($_POST['submit'])){
                $pnome = $_POST['pnome'];
                $plocal = $_POST['plocal'];
                $dnum = $_POST['dnum'];
                if(!empty($pnome) && $pnome != $project->getPName()){
                    $project->setPName($pnome);
                }
                if(!empty($plocal) && $plocal != $project->getProjectLocal()){
                    $project->setProjectLocal($plocal);
                }

                if($dnum != null && $dnum != $project->getDepartmentNumber()){
                    $department = $dc->getDepartment($dnum);
                    $project->setDepartment($department);
                }

                //echo "<br><br>";
                //var_dump($project);
                $controller->update($project);
            }
        ?>
    </main>
</body>
</html>