<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleção</title>
</head>
<body>
    <?php 
        require(__DIR__.'/../../controller/ProjectController.php');
        use controller\ProjectController;
        $controller = new ProjectController();
    ?>
    <header>
        <h1>Deleção de Projetos</h1>
    </header>
    <main>
        <?php 
            $projects = $controller->getAll();
            echo <<< HTML
            <form id="Form" action="{$_SERVER['PHP_SELF']}" method="post">
                <table border="1">
                <caption><input type="submit" name="submit" value="Apagar"></caption>
                    <tr>
                        <th>Nome Projeto</th>
                        <th>Numero Projeto</th>
                        <th>Local Projeto</th>
                        <th>Departamento</th>
                        <th colspan="1"></th>
                    </tr>
            HTML;
            foreach($projects as $project){
                if($project->getDepartment() != null){
                    echo <<<HTML
                        <tr>
                            <td>{$project->getPName()}</td>
                            <td>{$project->getPNumber()}</td>
                            <td>{$project->getProjectLocal()}</td>
                            <td>{$project->getDepartmentNumber()}</td>
                            <td><input type="checkbox" name="project[]" value="{$project->getPNumber()}"></td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$project->getPName()}</td>
                            <td>{$project->getPNumber()}</td>
                            <td>{$project->getProjectLocal()}</td>
                            <td>NULL</td>
                            <td><input type="checkbox" name="project[]" value="{$project->getPNumber()}"></td>
                        </tr>
                    HTML;
                }
            }
            echo "</form></table>"; 
            if(isset($_POST['submit'])){
                $ids = $_POST['project'];
                var_dump($ids);
                if($ids != null){
                    $projects = array();
                    foreach($ids as $id){
                        $project = new Project($id);
                        array_push($projects, $project);
                    }
                    $controller->delete($projects);
                }else{
                    echo "<br><p>#Falha ao deletar funcionario pelo views#</p>";
                }
            }
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>

    <script>
        document.getElementById('Form').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="project[]"]');
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