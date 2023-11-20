<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleção</title>
</head>
<body>
    <?php 
        require(__DIR__.'/../../controller/DepartmentController.php');
        use controller\DepartmentController;
        $controller = new DepartmentController();
    ?>
    <header>
        <h1>Deleção de funcionarios</h1>
    </header>
    <main>
        <?php 
            $department = $controller->getAll();
            echo <<< HTML
            <form id="Form" action="{$_SERVER['PHP_SELF']}" method="post">
                <table border="1">
                <caption><input type="submit" name="submit" value="Apagar"></caption>
                    <tr>
                        <th>D_nome</th>
                        <th>D_numero</th>
                        <th>CPF_gerente</th>
                        <th>Data Inicio Gerente</th>
                        <th colspan="1"></th>
                    </tr>
            HTML;
            foreach($department as $d){
                echo <<<HTML
                    <tr>
                        <td>{$d->getDName()}</td>
                        <td>{$d->getDNumber()}</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td><input type="checkbox" name="department[]" value="{$d->getDNumber()}"></td>
                    </tr>
                HTML;
            }
            echo "</form></table>"; 
            if(isset($_POST['submit'])){
                $ids = $_POST['department'];
                var_dump($ids);
                if($ids != null){
                    $departments = array();
                    foreach($ids as $id){
                        $department = new Department($id);
                        array_push($departments, $department);
                    }
                    $controller->delete($departments);
                }else{
                    echo "<br><p>#Falha ao deletar funcionario pelo views#</p>";
                }
            }
        ?>
        <button><a href="./action.php">Voltar</a></button>
    </main>

    <script>
        document.getElementById('Form').addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="department[]"]');
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