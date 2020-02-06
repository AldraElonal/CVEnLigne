<?php
/**
 * Created by PhpStorm.
 * User: Aldra
 * Date: 27/01/2020
 * Time: 20:39
 */

session_start();
unset($_SESSION['erreur']);
$email = htmlspecialchars($_POST['email']);
$name = htmlspecialchars($_POST['name']);
$subject = htmlspecialchars($_POST['subject']);
$content = htmlspecialchars($_POST['content']);

if (empty($email) OR filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $_SESSION['erreur']['email'] = true;
}

if (empty($name)) {
    $_SESSION['erreur']['name'] = true;
}

if (empty($subject)) {
    $_SESSION['erreur']['subject'] = true;
}

if (empty($content)) {
    $_SESSION['erreur']['content'] = true;
}
var_dump($email);
if (isset($_SESSION['erreur']) == false) {
    //envoiMail
    $toemail = $email;
    $message = $content;
    $headers[] = "From: " . $email;
    $headers[] = "Content-Type: text/html; charset=\"iso-8859-1\"";
    mail($toemail, $subject, $message, $headers);

// mail à l'expéditeur
    unset($headers);

    $message = "<html> <body>Vous avez envoyé le message suivant : <br/>" .
        "<strong>Destinataire :</strong> rem.leger@laposte.net <br/>" .
        "<strong>Objet :</strong> " . $subject . "<br/>" .
        "<strong>message envoyé :</strong> <br/>" .
        $content . "</body></html>";
    $headers[] = "From: rem.leger@laposte.net";
    $headers[] = "Content-Type: text/html;";
    $toemail = $email;
    var_dump($headers);
    mail($toemail, $subject, $message, implode("\r\n",$headers));

}

header('Location: index.php');

