<?php
$conn = new mysqli("localhost", "root", "", "richiestePazienti_medisoft_pa");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$paziente = $_POST['paziente'];
$richiesta = $_POST['richiesta'];
$tipo = $_POST['tipo'];
$stato = "Aperto";

$sql = "INSERT INTO richieste (paziente, richiesta, tipo, stato)
VALUES ('$paziente', '$richiesta', '$tipo', '$stato')";

if ($conn->query($sql) === TRUE) {
    header("Location: supporto.php");
    exit();
} else {
    echo "Errore: " . $conn->error;
}

$conn->close();
?>