<?php 
session_start();
require_once "../../view/inc/header.php";
require_once "../../view/inc/teacherNav.php";
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
<!-- assignments inside   -->
<div class = "course">
    <?php 
    if(!empty($allCourses)){
        foreach($allCourses as $course){?>
           
                <div class = "course-wrapper"> 
                    <h2><a href="subjectPage.php?courseId=<?php echo $course['courseId']?>" class = "course-heading-link"><?php echo ucwords($course['courseName']);?></a></h2>
                    <h4><?php echo $course['courseCode'];?></h4>
                    <a class = "add-icon-link" href="addAnnounce.php?courseId=<?php echo $course['courseId'] ?>"><img class="add-icon" src="https://static.thenounproject.com/png/953211-200.png" alt="">Announcements</a><br><br>
                    <a class = "add-icon-link" href="addAssignments.php?courseId=<?php echo $course['courseId'] ?>"><img class="add-icon" src="https://static.thenounproject.com/png/953211-200.png" alt="">Assignments</a>
                </div>
          
    <?php }}else{
        echo "no course added";
    }
    ?>
 </div>    
</body>
</html>