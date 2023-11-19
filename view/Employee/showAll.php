<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os funcionarios</title>
</head>
<body>

    <header>
        <h1>Mostrando todos os Funcionários no banco</h1>
    </header>
    <main>
        <?php 
        $em = $_GET['objeto'];
        //converte o json(todos os objetos) para um array de json para cada objeto 
        $employees = json_decode(urldecode($em));
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
        foreach($employees as $em){
            $employee = json_decode($em);
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
                    <td></td>
                    <td></td>
                </tr>
            HTML;
            }
            echo "</table>";  
        ?>
    </main>
</body>
</html>