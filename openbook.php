<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>スタート</title>
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
                <p>自分の、<br>自分による、<br>自分のための単語帳</p>
            </a>
        </div>
        <div class='sub_title'>
            <p>the word note of me,<br>by me,<br>for me</p>
        </div>
    </header>

    <form method=post action='https://word-note.main.jp/index.php'>
        <button class='clear_button'>
            <img src='./img/iconmonstr-undo-1-32.png'>
            もどる
        </button>
    </form>

    <body>
        <?php

        include('./login_safe.php');
        mysqli_set_charset($link, "utf8");
        if ($link) {
            //echo "リンクたっとる";
        } else {
            //echo "リンクたっとらん!";
        }

        if (!empty($_POST['openbook'])) {

            if (!empty($_POST['answer'])) {
                $result_regist_book = mysqli_query($link, "INSERT INTO words (book_id,word_id,question,answer,word_memo,last_answer_date,word_weight) VALUES ('" . $_POST['openbook'] . "', NULL, '" . $_POST['question'] . "','" . $_POST['answer'] . "',null,null,default)");
            }
            $result_open_book = mysqli_query($link, "SELECT * FROM words where book_id='" . $_POST['openbook'] . "'");

            $there_word = 0;

            $result_book = mysqli_query($link, "SELECT * FROM book_name where book_id='" . $_POST['openbook'] . "'");

            if ($result_book) {
                //echo "きとるやんけ";
            } else {
                //echo 'きとらんやんけ';
            }

            while ($row_book = mysqli_fetch_assoc($result_book)) {
                $book_id = $row_book["book_id"];
                $book_name = $row_book["book_name"];
                echo "<div style='text-align:center;'><h1>【" . $book_name . "】</h1>";
            }

            $book_id = $_POST['openbook'];
            //echo $book_id."の本を開くよ！";
            include('./function.php');
            $there_word=are_there_words($book_id);
            //echo $there_word."there_word";
            /*$count_word = 0;
            while ($open_book = mysqli_fetch_assoc($result_open_book)) {
                $count_word++;
                $there_word = 1;
            }*/

            if ($there_word == 0) {
                echo "<div style='text-align:center;'>単語を登録しましょう！<br><br>";
                echo "<form method=post action='https://word-note.main.jp/openbook.php'><input type=hidden name='openbook' value=" . $book_id . "><p>問題を登録する</p><input type=text name='question' required><p>回答を登録する</p><input type=text name='answer' required><br><button>登録！</button></form>";
            } else {
                echo "単語帳が【" . $there_word . "件】あります！";
                echo "<br><div><form method=post action='https://word-note.main.jp/book.php'><input type=hidden name='openbook' value=" . $book_id . "><button class='clear_button createbookbutton' style='background-color:#e3f6f5;'>スタート</button></form></div>";
                //echo "<form method=post action='https://localhost/openbook.php'><input type=hidden name='openbook' value=".$book_id."><p>問題を登録する</p><input type=text name='question'><p>回答を登録する</p><input type=text name='answer'><br><button>登録！</button></form>";
                echo "<br><br><br>";
                echo "<form method=post action='https://word-note.main.jp/openbook.php'><input type=hidden name='openbook' value=" . $book_id . "><p>問題を登録する</p><input type=text name='question' required><p>回答を登録する</p><input type=text name='answer' required><br><button>登録</button></form></div>";
            }
        } else {
            echo "<br>";
            echo "単語帳を開けませんでした…";
            echo "<br>";
        }
    ?>

    </body>

</html>