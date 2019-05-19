<?php

	require "./libs/PHPMailer/Exception.php";
	require "./libs/PHPMailer/OAuth.php";
	require "./libs/PHPMailer/PHPMailer.php";
	require "./libs/PHPMailer/POP3.php";
	require "./libs/PHPMailer/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	class Email{
		private $destinatario = null;
		private $assunto = null;
		private $mensagem = null;
		public $status = array('codigo_status' => null, 'descricao_status' => '');

		//magic methods
		public function __get($atributo){
			return $this->$atributo;
		}

		public function __set($atributo, $valor){
			$this->$atributo = $valor;
		}

		public function emailValido(){
			if(empty($this->destinatario) || empty($this->assunto) || empty($this->mensagem)){
				return false;
			}
			return true;
		}
	}

	$email = new Email();

	$email->__set('destinatario', $_POST['destinatario']);
	$email->__set('assunto', $_POST['assunto']);
	$email->__set('mensagem', $_POST['mensagem']);

	if(!$email->emailValido()){
		header('Location: index.php?envio=erro');
	}
	$mail = new PHPMailer(true);
	try {
    	//Configurando
    	$mail->SMTPDebug = false;  
    	$mail->isSMTP(); // 
	    $mail->Host = 'smtp.gmail.com'; //informação do host
	    $mail->SMTPAuth = true; 
	    $mail->Username = 'johndoe@gmail.com'; // email
    	$mail->Password = 'password'; // senha
    	$mail->SMTPSecure = 'tls'; 
	    $mail->Port = 587;

	    //Informações do destinatário/remetente
	    $mail->setFrom('johndoe@gmail.com', 'John Doe');
	    $mail->addAddress($email->__get('destinatario')); 

	    /* Possibilidade de adicionar anexos
	    $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
	    $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name*/

	    // Conteúdo
	    $mail->isHTML(true);
	    $mail->Subject = $email->__get('assunto');
	    $mail->Body = $email->__get('mensagem');

	    $mail->send();

	    $email->status['codigo_status'] = 1;
	    $email->status['descricao_status'] = 'E-mail enviado com sucesso!!';
	} catch (Exception $e) {
		$email->status['codigo_status'] = 2;
	    $email->status['descricao_status'] = "Não foi possível enviar esse e-mail!!";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
    	<title>- Enviando E-mails -</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>- Enviando E-mails -</h2>
				<p class="lead">Comprometido em enviar e-mails para todos os contatos que você quiser!</p>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php
						if($email->status['codigo_status'] ==1){ ?>
							<div class="container">
								<h1 class="display-4 text-success">Sucesso</h1>
								<p> <?=$email->status['descricao_status'] ?></p>
								<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
							</div>
						<?php }
						if($email->status['codigo_status'] == 2){?>
							<div class="container">
								<h1 class="display-4 text-danger">Ops!!</h1>
								<p> <?=$email->status['descricao_status'] ?></p>
								<a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
							</div>
						<?php } ?>
				</div>
			</div>
		</div>
	</body>
</html>