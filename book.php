    <!DOCTYPE html>
    <html>

    <head>
        <meta charaset="UTF-8">
        <title>Word_note</title>
        <!--やること
    ・関数を外に出してまとめる、メンテナンス性高める
    ・めちゃくちゃ可読性が低いので使っていない関数とかコメントアウトとか消す
    ・Echoじゃなくてもいい
    ・jQuery使ってみる！-->

        <link rel="stylesheet" href="./main.css">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    </head>

    <body>
        <?php if (!empty($_POST['openbook'])) : ?>
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
                    <form method=post action='https://word-note.main.jp/book.php'>
                        <input type='hidden' name='settings' value='settings'>
                        <input type=hidden name='book_id' value=" . $_POST['openbook'] . ">
                        <button class='settings_button'>
                            <img src='/img/iconmonstr-gear-6-32.png'>
                        </button>
                    </form>
                </div>
            </header>
            <?php
            include('./login_safe.php');
            $now = date("Y/m/d H:i:s");
            if (!empty($_POST['word_id'])) {
                $nowweight = $_POST['weight'];
                $addweight = $_POST['addweight'];
                $total_weight = $nowweight + $addweight;
                $update_book = mysqli_query($link, "update words set last_answer_date ='" . $now . "' where word_id='" . $_POST['word_id'] . "'");
                $update_book = mysqli_query($link, "update words set word_weight='" . $total_weight . "' where word_id='" . $_POST['word_id'] . "'");
            }
            $there_word = 0;
            //もし、○なら10日間出題されない。○が3回連続になったらALLモードでしか出ない。
            //もし△なら2日間でない。ただし△が2回連続になったら翌日出る。
            //×翌日出る
            //つまり、2回前の解答内容を保持しておく必要がある。
            mysqli_set_charset($link, "");
            $open_book = mysqli_query(
                $link,
                "SELECT * FROM words where book_id='" . $_POST['openbook'] . "' order by word_weight limit 1"
            );
            while ($row_book = mysqli_fetch_assoc($open_book)) {
                $book_id = $row_book["book_id"];
                $word_id = $row_book["word_id"];
                $weight = $row_book["word_weight"];
                $question = $row_book["question"];
                $answer = $row_book["answer"];
                $there_word = 1;
            }
            ?>
            <h2 id='question' onclick='clickBtn2()'><?php echo $question ?></h2>
            <br>
            <h2 id='answer'>
                <?php echo $answer ?>
            </h2>
            <div id='putin_button'>
                <div id='batu'>
                    <form method=post action='https://word-note.main.jp/book.php'>
                        <input type=hidden name='openbook' value=<?php echo  $book_id ?>>
                        <input type=hidden name='addweight' value=0.2>
                        <input type=hidden name='weight' value=<?php echo $weight ?>>
                        <input type=hidden name='word_id' value=<?php echo  $word_id ?>>
                        <button class='clear_button'>
                            <img src='./img/iconmonstr-smiley-3-240.png' class='iconcolor'>
                        </button>
                </div>
                <div id='sankaku'>
                    <form method=post action='https://word-note.main.jp/book.php'>
                        <input type=hidden name='openbook' value=<?php echo  $book_id ?>>
                        <input type=hidden name='addweight' value=0.5>
                        <input type=hidden name='weight' value=<?php echo $weight ?>>
                        <input type=hidden name='word_id' value=<?php echo  $word_id ?>>
                        <button class='clear_button'>
                            <img src='./img/iconmonstr-paperclip-2-240.png' class='iconcolor'>
                        </button>
                </div>
                <div id='maru'>
                    <form method=post action='https://word-note.main.jp/book.php' name='form1'>
                        <input type=hidden name='openbook' value=<?php echo  $book_id ?>>
                        <input type=hidden name='addweight' value=1>
                        <input type=hidden name='weight' value=<?php echo $weight ?>>
                        <input type=hidden name='word_id' value=<?php echo  $word_id ?>>
                        <button class='clear_button' onclick='yeahBtn()'>
                            <img src='./img/iconmonstr-smiley-1-240.png' class='iconcolor'>
                        </button>
                        <div class='clear'>
                    </form>
                </div>
            </div>
            <div class='clear'></div>
            </div>
            <br>
            <br>
            <div class='return'>
                <a href='https://word-note.main.jp/index.php'>
                    もどる
                </a>
            </div>
            <?php if ($there_word == 0) : ?>
                <div style='float:left;'>
                    <form method=post action='https://word-note.main.jp/index.php'>
                        <button class='clear_button'>
                            <img src='./img/iconmonstr-undo-1-32.png'>
                        </button>
                    </form>
                </div>単語を登録しましょう！<br><br>
                <form method=post action='https://word-note.main.jp/openbook.php'>
                    <input type=hidden name='openbook' value=" . $book_id . ">
                    <p>問題を登録する</p>
                    <input type=text name='question'>
                    <p>回答を登録する</p>
                    <input type=text name='answer'>
                    <br>
                    <button>登録！</button>
                </form>
            <?php endif; ?>
        <?php elseif (!empty($_POST['settings'])) : ?>
            <header class='header'>
                <form action='https://word-note.main.jp/index.php' method=post>
                    <div class='main_title'>
                        <a href='https://word-note.main.jp/index.php'>
                            <p>自分の、
                                <br>自分による、
                                <br>自分のための単語帳
                            </p>
                        </a>
                    </div>
                </form>
                <div class='sub_title'>
                    <p>
                        the word note of me,
                        <br>
                        by me,
                        <br>
                        for me
                    </p>
                </div>
            </header>
            <div>
                <div>
                    <form method=post action='https://word-note.main.jp/book.php'>
                        <?php echo "<input type=hidden name='openbook' value='" . $_POST[' book_id'] . "'>"; ?>
                        <button id='return' class='clear_button'>
                            <img src='./img/iconmonstr-undo-1-32.png'>
                        </button>
                    </form>
                </div>
                <div>
                    <h1 style='margin:0; float:left;'>
                        単語帳の設定
                    </h1>
                    <div class='clear'>
                    </div>
                </div>
                <?php
                include('./login_safe.php');
                $setting_book = mysqli_query($link, "SELECT * FROM words where book_id='" . $_POST['book_id'] . "' order by word_weight limit 1");
                $zero_book = 0;
                while ($set_book = mysqli_fetch_assoc($setting_book)) {
                    $word_id = $set_book['word_id'];
                    $zero_book = 1;
                }
                ?>
                <form method=post action='https://word-note.main.jp/settings.php'>
                    <div class='settings_card'>
                        【質問】<br>
                        <textarea name='question' type='text' rows='2' cols='40'>
            <?php $set_book['question'] ?>
            </textarea>
                    </div>
                    <br>
                    <div class='settings_card'>
                        【解答】
                        <br>
                        <textarea name='answer' type='text' rows='2' cols='40'>
            <?php $set_book['answer'] ?>
            </textarea>
                    </div>
                    <?php
                    $settings_bookname = mysqli_query($link, "SELECT * FROM book_name");
                    ?>
                    <br>
                    <div class='settings_card'>
                        【所属単語帳】
                        <br>
                        <select name='book'>
                            <?php
                            while ($set_bookname = mysqli_fetch_assoc($settings_bookname)) {
                                $book_id_result = $set_bookname['book_id'];
                                if ($book_id_result == $_POST['book_id']) {
                                    echo "<option selected>" . $set_bookname['book_name'] . "</option>";
                                } else {
                                    echo "<option>" . $set_bookname['book_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <input type='hidden' name='settings' value='rewrite'>
                    <input type=hidden name='word_id' value='" . $word_id . "'>
                    <input type=hidden name='book_id' value=" . $_POST['book_id'] . ">
                    <br>
                    <div style='text-align:center;'>
                        <button class='clear_button'>
                            <img src='./img/iconmonstr-synchronization-11-64.png' width='46' height='46' style='float:left; margin-top:0.5em'>
                            <h2 style='float:left;'>
                                この単語の設定を保存する
                            </h2>
                        </button>
                </form>
            </div>
            <br>
            <form method=post action='./settings.php'>
                <input type=hidden name='word_id' value='" . $word_id . "'>
                <?php
                echo "<input type=hidden name='book_id' value='" . $_POST['book_id'] . "'>";
                ?>
                <input type=hidden name='settings' value='delete'>
                <input type=hidden name='question' value=" . $set_book['question'] . ">
                <div style='text-align:center;'>
                    <button class='clear_button'>
                        <img src='./img/iconmonstr-warning-6-64.png' width='46' height='46' style='float:left; margin-top:0.5em'>
                        <h2 style='float:left;'>
                            この単語を削除する</h2>
                    </button>
            </form>
            </div>

        <?php else : ?>
            <header class='header'>
                <div class='main_title'>
                    <a href='https://word-note.main.jp/index.php'>
                        <p>
                            自分の、
                            <br>
                            自分による、
                            <br>
                            自分のための単語帳
                        </p>
                    </a>
                </div>
            </header>
            <br>
            うまくスタートできませんでした…
            <br>
            <br>
            <div>
                <a href="https://word-note.main.jp/index.php">
                </a>
            </div>
        <?php endif; ?>
        </div>
    </body>

    </html>

    <script>
        console.log(document.getElementById("answer"))
        if (document.getElementById("answer") == null) {
            console.log("nullだよー");
        } else {
            console.log("nullじゃないよー");
            document.getElementById("answer").style.visibility = "hidden";
        }

        function clickBtn2() {
            const answer = document.getElementById("answer");
            if (answer.style.visibility == "visible") {
                // hiddenで非表示
                answer.style.visibility = "hidden";
            } else {
                // visibleで表示
                answer.style.visibility = "visible";
            }
        }

        function settings() {}

        function yeahBtn() {
            //const maru
            const sankaku = document.getElementById("sankaku");
            const batu = document.getElementById("batu");
            //const page =document.getElementByid("page");
            if (sankaku.className != 'hidden_button') {
                sankaku.className = "hidden_button";
            }
            if (batu.className != 'hidden_button') {
                batu.className = "hidden_button";
            }
        }
    </script>