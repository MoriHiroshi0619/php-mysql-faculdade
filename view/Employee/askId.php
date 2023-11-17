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
            <input type="text" id="id" name="cpf" required>
            <input type="submit" value="confirmar">
        </form>
    </main>

    <?php 
        require('../../controller/EmployeeController.php');

        $controller = new EmployeeController();

        if(isset($_POST['submit'])){
            $cpf = $_POST['cpf'] ?? null;
            $controller->getById($cpf);
        }
    ?>
</body>
</html>