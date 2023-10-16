<?php

trait GetId {
    public function getId($entity, $email){
        try{
            $sql = "SELECT id FROM $entity WHERE email = ?";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
            return [];
        }
    }

    public function getDetails($entity, $id=null){
        try{
            if($id !== null){
                $sql = "SELECT * FROM $entity WHERE id = ?";
                $stmt = $this->prepare($sql);
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
            }else{
                $sql = "SELECT * FROM $entity";
                $stmt = $this->prepare($sql);
            }
            
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage() . $e->getLine();
            return array();
        }
    }


    public function updateDetails($entity, $id, $name, $email, $des, $img){
        try{
            $sql = "UPDATE $entity 
                SET 
                name = ? , 
                email = ? ,
                des = ?,
                img = ?
                WHERE id = ?";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $des, PDO::PARAM_STR);
            $stmt->bindParam(4, $img, PDO::PARAM_STR);
            $stmt->bindParam(5, $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage() . $e->getLine();
            return false;
        }
    }

    public function deleteProfile($entity, $id){
        try{
            $sql = "DELETE FROM $entity WHERE id = ?";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}

