<?php
    session_start();
    session_destroy();
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0.3;URL=login.php'>";
?>