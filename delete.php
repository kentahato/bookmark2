<?php

$id=$_GET["id"];

try{

$pdo=new PDO(
'mysql:host=mysql1014.onamae.ne.jp;dbname=5jhoo_bookmark;charset=utf8mb4',
'5jhoo_bookmark_user',
'*********'
);

}catch(PDOException $e){

exit($e->getMessage());

}

$stmt=$pdo->prepare("DELETE FROM gs_bm_table WHERE id=:id");

$stmt->bindValue(":id",$id,PDO::PARAM_INT);

$status=$stmt->execute();

if($status==false){

$error=$stmt->errorInfo();

exit($error[2]);

}else{

header("Location: select.php");

exit();

}