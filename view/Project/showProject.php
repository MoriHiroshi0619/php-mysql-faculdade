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
        <h1>Consultando um projeto pelo ID</h1>
    </header>
    <main>
        <table border="1">
            <tr>
            <tr>
                <th>Nome Projeto</th>
                <th>Numero Projeto</th>
                <th>Local Projeto</th>
                <th>Departamento</th>
            </tr>
            <?php 
                $pr = $_GET['objeto'];
                $project = json_decode(json_decode(urldecode($pr)));
                if(isset($project->deparment)){
                    $department = json_decode($project->deparment);
                    echo <<<HTML
                        <tr>
                            <td>{$project->pName}</td>
                            <td>{$project->pNumber}</td>
                            <td>{$project->projectLocal}</td>
                            <td>{$department->dNumber}</td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$project->pName}</td>
                            <td>{$project->pNumber}</td>
                            <td>{$project->projectLocal}</td>
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