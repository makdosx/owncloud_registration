<?php


  
  /*
   Class connection for connect to owncloud database 
    */  
  

 
 class connection
   {

    public $connect = array();


    public function __construct()
     {
      $this->connect[0]="your_host";
      $this->connect[1]="your_username";
      $this->connect[2]="your_password";
      $this->connect[3]="your_database_name";
      }



     public function __destruct()
     {
     // destroyed connect to server and data is null
      $this->connect[0]=null;
      $this->connect[1]=null;
      $this->connect[2]=null;
      $this->connect[3]=null;
      }


      } // end class for connecion (host,user,pass,db)





  
 

    // Class for filter input data from form registration 
    // Stop sql injection 
  
     class FILTER_INPUT
         {
     public function SAFE_DATA ($data)
      {
        $data = stripslashes($data);
        $data = trim ($data);

           if($data)
            {
         return ($data);
            }

          else
            {
           die ("STop: This data cannot be send safe");
             }
 
        } 
  

       } // end of filter class   


       

  
   


     // encryptionn function for insert new user
     // with registratin form 
  
      class ENCRYPTION_OWNCLOUD_FOR_REGISTRATION
         {
      public function BLOWFISH_ENCRYPTION($hash_password)
           {
           $hash_password = sha1 ($hash_password);
                
                if ($hash_password)
                   {
               return ($hash_password);
                   }

                 else
                  {
                    for ($fail=1; $fail<=8; $fail++)
                     {
                      $error = $fail*8;
                       }
                       $hash_password = $this->$error;
                  return (!$hash_password);
           trigger_error("Password encryption failed: $hash_password", E_USER_WARNING);
                    }
                  
            }  // end of function BLOWFISH_ENCRYPTION    
 
          } // end class for ecryption




    


     // encryptionn function for insert new user using extends 

        class ENCRYPTION_OWNCLOUD_CRACK extends ENCRYPTION_OWNCLOUD_FOR_REGISTRATION
            {
         public function BLOWFISH_ENCRYPTION($hash_password)
           {
           $hash_password = sha1 ($hash_password);
                
                if ($hash_password)
                   {
               return ($hash_password);
                   }

                 else
                  {
                    for ($fail=1; $fail<=8; $fail++)
                     {
                      $error = $fail*8;
                       }
                       $hash_password = $this->$error;
                  return (!$hash_password);
           trigger_error("Password encryption failed: $hash_password", E_USER_WARNING);
                    }
                  
            }  // end of function BLOWFISH_ENCRYPTIO 
 
            } // end class for ecryption with etends








?>
