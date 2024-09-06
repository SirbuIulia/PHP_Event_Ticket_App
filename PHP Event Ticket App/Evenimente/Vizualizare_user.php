<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ro">
<head>
    <title>Vizualizare Evenimente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
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
    </style>
</head>
<body>
<h1>TEDX EVENTS</h1>
<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");


if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY ID")) {
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Denumire</th><th>Data</th><th>Locatie</th><th>Topic</th></tr>";


        while ($row = $result->fetch_object()) {
            echo "<tr>";
            echo "<td><a href='detalii_eveniment.php?ID=".$row->ID."'>".$row->Denumire."</a></td>";
            echo "<td>".date('d-m-Y', strtotime(str_replace('-', '/', $row->Data)))."</td>";
            echo "<td>".$row->Locatie."</td>";
            echo "<td>".$row->Topic."</td>";
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
