<?php
session_start();
session_destroy();
header('Location: pagina_pornire.html');
if (isset($_SESSION['usernameAdmin']))
{
    unset($_SESSION['usernameAdmin']);
    echo "Ai fost deconectat cu succes";
    echo "<br \>";

}
else
    echo "<strong>Nu esti conectat!</strong>";
?>
