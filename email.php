<?php
header('Content-type: application/json; charset=ISO-8859-1');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$errors = array();
 if(empty($_POST['ct_captcha'])){
     
        $errors['captcha_error'] = 'O codigo digitado esta incorreto';
     
 }else{
    $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code
    require_once dirname(__FILE__) . '/securimage/securimage.php';
    $securimage = new Securimage();

    if ($securimage->check($captcha) == false) {
        $errors['captcha_error'] = 'O codigo digitado esta incorreto';
    }else{
        $to = 'contato@flordesarom.com.br';

        $subject = "Email de {$_POST['InputName']} do Site Flor de Sarom";

        $headers = "From: " . strip_tags($_POST['InputEmail']) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($_POST['InputEmail']) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


        $message = '<html><body>';
        $message .= "<h1>{$_POST['InputName']}</h1><h2>{$_POST['InputCompanny']}</h2>{$_POST['InputMessage']}";
        $message .= '</body></html>';


        if(mail($to, $subject, $message, $headers)){

        }else{
            $errors['captcha_error'] = 'O e-mail não pode ser enviado';
        }
    }
 }

$errmsg = '';
foreach ($errors as $key => $error) {
    // set up error messages to display with each field
    $errmsg .= " - {$error}<br>";
}

echo "{\"error\":".count($errors).", \"message\":\"{$errmsg}\"}";
exit;