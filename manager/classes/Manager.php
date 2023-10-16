<?php
$configFile = "../../config.php";
require_once $configFile;


class Manager extends PDO implements ManagerInterface
{
    //properties
    private $mangerId, $name,
    $email, $description, $profilePic;

    use GetId;

    //getters and setters
    public function setDetails($name, $email, $desc, $profilePic){
        try{
            $sqlStmt = "INSERT INTO manager
             VALUES(null, ?, ?, ?, ?, 'manager')";
            $stmt = $this->prepare($sqlStmt);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR); 
            $stmt->bindParam(3, $desc, PDO::PARAM_STR);
            $stmt->bindParam(4, $profilePic, PDO::PARAM_STR);
            $stmt->execute();
            echo "data inserted";
        }catch(PDOException $e){
            echo $e->getMessage() . "\n" . $e->getLine();
        }
        
    }
    // public function getDetails(){
    //     try{
    //         $sqlStmt = "SELECT * FROM manager";
    //         $stmt = $this->prepare($sqlStmt);
    //         $stmt->execute();
    //         $details = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //         return $details;
    //     }catch(PDOException $e){
    //         echo $e->getMessage() . "\n" .$e->getLine();
    //         return array();
    //     }
    // }
    public function getDetailsById($id){
        try{
            $sqlStmt = "SELECT * FROM manager WHERE managerId = ?";
            $stmt= $this->prepare($sqlStmt);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return array();
        }
    }
    

    //methods
    public function __toString(){
        return "class is". __CLASS__;
    }
    public function addStudent(){}
    public function addTeacher(){}
    public function addCategory(){}
    public function addCourse(){}
    public function addCourseInCategory(){}
    public function addStudentInCourse(){}
    public function addTeacherInCourse(){}
}
