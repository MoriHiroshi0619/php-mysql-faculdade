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
        <h1>Insira os dados novos do departamento</h1>
    </header>
    <main>
        <table border="1">
            <caption>Departmento que será editado</caption>
            <tr>
                <th>D_nome</th>
                <th>D_numero</th>
                <th>CPF_gerente</th>
                <th>Data Inicio Gerente</th>
            </tr>
            <?php 
                $num = $_REQUEST['id'];
                $department = $controller->getDepartment($num);
                echo <<<HTML
                    <tr>
                        <td>{$department->getDName()}</td>
                        <td>{$department->getDNumber()}</td>
                        <td>{$department->getManager()}</td>
                        <td>{$department->getManagerStartDate()}</td>
                    </tr>
                HTML;
            ?>
        </table>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de edição</h2>
            <label for="dnome">Nome do departamento</label>
            <input type="text" id="dnome" name="dnome" placeholder="Nome do departamento">
            <input type="hidden" name="id" value="<?=$num?>">
            <input type="submit" name="submit" value="Editar">
        </form>   
        <button><a href="./askEdit.php">voltar</a></button>   
        <?php 
            if(isset($_POST['submit'])){
                $dnome = $_POST['dnome'];
                if($dnome != $department->getDName()){
                    $department->setDName($dnome);
                }
                //var_dump($department);
                $controller->update($department);
            }
        ?>
    </main>
</body>
</html>