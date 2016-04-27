<?php

header('Content-type: application/json; charset=ISO-8859-1');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// sua chave secreta
$secret = "6LfPcR4TAAAAACsO9IbQdo5PsU2DK8MqlRe66USY";

// resposta vazia
$response = null;


$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response=".$_POST["g-recaptcha-response"]."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
//var_dump($response);
$errors = array();
if ($response == null || !$response['success']) {

    $errors['captcha_error'] = 'O codigo digitado esta incorreto';
} else {

    $to = 'contato@flordesarom.com.br';

    $subject = "Email de {$_POST['InputName']} do Site Flor de Sarom";

    $headers = "From: " . strip_tags($_POST['InputEmail']) . "\r\n";
    $headers .= "Reply-To: " . strip_tags($_POST['InputEmail']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


    $message = '<html><body>';
    $message .= "<h1>{$_POST['InputName']}</h1><h2>{$_POST['InputCompanny']}</h2>{$_POST['InputMessage']}";
    $message .= '</body></html>';


    if (mail($to, $subject, $message, $headers)) {
        
    } else {
        $errors['captcha_error'] = 'O e-mail não pode ser enviado';
    }
}

$errmsg = '';
foreach ($errors as $key => $error) {
    // set up error messages to display with each field
    $errmsg .= " - {$error}<br>";
}

echo "{\"error\":" . count($errors) . ", \"message\":\"{$errmsg}\"}";
exit;
