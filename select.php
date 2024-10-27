<?php
// 0. SESSION開始！！
session_start();

// 1. ログインチェック処理！


//１．関数群の読み込み
require_once('funcs.php');

loginCheck();

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_an_table');
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フリーアンケート表示</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body id="main">
    <nav class="navbar">
        <a class="navbar-brand" href="index.php">データ登録</a>
        <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
    </nav>

    <div class="container">
        <h1>フリーアンケート一覧</h1>
        <div class="card-container">
            <?php while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <div class="card">
                    <div class="card-title"><?= h($r['name']) ?></div>
                    <div class="card-content">
                        <p>メール: <?= h($r['email']) ?></p>
                        <p>年齢: <?= h($r['age']) ?></p>
                    </div>
                    <div class="card-actions">
                        <a class="btn btn-primary" href="detail.php?id=<?= $r['id'] ?>">詳細</a>

                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                            <input type="submit" value="削除" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>