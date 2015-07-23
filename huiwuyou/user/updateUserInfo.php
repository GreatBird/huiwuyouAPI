<?php
include '../con.php';

//$nickname=$_POST['nickname'];


$test=file_get_contents("php://input");
$data = json_decode($test,true); 
//nickname 为id 具有唯一性
$nickname=$data['id'];

if ($nickname!=null && strlen($nickname)>0) {
    global $usern;
    $selectS = mysqli_query($conn,"SELECT * FROM user_common WHERE id='$nickname'");
    while($row = mysqli_fetch_array($selectS))
    {
      $usern=$row['id'];
    }
    //验证数据库中是否有数据
    if ($nickname==$usern) {
        global $sql;
        $sql=$sql."update user_common set ";
        foreach ($data as $key => $value) {
            $sql=$sql.$key.' = '.'\''.$value.'\''.' ,';
        }
        $sql= substr($sql,0,strlen($sql)-1); 
        $sql=$sql."where id='$nickname'";
        //echo $sql;
        mysqli_query($conn,$sql);
        $arr = array ('code'=>1,'info'=>'update success and id is '.$nickname); 
    }else{
        $arr = array ('code'=>0,'info'=>'update failed id not exist'); 
    }
        //$arr["json"]=json_encode($arr,JSON_UNESCAPED_UNICODE);
        echo json_encode($arr,JSON_UNESCAPED_UNICODE); 
}


$conn->close();

?>
