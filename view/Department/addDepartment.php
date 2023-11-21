<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
</head>
<body>
    <?php 
        require(__DIR__.'/../../controller/DepartmentController.php');
        require(__DIR__.'/../../controller/EmployeeController.php');
        use controller\DepartmentController;
        use controller\EmployeeControllerl;
        $controller = new DepartmentController();
        $ec = new controller\EmployeeController();
    ?>
    <header>
        <h1>Adicionando um novo departamento</h1>
    </header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de inserção</h2>
            <label for="dnome">Nome do departamento</label>
            <input type="text" id="dnome" name="dnome" placeholder="Nome do departamento" required>
            <br>
            <label for="manager">Gerente [CPF / PNOME]</label>
            <select name="manager" id="manager">
                <option value="null">Nenhum</option>
            <?php 
                $employees = $ec->getAll();
                foreach($employees as $e){
                    if($e->getDepartment() == null){
                        echo <<<HTML
                            <option value="{$e->getCpf()}">{$e->getCpf()} / {$e->getFirstName()}</option>
                        HTML;  
                    }
                }
            ?>
            </select>

            <label for="managerDate">Data de Inicio do gerente</label>
            <input type="date" id="managerDate" name="managerDate">

            <input type="submit" name="submit" value="Inserir">
        </form>
        <button><a href="./action.php">Voltar</a></button>
    </main>
    <?php 
        if(isset($_POST['submit'])){
            $department = null;
            $dnome = $_POST['dnome'] ?? null;
            $manager = $_POST['manager'] ?? null;
            $managerDate = $_POST['managerDate'] ?? null;
            $dnumero = $controller->getMaxIdNumber();
            $department = new Department($dnumero); 
            $department->setDName($dnome);
            
            $manager = $ec->getEmployee($manager);
            if(empty($manager)){
                $manager = null;
                $managerDate = null;
            }else{
                $managerDate = date('Y-m-d');
            }

            $department->setManager($manager);
            $department->setManagerStartDate($managerDate);
            
            //var_dump($department);
            $controller->addDepartment($department);
        }
    ?>
    
</body>
</html>















