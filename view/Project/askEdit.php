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
        <h1>Editar um projeto</h1>
    </header>
    <main>
        <?php 
            $department = $controller->getAll();
            echo <<< HTML
            <form id="Form" action="{$_SERVER['PHP_SELF']}" method="post">
                <table border="1">
                <caption><input type="submit" name="submit" value="Editar"></caption>
                    <tr>
                        <th>Nome Projeto</th>
                        <th>Numero Projeto</th>
                        <th>Local Projeto</th>
                        <th>Departamento</th>
                        <th colspan="1"></th>
                    </tr>
            HTML;
            foreach($department as $project){
                if($project->getDepartment() != null){
                    echo <<<HTML
                        <tr>
                            <td>{$project->getPName()}</td>
                            <td>{$project->getPNumber()}</td>
                            <td>{$project->getProjectLocal()}</td>
                            <td>{$project->getDepartment()}</td>
                            <td><input type="radio" name="project" value="{$project->getPNumber()}"></td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$project->getPName()}</td>
                            <td>{$project->getPNumber()}</td>
                            <td>{$project->getProjectLocal()}</td>
                            <td>NULL</td>
                            <td><input type="radio" name="project" value="{$project->getPNumber()}"></td>
                        </tr>
                    HTML;
                }
            }
            echo "</form></table>"; 
            if(isset($_POST['submit'])){
                $id = $_POST['project'];
                header("location:/php-mysql-faculdade/view/Project/editForm.php?id={$id}");
                exit();
            }
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>
</body>
</html>