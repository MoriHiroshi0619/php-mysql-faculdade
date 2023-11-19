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
                $employee = json_decode(json_decode(urldecode($em)));
                echo <<<HTML
                    <tr>
                        <td>{$employee->firstName}</td>
                        <td>{$employee->middleName}</td>
                        <td>{$employee->lastName}</td>
                        <td>{$employee->cpf}</td>
                        <td>{$employee->birthDate}</td>
                        <td>{$employee->address}</td>
                        <td>{$employee->salary}</td>
                        <td>{$employee->sex}</td>
                        <td></td>
                        <td></td>
                    </tr>
                HTML;
            ?>
        </table>
        <a href="../../index.php">Voltar</a>
    </main>
</body>
</html>