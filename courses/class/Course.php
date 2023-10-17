<?php

class Course extends PDO
{
    private $courseName, $courseCode;

    public function setCourse($courseName, $courseCode, $teacherId){
        try{
            $sql = "INSERT INTO course VALUES(null, ?, ?,?)";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $courseName, PDO::PARAM_STR);
            $stmt->bindParam(2, $courseCode, PDO::PARAM_STR);
            $stmt->bindParam(3, $teacherId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getCourseForTeacher($Id){
        try{
            $sql = "SELECT * FROM course WHERE teacherId = ?";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $Id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return array();
        }
    }
    
    public function getCourseForStudent($Id){
        try{
            $sql = "SELECT * FROM course WHERE courseId = ?";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $Id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return array();
        }
    }
}