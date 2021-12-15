<?php

//Para incluir os diretorios
//require "./Bibliotecas/PHPMailer/Exception.php";
require "./Bibliotecas/PHPMailer/Exception.php";
require "./Bibliotecas/PHPMailer/OAuth.php";
require "./Bibliotecas/PHPMailer/PHPMailer.php";
require "./Bibliotecas/PHPMailer/POP3.php";
require "./Bibliotecas/PHPMailer/SMTP.php";

//Para importar os namespaces basta
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//Um objeto que recebe os dados são criados, e os dados são recebidos atraves de seu name
    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        public $status = array('codigo_status' => null, 'descricao' =>null);

        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
          $this->$atributo = $valor;
        }

        public function mensagemValida(){
            //o empty verifica se os dados estão ou não vazios
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem) ){
                return false;
            }
                return true;
        }
    }


    $mensagem = new Mensagem();

    

    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('mensagem', $_POST['mensagem']);
    $mensagem->__set('assunto', $_POST['assunto']);

    if(!$mensagem->mensagemValida()){
        echo 'Mensagem não é valida';
        //Mata o processamento do script nop ponto em que a instrução é lida
        //ou seja, tudo daqui pra frente não sera lido
        header('location: index.php');
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'cesarreis521@gmail.com';                     //SMTP username
        $mail->Password   = 'cesar08022002';                               //SMTP password
        $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('joana@gmail.com', ' Destinatario');
        $mail->addAddress($mensagem->__get('para'));     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Conteudo do email
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mensagem->__get('assunto');
        $mail->Body    = $mensagem->__get('mensagem');
        $mail->AltBody ='Necessaario ter um email que suporte HTML para visualizar a mensagem !!!';

        $mail->send();

        //Se o Email for enviado com sucesso, o array recebera estas variaveis
        $mensagem->status['codigo_status'] = 1;
        $mensagem->status['descricao'] = 'Email enviado com sucesso';
        
    } catch (Exception $e) {
        //Se o Email não for enviado com sucesso, o array recebera estas variaveis
        $mensagem->status['codigo_status'] = 2;
        $mensagem->status['descricao'] = 'Não foi possivel enviar o email, <br> Natureza do Erro: ' .$mail->ErrorInfo;
        
    }

?>

<html>
	<head>
		<meta charset="utf-8" />
    	<title>App Mail Send</title>

    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>

    <body>
        <div class='container'>
            <div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>
            <div class='row'>
                <div class='col-md-12'>

                <?php if($mensagem->status['codigo_status'] == 1){ ?>

                    <div class='container'>
                        <h1 class='display-4 text-success'>Sucesso</h1>
                        <p> <?=  $mensagem->status['descricao'] ?></p>
                        <a href="index.php" class='btn btn-outline-success btn-lg mt-5 mt-5 text-success'>Voltar</a>
                    </div>

                <?php } ?>

                <?php if($mensagem->status['codigo_status'] == 2){?>

                    <div class='container'>
                        <h1 class='display-4 text-danger'>Falha ao enviar</h1>
                        <p> <?=  $mensagem->status['descricao']?></p>
                        <a href="index.php" class='btn btn-outline-danger btn-lg mt-5 mt-5 text-danger'>Voltar</a>
                    </div>


                <?php } ?>
    
                </div>
            </div>
        </div>
    </body>
</html>