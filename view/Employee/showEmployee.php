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
                if(!empty($employee->supervisor) && !empty($employee->departament)){
                    $supervisor = json_decode($employee->supervisor);
                    $department = json_decode($employee->departament);
                    echo <<<HTML
                        <tr>
                            <td>{$employee->firstName}</td>
                            <td>{$employee->middleName}</td>
                            <td>{$employee->lastName}</td>
                            <td>{$employee->cpf}</td>
                            <td>{$employee->birthDate}</td>
                            <td>{$employee->address}</td>
                            <td>{$employee->sex}</td>
                            <td>{$employee->salary}</td>
                            <td>{$supervisor->cpf}</td>
                            <td>{$department->dNumber}</td>
                        </tr>
                    HTML;
                }else if(!empty($employee->supervisor)){
                    $supervisor = json_decode($employee->supervisor);
                    echo <<<HTML
                        <tr>
                            <td>{$employee->firstName}</td>
                            <td>{$employee->middleName}</td>
                            <td>{$employee->lastName}</td>
                            <td>{$employee->cpf}</td>
                            <td>{$employee->birthDate}</td>
                            <td>{$employee->address}</td>
                            <td>{$employee->sex}</td>
                            <td>{$employee->salary}</td>
                            <td>{$supervisor->cpf}</td>
                            <td>NULL</td>
                        </tr>
                    HTML;
                }else if(!empty($employee->departament)){
                    $department = json_decode($employee->departament);
                    echo <<<HTML
                        <tr>
                            <td>{$employee->firstName}</td>
                            <td>{$employee->middleName}</td>
                            <td>{$employee->lastName}</td>
                            <td>{$employee->cpf}</td>
                            <td>{$employee->birthDate}</td>
                            <td>{$employee->address}</td>
                            <td>{$employee->sex}</td>
                            <td>{$employee->salary}</td>
                            <td>NULL</td>
                            <td>{$department->dNumber}</td>
                        </tr>
                    HTML;
                }
                else{
                    echo <<<HTML
                        <tr>
                            <td>{$employee->firstName}</td>
                            <td>{$employee->middleName}</td>
                            <td>{$employee->lastName}</td>
                            <td>{$employee->cpf}</td>
                            <td>{$employee->birthDate}</td>
                            <td>{$employee->address}</td>
                            <td>{$employee->sex}</td>
                            <td>{$employee->salary}</td>
                            <td>NULL</td>
                            <td>NULL</td>
                        </tr>
                    HTML;
                }
            ?>
        </table>
        <button><a href="./action.php">Voltar</a></button>
    </main>
</body>
</html>