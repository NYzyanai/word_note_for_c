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


<body>

    <header class='header'>
        <div class='main_title'>
            <a href='https://word-note.main.jp/index.php'>
                <p>自分の、
                    <br>自分による、
                    <br>自分のための単語帳
                </p>
            </a>
        </div>
        <div class='sub_title'>
            <p>the word note of me,
                <br>by me,
                <br>for me
            </p>

        </div>
    </header>

    <?php
    include('./login_safe.php');
    include('./function.php');
    $book_name = $_POST['book_name'];
    $book_memo = $_POST['book_memo'];
    mysqli_set_charset($link, "utf8");
    $return_result_book = create_book($book_name, $book_memo);
    ?>

    <?php if (!empty($return_result_book)) : ?>

        <p style='text-align:center;'>
            単語帳【<?php echo $book_name  ?>】を作成しました！
        </p>

        <form method=post action='https://word-note.main.jp/openbook.php'>
            <input type=hidden name='openbook' value='<?php echo $return_result_book  ?>'>
            <button class='createbookbutton'>さっそく単語を登録する
            </button>
        </form>

    <?php else : ?>
        <h1>単語帳の数が20個を超えています！
            <br>さすがに多いので20個以下にしてください！
        </h1>

    <?php endif; ?>


    <form method=post action='https://word-note.main.jp/index.php'>
        <button class='clear_button'>
            <img src='./img/iconmonstr-undo-1-32.png'>
            もどる
        </button>
    </form>

</body>

</html>