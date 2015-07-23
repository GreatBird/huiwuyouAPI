
<?php

include '../con.php';

$test=file_get_contents("php://input");
    $data = json_decode($test,true); 



$phone=$data['phone'];
$password=$data['password'];
if (strlen($phone)>0&&strlen($password)>0) {
  
$selectS = mysqli_query($conn,"SELECT * FROM user_common WHERE phone='$phone'");

global $usern;
global $pass;
while($row = mysqli_fetch_array($selectS))
{
      $pass=$row['password'];
      $usern=$row['phone'];
}

if($phone==$usern){
  if($pass==$password){
      $arr = array ('code'=>1,'phone'=>$phone); 
    }else{
      $arr = array ('code'=>0,'msg'=>'wrong password'); 
    }
}

else{
        $arr = array ('code'=>0,'msg'=>'phone not exist'); 
}
}
else{
        $arr = array ('code'=>0,'msg'=>'phone or password cannot be empty '); 

}
        //$arr["json"]=json_encode($arr,JSON_UNESCAPED_UNICODE);
        echo json_encode($arr,JSON_UNESCAPED_UNICODE); 





$conn->close();

?>
