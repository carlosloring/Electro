<?php

public class Emails{
    
    private $email;
    
   public function __construct ($row == null){
     
     if (!$row == null) {

        $this->email = $row["email"];
        

    }   
     
 }
  
    public function get_email(){
    return $this->email;
}
    
    public function set_email($email){
    $this->email = $email;
}  
    
}