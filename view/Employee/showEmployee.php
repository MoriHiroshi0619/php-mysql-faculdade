<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
</head>
<body>
    <header>
        <h1>Consultando um funcionario pelo CPF</h1>
    </header>
    <main>
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
            <?php 
                $em = $_GET['objeto'];

                $employee = json_decode(urldecode($em));

                echo <<<HTML
                    <tr>
                        <td>{$employee->getFirstName()}</td>
                        <td>{$employee->getMiddleName()}</td>
                        <td>{$employee->getLastName()}</td>
                        <td>{$employee->getCpf()}</td>
                        <td>{$employee->getBirthDate()}</td>
                        <td>{$employee->getAddress()}</td>
                        <td>{$employee->getSalary()}</td>
                        <td>{$employee->getSex()}</td>
                        <td></td>
                        <td></td>
                    </tr>
                HTML;
            ?>
        </table>
    </main>
</body>
</html>