<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
</head>
<body>
    <header>
        <h1>Adicionando um novo departamento</h1>
    </header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de inserção</h2>
            <label for="dnome">Nome do departamento</label>
            <input type="text" id="dnome" name="dnome" placeholder="Nome do departamento" required>
            <input type="submit" name="submit" value="Inserir">
        </form>
        <button><a href="./action.php">Voltar</a></button>
    </main>
    <?php 
        require(__DIR__.'/../../controller/DepartmentController.php');
        use controller\DepartmentController;
        $controller = new DepartmentController();

        if(isset($_POST['submit'])){
            $department = null;
            $dnome = $_POST['dnome'] ?? null;
            $dnumero = $controller->getMaxIdNumber();
            $department = new Department($dnumero); 
            
            $department->setDName($dnome);

            $controller->addDepartment($department);
        }
    ?>
</body>
</html>















