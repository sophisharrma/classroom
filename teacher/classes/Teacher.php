<?php
require_once "../../config.php";
class Teacher extends PDO implements TeacherInterface
{
    //properties
    private $name, $teacherId, $email, $desc, $profilePic;

    use GetId;
    //getters and setters
    public function setDetails($name, $email, $desc, $profilePic){
        try{
            $sqlStmt = "INSERT INTO teacher
            VALUES(null, ?, ?, ?, ?, 'teacher')";
            $stmt = $this->prepare($sqlStmt);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $desc, PDO::PARAM_STR);
            $stmt->bindParam(4, $profilePic, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

    //methods
    public function createCourse($courseName, $courseCode){
        $dbms = new Course('mysql:host=localhost; dbname=moodle', 'root', '');
        if($dbms->setCourse($courseName, $courseCode,$_SESSION['id'])){
            return true;
        }else return false;
    }

    public function addAnnouncements($title, $des, $date, $teacherId, $courseId){
        try{
            $sql="INSERT INTO announcement VALUES(null, ?, ?, ?, ?, ?)";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $title, PDO::PARAM_STR);
            $stmt->bindParam(2, $des, PDO::PARAM_STR);
            $stmt->bindParam(3, $date, PDO::PARAM_STR);
            $stmt->bindParam(4, $teacherId, PDO::PARAM_INT);
            $stmt->bindParam(5, $courseId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }

    public function getAnnouncements($courseId){
        try{
            $sql = "SELECT * FROM announcement WHERE courseId = ?";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $courseId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }
}