<?php

class UserModel{

    static public function login($email, $password)
    {
        $query = "SELECT id_user, email, password, fk_rol_id, state 
              FROM users WHERE email = :email";

        $statement = model_sql::connectToDatabase()->prepare($query);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }

        return false;
    }

    static public function dataUser($id)
    {
        $sql = "SELECT
                 users.id_user AS id_user,
                 users.name AS name_user,
                 users.email AS email,
                 users.password AS password,
                 users.fk_gender_id AS id_gender,
                 users.state AS state,
                 genders.gender AS gender_detail,              
                 users.fk_rol_id AS id_rol,
                 roles.name AS name_rol
             FROM 
                 users
             JOIN 
                 genders ON users.fk_gender_id = genders.id_gender
             JOIN 
                 roles ON users.fk_rol_id = roles.id_rol
             WHERE 
                 users.id_user = ?";
                 
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static  public function checkExistingEmail($email)
    {
        try {
            $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ?";
            $checkStatement = model_sql::connectToDatabase()->prepare($checkQuery);
            $checkStatement->bindParam(1, $email, PDO::PARAM_STR);
            $checkStatement->execute();

            $count = $checkStatement->fetchColumn();

            if ($count > 0) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo "Error en la validación de duplicados: " . $e->getMessage();
            return false;
        }
    }

    static  public function checkExistingEmailWhileEditing($id, $email)
    {
        try {
            $checkQuery = "SELECT COUNT(*) FROM users WHERE email = ? AND id_user <> ?";
            $checkStatement = model_sql::connectToDatabase()->prepare($checkQuery);
            $checkStatement->bindParam(1, $email, PDO::PARAM_STR);
            $checkStatement->bindParam(2, $id, PDO::PARAM_INT);
            $checkStatement->execute();

            $count = $checkStatement->fetchColumn();

            if ($count > 0) {


                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo "Error en la validación de duplicados: " . $e->getMessage();
            return false;
        }
    }

    static public function newUser($value1, $value2, $value3, $value4, $value5)
    {
        $sql = "INSERT INTO users (name, email, password, fk_rol_id, fk_gender_id, state)
                                VALUES (:name, :email, :password, :fk_rol_id, :gender, 1)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':password', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':fk_rol_id', $value4, PDO::PARAM_INT);
        $stmt->bindParam(':gender', $value5, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }

    static public function getAllUser(){
        $sql = "SELECT
        users.id_user AS id_user,
        users.name AS name,
        users.email AS email,
        users.fk_rol_id AS fk_rol_id,
        roles.name AS name_rol,
        users.state AS state,
        users.fk_gender_id as fk_gender_id,
        genders.gender AS gender
    FROM
        users
    JOIN
        roles ON users.fk_rol_id = roles.id_rol
    JOIN
        genders ON users.fk_gender_id = genders.id_gender
    WHERE
        (users.state = 1 OR users.state = 2)";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function disableUser($id)
    {
        $sql = "UPDATE users SET state = 2 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false; 
        }
        $stmt = null;
    }

    static public function activateUser($id)
    {
        $sql = "UPDATE users SET state = 1 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false; 
        }
        $stmt = null;
    }

    static public function updateUserData($name, $fk_rol_id, $id_user, $gender, $email)
    {
        $sql = "UPDATE users SET name  = :name, fk_rol_id = :fk_id, email = :email, fk_gender_id = :gender WHERE id_user = :id_user";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':fk_id', $fk_rol_id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;

        } else {
            print_r($stmt->errorInfo());
            return false; 

        }
        $stmt = null;
    }

}

?>