<?php
 
 require_once 'conn.php';
 header('Content-Type: application/json');
 /**
 User Registeration
 */
 class Register
 {
 private $db;
 private $connection;
 function __construct()
 {
 //constructor call
 $this->db = new Connection();
 $this->connection=$this->db->get_connection();
 }
 public function does_user_exist($name,$mail,$mobile)
 {
 // does user already exist or not
 $query = "SELECT * FROM test WHERE Email='$mail'";
 $result=mysqli_query($this->connection,$query);
 if(mysqli_num_rows($result)>0){
$json['status']=400;
$json['message']=' Sorry '.$mail.' is already exist.';
   echo json_encode($json);
   mysqli_close($this->connection);
 }else {
   $query="insert into test(name,email,mobile) values('$name','$mail','$mobile')";
   $is_inserted=mysqli_query($this->connection,$query);
   if($is_inserted == 1){
$json['status']=200;
     $json['message']='Account created, Welcome '.$name;
   }else {
$json['status']=401;
     $json['message']='Something wrong';
   }
   echo json_encode($json);
   mysqli_close($this->connection);
 }
 } 
 }
 $register=new Register();
 if(isset($_GET['name'],$_GET['email'],$_GET['mobile']))
 {
   $name=$_GET['name'];
   $mail=$_GET['email'];
   $mobile=$_GET['mobile'];
 if (!empty($name) && !empty($mail) && !empty($mobile) ) {
    
     $register-> does_user_exist($name,$mail,$mobile);
   }else {
$json['status']=100;
     $json['message']='You must fill all the fields';
     echo json_encode($json);
   }
 }

 public function sendResponse($name,$email,$mobile) {

    $response = '<?xml version="1.0" encoding="utf-8"?>';
    $response .= '<response><status>'.$type.'</status>';

            $response = $response.'<remarks>'.$cause.'</remarks></response>';
            return $response;
 }

 ....
 ....

 header("Content-type: text/xml; charset=utf-8");
 echo sendResponse($name,$email,$mobile);
?>