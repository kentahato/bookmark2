<?php
//エラー表示
ini_set("display_errors", 1);

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:host=mysql1014.onamae.ne.jp;dbname=5jhoo_bookmark;charset=utf8mb4',
    '5jhoo_bookmark_user','*********');
} catch (PDOException $e) {
  exit('DBConnect Error:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL Errorr:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BookMark表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<link rel="stylesheet" href="css/style.css">
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>

<div class="container jumbotron">

<?php foreach($values as $v){ ?>

<div class="bookmark-card">

    <div class="book-title">
        📚 <?= htmlspecialchars($v["bookname"], ENT_QUOTES) ?>
    </div>

    <div class="book-url">
        🔗
        <a href="<?= htmlspecialchars($v["bookurl"], ENT_QUOTES) ?>" target="_blank">
            <?= htmlspecialchars($v["bookurl"], ENT_QUOTES) ?>
        </a>
    </div>

    <div class="book-comment">
        <?= nl2br(htmlspecialchars($v["bookcoment"], ENT_QUOTES)) ?>
    </div>

    <div class="button-area">

        <a href="detail.php?id=<?= $v["id"] ?>" class="edit-btn">
            ✏ 更新
        </a>

        <a href="delete.php?id=<?= $v["id"] ?>"
           class="delete-btn"
           onclick="return confirm('削除しますか？');">
            🗑 削除
        </a>

    </div>

</div>

<?php } ?>

</div>
</div>
<!-- Main[End] -->


<script>
  //JSON受け取り



</script>
</body>
</html>


