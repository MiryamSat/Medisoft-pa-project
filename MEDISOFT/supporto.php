<?php
$conn = new mysqli("localhost", "root", "", "richiestePazienti_medisoft_pa");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// QUERY
$sql = "SELECT * FROM richieste 
        WHERE paziente != '' 
        AND richiesta != '' 
        ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Customer Care - Medisoft PA</title>

<style>
body {
    font-family: Arial;
    margin: 0;
    background: #f5f7fa;
}

header {
    background: navy;
    color: white;
    padding: 20px;
}

.container {
    padding: 20px;
}

input, select, button {
    padding: 8px;
    margin-right: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th {
    background: navy;
    color: white;
    padding: 12px;
    text-align: left;
}

td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

/* STATI */
.aperto { color: red; font-weight: bold; }
.in-lavorazione { color: orange; font-weight: bold; }
.chiuso { color: green; font-weight: bold; }
</style>

</head>

<body>

<header>
    <h1>Customer Care - Gestione Richieste</h1>
</header>

<div class="container">

<!-- FORM -->
<form action="salva_richiesta.php" method="POST">
    <input type="text" name="paziente" placeholder="Nome paziente" required>
    <input type="text" name="richiesta" placeholder="Scrivi richiesta" required>

    <select name="tipo">
        <option value="Ricetta">Ricetta</option>
        <option value="Visita">Visita</option>
        <option value="Informazioni">Informazioni</option>
    </select>

    <button type="submit">Salva richiesta</button>
</form>

<br>

<!-- FILTRO -->
<select id="filtroStato" onchange="filtraRichieste()">
    <option value="tutti">Tutti</option>
    <option value="aperto">Aperto</option>
    <option value="in lavorazione">In lavorazione</option>
    <option value="chiuso">Chiuso</option>
</select>

<!-- TABELLA -->
<table id="tabellaSupporto">
    <tr>
        <th>Paziente</th>
        <th>Richiesta</th>
        <th>Tipo</th>
        <th>Stato</th>
    </tr>

<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        $classe = strtolower(str_replace(" ", "-", $row['stato']));

        echo "<tr>
            <td>{$row['paziente']}</td>
            <td>{$row['richiesta']}</td>
            <td>{$row['tipo']}</td>
            <td class='$classe'>{$row['stato']}</td>
        </tr>";
    }
}
?>
</table>

</div>

<script>
function filtraRichieste() {
    let filtro = document.getElementById("filtroStato").value.toLowerCase();

    let righe = document.querySelectorAll("#tabellaSupporto tr");

    righe.forEach((riga, index) => {
        if (index === 0) return;

        let statoCella = riga.cells[3];

        if (!statoCella) return;

        let stato = statoCella.innerText.toLowerCase().trim();

        if (filtro === "tutti") {
            riga.style.display = "";
        } else if (stato === filtro) {
            riga.style.display = "";
        } else {
            riga.style.display = "none";
        }
    });
}
</script>

</body>
</html>