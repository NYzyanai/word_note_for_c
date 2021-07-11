<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>単語帳作成</title>
    <!--単語帳を作ろう！
        ログイン機能があったらいいよね
        追加・削除・更新・読み込み機能(MySQL)機能を備えているのが必須
        ブラウザで動作確認ができること
        コードが閲覧できること-->

    <link rel="stylesheet" href="main.css" />

</head>

<?php

echo "<header class='header'>
            <div class='main_title'>
            <a href='https://word-note.main.jp/index.php'><p>自分の、<br>自分による、<br>自分のための単語帳</p></a>
            </div>";
echo "<div class='sub_title'>
            <p>the word note of me,<br>by me,<br>for me</p>

            </div></header>";

echo "<form method=post action='https://word-note.main.jp/index.php'>
                <button class='clear_button'>
                <input type=hidden name='openbook' value='" . $_POST['book_id'] . "'>
                <img src='./img/iconmonstr-undo-1-32.png'>
                もどる
                </button>
                </form>";

?>


<body>
    <div class="login">
        <form action="https://word-note.main.jp/created_book.php" method="post">
            <p>単語帳のタイトル</p>
            <input type="text" name="book_name" required>
            <p>説明</p>
            <input type="text" name="book_memo">
            <br>
            <input type="submit" text="作成！">
        </form>
    </div>


</body>

</html>