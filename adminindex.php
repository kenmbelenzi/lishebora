<?php
session_start();
if(isset($_SESSION["name"])) {
    $role = $_SESSION["role"];
    if (strcmp($role, 'admin') == 0) {
        include 'adminsidenav.php';
    } else {
        include 'farmersidenav.php';
    }
    }

