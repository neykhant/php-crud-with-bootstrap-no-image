<?php

session_start();

$name = '';
$age = '';
$phone = '';
$location = '';
$update = false;


$mysqli = new mysqli('localhost', 'root', '', 'datatable')

    or die(mysqli_error($mysqli));

// echo "connected to database";

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO crud (name, age, phone, location) 
    VALUES ('$name', '$age', '$phone', '$location' ) ") or die($mysqli->error);

    $_SESSION['msg'] = 'Your Record has been Saved';
    $_SESSION['msg-type'] = 'success';

    header("Location:index.php");
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM crud WHERE id=$id ") or die($mysqli->error);

    $_SESSION['msg'] = 'Your Record has been Deleted';
    $_SESSION['msg-type'] = 'danger';

    header("Location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    // echo $id;
    $update = true;

    $result = $mysqli->query("SELECT * FROM crud WHERE id=$id ") or die(mysqli_error($mysqli));
    if ($result) {

        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        $age = $row['age'];
        $phone = $row['phone'];
        $location = $row['location'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    //  echo $id;
    $name = $_POST['name'];
    // echo $name;
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE crud SET name='$name', age='$age' , phone='$phone', location='$location'
     WHERE id=$id ") or die(mysqli_error($mysqli));

    $_SESSION['msg'] = 'Your Record has been Updated';
    $_SESSION['msg-type'] = 'info';
    
    header("location:index.php");
}
