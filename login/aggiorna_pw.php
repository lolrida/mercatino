<?php
    include('../script_php/connessione.php');
    session_start();
    $currentPassword = $_SESSION['pass'];
    $newPassword = $_POST['pw'];

    if (hash("sha256",$newPassword) !== $currentPassword) 
    {
        $query = "UPDATE utente SET password = '".hash("sha256",$newPassword)."' WHERE username = '".$_SESSION['user']."'";
        $conn->query($query);
        $Message = urlencode("Password aggiornata con successo");
        header("Location: ../front-end/cambio_password.php?Message=".$Message);
    } 
    else 
    {
        $Message = urlencode("La nuova password non può essere uguale a quella attuale");
        header("Location: ../front-end/cambio_password.php?Message=".$Message);
    }
?>