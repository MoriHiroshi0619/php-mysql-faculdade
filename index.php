<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionarios</title>
</head>
<body>
    <header>
        <h1>Escolhendo uma Entidade do Banco de dados</h1>
    </header>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="action">Por favor escolha uma opção</label>
        <select name="action" id="action">
            <option value="employee">Funcionarios</option>
            <option value="project">Projetos</option>
            <option value="Department">Departmento</option>
        </select>
        <input type="submit" name="submit" value="Selecionar">
    </form>
</body>
</html>