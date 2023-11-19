<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleção</title>
</head>
<body>
    <?php 
        require(__DIR__ .'/../../controller/EmployeeController.php');
        use controller\EmployeeController;
        $controller = new \controller\EmployeeController();
    ?>
    <header>
        <h1>Deleção de funcionarios</h1>
    </header>
    <main>
        <?php 
            $employees = $controller->getAll(false);
            echo <<< HTML
            <form action="{$_SERVER['PHP_SELF']}" method="post">
                <table border="1">
                <caption><input type="submit" name="submit" value="Apagar"></caption>
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
            foreach($employees as $e){
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
                        <td></td>
                        <td></td>
                        <td><input type="checkbox" name="employee[]" value="{$e->getCpf()}"></td>
                    </tr>
                HTML;
            }
            echo "</form></table>"; 

            if(isset($_POST['submit'])){
                $employees = array();
                $cpfs = $_POST['employee'];
                foreach($cpfs as $cpf){
                    $employee = new Employee($cpf);
                    array_push($employees, $employee);
                }
                $controller->delete($employees);
            }
        ?>
    </main>
    <button><a href="../../index.php">Voltar</a></button>
</body>
</html>