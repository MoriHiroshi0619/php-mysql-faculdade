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
        require(__DIR__.'/../../controller/EmployeeController.php');
        use controller\DepartmentController;
        use controller\EmployeeControllerl;
        $controller = new DepartmentController();
        $ec = new controller\EmployeeController();
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
                if($department->getManager() != null){
                    echo <<<HTML
                        <tr>
                            <td>{$department->getDName()}</td>
                            <td>{$department->getDNumber()}</td>
                            <td>{$department->getManagerCpf()}</td>
                            <td>{$department->getManagerStartDate()}</td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$department->getDName()}</td>
                            <td>{$department->getDNumber()}</td>
                            <td>NULL</td>
                            <td>NULL</td>
                        </tr>
                    HTML;
                }
            ?>
        </table>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de edição</h2>
            <label for="dnome">Nome do departamento</label>
            <input type="text" id="dnome" name="dnome" placeholder="Nome do departamento">

            <br>
            <label for="manager">Gerente [CPF / PNOME]</label>
            <select name="manager" id="manager">
                <option value="null">Nenhum</option>
            <?php 
                $employees = $ec->getAll();
                foreach($employees as $e){
                    if($e->getDepartment() == null || $e->getDepartmentNumber() == $department->getDNumber()){
                        echo <<<HTML
                            <option value="{$e->getCpf()}">{$e->getCpf()} / {$e->getFirstName()}</option>
                        HTML;  
                    }
                }
            ?>
            </select>
            <label for="managerDate">Data de Inicio do gerente</label>
            <input type="date" id="managerDate" name="managerDate">

            <input type="hidden" name="id" value="<?=$num?>">
            <input type="submit" name="submit" value="Editar">
        </form>   
        <button><a href="./askEdit.php">voltar</a></button>   
        <?php 
            if(isset($_POST['submit'])){
                $dnome = $_POST['dnome'];
                if(!empty($dnome) && $dnome != $department->getDName()){
                    $department->setDName($dnome);
                }
                //var_dump($department);
                $controller->update($department);
            }
        ?>
    </main>
</body>
</html>