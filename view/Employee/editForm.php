<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição</title>
</head>
<body>
    <?php 
        require(__DIR__.'/../../controller/EmployeeController.php');
        use controller\EmployeeController;
        $controller = new EmployeeController();
    ?>
    <header>
        <h1>Insira os dados novos do funcionario</h1>
    </header>
    <main>
        <table border="1">
            <caption>Funcionario que será editado</caption>
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
            <?php 
                $cpf = $_REQUEST['cpf'];
                $employee = $controller->getEmployee($cpf);
                if($employee->getSupervisor() != null){
                    echo <<<HTML
                        <tr>
                            <td>{$employee->getFirstName()}</td>
                            <td>{$employee->getMiddleName()}</td>
                            <td>{$employee->getLastName()}</td>
                            <td>{$employee->getCpf()}</td>
                            <td>{$employee->getBirthDate()}</td>
                            <td>{$employee->getAddress()}</td>
                            <td>{$employee->getSalary()}</td>
                            <td>{$employee->getSex()}</td>
                            <td>{$employee->getSupervisorCpf()}</td>
                            <td>NULL</td>
                        </tr>
                    HTML;
                }else{
                    echo <<<HTML
                        <tr>
                            <td>{$employee->getFirstName()}</td>
                            <td>{$employee->getMiddleName()}</td>
                            <td>{$employee->getLastName()}</td>
                            <td>{$employee->getCpf()}</td>
                            <td>{$employee->getBirthDate()}</td>
                            <td>{$employee->getAddress()}</td>
                            <td>{$employee->getSalary()}</td>
                            <td>{$employee->getSex()}</td>
                            <td>NULL</td>
                            <td>NULL</td>
                        </tr>
                    HTML;
                }
            ?>
        </table>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <h2>Formulário de edição</h2>
            <label for="pnome">primeiro nome:</label>
            <input type="text" id="pnome" name="pnome" placeholder="Primeiro nome">
            <label for="minicial">Inicial do meio</label>
            <input type="text" id="minicial" name="minicial" placeholder="Inicial do meio" maxlength="1">
            <label for="unome">Ultimo nome</label>
            <input type="text" id="unome" name="unome" placeholder="Ultimo nome">
            <label for="data">Data de Nascimento</label>
            <input type="date" id="data" name="data">
            <label for="endereco">Endereço</label>
            <textarea name="endereco" id="endereco" cols="30" rows="10" placeholder="Digite aqui o Endereço"></textarea>
            <br>
            <label for="h">Homem</label>
            <input type="radio" id="h" value="H" name="genero" checked >
            <label for="m">Mulher</label>
            <input type="radio" id="m" value="M" name="genero" >
            <br>
            <label for="sala">Salario</label>
            <input type="number" id="sala" name="sala">
            <br>
            <label for="supervisor">supervisor </label>
            <select name="sp" id="supervisor">
                <?php 
                    if($employee->getSupervisor() != null){
                        echo <<<HTML
                            <option value="{$employee->getSupervisorCpf()}">{$employee->getSupervisorCpf()}/{$employee->getSupervisorName()}</option>
                        HTML;  
                    }
                ?>
                <option value="null">Nenhum</option>
                <?php 
                    $employees = $controller->getAll();
                    if($employee->getSupervisor() != null){
                        foreach($employees as $e){
                            if($e->getCpf() != $employee->getSupervisorCpf() && $e->getCpf() != $employee->getCpf()){
                                echo <<<HTML
                                    <option value="{$e->getCpf()}">{$e->getCpf()}/{$e->getFirstName()}</option>
                                HTML;  
                            }
                        }
                    }else{
                        foreach($employees as $e){
                            if($e->getCpf() != $employee->getCpf()){
                                echo <<<HTML
                                    <option value="{$e->getCpf()}">{$e->getCpf()}/{$e->getFirstName()}</option>
                                HTML;  
                            }
                        }
                    }
                ?>
            </select>
            
            <input type="hidden" name="cpf" value="<?=$cpf?>">
            <input type="submit" name="submit" value="Editar">
        </form>   
        <button><a href="./askEdit.php">voltar</a></button>   
        <?php 
            if(isset($_POST['submit'])){
                $pnome = $_POST['pnome'];
                $minicial = $_POST['minicial'];
                $unome = $_POST['unome'];
                $data = $_POST['data'];
                $endereco = $_POST['endereco'];
                $sexo = $_POST['genero'];
                $salario = $_POST['sala'];
                $supervisor = $_POST['sp'];
                
                if(!empty($pnome) && $pnome != $employee->getFirstName()){
                    $employee->setFirstName($pnome);
                }
                if(!empty($minicial) && $minicial != $employee->getMiddleName()) {
                    $employee->setMiddleName($minicial);
                }
                if(!empty($unome) && $unome != $employee->getLastName()) {
                    $employee->setLastName($unome);
                }
                if(!empty($data) && $data != $employee->getBirthDate()) {
                    $employee->setBirthDate($data);
                }
                if(!empty($endereco) && $endereco != $employee->getAddress()) {
                    $employee->setAddress($endereco);
                }
                if(!empty($sexo) && $sexo != $employee->getSex()) {
                    $employee->setSex($sexo);
                }
                if(!empty($salario) && $salario != $employee->getSalary()) {
                    $employee->setSalary($salario);
                }

                if($supervisor != null && $supervisor != $employee->getSupervisorCpf()){
                    $supervisor = $controller->getEmployee($supervisor);
                    $employee->setSupervisor($supervisor);
                }

                $controller->update($employee);
            }
        ?>
    </main>
</body>
</html>