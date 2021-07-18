<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>Word_note</title>
    <!--単語帳を作ろう！
        ログイン機能があったらいいよね
        追加・削除・更新・読み込み機能(MySQL)機能を備えているのが必須
        ブラウザで動作確認ができること
        コードが閲覧できること-->

    <link rel="stylesheet" href="main.css" />
    <link rel="icon" href="./favicon.ico" id="favicon">
</head>


<body>
    <header class="header">
        <div class="main_title">
            <a href='https://word-note.main.jp/'>
                <p>自分の、<br>自分による、<br>自分のための単語帳</p>
            </a>
        </div>

        <div class="sub_title">
            <form method=post action='https://word-note.main.jp/settings.php'><input type='hidden' name='settings' value='total_settings'><button class='settings_button'><img src='/img/iconmonstr-gear-6-32.png'></button></form>
        </div>
    </header>

    <?php

    ?>

    <br><br>



    <?php
    include('./login_safe.php');
    include('./function.php');





    if (!mysqli_connect_errno()) {


        if (!empty($_POST['book_name'])) {
            $book_name = $_POST['book_name'];
            $book_memo = $_POST['book_memo'];
            $create_book_result = mysqli_query(
                $link,
                "INSERT INTO book_name (book_id,book_name,book_memo,create_date,access_date) VALUES (NULL, '" . $book_name . "', '" . $book_memo . "',default,NULL)"
            );
        }

        // 文字化け防止
        mysqli_set_charset($link, "utf8");

        revealbook();
        $count_word_book = 0;
        echo $echo;
        if (!empty($result_book)) {
            echo "20210718 追加改修中　もし変な点があれば下部報告フォームをご利用ください";
        } else {
            echo "呼べてないよ";
        }
        while ($row_book = mysqli_fetch_assoc($result_book)) {
            $all_book = $row_book["book_id"];
            $book_id = $row_book["book_id"];
            $count_word_book++;
            echo "<form method=post action='https://word-note.main.jp/openbook.php'>
                            <input type=hidden name='openbook' value=" . $book_id . ">
                            <button class='bookindex'>" . $row_book["book_name"] . "</button>
                        </form>";
        }
    }
    ?>
    <form action='./create_book.php'>
        <button class='createbookbutton'>
            あたらしい単語帳を作る</button>
    </form>
<div style="text-align:center;">
<iframe src="https://docs.google.com/forms/d/e/1FAIpQLSf6u2CD9OHCPeYrSV7NDmlLVEzj9WjdDp_FVRGxsy4Yz3JSRg/viewform?embedded=true" width="640" height="372" frameborder="0" marginheight="0" marginwidth="0" >読み込んでいます…</iframe>
</div>
</body>

</html>