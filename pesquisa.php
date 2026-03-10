<html lang='pt-br'>
	<head>
		<meta charset='UTF-8'>
		<title>Agenda</title>
	</head>
	<body>
		<a href='index.php'>Inicial</a> 
		|
		<a href='pesquisa.php'>Pesquisa</a>
		<br>
		<h2>Pesquisa de Contatos</h2>
		<form method="post" action="pesquisa.php">
			<label>Nome parcial:</label>
			<input type="text" name="nome" />
			<button type="submit">Pesquisar</button>
		</form>
		<h2>Listagem de Contatos</h2>
		<table border>
			<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Ações</th>
			</tr>
		<?php
			$nome = '';
			if (isset($_POST['nome'])){
				$nome = $_POST['nome'];
			}
		
			/* Conectando com o banco de dados para listar registros */
			$datasource = 'mysql:host=localhost;dbname=agenda';
			$user = 'root';
			$pass = 'vertrigo';
			$db = new PDO($datasource, $user, $pass);
	
			$query = "SELECT * FROM contato WHERE nome LIKE '%$nome%'";
			$stm = $db -> prepare($query);
			
			if ($stm -> execute()) {
				$result = $stm->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row) {
					$id = $row['contatoid'];
					$nome = $row['nome'];
					$email = $row['email'];
					$telefone= $row['telefone'];
	
					print "<tr>
					<td>$nome</td>
					<td>$email</td>
					<td>$telefone</td>
					<td><a href='delete.php?id=$id'>Excluir</a> | 	
					<a href='edita.php?id=$id'>Editar</a></td>
					</tr>";					
				}				
			} else {
				print '<p>Erro ao listar alunos!</p>';
			}
		?>
		</table>
	</body>
</html>