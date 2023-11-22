<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Consultando um departamento pelo ID</h1>
    </header>
    <main>
        <table border="1">
            <tr>
                <th>D_nome</th>
                <th>D_numero</th>
                <th>CPF_gerente</th>
                <th>Data Inicio Gerente</th>
            </tr>
            <?php 
                $de = $_GET['objeto'];
                $department = json_decode(json_decode(urldecode($de)));
                if(!empty($department->manager)){
                    $manager = json_decode($department->manager);
                    echo <<<HTML
                        <tr>
                            <td>{$department->dName}</td>
                            <td>{$department->dNumber}</td>
                            <td>{$manager->cpf}</td>
                            <td>{$department->managerStartDate}</td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$department->dName}</td>
                            <td>{$department->dNumber}</td>
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