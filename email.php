<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    echo 'true';
}else{
    echo 'false';
}