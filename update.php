<?php

/**
 * Use an HTML form to edit an entry in the
 * users table.
 *
 */

//require "../config.php";
//require "../common.php";
include "db.php";
if (isset($_GET['id'])) {
    try {

        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}