<?php

require_once('Slim/Slim.php');
require_once('db.php');


\Slim\Slim::registerAutoloader();

$sc = new \Slim\Slim();
 
header('Content-Type: application/json');

$sc->contentType("application/json");

$sc->post('/login',function() use($sc){
    $con = getDB();
    $body = json_decode($sc->request->getBody());
    $username = mysqli_real_escape_string($con,$body->data->username);
    $password = md5(mysqli_real_escape_string($con,$body->data->password));

    $verify = mysqli_query($con, "SELECT * FROM `admins` WHERE `username`='$username' AND `password`='$password'") or die(throw_error(mysqli_error($con)));

    if(mysqli_num_rows($verify) == 1){

        $session_vars = mysqli_fetch_array($verify);
        //$auth_code = generateAuthCode(9);
        session_start();

        $_SESSION['logged_in'] = "yes";
        $_SESSION['username'] = $session_vars['username'];

        // $_SESSION['a_id'] = $session_vars['a_id'];
    

        print_r(json_encode((array("status"=>"success","message"=>"Sign in was successfull.","data"=>null))));

    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"Username or password is wrong.","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});


$sc->get('/get-email',function() use($sc){

   session_start();

    $con = getDB();
    $body = json_decode($sc->request->getBody());
    $username = $_SESSION['username'];
        
    $verify = mysqli_query($con, "SELECT email FROM `admins` WHERE `username`='$username'") or die(throw_error(mysqli_error($con)));
     $data = mysqli_fetch_array($verify);
     $email  =  $data['email'];
     print_r(json_encode((array("status"=>"success","message"=>"Got email.","data"=>$email,"username"=>"$username"))));

   
    mysqli_close($con);
    $sc->stop();

});





$sc->put('/chng_pswd',function() use($sc){

session_start();

    $con = getDB();
    $body = json_decode($sc->request->getBody());
    $username = $_SESSION['username'];
    $o_password = md5(mysqli_real_escape_string($con,$body->data->o_password));
    $n_password = md5(mysqli_real_escape_string($con,$body->data->n_password));
    $c_password = md5(mysqli_real_escape_string($con,$body->data->c_password));
    $que = mysqli_query($con,"SELECT password from admins where username='$username'");
    $data = mysqli_fetch_array($que);
    $dbpass = $data['password'];



    if(($n_password==$c_password) && $dbpass==$o_password ){
    mysqli_query($con, "UPDATE `admins` SET `password`='$c_password' WHERE `username`='$username' ");
print_r(json_encode((array("status"=>"success","message"=>"Password changed.","data"=>null))));
}

else {

print_r(json_encode((array("status"=>"failed","message"=>"Passwords are not correct","data"=>null))));


}

    $sc->stop();

});



$sc->put('/admins/cmail',function() use($sc){
session_start();
    $con = getDB();
    $username = $_SESSION['username'];
      $body = json_decode($sc->request->getBody());
     $nmail = mysqli_real_escape_string($con,$body->data->nmail);
          $cmail = mysqli_real_escape_string($con,$body->data->cmail);



   
      
    if($nmail==$cmail)
    {
            mysqli_query($con, "UPDATE `admins` SET `email`='$nmail' WHERE `username`='$username'");
         print_r(json_encode((array("status"=>"success","message"=>"Email is updated","data"=>null))));

    }
     else{

        print_r(json_encode((array("status"=>"fail","message"=>"Both emails are not same.","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});



$sc->put('/news/:a_id',function($a_id) use($sc){
    

    $con = getDB();
    $a_id = mysqli_escape_string($con,$a_id);
      $body = json_decode($sc->request->getBody());
     $date = mysqli_real_escape_string($con,$body->data->date);
    $title = (mysqli_real_escape_string($con,$body->data->title));

        mysqli_query($con, "UPDATE `news` SET `date`='$date',`title`='$title' WHERE `id`='$a_id' ");
        print_r(json_encode((array("status"=>"success","message"=>"News with id ".$a_id." is updated.","data"=>null))));

   
    
    mysqli_close($con);
    $sc->stop();


});






$sc->put('/admins/:a_id',function($a_id) use($sc){
    

    $con = getDB();
    $a_id = mysqli_escape_string($con,$a_id);
      $body = json_decode($sc->request->getBody());
     $email = mysqli_real_escape_string($con,$body->data->email);
    $password = md5(mysqli_real_escape_string($con,$body->data->password));

    if($body->data->password=="" || $password==null){

            mysqli_query($con, "UPDATE `admins` SET `email`='$email' WHERE `id'='$a_id' ");
                     print_r(json_encode((array("status"=>"Success","message"=>"Email with id ".$a_id." is updated.","data"=>null))));
    }


    else
    {
        mysqli_query($con, "UPDATE `admins` SET `email`='$email',`password`='$password' WHERE id='$a_id' ");
        print_r(json_encode((array("status"=>"success","message"=>"Email with id ".$a_id." has changed password and email successfully.","data"=>null))));

    }
    
    mysqli_close($con);
    $sc->stop();


});


$sc->put('/admins/delete/:a_id',function($a_id) use($sc){
    

    $con = getDB();
    $a_id = mysqli_escape_string($con,$a_id);
   

    

            if(mysqli_query($con, "DELETE FROM  `admins` WHERE `id`='$a_id' "))
                     print_r(json_encode((array("status"=>"success","message"=>"Email with id ".$a_id." is deleted.","data"=>null))));
   else  print_r(json_encode((array("status"=>"Failed","message"=>"Email with id ".$a_id." not deleted.","data"=>null))));


 
    
    mysqli_close($con);
    $sc->stop();


});

$sc->put('/news/delete/:a_id',function($a_id) use($sc){
    

    $con = getDB();
    $a_id = mysqli_escape_string($con,$a_id);

            if(mysqli_query($con, "DELETE FROM  `news` WHERE `id`='$a_id' "))
                     print_r(json_encode((array("status"=>"success","message"=>"News with id ".$a_id." is deleted.","data"=>null))));
   else  print_r(json_encode((array("status"=>"Failed","message"=>"News with id ".$a_id." not deleted.","data"=>null))));


 
    
    mysqli_close($con);
    $sc->stop();


});


$sc->put('/admins/reset/:a_id',function($a_id) use($sc){

    $con = getDB();
        $a_id = mysqli_escape_string($con,$a_id);
      $body = json_decode($sc->request->getBody());
     $username = mysqli_real_escape_string($con,$body->data->username);


   
      
    if(mysqli_query($con, "UPDATE admins SET password=md5('hugsy') WHERE id=$a_id "))
    {

     print_r(json_encode((array("status"=>"success","message"=>"Username with id ".$a_id." mail is send.","data"=>null))));

    }
     else{

        print_r(json_encode((array("status"=>"fail","message"=>"Unable to reset password.","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});

$sc->get('/news',function() use($sc){

  

    $con = getDB();
    $body = json_decode($sc->request->getBody());
   
        
    $query = mysqli_query($con, "SELECT * FROM `news`") or die(throw_error(mysqli_error($con)));
     

 if(mysqli_num_rows($query) > 0){

            $output =  array();
         while ($data = mysqli_fetch_array($query)) {        
            $date = $data['date'];
            $title = $data['title'];
           
                array_push($output, array("date"=>$date,"title"=>$title));
            }

            print_r((json_encode(array("status"=>"success","message"=>"Got news","data"=>$output))));
        

        
    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"No news in db","data"=>null))));

    }

   
    mysqli_close($con);
    $sc->stop();

});



$sc->get('/admins/all',function() use($sc){

$con = getDB();
$query = mysqli_query($con,"SELECT id,username,password,email FROM admins") or  die(throw_error(mysqli_error($con)));
 if(mysqli_num_rows($query) > 0){

            $output =  array();
         while ($data = mysqli_fetch_array($query)) {        
            $user = $data['username'];
            $pass = $data['password'];
            $id = $data['id'];
            $email = $data['email'];
                array_push($output, array("id"=>"$id","username"=>$user,"password"=>$pass,"email"=>$email));
            }

            print_r((json_encode(array("status"=>"success","message"=>"these are the list of admins","data"=>$output))));
        

        
    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"No data in database","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});



$sc->get('/news/all',function() use($sc){

$con = getDB();
$query = mysqli_query($con,"SELECT * FROM news") or  die(throw_error(mysqli_error($con)));
 if(mysqli_num_rows($query) > 0){

            $output =  array();
         while ($data = mysqli_fetch_array($query)) {  
            $id = $data['id'];   
            $date = $data['date'];
            $title = $data['title'];
           
                array_push($output, array("id"=>$id,"date"=>$date,"title"=>$title));
            }

            print_r((json_encode(array("status"=>"success","message"=>"these are the list of news","data"=>$output))));
        

        
    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"No news in database","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});


$sc->get('/home-slider',function() use($sc){

$con = getDB();
$query = mysqli_query($con,"SELECT id,source,heading1,heading2,blink,btitle FROM homeslider") or  die(throw_error(mysqli_error($con)));
 if(mysqli_num_rows($query) > 0){

            $output =  array();
         while ($data = mysqli_fetch_array($query)) {  
            $source = $data['source'];  
             $id = $data['id'];  
               $heading1 = $data['heading1'];
                 $heading2= $data['heading2'];  
                  $blink= $data['blink'];  
                   $btitle= $data['btitle'];     
            
           
 array_push($output, array("id"=>$id,"heading1"=>$heading1,"heading2"=>$heading2,"blink"=>$blink,"btitle"=>$btitle,"source"=>$source));
            }

            print_r((json_encode(array("status"=>"success","message"=>"these are the list of source of images","data"=>$output))));
        

        
    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"No source images in database","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});



$sc->get('/get_crequests/:page',function($page) use($sc){
$con = getDB();
$page = mysqli_escape_string($con, $page);

$lim = 3;
if($page==""||$page=="1"){
$page1=0;

}
else
{
$page1=($page*$lim)-$lim;

}

$res = mysqli_query($con,"SELECT * FROM contact limit $page1,$lim ");
$output = array();
while($row=mysqli_fetch_array($res))
{

    array_push($output, array("Id"=>$row['id'],"Name"=>$row['Name'],"Email"=>$row['Email'],"Telephone"=>$row['Tel'],"Message"=>$row['Message'],"Time"=>$row['time']));
   


}

print_r(json_encode(array("status"=>"success","message"=>"getting contact requests","data"=>$output)));

$res1 = mysqli_query($con,"SELECT * FROM service_requests");
$cou = mysqli_num_rows($res1);
$t = $cou/5;
$a  = ceil($t);


// echo "<br>";  echo "<br>";
// for ($b=1; $b<=$a;$b++) { 

//


});

$sc->get('/getrequests/:page',function($page) use($sc){
$con = getDB();
$page = mysqli_escape_string($con, $page);
$lim = 2;
if($page==""||$page=="1"){
$page1=0;

}
else
{
$page1=($page*$lim)-$lim;

}

$res = mysqli_query($con,"SELECT * FROM service_requests limit $page1,$lim");
$output  =array();
while($row=mysqli_fetch_array($res))
{
 
  array_push($output, array("s_no"=>$row['s_id'],"type"=>$row['type'],"time"=>$row['timestamp'],"email"=>$row['email'],"Tel"=>$row['tel'],"description"=>$row['description']));
   

}
print_r(json_encode(array("status"=>"success","message"=>"requests retreived.".$page,"data"=>$output)));


$res1 = mysqli_query($con,"SELECT * FROM contact");
$cou = mysqli_num_rows($res1);
$t = $cou/5;
$a  = ceil($t);


// echo "<br>";  echo "<br>";
// for ($b=1; $b<=$a;$b++) { 

//


});


$sc->post('/admin/new',function() use($sc){
    $con = getDB();
    $body = json_decode($sc->request->getBody());
    $username = mysqli_real_escape_string($con,$body->data->username);
    $password = md5(mysqli_real_escape_string($con,$body->data->password));
    $email  = mysqli_real_escape_string($con,$body->data->email);
    $auth_level  = mysqli_real_escape_string($con,$body->data->auth_level);

    

    if(mysqli_query($con, "INSERT  into  admins (username,password,email,auth_level ) VALUES('$username','$password','$email','$auth_level')")){
       

        print_r(json_encode((array("status"=>"success","message"=>"Admin added successfully.","data"=>null))));

    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"Username already in use.","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();
});

$sc->get('/event/all',function() use($sc){

$con = getDB();
$query = mysqli_query($con,"SELECT id,name,day,mon,year,venue FROM events ORDER BY year DESC") or  die(throw_error(mysqli_error($con)));
 if(mysqli_num_rows($query) > 0){

            $output =  array();
         while ($data = mysqli_fetch_array($query)) {        
            $name = $data['name'];
            $day = $data['day'];
            $mon = $data['mon'];
            $id = $data['id'];
            $venue = $data['venue'];
                array_push($output, array("id"=>$id,"name"=>$name,"day"=>$day,"mon"=>$mon,"venue"=>$venue));
            }

            print_r((json_encode(array("status"=>"success","message"=>"Events listed","data"=>$output))));
        }
    else
        print_r(json_encode((array("status"=>"fail","message"=>"No data in database","data"=>null))));

    mysqli_close($con);
    $sc->stop();

});


$sc->get('/admins/event/all',function() use($sc){

$con = getDB();
$query = mysqli_query($con,"SELECT id,name,e_date,venue FROM events") or  die(throw_error(mysqli_error($con)));
 if(mysqli_num_rows($query) > 0){

            $output =  array();
         while ($data = mysqli_fetch_array($query)) {        
            $name = $data['name'];
            $date = $data['e_date'];
            $id = $data['id'];
            $venue = $data['venue'];
                array_push($output, array("id"=>"$id","name"=>$name,"date"=>$date,"venue"=>$venue));
            }

            print_r((json_encode(array("status"=>"success","message"=>"Events listed","data"=>$output))));
        }
    else
        print_r(json_encode((array("status"=>"fail","message"=>"No data in database","data"=>null))));

    mysqli_close($con);
    $sc->stop();

});


$sc->post('/admin/add-event',function() use($sc){
    $con = getDB();
    $body = json_decode($sc->request->getBody());
    $e_name = mysqli_real_escape_string($con,$body->data->e_name);
    $date = mysqli_real_escape_string($con,$body->data->date);
    $venue = mysqli_real_escape_string($con,$body->data->venue);
    $date_parts=preg_split('/(\s|-|\/)/', $date);
    $mon=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $d=$mon[$date_parts[1]-1];

    if(mysqli_query($con, "INSERT  into  events (name,e_date,day,mon,year,venue) VALUES('$e_name','$date','$date_parts[0]','$d','$date_parts[2]','$venue')")){
        print_r(json_encode((array("status"=>"success","message"=>"Event added successfully.","data"=>null))));
    }
    else{
        print_r(json_encode((array("status"=>"fail","message"=>"Some error","data"=>null))));
    }

    mysqli_close($con);
    $sc->stop();
});

$sc->put('/admins/event/:a_id',function($a_id) use($sc){
    

    $con = getDB();
    $a_id = mysqli_escape_string($con,$a_id);
      $body = json_decode($sc->request->getBody());

     $name = mysqli_real_escape_string($con,$body->data->e_name);
     $date = mysqli_real_escape_string($con,$body->data->date);
     $venue = mysqli_real_escape_string($con,$body->data->venue);

    if(mysqli_query($con, "UPDATE `events` SET `name`='$name',`e_date`='$date',`venue`='$venue' WHERE id='$a_id' "))
        print_r(json_encode((array("status"=>"success","message"=>"Event id ".$a_id." has been changed successfully.","data"=>null))));
    else
        print_r(json_encode((array("status"=>"Failed","message"=>"Event with id ".$a_id." not updated.","data"=>null))));

    mysqli_close($con);
    $sc->stop();


});

$sc->put('/admins/delete_event/:a_id',function($a_id) use($sc){
    

    $con = getDB();
    $a_id = mysqli_escape_string($con,$a_id);

    if(mysqli_query($con, "DELETE FROM  `events` WHERE `id`='$a_id' "))
       print_r(json_encode((array("status"=>"success","message"=>"Event with id ".$a_id." deleted.","data"=>null))));
  
    else  print_r(json_encode((array("status"=>"Failed","message"=>"Event with id ".$a_id." not deleted.","data"=>null))));
    
    mysqli_close($con);
    $sc->stop();


});

$sc->post('/news/new',function() use($sc){
    $con = getDB();
    $body = json_decode($sc->request->getBody());
    $date = mysqli_real_escape_string($con,$body->data->date);
    $title = (mysqli_real_escape_string($con,$body->data->title));
  

    

    if(mysqli_query($con, "INSERT  into  news (`date`,`title`)  VALUES('$date','$title')")){
       

        print_r(json_encode((array("status"=>"success","message"=>"News Inserted","data"=>null))));

    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"News not inserted.","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();
});


$sc->post('/porequests',function() use($sc){
$con = getDB();
    $body = json_decode($sc->request->getBody());
    $type = mysqli_real_escape_string($con,$body->data->type);
    $description = mysqli_real_escape_string($con,$body->data->description);
      $email = mysqli_real_escape_string($con,$body->data->Email);
    $tel = mysqli_real_escape_string($con,$body->data->Tel);

     if(mysqli_query($con, "INSERT  into  service_requests (type,Email,Tel,description) VALUES('$type','$email','$tel','$description')")){
        // $session_vars = mysqli_fetch_array($verify);
        //$auth_code = generateAuthCode(9);
        session_start();
        $_SESSION['logged_in'] = "yes";

       //  $_SESSION['access_id'] = $session_vars['a_id'];
       // $_SESSION['auth_level'] = $session_vars['auth_level'];
       //  $_SESSION['username'] = $session_vars['username'];
       //  $_SESSION['name'] = $session_vars['name'];

        print_r(json_encode((array("status"=>"success","message"=>"Requests posted successfully","data"=>null))));

    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"Failed to post query.","data"=>null))));

    }

    mysqli_close($con);



    $sc->stop();
});


$sc->post('/contact-requests',function() use($sc){
$con = getDB();
    $body = json_decode($sc->request->getBody());
    $name = mysqli_real_escape_string($con,$body->data->name);
    $message = mysqli_real_escape_string($con,$body->data->Message);
    $email = mysqli_real_escape_string($con,$body->data->email);
    $tel = mysqli_real_escape_string($con,$body->data->tel);

     if(mysqli_query($con, "INSERT  into  contact (Name,Email,Tel,Message) VALUES('$name','$email','$tel','$message')")){
        // $session_vars = mysqli_fetch_array($verify);
        //$auth_code = generateAuthCode(9);
        session_start();
        $_SESSION['logged_in'] = "yes";

       //  $_SESSION['access_id'] = $session_vars['a_id'];
       // $_SESSION['auth_level'] = $session_vars['auth_level'];
       //  $_SESSION['username'] = $session_vars['username'];
       //  $_SESSION['name'] = $session_vars['name'];

        print_r(json_encode((array("status"=>"success","message"=>"Contact Requests posted successfully","data"=>"null"))));

    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"Failed to post contact requests.","data"=>"null"))));

    }

    mysqli_close($con);



    $sc->stop();
});


$sc->post('/bulkmail',function() use($sc){

    $con = getDB();


    $mail = new PHPMailer;
     $body = json_decode($sc->request->getBody());
    $msg = mysqli_real_escape_string($con,$body->data->msg);



$mail->isSMTP();
$mail->Host = 'smtp.google.com';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 25;
$mail->Username = 'jokerhoker@gmail.com';
$mail->Password = 'passwordispulkit';
$mail->setFrom('jokerhoker@gmail.com', 'List manager');
$mail->addReplyTo('jokerhoker@gmail.com', 'List manager');

$mail->Subject = "PHPMailer Simple database mailing list test";


$bodyy = file_get_contents('contents.html');
//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($bodyy);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = '$msg';

//Connect to the database and select the recipients from your mailing list that have not yet been sent to
//You'll need to alter this to match your database
$con = getDB();
$result = mysqli_query($con, 'SELECT Name, Email FROM contact');

foreach ($result as $row) { //This iterator syntax only works in PHP 5.4+
    $mail->addAddress($row['Email'], $row['Name']);
   

    if (!$mail->send()) {
        echo "Mailer Error (" . str_replace("@", "&#64;", $row["Email"]) . ') ' . $mail->ErrorInfo . '<br />';
        break; //Abandon sending
    } else {
        echo "Message sent to :" . $row['Name'] . ' (' . str_replace("@", "&#64;", $row['email']) . ')<br />';
        //Mark it as sent in the DB
            }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();

}


});





$sc->run();
?>



    