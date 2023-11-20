<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
</head>
<body>
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
            <input type="submit" name="submit" value="Inserir">
        </form>
        <button><a href="./action.php">Voltar</a></button>
    </main>
    <?php 
        require(__DIR__.'/../../controller/ProjectController.php');
        use controller\ProjectController;
        $controller = new ProjectController();
        if(isset($_POST['submit'])){
            $project = null;
            $pnome = $_POST['pnome'] ?? null;
            $plocal = $_POST['plocal'] ?? null;
            $pnumero = $controller->getMaxIdNumber();
            $project = new Project($pnumero); 

            $project->setPName($pnome);
            $project->setProjectLocal($plocal);

            $controller->addProject($project);
        }
    ?>
</body>
</html>















