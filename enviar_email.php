<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Defina o e-mail do destinatário
    $to = "chicaobatista@hotmail.com"; // Altere para seu e-mail
    $subject = "Nova mensagem de $nome"; // Assunto do e-mail
    $message = "Mensagem de $nome ($email):\n\n$mensagem"; // Corpo da mensagem
    $headers = "From: $email"; // Cabeçalho com o e-mail do remetente

    // Tenta enviar o e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "Mensagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a mensagem.";
    }
}
?>