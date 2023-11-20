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
        use controller\ProjectController;
        $controller = new ProjectController();
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
                            <td>{$project->getDepartment()}</td>
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
            <input type="hidden" name="id" value="<?=$num?>">
            <input type="submit" name="submit" value="Editar">
        </form>   
        <button><a href="./askEdit.php">voltar</a></button>   
        <?php 
            if(isset($_POST['submit'])){
                $pnome = $_POST['pnome'];
                $plocal = $_POST['plocal'];
                if(!empty($pnome) && $pnome != $project->getPName()){
                    $project->setPName($pnome);
                }
                if(!empty($plocal) && $plocal != $project->getProjectLocal()){
                    $project->setProjectLocal($plocal);
                }
                $controller->update($project);
            }
        ?>
    </main>
</body>
</html>