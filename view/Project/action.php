<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projetos</title>
</head>
<body>
    <header>
        <h1>Escolhendo uma ação do CRUD</h1>
    </header>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="action">Por favor escolha uma opção</label>
        <select name="action" id="action">
            <option value="getAll">Mostrar todos os projetos</option>
            <option value="getById">Consultar pelo numero</option>
            <option value="add">Adicionar um novo projeto</option>
            <option value="edit">Editar um projeto</option>
            <option value="delete">Excluir um projeto</option>
        </select>
        <input type="submit" name="submit" value="Selecionar">
    </form>
    <button><a href="../../index.php">Voltar</a></button>
</body>
</html>

<?php 
    require(__DIR__.'/../../controller/ProjectController.php');
    use controller\ProjectController;
    $controller = new ProjectController();

    if(isset($_POST['submit'])){
        $action = $_REQUEST['action'] ?? 'getAll';
        if($action == 'getAll'){
            $controller->getAndShowAll();

        }

        if($action == 'getById'){
            header('location:/php-mysql-faculdade/view/Project/askId.php');
            exit();
        }

        if($action == 'add'){
            //header('location:/php-mysql-faculdade/view/Department/addDepartment.php');
            //exit();
        }

        if($action == 'edit'){
            //header('location:/php-mysql-faculdade/view/Department/askEdit.php');
            //exit();
        }

        if($action == 'delete'){
            //header('location:/php-mysql-faculdade/view/Department/deleteForm.php');
            //exit();
        }
    }

?>