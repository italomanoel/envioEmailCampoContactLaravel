<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request; usar apenas o 'use Request'
use Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
/* Usar apenas se necessitar, checar documentação do PHPMailer
use PHPMailer\PHPMailer\POP3;
use PHPMailer\PHPMailer\OAuth;
*/
// Esse header é utilizado para permitir o uso de acentos, etc sem erro ao enviar o e-mail
header('Content-Type: text/html; charset=UTF-8');

class EnvioEmailController extends Controller
{
    //Caso tentar acesso pela url direto será redirecionado para página inicial.
    public function index()
    {
        return redirect('/');
    }
    //começo do processo de envio:
    public function envioE(Request $request)
    {
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions
        //try {
        $mail->SMTPDebug = false;        // Usar 1 para debug e mensagem, 2 para mensagem somente. false na produção
        $mail->isSMTP();                 // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';	 // Usado o gmail como exemplo, pode ser outro.
        $mail->SMTPAuth = true;          // Enable SMTP authentication
        $mail->Username = 'Colocar email smtp a ser usado';
        $mail->Password = 'senha desse email';
        $mail->SMTPSecure = 'tls';    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;   //587 or 465 or 25(ssl)
        $mail->SetFrom('Email de quem está enviando, aqui o mesmo email smtp usado', 'De');
        $mail->addAddress('email que receberá as mensagens enviadas do formulário de contato', 'Recebendo');	// Add a recipient, Name is optional
        // $mail->addReplyTo('your-email@gmail.com', 'Mailer');
        // $mail->addCC('his-her-email@gmail.com');
        // $mail->addBCC('his-her-email@gmail.com');
        //==============para enviar arquivos Attachments (optional) imagens e arquivos
        // $mail->addAttachment('/var/tmp/file.tar.gz');			// Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name
        $mail->isHTML(true);
        $mail->Subject  = 'Assunto';
        $mail->CharSet  = 'UTF-8';  //para aceitar acentuação nas mensagens.
        $mail->Body    .= '<b>C</b>: '        .Request::input('c')         .'<br>';
        $mail->Body    .= '<b>G</b>: '        .Request::input('g')         .'<br>';
        $mail->Body    .= '<b>email</b>: '    .Request::input('email')     .'<br>';
        $mail->Body    .= '<b>telefone</b>: ' .Request::input('telefone')  .'<br>';
        $mail->Body    .= '<b>celular</b>: '  .Request::input('celular')   .'<br>';
        $mail->Body    .= '<b>mensagem</b>: ' .Request::input('mensagem')  .'<br>';

        if ($mail->Send()) {
          //criado duas páginas para mensagem de sucesso ou erro amigável ao usuário.
            return view('envioEmailSucesso');
        } else {
            return view('envioEmailFalha');
        }
    }
}
