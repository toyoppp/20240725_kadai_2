<?php

session_start();

require_once('funcs.php');

loginCheck();

$id = $_GET['id']; //?id~**を受け取る
require_once('funcs.php');
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_an_table WHERE id=:id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ更新</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Head[Start] -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
        </div>
    </nav>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div class="container">
        <h1>編集</h1>

        <form method="POST" action="update.php">
            <div class="jumbotron">
                <fieldset>
                    <label>名前：<input type="text" name="name" value="<?= $row['name'] ?>"></label><br>
                    <label>Email：<input type="text" name="email" value="<?= $row['email'] ?>"></label><br>
                    <label>年齢：<input type="text" name="age" value="<?= $row['age'] ?>"></label><br>
                    <label><textArea name="naiyou" rows="4" cols="40"><?= $row['naiyou'] ?></textArea></label><br>
                    <input type="submit" value="送信">
                    <input type="hidden" name="id" value="<?= $id ?>">
                </fieldset>
            </div>
        </form>
    </div>
    <!-- Main[End] -->


</body>

</html>