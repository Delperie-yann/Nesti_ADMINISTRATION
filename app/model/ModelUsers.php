<?php

declare(strict_types=1);


/** @var string $sql */

?><?php

    include_once PATH_MODEL . 'Connection.php';
    class ModelUsers
    {
        //=============
        // readAll
        //=============
        /**
         * Read all users
         *  return empty array or object
         *
         */
        public static function readAll()
        {

            $pdo = Connection::getPdo();

            try {

                $sql    = "SELECT users.idUsers AS idUser, lastName AS lastname, firstName AS firstname, email AS email, passwordHash AS passwordHash, flag AS flag, dateCreation AS dateCreation, login AS loginUser, address1 AS address1, address2 AS address2, zipCode AS zipCode, idcity AS idcity FROM users";
                $result = $pdo->query($sql);
                if ($result) {
                    $array = $result->fetchAll(PDO::FETCH_CLASS, 'Users');
                } else {
                    $array = [];
                }
            } catch (PDOException $e) {

                die("ERROR: Could not able to execute querry " . $e->getMessage());
            }
            return $array;
        }
        //=============
        // readOneBy
        //=============
        /**
         * Read users with ele1 at value ele2
         * 
         *  $parametrer
         *  $value
         *  return object users
         */
        public function readOneBy($parameter, $value)
        {
            //requete
            $pdo = Connection::getPdo();
            try {
                $sql = "SELECT idUsers AS idUser, lastName AS lastname, firstName AS firstname, email AS email, passwordHash AS passwordHash, flag AS flag, dateCreation AS dateCreation, login , address1 AS address1, address2 AS address2, zipCode AS zipCode, idcity AS idCity FROM users where $parameter = '$value'";

                $result = $pdo->query($sql);

                if ($result) {

                    $data = $result->fetch(PDO::FETCH_ASSOC);
                } else {

                    $data = [];
                }

                $user = new Users();
                $user->setUserFromArray($data);
            } catch (PDOException $e) {
                die("ERROR: Could not able to execute querry " . $e->getMessage());
            }
            return $user;
        }
        //=============
        // findChild
        //=============
        /**
         *
         *
         *
         */
        public function findChild($type, $value)
        {
            $pdo = Connection::getPdo();
            try {
                $sql = "SELECT * FROM $type WHERE id" . ucfirst($type) . "= $value";

                $result = $pdo->query($sql);
                $data   = $result->fetch();
            } catch (PDOException $e) {
                die("ERROR: Could not able to execute querry " . $e->getMessage());
            }
            return $data;
        }
        //=============
        // insertUser
        //=============
        /**
         *
         *
         *
         */
        public function insertUser(Users &$user)
        {

            $pdo = Connection::getPdo();
            try {
                // Create prepared statement
                $sql = "INSERT INTO users (lastName,firstName,passwordHash,email,flag,dateCreation,login,address1,address2,zipCode,idCity) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

                $stmt = $pdo->prepare($sql);

                $values = [$user->getLastName(), $user->getFirstName(), $user->getPasswordHash(), $user->getEmail(), $user->getFlag(), $user->getDateCreation(), $user->getLogin(), $user->getAddress1(), $user->getAddress2(), $user->getZipCode(), $user->getIdCity()];

                // Execute the prepared statement
                $stmt->execute($values);

                $newUser = $this->readOneBy("idUsers", $pdo->lastInsertId());
            } catch (PDOException $e) {
                die("ERROR: Could not able to execute querry " . $e->getMessage());
            }

            unset($pdo);
            return $newUser;
        }
        //=============
        // DeleteUser
        //=============
        /**
         *  Use object user  by is Id and set flag to b
         * return the user modifiy
         *
         *
         */
        /**
         * deleteUser
         *
         * 
         * @return object
         */
        public function deleteUser(Users &$user)
        {
            $pdo = Connection::getPdo();
            try {
                $sql = "UPDATE users SET flag = 'b' WHERE idUsers = ?";

                $stmt = $pdo->prepare($sql);

                $values = [$user->getIdUser()];

                // Execute the prepared statement
                $stmt->execute($values);
                $deleteUser = $this->readOneBy("idUsers", $user->getIdUser());
            } catch (PDOException $e) {
                die("ERROR: Could not able to execute querry " . $e->getMessage());
            }
            unset($pdo);
            return $deleteUser;
        }
        //=============
        // UPDATE USER
        //=============
        /**
         *  With user objet insert value
         * and if true
         * return the new object user
         *
         */
        /**
         * updateUsers
         *
         * 
         * @return object
         */
        public function updateUsers(Users &$user)
        {
            $pdo = Connection::getPdo();
            try {
                $sql = "UPDATE users SET lastName = ?, firstName = ?, address1 = ?, address2 = ?, zipCode = ?, flag = ?,idCity = ?  where idUsers = ?";

                $stmt = $pdo->prepare($sql);

                $values = [$user->getLastname(), $user->getFirstname(), $user->getAddress1(), $user->getAddress2(), $user->getZipCode(), $user->getFlag(), $user->getIdCity(), $user->getIdUser()];

                // Execute the prepared statement
                $stmt->execute($values);
                $user = $this->readOneBy("idUsers", $user->getIdUser());
            } catch (PDOException $e) {
                die("ERROR: Could not able to execute $sql. " . $e->getMessage());
            }
            unset($pdo);
            return $user;
        }
        //=============
        // UPDATE USER
        //=============
        /**
         *  With user objet insert value
         * and if true
         * return the new object user
         *
         */
        /**
         * updatePassword
         *
         * 
         * @return object
         */
        public function updatePassword(Users &$user)
        {
            $pdo = Connection::getPdo();
            try {
                $sql = "UPDATE users SET passwordHash = ?  where idUsers = ?";

                $stmt = $pdo->prepare($sql);

                $values = [$user->getPasswordHash(), $user->getIdUser()];

                // Execute the prepared statement
                $stmt->execute($values);
                $user = $this->readOneBy("idUsers", $user->getIdUser());
            } catch (PDOException $e) {
                die("ERROR: Could not able to execute $sql. " . $e->getMessage());
            }
            unset($pdo);
            return $user;
        }
    }
