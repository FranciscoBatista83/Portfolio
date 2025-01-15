<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);



require 'carregaenv.php';
carregarEnv();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = htmlspecialchars($_POST['nome']);
    $email_form = htmlspecialchars($_POST['email']);
    $mensagem = htmlspecialchars($_POST['mensagem']);

    if (empty($nome) || empty($email_form) || empty($mensagem)) {
        die('Preencha todos os campos.');

    }
}



include('vendor/autoload.php');

//Importa as classes do PHPMailer para o espaço de nomes global
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Carrega o autoloader do Composer
require 'vendor/autoload.php';

$email_que_envia = 'chicaobatista1983@gmail.com';
$email_que_recebe = 'franciscobatista@franciscobatista.com';
$senha_app_email = getenv('EMAIL_PASSWORD');

//Cria uma instância; passando true permite o uso de exceções
$mail = new PHPMailer(true);

try {
    //Configurações do servidor SMTP (Hotmail/Outlook)
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                         //Desabilita a depuração (coloque DEBUG_SERVER para testes)
    $mail->isSMTP();                                            //Define que o envio será por SMTP
    $mail->Host       = getenv('EMAIL_HOST');                   //Servidor SMTP google (gmail)
    $mail->SMTPAuth   = true;                                   //Habilita autenticação SMTP
    $mail->Username   = $email_que_envia;                                   //Seu endereço de e-mail
    $mail->Password   = $senha_app_email;                                        //Sua senha
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Criptografia TLS (mais seguro)
    $mail->Port       = getenv('EMAIL_PORT');
    $mail->CharSet = 'UTF-8';                                    //Porta para TLS (587)

    //Destinatários
    $mail->setFrom($email_que_envia, 'Francisco Batista');  //Seu e-mail como remetente
    $mail->addAddress($email_que_recebe, 'Destinatário');     //E-mail do destinatário
    $mail->addReplyTo($email_form, $nome); //Respostas irão para este e-mail

    //Conteúdo do e-mail
    $mail->isHTML(true);                                        //E-mail no formato HTML
    $mail->Subject = 'Recebido do formulario do site';  
    $mail->Body    = "Nome: $nome<br>Email: $email_form<br>Mensagem: $mensagem";
    $mail->AltBody = 'Nome: ' . $nome . "\nEmail: " . $email_form . "\nMensagem: " . $mensagem;

    //Envia o e-mail
    $mail->send();
    echo "<script>alert('Sua mensagem foi enviada com sucesso!'); window.location.href='index.html';</script>";
exit;
} catch (Exception $e) {
    error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
    echo "<script>alert('Erro ao enviar a mensagem. Tente novamente mais tarde.'); window.location.href='index.html';</script>";
    exit;
}
?>