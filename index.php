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
  				
					<div class="card-body font-weight-bold">
						<form action="processa_envio.php" method="post">
							<div class="form-group">
								<label for="para">Destinatário:</label>
								<input name="destinatario" type="text" class="form-control" id="para" placeholder="fulano@dominio.com.br">
							</div>

							<div class="form-group">
								<label for="assunto">Assunto:</label>
								<input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assundo do e-mail">
							</div>

							<div class="form-group">
								<label for="mensagem">Mensagem:</label>
								<textarea name="mensagem" class="form-control" id="mensagem"></textarea>
							</div>

							<?php
                  			if (isset($_GET['envio']) == 'erro'){?>
			                    <div class="text-danger">
			                      Verifique se todos os campos foram preenchidos.
			                    </div>
                			<?php } ?>
							<button type="submit" class="btn btn-primary btn-lg">Enviar</button>
						</form>
					</div>
				</div>
      		</div>
      	</div>

	</body>
</html>