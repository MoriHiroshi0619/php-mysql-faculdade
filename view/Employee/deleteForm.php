<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleção</title>
    <link rel="stylesheet" href="../css/style.css">
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
            $employees = $controller->getAll();
            echo <<< HTML
            <form id="Form" action="{$_SERVER['PHP_SELF']}" method="post">
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
                        <td><input type="checkbox" name="employee[]" value="{$e->getCpf()}"></td>
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
                            <td><input type="checkbox" name="employee[]" value="{$e->getCpf()}"></td>
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
                            <td><input type="checkbox" name="employee[]" value="{$e->getCpf()}"></td>
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
                            <td><input type="checkbox" name="employee[]" value="{$e->getCpf()}"></td>
                        </tr>
                    HTML;
                }
            }
            echo "</form></table>"; 
            if(isset($_POST['submit'])){
                $cpfs = $_POST['employee'];
                var_dump($cpfs);
                if($cpfs != null){
                    $employees = array();
                    foreach($cpfs as $cpf){
                        $employee = new Employee($cpf);
                        array_push($employees, $employee);
                    }
                    $controller->delete($employees);
                }else{
                    echo "<br><p>#Falha ao deletar funcionario pelo views#</p>";
                }
            }
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>
    
    <script>
        document.getElementById('Form').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="employee[]"]');
            let peloMenosUmMarcado = false;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    peloMenosUmMarcado = true;
                }
            });

            if (!peloMenosUmMarcado) {
                event.preventDefault();
                alert('Por favor, marque pelo menos uma opção.');
            }
        });
</script>
</body>
</html>