<?php
    require_once('../EsercizioDatabase/config.php');
    require_once('../EsercizioDatabase/manage_db.php');

    $mysqli->query("USE biblioITS");

    if ($_POST['actionType'] == "register") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $birthday = $_POST['birthday'];

        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $surname = filter_var($surname, FILTER_SANITIZE_STRING);
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $birthday = filter_var($birthday, FILTER_SANITIZE_STRING);

        if (!$username || !$password || !$name || !$surname || !$address || !$birthday) {
            $error = 'Fields required!';
        }

        $user = array (
            "user" => "$username",
            "password" => "$password",
            "name" => "$name",
            "surname" => "$surname",
            "address" => "$address",
            "birthday" => "$birthday"
        );

        $query = $mysqli->query("SELECT user FROM userITS WHERE user = '$username'");

        if ($query->num_rows) {
            echo "ERROR, username exist!"; 
        } else {
            insertRecords("userITS", $user, $mysqli);
        }
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        if (!$username || !$password) {
            $error = 'Field required';
        }

        $query = $mysqli->query("SELECT user, password FROM userITS WHERE user = '$username' && password = '$password'");

        if ($query->num_rows) {
            echo "Welcome $username"; 
        } else {
            echo "Access negative!";
        }
    }
?>


