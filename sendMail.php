<?php
	header("Content-type: text/html; charset=ISO-8859-1");
	
	require_once('PHPMailer_5.2.1/class.phpmailer.php'); /* classe PHPMailer */
	 
	/* Recebe os dados do cliente ajax via POST */
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	$msg = $_POST['msg'];
	 
	try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled
	 
	/* CORPO DO E-MAIL */
	$body .= "<h2>Mensagem do site Agência OLHAR DIGITAL</h2>";
	$body .= "<strong>Nome:</strong> $nome <br>";
	$body .= "<strong>E-mail:</strong> $email <br>";
	$body .= "<strong>Telefone:</strong> $telefone <br><br>";
	$body .= "<strong>Mensagem:</strong><br>";
	$body .= $msg;
	$body .= "<br><br><br>";
	$body .= "----------------------------";
	$body .= "<br>";
	$body .= "Enviado em <strong>".date("d/m/Y")." as ".date("H:m")." por ".$_SERVER['REMOTE_ADDR']."</strong>"; //mostra a data e o IP
	$body .= "<br>";
	$body .= "----------------------------";
	 
	$mail->IsSMTP(); //tell the class to use SMTP
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->Port = 465; //SMTP porta (as mais utilizadas são '25' e '587'
	$mail->Host = "server.alfa-server.info"; // SMTP servidor
	$mail->Username = "contato@agenciaolhardigital.com";  // SMTP  usuário
	$mail->Password = "agencia5859262";  // SMTP senha
	 
	$mail->IsSendmail(); 
	 
	$mail->AddReplyTo($email, $nome); //Responder para..
	$mail->From = $email; //e-mail fornecido pelo cliente
	$mail->FromName   = $nome; //nome fornecido pelo cliente
	 
	$to = "agenciaolhardigital@gmail.com"; //Enviar para
	$mail->AddAddress($to);
	$mail->Subject  = "Contato Agencia OLHAR DIGITAL"; //Assunto
	$mail->WordWrap   = 80; // set word wrap
	 
	$mail->MsgHTML($body);
	 
	$mail->IsHTML(true); // send as HTML
	 
	$mail->Send();
	echo 'Mensagem enviada com sucesso.'; //retorno devolvido para o ajax caso sucesso
	} catch (phpmailerException $e) {
	echo $e->errorMessage(); //retorno devolvido para o ajax caso erro
	}


?>