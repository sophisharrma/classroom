<?php 
session_start();
require_once "../../view/inc/header.php";
require_once "../../config.php";

$student1 = new Student('mysql:host=localhost; dbname=moodle', 'root', '');
$details = $student1->getDetails($_SESSION['role'], $_SESSION['id']);

if(isset($_POST['update'])){
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $desc = trim(filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING));
    $profilePic = trim(filter_input(INPUT_POST, 'profilePic', FILTER_SANITIZE_STRING));

    if($student1->updateDetails($_SESSION['role'], $_SESSION['id'], $name, $email, $desc, $profilePic)){
        header('location: profile.php');
    }else{
        echo "not updated";
    }
}

if(isset($_GET['status'])){
    $status = $_GET['status'];
    if($status == 'delete'){
        if(isset($_POST['yes'])){
            if(!$student1->deleteProfile($_SESSION['role'], $_SESSION['id'])){
                echo "not deleted";
            }else{
                header('location: login.php');
            }
        }else if(isset($_POST['no'])){
            header('location: profile.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../view/styles/style.css">
    <title>profile</title>
</head>
<body>
    <div style="margin-bottom: 10%;display:inline-flex; width:100%; justify-content:space-evenly;">
        
        <?php 
        foreach($details as $detail){?>
            <div style=" width: 33%">
            <img style=" width: 100%" src="<?php echo $detail['img']; ?>" alt="">
            </div>

            <div style=" width: 50%">
                <?php
                echo "Name : ".ucwords($detail['name']). "<br>". "<br>";
                echo "E-mail : ".$detail['email']. "<br>". "<br>";
                echo "Role : ".ucfirst($detail['role']). "<br>". "<br>";
                echo ucfirst($detail['des']). "<br>". "<br>";
                ?>
                <a href="profile.php?status=update" style="margin:  10%; text-decoration: none; color: green">Update</a>
                <a href="profile.php?status=delete" style="margin:  10%; text-decoration: none; color: green">Delete</a>
            </div>    
        <?php }
        ?>
       
    </div>
    
    <?php 
    if($status=="update"){
        $details = $student1->getDetails($_SESSION['role'], $_SESSION['id']);
        foreach($details as $detail){
        ?>
    <div >
    <form class = "signup-form" action="" method="post">
    <br>
        <label class="label" for="name">Name</label><br>
        <input type="text" id="name" name="name" value="<?php echo $detail['name'] ?>" required><br><br>

        <label class="label" for="email">Email</label><br>
        <input type="email" id="email" name="email" value="<?php echo $detail['email'] ?>" required><br><br>

        <label class="label" for="desc">Description</label><br>
        <input type="text" id="desc" name="desc" value="<?php echo $detail['des'] ?>" required><br><br>

        <label class="label" for="profilePic">Image</label><br>
        <input type="text" id="profilePic" name="profilePic"  value="<?php echo $detail['img'] ?>"required><br><br>

        <input class = "sign-up-button" style="margin-left: 0;" type="submit" name="update" value="Submit">
    </form>
    </div>
    <?php }
    }else if($status === 'delete'){?>
        <div style="width: 50%; margin: 0 30%; border: 1px solid black; background-color: green;">
            <h4 style="margin: 1% 0">Are you sure, you want to delete this profile?</h4>
            <p style="margin: 3% 0">profile will be permanently deleted and you cannot restore it</p>
            <form action="" method="post">
                <input type="submit" name="yes" value="Yes">
                <input type="submit" name="no" value="No">
            </form>
        </div>
    <?php }
    ?>
    
</body>
</html>