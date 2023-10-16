<?php 
session_start();
require_once "../../view/inc/header.php";
require_once "../../view/inc/teacherNav.php";
require_once "../../config.php";
if(isset($_POST['addCourse'])){

    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $code = trim(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));

    $teacher2 = new Teacher('mysql:host=localhost; dbname=moodle', 'root', '');
    if($teacher2->createCourse($name, $code)){
        header('location: allCourses.php');
    }else{
        echo "course not added";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teacher</title>
    <link rel="stylesheet" href="../../view/styles/style.css">
</head>
<body>
    
    <form action="" method="post">
        <label for="name"> Course Name</label><br>
        <input type="text" id="name" name="name" required ><br>
        <label for="code"> Course Code</label><br>
        <input type="text" id="code" name="code" required><br><br>
        <input type="submit" name="addCourse" value="Add Course">
    </form>
</body>
</html>