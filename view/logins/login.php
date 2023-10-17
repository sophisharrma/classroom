<?php
session_start();
require_once "../inc/header.php";
require_once "../../config.php";

if(isset($_POST['login'])){
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $role = trim(filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING));
    if($role === 'manager'){
        $manager1 = new Manager("mysql:host=localhost; dbname=moodle",'root','');
        $result = $manager1->getDetails('manager');
        $employee = $manager1;
    }else if ($role === 'teacher'){
        $teacher1 = new Teacher("mysql:host=localhost; dbname=moodle",'root','');
        $result = $teacher1->getDetails('teacher');
        $employee = $teacher1;
    }else{
        $student1 = new Student("mysql:host=localhost; dbname=moodle",'root','');
        $result = $student1->getDetails('student'); 
        $employee = $student1;  
    }

//var_dump($result);

   
    if($result){ 
        foreach($result as $arr){
            foreach($arr as $key => $elem){
                    if($key == 'email' && $elem === $email){
                        $_SESSION['email'] = $email;
                        $_SESSION['role'] = $role;
                        $_SESSION['id'] = $employee->getId($role, $email);
                        $_SESSION['id'] = $_SESSION['id']['id'];
                        header("location: ../../$role/view/$role"."Index.php");
                    }
                
            }
        }
        echo "invalide user or invalid Credentials";
    }
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
    <h3 class = "signup-text">Log in to your classroom now.</h3>
    <div class = "signup-form_wrapper">
        <h2 class = "signup-header">Log In </h2>
    <form class = "signup-form" action="" method="post">

        <label class="label" for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label class="label" for="role">Log In As</label><br>
        <select name="role" id="role" required>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
            <option value="manager">Manager</option>
        </select><br><br>

        <input class = "sign-up-button" type="submit" name="login" value="Log in">
    </form>
    <p>New User? <a href="signUp.php">Sign Up</a></p>
    </div>
</body>
</html>