<?php 
session_start();
require_once "../../view/inc/header.php";
require_once "../../view/inc/studentNav.php";
require_once "../../config.php";
if(isset($_POST['submit'])){
    $code = trim(filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING));
    $student3 = new Student('mysql:host=localhost; dbname=moodle', 'root', '');
    
    ($student3->joinCourse($code) === true)?
        print("done"):print "couldnot add course to your records";
    
    //$student3->addCourseToStudent(2, 21);
       
    
}
$student3 = new Student('mysql:host=localhost; dbname=moodle', 'root', '');
 echo gettype($student3->getCourseIdFromStudent());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../view/styles/style.css">
    <title>student</title>
</head>
<body>
    <form action="" method="post">
        <h3>Join Course</h3>
        <label for="code">Enter course code </label><small>(Given by your teacher)</small><br>
        <input type="text" name="code" id="code" required><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>