<?php

session_start();
require_once dirname(__FILE__) . "/functions.php";

$pdo = connect();
if(isset($_POST)) {

    $trimedString = str_replace("\r\n", "", str_replace("\r", "", str_replace("\n", "", str_replace("\t", "", str_replace("　", "", str_replace(" ", "", $_POST["message"]))))));
    if((validateToken($_POST["token"]) && ($trimedString !== ""))) {
        $name = $_POST["name"] !== "" ? $_POST["name"] : "Unknown";
        $message = $_POST["message"];

        try {
            $pdo -> beginTransaction();
            $sql = "INSERT INTO kakikomi(name, message) VALUES(:name, :message)";
            $stmt = $pdo -> prepare($sql);
            $stmt -> bindValue("name", $name);
            $stmt -> bindValue("message", $message);
            $stmt -> execute();
            $pdo -> commit();
        } catch(\Exception $e) {
            // echo $e -> getMessage() . "<br>";
            // echo $e -> getLine() . "<br>";
            echo "Post Error...<br>書き込みに失敗しました。<br>";
        }
        
    }
    
}

try {
    $sql = "SELECT * FROM kakikomi ORDER BY date DESC";
    $stmt = $pdo -> prepare($sql);
    $loadResult = $stmt -> execute();
    $messages = $stmt -> fetchAll();
} catch(\Exception $e) {
    // echo $e -> getMessage() . "<br>";
    // echo $e -> getLine() . "<br>";
    $loadResult = false;
    $messages = [];
}
$mscount = count($messages);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>KEIJI BAN</title>
</head>
<body>
    <h1>簡易掲示板</h1>
    <div class="submit-container">
        <form action="" class="submit-form" id="submit-form" method="POST">
        <input class="submit-token" type="hidden" name="token" value="<?= setToken(); ?>" form="submit-form">
        <input class="submit-name" type="text" name="name" placeholder="名前を入力してください（省略可）" form="submit-form">
        <textarea class="submit-message" name="message" placeholder="メッセージを入力してください（必須）" form="submit-form" required></textarea>
        <button class="submit-button" form="submit-form">送信</button>
    </div>
    <main>
        <?php if($loadResult) : ?>
        <?php if(!$mscount == 0) : ?>
        <?php foreach($messages as $msg) : ?>
        <div class="message-container">
        <p class="message-header">
            <small class="id"><?= h($msg["id"]); ?></small>
            <small class="name"><?= h($msg["name"]); ?></small>
            <small class="date"><?= h($msg["date"]); ?></small>
        </p>
        <p class="message">
            <?= nl2br(h($msg["message"])); ?>
        </p>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <p>No message.<br>メッセージがまだありません。</p>
        <?php endif; ?>
        <?php else : ?>
        <p>Load error.<br>メッセージの読み込みに失敗しました。</p>
        <?php endif; ?>
    </main>
</body>
</html>