<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicição</title>
</head>
<body>
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
            <label for="h">Homem</label>
            <input type="radio" id="h" value="H" name="genero" checked >
            <label for="m">Mulher</label>
            <input type="radio" id="m" value="M" name="genero" >
            <br>
            <label for="sala">Salario</label>
            <input type="number" id="sala" name="sala"  required>
            <input type="submit" name="submit" value="Inserir">
        </form>
        <button><a href="../../index.php">Voltar</a></button>
    </main>
    <?php 
        require(__DIR__ .'/../../controller/EmployeeController.php');
        use controller\EmployeeController;
        $controller = new \controller\EmployeeController();
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

            $employee = new Employee($cpf); 

            $employee->setFirstName($pnome);
            $employee->setMiddleName($minicial);
            $employee->setLastName($unome);
            $employee->setBirthDate($data);
            $employee->setAddress($endereco);
            $employee->setSex($sexo);
            $employee->setSalary($salario);

            $controller->addEmployee($employee);
        }
    ?>
</body>
</html>















