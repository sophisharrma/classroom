<?php 
session_start();
require_once "../../view/inc/header.php";
require_once "../../view/inc/studentNav.php";
require_once "../../config.php";

    
    $student3 = new Student('mysql:host=localhost; dbname=moodle', 'root', '');
    $courses = $student3->getCourseFromStudent();
    $courses = explode(',', $courses);
    


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
   <?php 
   if($courses){
     foreach($courses as $courseId){
        //$courseId = $courses[$i];
        $course1 = new Course('mysql:host=localhost; dbname=moodle', 'root', '');
        $allCourses = $course1->getCourseForStudent($courseId);
        foreach($allCourses as $course){
        ?>
        <div class = "course-wrapper"> 
            <h2><a href="../../teacher/view/subjectPage.php?courseId=<?php echo $course['courseId']?>" class = "course-heading-link"><?php echo ucwords($course['courseName']);?></a></h2>
            <h4><?php echo $course['courseCode'];?></h4>
            
        </div>
        
   <?php }}}else{
    echo "no courses yet.";
   }
   ?>
</body>
</html>