<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Agenda</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <<div class="container">
        <a href='index.php'>Inicial</a> |
        <a href='pesquisa.php'>Pesquisa</a>
        <h3>Cadastro de Contatos</h3>
        <form method='POST' action='insere.php'>
            <label>Nome: </label>
            <input name='nome'><br>
            <label>E-mail: </label>
            <input name='email'><br>
            <label>Telefone: </label>
            <input name='telefone'><br>
            <button type='submit'>Salvar</button>
        </form>
        <h3>Listagem de Contatos</h3>
        <table border>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php
    # Conecta com BD
    $ds = "mysql:host=localhost;dbname=agenda";
    $con = new PDO($ds, 'root', 'vertrigo');

    # Seleciona todos os registros
    $sql = "SELECT * FROM contato";
    $stm = $con->prepare($sql);
    $stm->execute();

    # Percorre os registros
    foreach($stm as $row){
        $id = $row['contatoid'];
        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>
                <a href='deleta.php?id=$id'>Deletar</a>
                |
                <a href='edita.php?id=$id'>Editar</a>
             </td>"; 
        echo "</tr>";
    }
?>
        </table>
        </div>
</body>

</html>