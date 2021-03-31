<?php
class Utils
{
    public static function checkEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = "L'adresse email ".$email ." est considérée comme invalide.";
        } 
        
        return $result ?? '';
    }
}
