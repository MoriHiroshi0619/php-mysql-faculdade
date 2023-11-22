<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
        require(__DIR__ .'/../../controller/EmployeeController.php');
        require(__DIR__ .'/../../controller/DepartmentController.php');
        use controller\EmployeeController;
        use controller\DepartmentController;
        $controller = new \controller\EmployeeController();
        $dc = new \controller\DepartmentController();
    ?>

    <header>
        <h1>Adicionando um novo funcionario</h1>
    </header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de inserção</h2>
            <label for="pnome">primeiro nome:</label>
            <input type="text" id="pnome" name="pnome" placeholder="Primeiro nome" required>
            <label for="minicial">Inicial do meio</label>
            <input type="text" id="minicial" name="minicial" placeholder="Inicial do meio" maxlength="1" required>
            <label for="unome">Ultimo nome</label>
            <input type="text" id="unome" name="unome" placeholder="Ultimo nome" required>
            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" placeholder="12345678910" maxlength="11" required>
            <label for="data">Data de Nascimento</label>
            <input type="date" id="data" name="data" required>
            <label for="endereco">Endereço</label>
            <textarea name="endereco" id="endereco" cols="30" rows="10" placeholder="Digite aqui o Endereço"></textarea>
            <br>
            <input type="radio" id="h" value="H" name="genero" checked >
            <label for="h">Homem</label>
            <input type="radio" id="m" value="F" name="genero" >
            <label for="m">Mulher</label>
            <br>
            <label for="sala">Salario</label>
            <input type="number" id="sala" name="sala"  required>
            <br>
            <label for="supervisor">se tiver supervisor, escolha pelo cpf/Nome</label>
            <select name="sp" id="supervisor">
                <option value="null">Nenhum</option>
                <?php 
                    $employees = $controller->getAll();
                    foreach($employees as $e){
                        echo <<<HTML
                            <option value="{$e->getCpf()}">{$e->getCpf()}/{$e->getFirstName()}</option>
                        HTML;  
                    }
                ?>
            </select>
            <br>
            <label for="deparment">se tiver um departamento, escolha pelo ID/Nome</label>
            <select name="dnr" id="department">
                <option value="null">Nenhum</option>
                <?php 
                    $departments = $dc->getAll();
                    foreach($departments as $d){
                        echo <<<HTML
                            <option value="{$d->getDNumber()}">{$d->getDNumber()}/{$d->getDName()}</option>
                        HTML;
                    }
                ?>
            </select>
            <br>
            <input type="submit" name="submit" value="Inserir">
        </form>
        <button><a href="./action.php">Voltar</a></button>
    </main>
    <?php 
        if(isset($_POST['submit'])){
            $employee = null;
            $pnome = $_POST['pnome'] ?? null;
            $minicial = $_POST['minicial'] ?? null;
            $unome = $_POST['unome'] ?? null;
            $cpf = $_POST['cpf'] ?? null;
            $data = $_POST['data'] ?? null;
            $endereco = $_POST['endereco'] ?? null;
            $sexo = $_POST['genero'] ?? null;
            $salario = $_POST['sala'] ?? null;
            $supervisor = $_POST['sp'] ?? null;
            $dnr = $_POST['dnr'] ?? null;

            $employee = new Employee($cpf); 

            $employee->setFirstName($pnome);
            $employee->setMiddleName($minicial);
            $employee->setLastName($unome);
            $employee->setBirthDate($data);
            $employee->setAddress($endereco);
            $employee->setSex($sexo);
            $employee->setSalary($salario);

            $supervisor = $controller->getEmployee($supervisor);
            $employee->setSupervisor($supervisor);

            $department = $dc->getDepartment($dnr);
            $employee->setDepartment($department);

            $controller->addEmployee($employee);
        }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            const cpfField = document.getElementById('cpf');
            const cpfValue = cpfField.value.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (cpfValue.length !== 11 || isNaN(cpfValue)) {
                alert('O CPF deve conter exatamente 11 dígitos numéricos!');
                event.preventDefault(); // Impede o envio do formulário se a validação falhar
            }
        });
    });
    </script>
</body>
</html>















