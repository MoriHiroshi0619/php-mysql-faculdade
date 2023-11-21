<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
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
        <h1>Adicionando um novo projeto</h1>
    </header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de inserção</h2>
            <label for="pnome">Nome do projeto</label>
            <input type="text" id="pnome" name="pnome" placeholder="Nome do departamento" required>
            <label for="projlocal">Local do projeto</label>
            <input type="text" id="projlocal" name="plocal" placeholder="Local do projeto" required>
            <br>
            <label for="dnum">Departamento [ID / NOME]</label>
            <select name="dnum" id="dnum">
                <option value="null">Nenhum</option>
                <?php 
                    $departments = $dc->getAll();
                    foreach($departments as $d){
                        echo <<<HTML
                            <option value="{$d->getDNumber()}">{$d->getDNumber()} / {$d->getDName()}</option>
                        HTML;
                    }
                ?>
            </select>
            <input type="submit" name="submit" value="Inserir">
        </form>
        <button><a href="./action.php">Voltar</a></button>
    </main>
    <?php 
        if(isset($_POST['submit'])){
            $project = null;
            $pnome = $_POST['pnome'] ?? null;
            $plocal = $_POST['plocal'] ?? null;
            $dnum = $_POST['dnum'] ?? null;
            $pnumero = $controller->getMaxIdNumber();
            $project = new Project($pnumero); 

            $project->setPName($pnome);
            $project->setProjectLocal($plocal);

            $department = $dc->getDepartment($dnum);
            if(empty($department)){
                $department = null;
            }
            $project->setDepartment($department);
            

            //var_dump($project);
            $controller->addProject($project);
        }
    ?>
</body>
</html>















