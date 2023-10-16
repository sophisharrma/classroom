<?php 
session_start();
require_once "../../view/inc/header.php";
if($_SESSION['role'] === 'teacher'){
require_once "../../view/inc/teacherNav.php";
}
require_once "../../config.php";

    $course = new Course('mysql:host=localhost; dbname=moodle', 'root', '');
    $allCourses = $course->getCourseForTeacher($_SESSION['id']);


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

<div class="assign-wrapper" >
 <div class = "assignments">
    <h3 style="text-align:center">Announcements</h3>
 <?php 
 if($_GET['courseId']){
    $teacher1 = new Teacher('mysql:host=localhost; dbname=moodle', 'root', '');
    $announcements = $teacher1->getAnnouncements($_GET['courseId']);
    if($announcements){
    foreach($announcements as $announcement){?>
        <div style = "background-color:white; border:1px solid black;
        margin: 2% 1%;">
            <?php 
            echo "<h4> Title : ". ucwords($announcement['title']) . "</h4>";
            echo $announcement['des'] . "<br><br>";
            echo "<em>Posted On : </em>".$announcement['date'] . "<br><br>";
            ?>
        </div>
   <?php  }
    }else{
        echo " *** no announcements yet *** ";
    }
 }
 
 ?>
 </div> 
 <div class = "assignments">
 <h3 style="text-align:center">Assignments</h3>
 <?php  echo " *** no assignments yet *** "; ?>
 </div> 
</div>   
</body>
</html>