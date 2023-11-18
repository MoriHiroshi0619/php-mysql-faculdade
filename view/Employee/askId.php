<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contulta</title>
</head>
<body>
    <header>
        <h1>Consultando um funcionario pelo CPF</h1>
    </header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <label for="id">Informe o cpf do funcionario</label>
            <input type="text" id="id" name="cpf" maxlength="11" required>
            <input type="submit" name="submit" value="confirmar">
        </form>
    </main>

    <?php 
        require(__DIR__ .'/../../controller/EmployeeController.php');
        use controller\EmployeeController;
        $controller = new \controller\EmployeeController();
        
        if(isset($_POST['submit'])){
            $cpf = $_POST['cpf'] ?? null;
            echo "<br $cpf>";
            $controller->getById($cpf);
        }
    ?>
</body>
</html>