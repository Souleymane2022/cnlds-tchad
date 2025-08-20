<?php
<?php

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$comments = isset($_POST['comments']) ? trim($_POST['comments']) : '';

if ($name && $email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $to_email = "souleymanemahamatsaleh2000@gmail.com";
    $subject = "Nouveau message de contact depuis le site CNLDS";
    $message = nl2br(
        "Bonjour,\n\n".
        "Vous avez reçu un nouveau message depuis le formulaire de contact du site.\n\n".
        "Nom : $name\n".
        "Téléphone : $phone\n".
        "Email : $email\n\n".
        "Message :\n$comments\n\n".
        "IP utilisateur : ".getHostByName(getHostName())."\n".
        "Date : ".date('d-m-Y H:i')."\n"
    );

    $headers  = "From: $name <$email>\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    if (@mail($to_email, $subject, $message, $headers)) {
        $status = 'success';
        $output = "Merci $name, votre message a bien été envoyé ! Nous vous répondrons rapidement.";
    } else {
        $status = 'error';
        $output = "Erreur lors de l'envoi du message. Veuillez réessayer plus tard.";
    }
} else {
    $status = 'error';
    $output = "Veuillez remplir tous les champs obligatoires avec une adresse email valide.";
}

echo json_encode(['status' => $status, 'msg' => $output]);
?>