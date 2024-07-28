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



}







?>