<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os funcionarios</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header>
        <h1>Mostrando todos os Funcionários no banco</h1>
    </header>
    <main>
        <?php 
        require_once(__DIR__.'/../../data/Employee.php');
        require_once(__DIR__.'/../../data/Department.php');
        session_start();
        //$em = $_GET['objeto'];
        //converte o json(todos os objetos) para um array de json para cada objeto 
        //$employees = json_decode(urldecode($em));
        $employees = $_SESSION['employees'];
        echo <<< HTML
            <table border="1">
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
                    </tr>
                HTML;
            }
        }
            echo "</table>";  
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>

</body>
</html>