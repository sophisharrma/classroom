<?php 
session_start();
require_once "../../view/inc/header.php";
require_once "../../view/inc/teacherNav.php";
require_once "../../config.php";
if(isset($_POST['addAnnounce'])){
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $des = trim(filter_input(INPUT_POST, 'notice', FILTER_SANITIZE_STRING));
    $date = date("Y-m-d  h:i:s");
    $teacherId = $_SESSION['id'];
    $courseId = trim(filter_input(INPUT_GET, 'courseId', FILTER_SANITIZE_NUMBER_INT));
    

    $teacher1 = new Teacher('mysql:host=localhost; dbname=moodle', 'root', '');
    $result = $teacher1->addAnnouncements($title, $des, $date, $teacherId, $courseId);
    if($result){
        echo "announcement added";
    }else{
        echo "announcement not added";
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
        <label for="title"> Title</label><br>
        <input type="text" id="title" name="title" required ><br>
        <label for="notice"> Notice</label><br>
        <textarea name="notice" id="notice" cols="30" rows="10" required></textarea>
        <br><br>
        <input type="submit" name="addAnnounce" value="Submit">
    </form>
</body>
</html>