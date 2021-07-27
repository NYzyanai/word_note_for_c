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
        include('./function.php');
        mysqli_set_charset($link, "utf8");

        $book_id = $_POST['openbook'];
       
        //登録
        if (!empty($_POST['question'])&&!empty($_POST['answer'])&&!empty($_POST['regist'])) {
            resist_word($_POST['openbook'], $_POST['question'], $_POST['answer']);
        }


        if (!empty($_POST['openbook'])) {

            $result_book =
             mysqli_query($link, 
             "SELECT * FROM book_name where book_id='" . $_POST['openbook'] . "'");

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
            
            
            $there_word = are_there_words($book_id);
        ?>

            <?php if ($there_word == 0) : ?>

                <div style='text-align:center;'>
                    単語を登録しましょう！
                    <br>
                    <br>
                    <form method=post action='https://word-note.main.jp/openbook.php'>
                        <input type=hidden name='openbook' value=<?php echo  $book_id ?>>
                        <input type=hidden name='regist' value='regist'>
                        <p>
                            問題を登録する
                        </p>
                        <input type=text name='question' required>
                        <p>
                            回答を登録する
                        </p>
                        <input type=text name='answer' required>
                        <br>
                        <button>
                            登録！
                        </button>
                    </form>

                <?php else : ?>

                    単語帳が【
                    <?php echo  $there_word ?>
                    件】あります！

                    <br>

                    <div>
                        <form method=post action='https://word-note.main.jp/book.php'>
                            <input type=hidden name='openbook' value=<?php echo $book_id ?>>
                            <button class='clear_button createbookbutton' style='background-color:#e3f6f5;'>
                                スタート
                            </button>
                        </form>
                    </div>

                    <form method=post action='https://word-note.main.jp/openbook.php'>
                        <input type=hidden name='openbook' value=<?php echo $book_id ?>>
                        <input type=hidden name='regist' value='regist'>

                        <p>
                            問題を登録する
                        </p>
                        <input type=text name='question'>
                        <p>
                            回答を登録する
                        </p>
                        <input type=text name='answer'>
                        <br>
                        <button>
                            登録！
                        </button>
                    </form>
                </div>

            <?php endif; ?>
        <?php
        } else {
            echo "<br>";
            echo "単語帳を開けませんでした…";
            echo "<br>";
        }
        ?>

    </body>

</html>