<?php
require_once "../../config.php";
class Student extends PDO implements StudentInterface
{
     //properties
     private $name, $email, $desc, $profilePic;

     use GetId;

    
     //getters and setters
     public function setDetails($name, $email, $desc, $profilePic){
         try{
             $sqlStmt = "INSERT INTO student
             VALUES(null, ?, ?, ?, ?, 'student','')";
             $stmt = $this->prepare($sqlStmt);
             $stmt->bindParam(1, $name, PDO::PARAM_STR);
             $stmt->bindParam(2, $email, PDO::PARAM_STR);
             $stmt->bindParam(3, $desc, PDO::PARAM_STR);
             $stmt->bindParam(4, $profilePic, PDO::PARAM_STR);
             $stmt->execute();
             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
             return $result;
         }catch(PDOException $e){
             echo $e->getMessage() . $e->getFile() . $e->getLine();
             return [];
         }
     }

     public function getCourseIdFromStudent(){
        $sql = "SELECT courseId FROM student WHERE id = ?";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $courseId = $result['courseId'];
        return $courseId;
     }
    //methods 
    public function addCourseToStudent($courseId, $studentId){
        try{
            $courseIdStr = self::getCourseIdFromStudent();
            $str = "";
                if($courseIdStr == NULL){
                    $str = (string)$courseId . ',';
                }else{
                    $str = $courseIdStr . (string)$courseId . ',';
                }
            
            
                 
            $sql = "UPDATE student 
            SET courseId = ?
            WHERE id = ?";

            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $str, PDO::PARAM_STR);
            $stmt->bindParam(2, $studentId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function joinCourse($courseCode){
        try{
            $sql = "SELECT courseId FROM course WHERE courseCode = ?";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $courseCode, PDO::PARAM_STR);
            $stmt->execute();
            $courseId = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($courseId!=null){
                
                $student1 = new Student('mysql:host=localhost; dbname=moodle', 'root', '');
                $student1->addCourseToStudent($courseId[0]['courseId'], $_SESSION['id']);
                return true ;
            }
        }catch(PDOException $e){
            echo $e->getMessage() . $e->getLine() . $e->getFile();
            return false;
        }  
    }

    public function getCourseFromStudent(){
        $courses = self::getCourseIdFromStudent();
        return $courses;
    }
}

