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

$stmt=$pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status=$stmt->execute();

$v=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head>

<meta charset="UTF-8">

<title>更新</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

</head>

<body>

<header>

<nav class="navbar navbar-default">

<div class="container-fluid">

<div class="navbar-header">

<a class="navbar-brand" href="select.php">
データ一覧
</a>

</div>

</div>

</nav>

</header>

<form action="update.php" method="post">

<div class="jumbotron">

<fieldset>

<legend>BookMark更新</legend>

<input type="hidden" name="id"
value="<?= $v["id"] ?>">

<label>

書籍名

<input type="text"
name="bookname"
value="<?= htmlspecialchars($v["bookname"],ENT_QUOTES) ?>">

</label>

<label>

URL

<input type="text"
name="bookurl"
value="<?= htmlspecialchars($v["bookurl"],ENT_QUOTES) ?>">

</label>

<label>

<textarea
name="bookcoment"
rows="5"><?= htmlspecialchars($v["bookcoment"],ENT_QUOTES) ?></textarea>

</label>

<input type="submit" value="更新">

</fieldset>

</div>

</form>

</body>
</html>