<?php

function confirmationMail($login, $mail, $key, $flag)
{
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
		$nl = "\r\n";
	else
		$nl = "\n";

    if ($flag)
    {
        $message =
        '<html>
        	Cher(e) ' . $login . '<br>
        	nous sommes heureux de vous compter parmis nos membres !
        	<br>
        	Merci de cliquez sur le lien suivant afin de valider votre inscription
        	<br>
        	<a href="http://' . $_SERVER['HTTP_HOST'] . '/camagru/views/confirmation.php?login=' . urlencode($login) . '&key=' . $key . '"> confirmer votre compte</a>
        	<br><br>
        	<br><br>
        	<p>Ce courriel vous est envoyé automatiquement, merci de ne pas utiliser la fonction "répondre à l\'expéditeur".</p>
        </html>';
    }  
    else 
    {
        $message = 
        '<html>
            Cher(e) ' . $login . ',<br>
            <br>
            Merci de cliquez sur le lien afin de réinitialiser votre mot de passe
            <br>
            <a href="http://' . $_SERVER['HTTP_HOST'] . '/camagru/views/restore.php?login=' . urlencode($login) . '&key=' . $key . '"> Réinitialiser mon mot de passe !</a>
            <br><br>
            <br><br>
            <p>Ce courriel vous est envoyé automatiquement, merci de ne pas utiliser la fonction "répondre à l\'expéditeur".</p>
        </html>';
    }

    if ($flag)
        $subject = 'Camagru - Confirmation inscription !';
    else
        $subject = 'Camagru - Réinitialisation de mot de passe';
    
    $header = "From: \"Camagru\" <no-reply@camagru.fr>" . $nl;
    $header .= 'MIME-Version: 1.0' . $nl;
    $header .= "Content-Type: text/html; charset=\"ISO-8859-1\"";
	    
    if (mail($mail, $subject, $message, $header))
    	return 1;
    return 0;
}
