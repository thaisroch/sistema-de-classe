<?php
    //Deslogando do sistema.
    session_start();
    unset($_SESSION['id']);
    header("location: index.php");
?>
<script>
    localStorage.removeItem(hasVisited);
</script>