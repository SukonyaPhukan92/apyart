<?php
session_start();
if(session_destroy())
{
    echo "<script type='text/javascript'>window.location='admin-login.php';</script> ";
}
?>