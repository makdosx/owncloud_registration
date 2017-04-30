<html>
<head>

  <link rel="shortcut icon" href="/register/icons/favicon.png" />

 <link rel="stylesheet" type="text/css" href="/register/css/index.css">

</head>


<body>


 <img src="/register/icons/logo.png" height="130" width="250" id="img">



  <form action="" id="form" method="POST">
   <input type="text" name="username" id="username" maxlength="16" placeholder="Username" autofocus="autofocus" required>
     <br>
    <input type="email" name="email" id="mail" maxlength="64" placeholder="Email" required> 
     <br>
    <input type="password" name="password" id="passwd" maxlength="32" placeholder="Password" required>
    <br>
  <input type="password" name="retype_password" id="passwd" maxlength="32" placeholder="Password again" required>
    <br>
    <input type="submit" name="submit" id="sub" value="Register">
     <br><br>
    
   
        <!--
      // $url = $_SERVER['REQUEST_URI'];
      // $url_reg = substr("$url",0,10);  
      // $url_reg_htm = $url_reg ."index.html";
          -->
    

     <a href='/index.html' id='back'> Back to home </a>

     


  </form>  




</body>
</html>





<?php


error_reporting(E_ALL);
ini_set('display_errors','On');



  
  if(isset($_POST['submit']))
    {

     require_once('classes.php');

      $obj_conn = new connection;

     $host = $obj_conn->connect[0];
     $user = $obj_conn->connect[1];
     $pass = $obj_conn->connect[2];
     $db   = $obj_conn->connect[3];


     $conn = new mysqli($host,$user,$pass,$db); 
   
      if($conn->connect_error)
       {
       die ('Connection failed ' .$conn->connect_error);
        }    
  

   else
    {

     $obj_filter = new FILTER_INPUT;

     $username = $obj_filter->SAFE_DATA($_POST['username']);
     $username = $conn->real_escape_string($_POST['username']);
     $email = $obj_filter->SAFE_DATA($_POST['email']);
     $email = $conn->real_escape_string($_POST['email']);
     $password = $obj_filter->SAFE_DATA($_POST['password']);
     $password = $conn->real_escape_string($_POST['password']);
     $retype_password = $obj_filter->SAFE_DATA($_POST['retype_password']);
     $retype_password = $conn->real_escape_string($_POST['retype_password']);
 

     $obj_encryption = new ENCRYPTION_OWNCLOUD_CRACK;

     $hash = $obj_encryption->BLOWFISH_ENCRYPTION($password);


    $sql="select uid from oc_users";
    $result=$conn->query($sql);


       
       while ($row=$result->fetch_assoc())
        {
    
         if ($row['uid']==$username) 
          {
         echo '<script type="text/javascript">alert("This name exists. Please choose an another name!");
         </script>';
       echo ("<script>location.href='/register'</script>");
            }
  

          else if ($row['uid']!=$username)
           {
          
             if($password!=$retype_password)
              {
            echo '<script type="text/javascript">alert("Password and retype password do not match!");
         </script>';
       echo ("<script>location.href='/register'</script>");
               }
          

             if ($password==$retype_password)
                {
                 $sql_user="insert into oc_users (uid,password) values ('$username','$hash')";
                 $result_user = $conn->query($sql_user);
                

                 $sql_user_settings = "insert into oc_preferences (userid,appid,configkey,configvalue)
                                       values ('$username','settings','email','$email');";
                 $sql_user_settings .= "insert into oc_preferences (userid,appid,configkey,configvalue)
                                       values ('$username','files','quota','100 MB')";

                 $result_user_settings = $conn->multi_query($sql_user_settings);


                    if($result_user===TRUE && $result_user_settings===TRUE)
                     {
                   echo '<script type="text/javascript">alert("Registration successfully!");
           </script>';
       echo ("<script>location.href='/index.php'</script>");
                       }


                }



            }


         } // end of while assoc table   
   




     }// end else of connection  


     } // end of isset
  

?>

-
