<?php
  include 'connection.php';
  session_start();
  if(!$_SESSION['instituicao']){
    header('location:login.php');
    exit();
  }
  else{
        $id=$_GET['id_eve'];
        $conn=conexao();
        $select="select * from evento where cod_evento = {$id}";
        $res = $conn->prepare($select);//preparando query
        $res->execute();//executando
        $result = $res->fetchAll();

  }

?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <!-- Required meta tags -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<meta charset="utf-8">
	<meta name="description" content="Junte-se ao FRESHR. Uma visão de prosperidade para a sua carreira.">
	<meta name="keywords" content="FRESHR, Eventos, Buscar, Profissão, Criar evento">
	<meta name="robots" content="Alterar evento, follow">
	<meta name="author" content="Iago Pereira, Lucas Campanelli, Nicholas Campanelli, Renato Melo, Willian Ferreira">
	<link rel="stylesheet" href="css/eventoinfo.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://kit.fontawesome.com/337796870f.js"></script>
	<link rel="icon" href="images/icon.png">
	<meta name="viewport" content="width=device-width">
	<meta name="theme-color" content="#162573">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?php echo $result[0]['nome_evento'];?> - FRESHR</title>
</head>
<body class='bgindex'>
  <center>
		<input type='checkbox' id='dropcheck'>
		<input type='checkbox' id='chec'>
		<label for='chec' class='backdiv'></label>
		<div class='icons'>
			<a href='index.php'><i class="fas fa-home fa-2x"></i></a><br>
			<i class="fas fa-map-marked fa-2x"></i><br>
			<i class="fas fa-users fa-2x"></i><br>
			<a href='sobre.php'><i class="fas fa-info fa-2x"></i></a><br>
			<i class="fas fa-question fa-2x"></i><br>
			<hr>
		</div>

		<nav>
			<div class='menulist'>
				<a href='index.php'><div class='b1'>Página inicial</div></a>
				<a href='listar_eventos.php'><div class='b2'>Eventos</div></a>
				<a href='listar_inst.php'><div class='b3'>Instituição</div></a>
				<a href='sobre.php'><div class='b4'>Sobre nós</div></a>
				<a href='index.php'><div class='b5'>Ajuda</div></a>
			</div>
		</nav>

		<div class='dropdown'>
			<?php
			if(isset($_SESSION['usuario']))
			{
				echo "<h1 class='imageuser'>".substr($_SESSION['usuario'][0], 0, strlen($_SESSION['usuario'][0]) - (strlen($_SESSION['usuario'][0])-1))."".substr($_SESSION['usuario'][4], 0, strlen($_SESSION['usuario'][4]) - (strlen
				($_SESSION['usuario'][4])-1))."</h1>";
			}

			if(isset($_SESSION['instituicao']))
			{
				echo "<h1 class='imageuser'>".substr($_SESSION['instituicao'][0], 0, strlen($_SESSION['instituicao'][0]) - (strlen($_SESSION['instituicao'][0])-4))."</h1>";
			}
			?>
			<br>

			<?php
			if(isset($_SESSION['instituicao'][0])){
				echo "<a href='painel_inst.php' class='account'>Minha Conta</a>";
			}
			else{
				echo "<a href='painel_usuario.php' class='account'>Minha Conta</a>";
			}
			?>

			<br>
			<a href='config.php' class='account'>Configurações</a>
			<br>
			<a href='painel_usuario.php' class='account'>Ajuda</a>
			<br>
			<br>
			<a href='logout_script.php' class='exit'>Sair</a>
		</div>

		<header class='cabecalhoindex' id='grid'>

			<div class='menudiv'>
				<div class='menubtn'>
					<label for='chec' class='labelchec'><i class="fas fa-bars fa-2x"></i></i></label>
				</div>
				<a href='index.php'><h1 class='logoeheader'>FRESHR</h1></a>
			</div>
			<div class='pesquisarbtn'>

			</div>

			<div class='userdiv'>
				<?php
				if(isset($_SESSION['instituicao'])){
					echo "<label for='dropcheck' class='dropcheck'><div class='userbtn'><i class='fas fa-user-circle fa-2x'></i>
					</div></label>";
				}
				else{
					echo "<div class='userbtn'><a href='login.php'><i class='fas fa-user-circle fa-2x'></i></a>
					</div>";
				}
				?>
			</div>

		</header>
		<div class='elem1'>
			<div class="icontainer">
				<form name='criareventoform' method="POST" action="?validar=true" enctype="multipart/form-data">
					<div class="form-group" id='imageup'>
						<label for="exampleFormControlFile1" class='imagevis'><img class='bannervisu' src="upload/<?php echo $result[0]['banner_evento'];?>"><center><b>Banner</b> do Evento</center></label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name='arquivo'>
					</div>
					<div class="nomeev">
						<label class='labelint'>Dê um <b>nome</b> ao seu evento:</label><br>
						<input class='inputcreate' id='createnome' type='text' name='nome' value=<?php echo $result[0]['nome_evento'];?>><center><hr></center><br>
					</div>

					<div class="info1">
						<div class="infos">

							<label class='labelint'>Nos conte um pouco sobre o seu evento:</label>
							<textarea draggable="false" placeholder="Venha e participe do evento mais esperado do ano!" name='desc' maxlength="149"><?php echo $result[0]['descricao_evento'];?></textarea>

							<label class='labelint'>Quando o evento irá <b>começar</b>?</label>
							<input class='inputcreate' type='date' name='dateinic' value=<?php echo $result[0]['data_inicio'];?>>

							<label class='labelint'>Quando o evento irá <b>acabar</b>?</label>
							<input class='inputcreate' type='date' name='datefinal' value=<?php echo $result[0]['data_termino'];?>

							<label class='labelint'>Informe o horário que o evento <b>inciará</b>:</label>
							<input class='inputcreate' type='time' name='timeinic' value=<?php echo $result[0]['hora_inicio'];?>>

							<label class='labelint'>Informe o horário que o evento <b>encerrará</b>:</label>
							<input class='inputcreate' type='time' name='timefinal' value=<?php echo $result[0]['hora_termino'];?>>

							<label class='labelint'>Qual o <b>preço</b> do evento?</label>
							<input class='inputcreate' type='number' name='preco' value=<?php echo $result[0]['preco_evento'];?>>

						</div>
						<div class="endereco">
							<label class='labelint'>Informe o <b>logradouro</b> do evento:</label>
							<input class='inputcreate' type='text' name='endereco' value=<?php echo $result[0]['endereco_evento'];?>>

							<label class='labelint'>Qual <b>bairro</b> o evento ocorrerá?</label>
							<input class='inputcreate' type='text' name='bairro' value=<?php echo $result[0]['bairro_evento'];?>>

							<label class='labelint'>Qual <b>cidade</b> o evento ocorrerá?</label>
							<input class='inputcreate' type='text' name='cidade' value=<?php echo $result[0]['cidade_evento'];?>>

							<label class='labelint'>Qual <b>estado</b> o evento ocorrerá?</label><br>
							<select name="estado">
								<option value=<?php echo $result[0]['estado_evento'];?> selected><?php echo $result[0]['estado_evento'];?></option>
								<option value="AC">Acre</option>
								<option value="AL">Alagoas</option>
								<option value="AP">Amapá</option>
								<option value="AM">Amazonas</option>
								<option value="BA">Bahia</option>
								<option value="CE">Ceará</option>
								<option value="DF">Distrito Federal</option>
								<option value="ES">Espirito Santo</option>
								<option value="GO">Goiás</option>
								<option value="MA">Maranhão</option>
								<option value="MT">Mato Grosso</option>
								<option value="MS">Mato Grosso do Sul</option>
								<option value="MG">Minas Gerais</option>
								<option value="PA">Pará</option>
								<option value="PB">Paraíba</option>
								<option value="PR">Paraná</option>
								<option value="PE">Pernambuco</option>
								<option value="PI">Piauí</option>
								<option value="RJ">Rio de Janeiro</option>
								<option value="RJ">Rio Grande do Norte</option>
								<option value="RS">Rio grande do sul</option>
								<option value="RO">Rondônia</option>
								<option value="RR">Roraima</option>
								<option value="SC">Santa Catarina</option>
								<option value="SP">São Paulo</option>
								<option value="SE">Sergipe</option>
								<option value="TO">Tocantins</option>
							</select><br>

							<label class='labelint'>Agora, digite o <b>CEP</b>:</label>
							<input class='inputcreate' type='text' name='cep' value=<?php echo $result[0]['cep_evento'];?>>
						</div>
					</div>
					<center>
					<br>
					<br>

					<div class='btnext'><a href='eventinfo.php'><button class='prox'>Pronto!</button></a></div>
					</center>
				</form>
			</div>
		</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</center>
</body>

<?php
if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true){
		$conn=conexao();
    $erro = null;
    $coderro = null;
    $valido = false;

    if(strlen(utf8_decode($_POST["nome"])) < 1 || strlen(utf8_decode($_POST["nome"])) > 255) {
        $erro = " digite um nome válido.";
        $coderro = 1;
    }

    elseif(strlen(utf8_decode($_POST["dateinic"])) <10 || strlen(utf8_decode($_POST["dateinic"])) > 10) {
        $erro = " selecione uma data de inicio do evento.";
        $coderro = 3;
    }

    elseif(strlen(utf8_decode($_POST["datefinal"])) < 10 || strlen(utf8_decode($_POST["datefinal"])) > 10){
        $erro = "selecione uma data de termino do eventto.";
        $coderro = 4;
    }

    elseif(strtotime($_POST['dateinic']) > strtotime($_POST['datefinal'])){
        $erro = "A data de inicio é posterior à data de termino. Selecione de maneira correta";
        $coderro = 5;
    }

    elseif(strlen(utf8_decode($_POST["timeinic"])) <8 || strlen(utf8_decode($_POST["timeinic"])) > 8) {
        $erro = " digite uma hora para o inicio do evento.";
        $coderro = 6;
    }
    elseif(strlen(utf8_decode($_POST["timefinal"])) < 8 || strlen(utf8_decode($_POST["timefinal"])) > 8){
        $erro = " digite uma hora para o final do evento";
        $coderro = 7;
    }

    elseif(strtotime($_POST['timeinic']) > strtotime($_POST['timefinal'])){
        $erro = "A hora de inicio é posterior à hora de termino. Selecione de maneira correta";
        $coderro = 8;
    }


    elseif(strlen(utf8_decode($_POST["endereco"])) < 5 || strlen(utf8_decode($_POST["endereco"])) > 100){
        $erro = " digite um endereço valido(Minimo 5 caracateres)";
        $coderro = 9;
    }
    elseif(strlen(utf8_decode($_POST["bairro"])) < 3 || strlen(utf8_decode($_POST["bairro"])) > 100){
        $erro = "Digite um bairro válido (Minimo 3 caracteres)";
        $coderro = 10;
    }
    elseif(strlen(utf8_decode($_POST["cidade"])) < 1 || strlen(utf8_decode($_POST["cidade"])) > 100){
        $erro = "Digite uma cidade válida (Minimo 1 caractere) ";
        $coderro = 11;
    }
    elseif(strlen(utf8_decode($_POST["estado"])) < 1 || strlen(utf8_decode($_POST["estado"])) > 2){
        $erro = "Selecione o estado onde acontecerá o evento";
        $coderro = 12;
    }
    elseif(strlen(utf8_decode($_POST["cep"])) != 9) {
        $erro = "Digite um cep válido";
        $coderro = 13;
    }
    elseif(strlen(utf8_decode($_POST["desc"])) < 1 || strlen(utf8_decode($_POST["desc"])) > 200){
        $erro = "Digite uma descrição válida (Minimo de 1 caractere)";
        $coderro = 14;
    }

    else{
        $valido = true;
    }

}

    if(isset($valido) && $valido == true){
        $update="update evento set nome_evento =?,data_inicio=?,data_termino=?,hora_inicio=?,hora_termino=?,endereco_evento=?,bairro_evento=?,cidade_evento=?,estado_evento=?,cep_evento=?,descricao_evento=?,preco_evento=? where cod_evento ={$_GET['id_eve']}";
        $stmt = $conn->prepare($update);

			//Atrelando os dados às tabelas
			$stmt->bindValue(1, $_POST["nome"]);
			$stmt->bindValue(2, $_POST["dateinic"]);
			$stmt->bindValue(3, $_POST["datefinal"]);
			$stmt->bindValue(4,$_POST["timeinic"]);
			$stmt->bindValue(5,$_POST["timefinal"]);
			$stmt->bindValue(6,$_POST["endereco"]);
			$stmt->bindValue(7,$_POST["bairro"]);
			$stmt->bindValue(8,$_POST["cidade"]);
			$stmt->bindValue(9,$_POST["estado"]);
			$stmt->bindValue(10,$_POST["cep"]);
            $stmt->bindValue(11,$_POST["desc"]);
            $stmt->bindValue(12,$_POST["preco"]);


			$stmt->execute();

			if($stmt->errorCode() != "00000"){
				$erro = "Erro código " . $stmt->errorCode() . ": ";
				$erro .= implode(", ", $stmt->errorInfo());
				echo $erro;
            } //Exibir erro de comunicação com o banco de dados

            $script = "<script language='javascript'>location.href='painel_inst.php';
            alert('Evento editado com sucesso.');
            </script>';";
            echo $script;
    }
    else{
        if (isset($erro)) {
            if($coderro == 1){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 2){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 3){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 4){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 5){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 6){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 7){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 8){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 9){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 10){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 11){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 12){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 13){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
            if($coderro == 14){
                echo "<div class='erro'>Por gentileza,".$erro."</div><br>";
            }
        }
    }
?>