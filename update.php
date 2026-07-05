<?php

$id=$_POST["id"];
$bookname=$_POST["bookname"];
$bookurl=$_POST["bookurl"];
$bookcoment=$_POST["bookcoment"];

try{

$pdo=new PDO(
'mysql:host=mysql1014.onamae.ne.jp;dbname=5jhoo_bookmark;charset=utf8mb4',
'5jhoo_bookmark_user',
'*********'
);

}catch(PDOException $e){

exit($e->getMessage());

}

$sql="UPDATE gs_bm_table
SET

bookname=:bookname,
bookurl=:bookurl,
bookcoment=:bookcoment

WHERE id=:id";

$stmt=$pdo->prepare($sql);

$stmt->bindValue(":bookname",$bookname);
$stmt->bindValue(":bookurl",$bookurl);
$stmt->bindValue(":bookcoment",$bookcoment);
$stmt->bindValue(":id",$id,PDO::PARAM_INT);

$status=$stmt->execute();

if($status==false){

$error=$stmt->errorInfo();

exit($error[2]);

}else{

header("Location: select.php");

exit();

}