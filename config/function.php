<?php

function checkmail($email){
    if(!preg_match('^[a-z0-9]+([-_.]?[a-z0-9])+@[a-z0-9]+([-_.]?[a-z0-9])+.[a-z]{2,4}', $email)) 
        { 
            return false; 
        } 
        return true; 
}


?>