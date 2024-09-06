<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");

if (isset($_GET['ID']) && is_numeric($_GET['ID']))
{
    $ID = $_GET['ID'];

    if ($stmt = $mysqli->prepare("DELETE FROM speakeri WHERE ID = ? LIMIT 1"))
    {
        $stmt->bind_param("i", $ID);
        $stmt->execute();
        $stmt->close();
        echo "<div>Inregistrarea a fost stearsa!</div>";
    }
    else
    {
        echo "ERROR: Nu se poate executa delete.";
    }

    $mysqli->close();
}

echo "<p><a href=\"Vizualizare.php\">Index</a></p>";

?>
