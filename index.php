<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionarios</title>
</head>
<body>
    <header>
        <h1>Escolhendo uma ação do CRUD</h1>
    </header>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="action">Por favor escolha uma opção</label>
        <select name="action" id="action">
            <option value="getAll">Mostrar todos os funcionarios</option>
            <option value="getById">Consultar por cpf</option>
            <option value="add">Adicionar um novo funcionario</option>
            <option value="delete">Excluir funcionarios</option>
        </select>
        <input type="submit" name="submit" value="Selecionar">
    </form>
</body>
</html>

<?php 
    require('./controller/EmployeeController.php');
    use controller\EmployeeController;
    $controller = new EmployeeController();

    if(isset($_POST['submit'])){
        $action = $_REQUEST['action'] ?? 'getAll';
        if($action == 'getAll'){
            $controller->{$action}();
        }
        if($action == 'getById'){
            header('location: ./view/Employee/askId.php');
        }
        if($action == 'add'){
            header('location: ./view/Employee/addEmployee.php');
        }
    }

?>