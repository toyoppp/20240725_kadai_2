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
    <title>データ登録</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <nav class="navbar">
        <a href="select.php">データ一覧</a>
        <a href="login.php">ログイン</a>
        <form class="logout-form" action="logout.php" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
                <button type="submit" class="logout-button">ログアウト</button>
            </form>
        </form>
    </nav>

    <div class="container">
        <h1>フリーアンケート</h1>

        <form method="POST" action="insert.php">
            <fieldset>
                <div class="form-group">
                    <label for="name">名前：</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email：</label>
                    <input type="text" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="age">年齢：</label>
                    <input type="text" id="age" name="age">
                </div>
                <div class="form-group">
                    <label for="naiyou">内容：</label>
                    <textarea id="naiyou" name="naiyou" rows="4"></textarea>
                </div>
                <input type="submit" value="送信">
            </fieldset>

        </form>
    </div>
</body>

</html>