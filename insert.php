<?php
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$bookname = $_POST["bookname"];
$bookurl = $_POST["bookurl"];
$bookcoment = $_POST["bookcoment"];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:host=mysql1014.onamae.ne.jp;dbname=5jhoo_bookmark;charset=utf8mb4',
    '5jhoo_bookmark_user','*********');
} catch (PDOException $e) {
  exit('DBConnect Error:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql="INSERT INTO gs_bm_table(bookname,bookurl,bookcoment,indate)VALUES(:bookname, :bookurl,:bookcoment,sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookname', $bookname,);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookcoment', $bookcoment);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
header("location: index.php");
exit();

}
?>
