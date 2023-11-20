<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição</title>
</head>
<body>
    <?php 
        require(__DIR__.'/../../controller/DepartmentController.php');
        use controller\DepartmentController;
        $controller = new DepartmentController();
    ?>
    <header>
        <h1>Editar um departamento</h1>
    </header>
    <main>
        <?php 
            $department = $controller->getAll();
            echo <<< HTML
            <form id="Form" action="{$_SERVER['PHP_SELF']}" method="post">
                <table border="1">
                <caption><input type="submit" name="submit" value="Editar"></caption>
                    <tr>
                        <th>D_nome</th>
                        <th>D_numero</th>
                        <th>CPF_gerente</th>
                        <th>Data Inicio Gerente</th>
                        <th colspan="1"></th>
                    </tr>
            HTML;
            foreach($department as $d){
                echo <<<HTML
                    <tr>
                        <td>{$d->getDName()}</td>
                        <td>{$d->getDNumber()}</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td><input type="radio" name="department" value="{$d->getDNumber()}"></td>
                    </tr>
                HTML;
            }
            echo "</form></table>"; 
            if(isset($_POST['submit'])){
                $id = $_POST['department'];
                header("location:/php-mysql-faculdade/view/Department/editForm.php?id={$id}");
                exit();
            }
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>
</body>
</html>