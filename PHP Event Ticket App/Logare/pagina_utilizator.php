<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ro">
<head>
    <title>Vizualizare Inregistrari Evenimente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout-container {
            position: absolute;
            top: 10px;
            right: 50px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
    </style>
</head>
<body>

<header>
    <h1>Evenimente</h1>
</header>

<nav>
    <a href="../Logare/pagina_pornire.html">Acasa</a>
    <a href="../Evenimente/Vizualizare_guest.php">Evenimente</a>
    <a href="../Sponsori/Vizualizare_guest.php">Sponsori</a>
    <a href="../Speakeri/Vizualizare_guest.php">Speakeri</a>
    <a href="../Parteneri/Vizualizare_guest.php">Parteneri</a>
</nav>

<button class="logout-container" onclick="window.location.href='../Logare/logout.php'">LOGOUT</button>

<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");

if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY ID")) {
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Denumire</th><th>Data</th><th>Locatie</th><th>Topic</th><th></th></tr>";

        while ($row = $result->fetch_object()) {
            echo "<tr>";
            echo"<td><a href='".$row->Link_eveniment."'>".$row->Denumire."</a></td>";
            echo "<td>".date('d-m-Y', strtotime(str_replace('-', '/', $row->Data)))."</td>";
            echo "<td>".$row->Locatie."</td>";
            echo "<td>".$row->Topic."</td>";
            echo "<td><a href='bilete.php?ID=".$row->ID."' style='background-color: #3498db; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none; display: inline-block;'>Cumpara bilet</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nu sunt înregistrări în tabel!";
    }
} else {
    echo "Error: ".$mysqli->error();
}

$mysqli->close();
?>
</body>
</html>
