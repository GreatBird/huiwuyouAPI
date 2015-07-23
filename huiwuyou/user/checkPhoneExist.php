
<?php

include '../con.php';

$test=file_get_contents("php://input");
    $data = json_decode($test,true); 

$phone=$data['phone'];

if (strlen($phone)>0) {
	
$selectS = mysqli_query($conn,"SELECT * FROM user_common WHERE phone='$phone'");


global $usern;

while($row = mysqli_fetch_array($selectS))
{
      $usern=$row['phone'];
}


if ($usern==$phone) {
    $arr = array ('code'=>0,'msg'=>'phone already exist!'); 
}else{
    $arr = array ('code'=>1,'msg'=>'phone does not exist!'); 
}



}
else{
        $arr = array ('code'=>0,'msg'=>'can not be null'); 

}
        //$arr["json"]=json_encode($arr,JSON_UNESCAPED_UNICODE);
        echo json_encode($arr,JSON_UNESCAPED_UNICODE); 





$conn->close();

?>
