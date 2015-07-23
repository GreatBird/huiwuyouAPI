
<?php

include '../con.php';

$test=file_get_contents("php://input");
$data = json_decode($test,true); 



$username=$data['username'];
$password=$data['password'];
if (strlen($username)>0&&strlen($password)>0) {
	
$selectS = mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");

global $usern;
global $pass;
while($row = mysqli_fetch_array($selectS))
{
      $pass=$row['password'];
      $usern=$row['username'];
}

if($username==$usern){
	if($pass==$password){
	    $arr = array ('code'=>1,'username'=>$username); 
		}else{
	    $arr = array ('code'=>0,'msg'=>'wrong password'); 
    }
}

else{
        $arr = array ('code'=>0,'msg'=>'username not exist'); 
}
}
else{
        $arr = array ('code'=>0,'msg'=>'username or password cannot be empty '); 

}
        //$arr["json"]=json_encode($arr,JSON_UNESCAPED_UNICODE);
        echo json_encode($arr,JSON_UNESCAPED_UNICODE); 





$conn->close();

?>
