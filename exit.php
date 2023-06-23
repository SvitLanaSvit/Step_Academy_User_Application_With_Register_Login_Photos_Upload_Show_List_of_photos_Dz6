<?
    setcookie("email", "$email", time() - (60 * 60 * 2), "/", "", 0, 0 );
    header("Location: menu.php");
?>