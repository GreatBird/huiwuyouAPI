<?php
include '../con.php';

    global $sql;
    global $tempSql;
    $arr=array();
    $finalArr=array();

    $test=file_get_contents("php://input");
    $data = json_decode($test,true); 

    $sql=$sql."select * from user_common where ";
    foreach ($data as $key => $value) {
        $tempSql=$tempSql.$key.' = '.'\''.$value.'\''.' and ';
    }
    $sql=$sql.substr($tempSql, 0,-4);
    
    //echo $sql;
    $result = mysqli_query($conn,$sql);
    //var_dump(mysqli_fetch_array($result));
    
    if ($result) {
             $count=0;

             while($row = mysqli_fetch_array($result))
                { 
                      foreach ($row as $key => $value) {
                        if (!is_int($key)) {
                            //echo 'key is '.$key.' and value is '.$value.'<br>';
                            if ($key=='password') {
                                continue;
                            }
                            $arr[$key]=$value;
                        }
                        //echo 'key is '.$key.' and value is '.$value.'<br>';
                        
                      }
                      $finalArr[$count]=$arr;
                      //echo 'count is '.$count;
                        $count=$count+1;
                }
       


    }else{
        $arr['code']=0;
        $arr['info']='query failed,reason is incorrect column name!';
    }

   
    echo json_encode($finalArr,JSON_UNESCAPED_UNICODE); 



$conn->close();

?>
