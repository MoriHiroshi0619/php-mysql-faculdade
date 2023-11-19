<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contulta</title>
</head>
<body>
    <header>
        <h1>Consultando um departamento pelo ID</h1>
    </header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="id">Informe o ID do departamento</label>
            <input type="text" id="id" name="num" required>
            <input type="submit" name="submit" value="confirmar">
        </form>
    </main>

    <?php 
        require(__DIR__.'/../../controller/DepartmentController.php');
        use controller\DepartmentController;
        $controller = new DepartmentController();
        
        if(isset($_POST['submit'])){
            $num = $_POST['num'] ?? null;
            $controller->getById($num);
        }
    ?>
</body>
</html>