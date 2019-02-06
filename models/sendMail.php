<?php

function confirmationMail($login, $mail, $key, $flag)
{
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
		$nl = "\r\n";
	else
		$nl = "\n";

    if ($flag == 2)
    {
        $message = 
        '<html>
            Cher(e) ' . $login . ',<br>
            <br>
            Tu as une images qui viens d\'être commenté vas vite lire ce fameux commentaire.
            <br>
            <br><br>
            <br><br>
            <p>Ce courriel vous est envoyé automatiquement, merci de ne pas utiliser la fonction "répondre à l\'expéditeur".</p>
        </html>';
    }

    if ($flag == 1)
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

    if ($flag == 0)
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

    if ($flag == 0)
        $subject = 'Camagru - Réinitialisation de mot de passe';
    if ($flag == 1)
        $subject = 'Camagru - Confirmation inscription !';
    if ($flag == 2)
        $subject = 'Camagru - Nouveau commentaire !';
    
    $header = "From: \"Camagru\" <no-reply@camagru.fr>" . $nl;
    $header .= 'MIME-Version: 1.0' . $nl;
    $header .= "Content-Type: text/html; charset=\"ISO-8859-1\"";
	    
    if (mail($mail, $subject, $message, $header))
    	return 1;
    return 0;
}
