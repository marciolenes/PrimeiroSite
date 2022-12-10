<?php
$data = date('d-m-Y H:i:s');
$Nome = $_POST["nome"]; // Pega o valor do campo Nome
$Email = $_POST["email"]; // Pega o valor do campo Email
$Assunto = $_POST["assunto"]; // Pega o valor do campo Assunto
$Mensagem = $_POST["mensagem"]; // Pega os valores do campo Mensagem

// Variável que junta os valores acima e monta o corpo do email
$Vai  = "Data: $data\n\nNome: $Nome\n\nE-mail: $Email\n\nAssunto: $Assunto\n\nMensagem: $Mensagem\n";

require_once ("phpmailer/PHPMailerAutoload.php");
$mail = new PHPMailer;

define('GUSER', 'seuze.faleconosco@gmail.com'); // <-- Insira aqui o seu GMail ou outros
define('GPWD', 'qualidade10'); // <-- Insira aqui a senha do seu GMail
function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {
global $error;

$mail = new PHPMailer();
$mail->IsSMTP(); // Ativar SMTP
$mail->SMTPDebug = 0; // Debugar: 1 = erros e mensagens, 2 = mensagens apenas
$mail->SMTPAuth = true; // Autenticação ativada
$mail->SMTPSecure = 'ssl'; // SSL REQUERIDO pelo GMail
$mail->Host = 'smtp.gmail.com'; // SMTP utilizado nesse caso é o do Gmail
$mail->Port = 465; // A porta 587 deverá estar aberta em seu servidor
//port 465 is for ssl and port 587 is for tls.
$mail->Username = GUSER;
$mail->Password = GPWD;
$mail->SetFrom($de, $de_nome);
$mail->Subject = $assunto;
$mail->Body = $corpo;
$mail->AddAddress($para);

if(!$mail->Send()) {
$error = 'Mail error: '.$mail->ErrorInfo;
return false;
} else {
//$error = 'Mensagem enviada!';
echo "<script >alert('Mensagem enviada com sucesso.Em breve retornaremos,obrigado!!!')</script>";
echo "<script>window.location = \"index.html\"</script>";
return true;
}
}
	
// Insira abaixo o email que irá receber a mensagem e o email que irá enviar (o mesmo da variável GUSER), 
//o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

 if (smtpmailer('seuzeusinagem@yahoo.com.br', 'seuze.faleconosco@gmail.com', 'Faleconosco', 'Seuze Faleconosco', $Vai)) {

}
if (!empty($error)) echo $error;
?>