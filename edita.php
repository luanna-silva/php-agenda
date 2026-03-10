<?php
    # Recebe o id pela URL
    $id = $_GET['id'];

    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=agenda";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Buscar dados do registro
    $sql = "SELECT * from contato WHERE contatoid=?";
    $stm = $con->prepare($sql);
    $stm->bindParam(1, $id);

    # Executa o SQL
    $stm->execute();

    # Pega o resultado
    $result = $stm->fetch();
    $nome = $result['nome'];
    $email = $result['email'];
    $telefone = $result['telefone'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
</head>
<body>
<h3>Editar Contato</h3>
<form method='post' action='atualiza.php'>
    <input type='hidden' name='id' 
        value='<?php print $id ?>'> 
    <label>Nome: </label>
    <input name='nome' 
        value='<?php print $nome ?>'><br>
    <label>Email: </label>
    <input name='email' 
        value='<?php print $email ?>'><br>
    <label>Telefone: </label>
    <input name='telefone' 
        value='<?php print $telefone ?>'><br>
    <button type='submit'>Atualizar</button>
</form>
</body>
</html>