<?php

/**
 * Delete a user
 */

include "db.php";

if (isset($_GET["id"])) {
    try {


        $id = $_GET["id"];

        $sql = "DELETE FROM register_user WHERE id = :id";

        $statement = $db->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $success = "User successfully deleted";
        echo $success;
        header("Location:../adminindex.php");
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
