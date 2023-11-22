<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
        require(__DIR__.'/../../controller/EmployeeController.php');
        use controller\EmployeeController;
        $controller = new EmployeeController();
    ?>
    <header>
        <h1>Editar um funcionario</h1>
    </header>
    <main>
        <?php 
            $employee = $controller->getAll();
            echo <<< HTML
            <form id="Form" action="{$_SERVER['PHP_SELF']}" method="post">
                <table border="1">
                <caption><input type="submit" name="submit" value="Editar"></caption>
                    <tr>
                        <th>P_nome</th>
                        <th>M_inicial</th>
                        <th>U_nome</th>
                        <th>cpf</th>
                        <th>Data_nascimento</th>
                        <th>Endereço</th>
                        <th>sexo</th>
                        <th>salario</th>
                        <th>cpf sepervisor</th>
                        <th>Numero de departamento</th>
                        <th colspan="1"></th>
                    </tr>
            HTML;
            foreach($employee as $e){
                if($e->getSupervisor() != null && $e->getDepartment() != null){
                    echo <<<HTML
                    <tr>
                        <td>{$e->getFirstName()}</td>
                        <td>{$e->getMiddleName()}</td>
                        <td>{$e->getLastName()}</td>
                        <td>{$e->getCpf()}</td>
                        <td>{$e->getBirthDate()}</td>
                        <td>{$e->getAddress()}</td>
                        <td>{$e->getSalary()}</td>
                        <td>{$e->getSex()}</td>
                        <td>{$e->getSupervisorCpf()}</td>
                        <td>{$e->getDepartmentNumber()}</td>
                        <td><input type="radio" name="employee" value="{$e->getCpf()}"></td>
                    </tr>
                HTML;
                }else if($e->getSupervisor() != null){
                    echo <<<HTML
                        <tr>
                            <td>{$e->getFirstName()}</td>
                            <td>{$e->getMiddleName()}</td>
                            <td>{$e->getLastName()}</td>
                            <td>{$e->getCpf()}</td>
                            <td>{$e->getBirthDate()}</td>
                            <td>{$e->getAddress()}</td>
                            <td>{$e->getSalary()}</td>
                            <td>{$e->getSex()}</td>
                            <td>{$e->getSupervisorCpf()}</td>
                            <td>NULL</td>
                            <td><input type="radio" name="employee" value="{$e->getCpf()}"></td>
                        </tr>
                    HTML;
                }else if($e->getDepartment() != null){
                    echo <<<HTML
                        <tr>
                            <td>{$e->getFirstName()}</td>
                            <td>{$e->getMiddleName()}</td>
                            <td>{$e->getLastName()}</td>
                            <td>{$e->getCpf()}</td>
                            <td>{$e->getBirthDate()}</td>
                            <td>{$e->getAddress()}</td>
                            <td>{$e->getSalary()}</td>
                            <td>{$e->getSex()}</td>
                            <td>NULL</td>
                            <td>{$e->getDepartmentNumber()}</td>
                            <td><input type="radio" name="employee" value="{$e->getCpf()}"></td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$e->getFirstName()}</td>
                            <td>{$e->getMiddleName()}</td>
                            <td>{$e->getLastName()}</td>
                            <td>{$e->getCpf()}</td>
                            <td>{$e->getBirthDate()}</td>
                            <td>{$e->getAddress()}</td>
                            <td>{$e->getSalary()}</td>
                            <td>{$e->getSex()}</td>
                            <td>NULL</td>
                            <td>NULL</td>
                            <td><input type="radio" name="employee" value="{$e->getCpf()}"></td>
                        </tr>
                    HTML;
                } 
            }
            echo "</form></table>"; 
            if(isset($_POST['submit'])){
                $cpf = $_POST['employee'];
                header("location:/php-mysql-faculdade/view/Employee/editForm.php?cpf={$cpf}");
                exit();
            }
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>
</body>
</html>