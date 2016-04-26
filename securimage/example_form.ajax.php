<?php
session_start(); // this MUST be called prior to any output including whitespaces and line breaks!

$GLOBALS['ct_recipient'] = 'YOU@EXAMPLE.COM'; // Change to your email address!
$GLOBALS['ct_msg_subject'] = 'Securimage Test Contact Form';

$GLOBALS['DEBUG_MODE'] = 1;
// CHANGE TO 0 TO TURN OFF DEBUG MODE
// IN DEBUG MODE, ONLY THE CAPTCHA CODE IS VALIDATED, AND NO EMAIL IS SENT
// Process the form, if it was submitted
process_si_contact_form();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <title>Securimage Example Form</title>
    </head>
    <body>

        <fieldset>
            <legend>Example Form</legend>

            <p class="note">
                This is an example PHP form that processes user information, checks for errors, and validates the captcha code.<br />
                This example form also demonstrates how to submit a form to itself to display error messages.
            </p>

            <div id="success_message" style="display: none">Your message has been sent!<br />We will contact you as soon as possible.</div>

            <form method="post" action="" id="contact_form" onsubmit="return processForm()">

                <p>
<?php require_once 'securimage.php';
echo Securimage::getCaptchaHtml(array('input_name' => 'ct_captcha')); ?>
                </p>

                <p>
                    <br />
                    <input type="submit" value="Submit Message" />
                </p>

            </form>
        </fieldset>

        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script type="text/javascript">
                $.noConflict();

                function reloadCaptcha()
                {
                    jQuery('#siimage').prop('src', './securimage_show.php?sid=' + Math.random());
                }

                function processForm()
                {
                    jQuery.ajax({
                        url: '<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) ?>',
                        type: 'POST',
                        data: jQuery('#contact_form').serialize(),
                        dataType: 'json',
                    }).done(function (data) {
                        if (data.error === 0) {
                            jQuery('#success_message').show();
                            jQuery('#contact_form')[0].reset();
                            reloadCaptcha();
                            setTimeout("jQuery('#success_message').fadeOut()", 12000);
                        } else {
                            alert("There was an error with your submission.\n\n" + data.message);

                            if (data.message.indexOf('Incorrect security code') >= 0) {
                                jQuery('#captcha_code').val('');
                            }
                        }
                    });

                    return false;
                }
        </script>

    </body>
</html>

<?php

// The form processor PHP code
function process_si_contact_form() {
    if(empty($_POST['ct_captcha'])) return false;
    $captcha = @$_POST['ct_captcha']; // the user's entry for the captcha code
    require_once dirname(__FILE__) . '/securimage.php';
    $securimage = new Securimage();
    $errors = array();

    if ($securimage->check($captcha) == false) {
        $errors['captcha_error'] = 'Incorrect security code entered';
    }

    $errmsg = '';
    foreach ($errors as $key => $error) {
        // set up error messages to display with each field
        $errmsg .= " - {$error}\n";
    }

    $return = array('error' => count($errors), 'message' => $errmsg);
    die(json_encode($return));
}

// function process_si_contact_form()
