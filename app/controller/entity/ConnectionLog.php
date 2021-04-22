<?php

class ConnectionLog{

    Private $idUsers;
    Private $dateConnection;
    Private $IdUserLog;


    public function setConnectionLogFromArray($ConnectionLog)
    {
    //var_dump($user);
     foreach ($ConnectionLog as $key => $value) {
   
      $this->$key = $value;
   
     }
    }

    /**
     * Get the value of idUsers
     */
    public function getIdUsers()
    {
        return $this->idUsers;
    }

    /**
     * Set the value of idUsers
     *
     * @return self
     */
    public function setIdUsers($idUsers) : self
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    /**
     * Get the value of dateConnection
     */
    public function getDateConnection()
    {
        return $this->dateConnection;
    }

    /**
     * Set the value of dateConnection
     *
     * @return self
     */
    public function setDateConnection($dateConnection) : self
    {
        $this->dateConnection = $dateConnection;

        return $this;
    }

    /**
     * Get the value of IdUserLog
     */
    public function getIdUserLog()
    {
        return $this->IdUserLog;
    }

    /**
     * Set the value of IdUserLog
     *
     * @return self
     */
    public function setIdUserLog($IdUserLog) : self
    {
        $this->IdUserLog = $IdUserLog;

        return $this;
    }
    public function setLogFromArray($log)
    {
       //var_dump($user);
       foreach ($log as $key => $value) {
 
          $this->$key = $value;
       }
    }
}
