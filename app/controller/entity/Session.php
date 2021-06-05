<?php

class Session
{
    
    /**
     * isConnectUser
     *
     * @return bool
     */
    public function isConnectUser()
    {
        $isConnect = false;
        if (isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])) {
            $isConnect = true;
        }
        return $isConnect;
    }

      
    /**
     * disconnectUser
     *
     * @return void
     */
    public function disconnectUser()
    {
        $_SESSION["deconnection"] = "réussie";
        header('location:' . BASE_URL . "connection");
        die();
    }
}
