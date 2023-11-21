<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os projetos</title>
</head>
<body>

    <header>
        <h1>Mostrando todos os projetos no banco</h1>
    </header>
    <main>
        <?php 
            $pr = $_GET['objeto'];
            $projects = json_decode(urldecode($pr));
            echo <<< HTML
                <table border="1">
                    <tr>
                        <th>Nome Projeto</th>
                        <th>Numero Projeto</th>
                        <th>Local Projeto</th>
                        <th>Departamento</th>
                    </tr>
            HTML;
            foreach($projects as $pr){
                $project = json_decode($pr);
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
            }
            echo "</table>";  
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>

</body>
</html>