<?php
include 'config.php';

// Register
if (isset($_POST['register'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];

    if ($p1 == $p2) {
        $hash = password_hash($p1, PASSWORD_DEFAULT);

        $insertUser = $conn->prepare("INSERT INTO users(userFirstName, userLastName, userEmail, userPassword) VALUES(?, ?, ?, ?)");
        $insertUser->execute([
            $f_name,
            $l_name,
            $email,
            $hash
        ]);

        header("Location: login.php");
        exit();
    } else {
        header("Location: register.php");
    }
}

// logout
if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['logged_in']);
    unset($_SESSION['u_id']);

    header('Location: home.php');
}

// add data to list
if (isset($_POST['create'])) {
    $userID = $_POST['userID'];
    $dish = $_POST['dish'];

    $insertStatement = $conn->prepare("INSERT INTO list(userID, p_dish) VALUES(?, ?)");
    $insertStatement->execute([$userID, $dish]);

    header("Location: index.php");
    exit();
}

// add data for Recipes
if (isset($_POST['addone'])) {

    $userID = $_POST['userID'];
    $pID = $_POST['pID'];
    $recipe = $_POST['recipe'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];


    // Prepare the INSERT statement
    $insertData = $conn->prepare("INSERT INTO recipes(userID, list_id, p_recipe, p_price, p_quantity) VALUES(?, ?, ?, ?, ?)");
    $insertData->execute([$userID, $pID, $recipe, $price, $quantity]);

    // Redirect to the list page after all items are inserted
    header("Location: index.php");
    exit();
}

// update data
if (isset($_POST['update'])) {
    $pID = $_POST['pID'];
    $userItem = $_POST['recipe'];
    $userPrice = $_POST['price'];
    $quantity = $_POST['quantity'];

    $updateList = $conn->prepare("UPDATE recipes SET p_recipe=?, p_price=?, p_quantity=? WHERE p_id=?");
    $updateList->execute([$userItem, $userPrice, $quantity, $pID]);

    $msg = 'Successfully Updated!';
    header("Location: index.php?msg=$msg");
    exit();
}

// delete data from items
if (isset($_GET['delete'])) {
    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM list WHERE p_id=?");
    $delete->execute([$id]);

    $delete = $conn->prepare("DELETE FROM recipes WHERE list_id=?");
    $delete->execute([$id]);

    header("Location: index.php");
    exit();
}


?>
