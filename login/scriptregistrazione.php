<?php
    session_start();
    include('../connessione.php');  // Questo richiama la connessione quindi possiamo usare $conn in questa pagina

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $classe=$_POST['classe'];
    $password = hash("sha256",$_POST['pw']);

    # Controllo se l'utente è già registrato
    $checkQuery = "SELECT * FROM utente WHERE username = '$username'";
    $result = $conn->query($checkQuery);
    # Se non è registrato lo inserisco nel database, altrimenti mostro un errore
    if($result->num_rows == 0)
    {
        $query = "INSERT INTO utente (username,password,nome,cognome,email,classe) VALUES ('$username','$password','$nome', '$cognome', '$email','$classe')";
        if ($conn->query($query)) 
        {
            $_SESSION['status'] = "Registrazione effettuata";
            header("Location: ..\index.php");
        } 
        
        else 
        {
            $_SESSION['status'] = "Email gia esistente";
            header("Location: registrazione.php");
        }
    }
    else 
    {
        $_SESSION['status'] = "Utente gia esistente";
        header("Location: registrazione.php");
    }
    
?>
