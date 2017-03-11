<?php


require_once('Slim/Slim.php');
require_once('db.php');
require '../pmail/PHPMailerAutoload.php';

\Slim\Slim::registerAutoloader();

$sc = new \Slim\Slim();
 
header('Content-Type: application/json');

$sc->contentType("application/json");

$sc->post('/login',function() use($sc){
    $con = getDB();
    $body = json_decode($sc->request->getBody());
    $username = mysqli_real_escape_string($con,$body->data->username);
    $password = md5(mysqli_real_escape_string($con,$body->data->password));

    $verify = mysqli_query($con, "SELECT * FROM `admins` WHERE `username`='$username' AND `password`='$password'  ") or die(throw_error(mysqli_error($con)));

    if(mysqli_num_rows($verify) == 1){
        $session_vars = mysqli_fetch_array($verify);
        //$auth_code = generateAuthCode(9);
        session_start();
        $_SESSION['logged_in'] = "yes";

    

        print_r(json_encode((array("status"=>"success","message"=>"Sign in was successfull.","data"=>null))));

    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"Username or password is wrong.","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});


$sc->put('/admins/:a_id',function($a_id) use($sc){
    

	$con = getDB();
	$a_id = mysqli_escape_string($con,$a_id);
      $body = json_decode($sc->request->getBody());
   	 $username = mysqli_real_escape_string($con,$body->data->username);
    $password = md5(mysqli_real_escape_string($con,$body->data->password));

    
    if(mysqli_query($con, "UPDATE admins SET username='$username',password='$password' WHERE id='$a_id' "))
    {
    	print_r(json_encode((array("status"=>"success","message"=>"Username with id ".$a_id." is updated.","data"=>null))));

    }
     else{

        print_r(json_encode((array("status"=>"fail","message"=>"Nothing updated. Wrong input.","data"=>null))));

    }

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

$sc->get('/admins/all',function() use($sc){

$con = getDB();
$query = mysqli_query($con,"SELECT username FROM admins") or  die(throw_error(mysqli_error($con)));
 if(mysqli_num_rows($query) > 0){

            $output =  array();
         while ($data = mysqli_fetch_array($query)) {        
         	$user = $data['username'];
                array_push($output, array("username"=>$user));
            }

            print_r((json_encode(array("status"=>"success","message"=>"these are the list of admins","data"=>$output))));
        

        
    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"No data in database","data"=>null))));

    }

    mysqli_close($con);
    $sc->stop();

});

$sc->get('/get_crequests/:page',function($page) use($sc){
$con = getDB();
$page = mysqli_escape_string($con, $page);

$lim = 1;
if($page==""||$page=="1"){
$page1=0;

}
else
{
$page1=($page*$lim)-$lim;

}

$res = mysqli_query($con,"SELECT * FROM contact limit $page1,$lim");
$output = array();
while($row=mysqli_fetch_array($res))
{

    array_push($output, array("Name"=>$row['Name'],"Email"=>$row['Email'],"Telephone"=>$row['Tel'],"Contact Details"=>$row['Contact']));
   


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
 
  array_push($output, array("s_no"=>$row['s_id'],"type"=>$row['type'],"email"=>$row['email'],"Tel"=>$row['tel'],"description"=>$row['description']));
   

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
        // $session_vars = mysqli_fetch_array($verify);
        //$auth_code = generateAuthCode(9);
        // session_start();
        // $_SESSION['logged_in'] = "yes";

       //  $_SESSION['access_id'] = $session_vars['a_id'];
       // $_SESSION['auth_level'] = $session_vars['auth_level'];
       //  $_SESSION['username'] = $session_vars['username'];
       //  $_SESSION['name'] = $session_vars['name'];

        print_r(json_encode((array("status"=>"success","message"=>"Admin added successfully.","data"=>null))));

    }
    else{

        print_r(json_encode((array("status"=>"fail","message"=>"Username already in use.","data"=>null))));

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


$sc->post('/contact_requests',function() use($sc){
$con = getDB();
    $body = json_decode($sc->request->getBody());
    $name = mysqli_real_escape_string($con,$body->data->name);
    $contact = mysqli_real_escape_string($con,$body->data->contact);
    $email = mysqli_real_escape_string($con,$body->data->email);
    $tel = mysqli_real_escape_string($con,$body->data->tel);

     if(mysqli_query($con, "INSERT  into  contact (Name,Email,Tel,Contact) VALUES('$name','$email','$tel','$contact')")){
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



