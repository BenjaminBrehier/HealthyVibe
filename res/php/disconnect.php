<?php
//! Permet de se déconnecter en détruisant la session
session_start();
session_destroy();
header("Location: ../../index.php");
exit();
