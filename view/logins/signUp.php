<?php
require_once "../inc/header.php";
require_once "../../config.php";

if(isset($_POST['submit'])){
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $desc = trim(filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING));
    $profilePic = trim(filter_input(INPUT_POST, 'profilePic', FILTER_SANITIZE_STRING));
    $role = trim(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING));

    
    if($role === 'manager'){
        $manager1 = new Manager("mysql:host=localhost; dbname=moodle",'root','');
        $manager1->setDetails($name, $email, $desc, $profilePic);
    }else if ($role === 'teacher'){
        $teacher1 = new Teacher("mysql:host=localhost; dbname=moodle",'root','');
        $teacher1->setDetails($name, $email, $desc, $profilePic);
    }else{
        $student1 = new Student("mysql:host=localhost; dbname=moodle",'root','');
        $student1->setDetails($name, $email, $desc, $profilePic);
    }
 header('location: login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <h3 class = "signup-text">Sign up to join your classroom now.</h3>
    <div class = "signup-form_wrapper">
        <h2 class = "signup-header">Sign Up </h2>
    <form class = "signup-form" action="" method="post">
        <label class="label" for="name">Name</label><br>
        <input type="text" id="name" name="name" required><br>

        <label class="label" for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br>

        <label class="label" for="desc">Description</label><br>
        <input type="text" id="desc" name="desc" required><br>

        <label class="label" for="profilePic">Image</label><br>
        <input type="text" id="profilePic" name="profilePic" required><br>

        <label class="label" for="role">Role</label><br>
        <select name="role" id="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="manager">Manager</option>
        </select><br><br>


        <input class = "sign-up-button" type="submit" name="submit" value="Submit">
    </form>
    <p>Already a User? <a href="login.php">Log In</a></p>
    </div>
</body>
</html>