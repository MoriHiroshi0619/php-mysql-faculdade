<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os departamentos</title>
</head>
<body>

    <header>
        <h1>Mostrando todos os departamentos no banco</h1>
    </header>
    <main>
        <?php 
        $de = $_GET['objeto'];
        //converte o json(todos os objetos) para um array de json para cada objeto 
        $departments = json_decode(urldecode($de));
        echo <<< HTML
            <table border="1">
                <tr>
                    <th>D_nome</th>
                    <th>D_numero</th>
                    <th>CPF_gerente</th>
                    <th>Data Inicio Gerente</th>
                </tr>
        HTML;
        foreach($departments as $de){
            $department = json_decode($de);
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
        }
            echo "</table>";  
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>

</body>
</html>