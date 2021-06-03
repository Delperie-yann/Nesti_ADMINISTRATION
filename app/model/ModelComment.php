<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelComment
{
    //=============
    // readAll
    //=============
    /**
     *
     *
     *
     */
    public function readAll()
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM comment";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Comment');
        } else {
            $array = [];
        }
        return $array;
    }
    //=============
    // readAllBy
    //=============
    /**
     *
     *
     *
     */
    public function readAllBy($parameter, $value)
    {
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM comment where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Comment');
        } else {
            $array = [];
        }
        return $array;
    }
    //=============
    // readOneBy
    //=============
    /**
     *
     *
     *
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM comment where $parameter = '$value'";
        // var_dump($sql);
        $result = $pdo->query($sql);

        if ($result) {
            $data = $result->fetch();
        } else {
            $data = [];
        }

        $comment = new Comment();
        $comment->setCommentFromArray($data);

        return $comment;
    }
    //=============
    // updateComment
    //=============
    /**
     *
     *
     *
     */
    public function updateComment(Comment &$comment)
    {
        $pdo = Connection::getPdo();
        try {
            $sql = "UPDATE comment SET flag = ?, idModerator = ?  where idUsers = ? AND idRecipe= ?";

            $stmt = $pdo->prepare($sql);

            $values = [$comment->getFlag(), $comment->getIdModerator(), $comment->getIdUsers(), $comment->getIdRecipe()];

            // Execute the prepared statement
            $stmt->execute($values);

            $comment = $this->readOneBy("idUsers", $comment->getIdUsers());
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        // return $comment;
    }
    //=============
    // readOneBy2Prameter
    //=============
    /**
     *
     *
     *
     */
    public function readOneBy2Prameter($parameter, $value, $parameter2, $value2)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM comment where $parameter = '$value' and $parameter2 = '$value2'";

        $result = $pdo->query($sql);

        if ($result) {
            $data = $result->fetch();
        } else {
            $data = [];
        }

        $comment = new Comment();
        $comment->setCommentFromArray($data);
        return $comment;
    }
}
