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
    <?php
    include('./login_safe.php');
    include('./function2.php'); ?>
</head>

<header class='header'>
    <div class='main_title'>
        <a href='https://word-note.main.jp/index.php'>
            <p>自分の、<br>自分による、<br>自分のための単語帳</p>
        </a>
    </div>
    <!--設定に来た時だけ出さないようにしたい-->
    <?php if (empty($_POST['settings'])) : ?>
        <div class='sub_title'>
            <form method=post action='https://word-note.main.jp/book2.php'>
                <input type='hidden' name='settings' value='settings'>
                <input type=hidden name='book_id' value="<?php echo $_POST['openbook'] ?>">
                <button class='settings_button'><img src='/img/iconmonstr-gear-6-32.png'>
                </button>
            </form>
        </div>
    <?php else : ?>
        <div class='sub_title'>
            <p>the word note of me,<br>by me,<br>for me</p>
        </div>
    <?php endif; ?>
</header>


<body>

    <?php

/*echo "IDは【「".$_POST['word_id'],
"アンサーは【「".$_POST['answer'],
"ファーストアンサーは【「".$_POST['first_answer'],
"セカンドアンサーは【「".$_POST['second_answer'];*/

    if (!empty($_POST['openbook'])) :

        //もし、○なら10日間出題されない。○が3回連続になったらALLモードでしか出ない。
        //もし△なら2日間でない。ただし△が2回連続になったら翌日出る。
        //×翌日出る
        //つまり、2回前の解答内容を保持しておく必要がある。
    ?>



        <?php
        if (!empty($_POST['word_id'])) {

            $result = answer_card(
                $_POST['word_id'],
                $_POST['answer'],
                $_POST['first_answer'],
                $_POST['second_answer']
            );


            if (!empty($result)) {
                //echo "書き換え完了";
            } else {
                //echo "書き換えがうまくいっていない";
            }
        }
        $there_word = 0;


        mysqli_set_charset($link, "");
        $open_card = open_card($_POST['openbook']);


        while ($row_book = mysqli_fetch_assoc($open_card)) {

            $book_id = $row_book["book_id"];
            $word_id = $row_book["word_id"];
            $question = $row_book['question'];
            $answer = $row_book['answer'];
            $word_memo = $row_book['word_memo'];
            $last_answer_date = $row_book['last_answer_date'];


            $first_answer = $row_book["first_answer"];
            $second_answer = $row_book["second_answer"];
            $clear_flag = $row_book["clear_flag"];

            $there_word = 1;
        } ?>

        <?php if ($there_word != 0) : ?>
      <?php 
            if ($first_answer<>""){


                echo "最後に解いた日：".$last_answer_date;
             } ?>
            <h2 id='question' onclick='clickBtn2()'>
                <?php echo $question ?>
            </h2>
            <br>

            <h2 id='answer'>
                <?php echo $answer ?>
            </h2>

            <div id='putin_button'>

                <div id='batu'>

                    <form method=post action='https://word-note.main.jp/book2.php'>

                        <input type=hidden name='openbook' value=<?php echo  $book_id ?>>

                        <input type=hidden name='word_id' value=<?php echo  $word_id ?>>

                        <!--<input type=hidden name='addweight' value=0.2>-->

                        <input type=hidden name='last_answer_date' value=<?php echo  $last_answer_date ?>>

                        <input type=hidden name='weight' value=<?php echo  $weight ?>>

                        <input type=hidden name='first_answer' value=<?php echo  $first_answer ?>>
                        <input type=hidden name='second_answer' value=<?php echo  $second_answer ?>>

                        <input type=hidden name='answer' value="0">
                        <input type=hidden name='clear_flag' value=<?php echo  $clear_flag ?>>



                        <button class='clear_button'>
                            <img src='./img/iconmonstr-smiley-3-240.png' class='iconcolor'>
                        </button>
                    </form>
                </div>

                <div id='sankaku'>

                    <form method=post action='https://word-note.main.jp/book2.php'>

                        <input type=hidden name='openbook' value=<?php echo  $book_id ?>>

                        <input type=hidden name='word_id' value=<?php echo  $word_id ?>>

                        <!--<input type=hidden name='addweight' value=0.2>-->
                        <input type=hidden name='answer' value="1">
                        <input type=hidden name='last_answer_date' value=<?php echo  $last_answer_date ?>>

                        <input type=hidden name='weight' value=<?php echo  $weight ?>>

                        <input type=hidden name='first_answer' value=<?php echo  $first_answer ?>>
                        <input type=hidden name='second_answer' value=<?php echo  $second_answer ?>>

                        <input type=hidden name='clear_flag' value=<?php echo  $clear_flag ?>>

                        <button class='clear_button'>
                            <img src='./img/iconmonstr-paperclip-2-240.png' class='iconcolor'>
                        </button>
                    </form>
                </div>

                <div id='maru'>
                    <form method=post action='https://word-note.main.jp/book2.php' name='form1'>
                        <input type=hidden name='openbook' value=<?php echo  $book_id ?>>
                        <input type=hidden name='word_id' value=<?php echo  $word_id ?>>

                        <!--<input type=hidden name='addweight' value=0.2>-->
                        <input type=hidden name='answer' value=2>

                        <input type=hidden name='last_answer_date' value=<?php echo  $last_answer_date ?>>

                        <input type=hidden name='weight' value=<?php echo  $weight ?>>

                        <input type=hidden name='first_answer' value=<?php echo  $first_answer ?>>
                        <input type=hidden name='second_answer' value=<?php echo  $second_answer ?>>

                        <input type=hidden name='clear_flag' value=<?php echo  $clear_flag ?>>

                        <button class='clear_button' onclick='yeahBtn()'>
                            <img src='./img/iconmonstr-smiley-1-240.png' class='iconcolor'>
                        </button>

                    </form>
                </div>

                <div class='clear'>
                </div>

                <br>
                <br>
            </div>

            <div class='return'>
                <a href='https://word-note.main.jp/index.php'>
                    もどる
                </a>
            </div>
        <?php elseif ($there_word == 0) : ?>

            <div style='float:left;'>
                <form method=post action='https://word-note.main.jp/index.php'>
                    <button class='clear_button'>
                        <img src='./img/iconmonstr-undo-1-32.png'>
                    </button>
                </form>
            </div>
            単語を登録しましょう！
            <br>
            <br>
            <form method=post action='https://word-note.main.jp/openbook.php'>
                <input type=hidden name='openbook' value=<?php echo $book_id ?>>
                <p>問題を登録する</p>
                <input type=text name='question'>
                <p>回答を登録する</p>
                <input type=text name='answer'>
                <br>
                <button>
                    登録！
                </button>
            </form>
        <?php endif; ?>

    <?php elseif (!empty($_POST['settings'])) : ?>
        <div>
            <div>
                <form method=post action='https://word-note.main.jp/book2.php'>
                    <input type=hidden name='openbook' value=<?php echo $_POST['book_id'] ?>>
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

            $setting_book = open_card($_POST['book_id']);
            /*$setting_book = mysqli_query($link, "SELECT * FROM words where book_id='" . $_POST['book_id'] . "' order by word_weight limit 1");*/


            $zero_book = 0;
            while ($set_book = mysqli_fetch_assoc($setting_book)) {
                $word_id = $set_book['word_id'];
                $question = $set_book['question'];
                $answer = $set_book['answer'];
                $zero_book = 1;
            } ?>

            <?php if ($zero_book == 0) : ?>
                戻る
            <?php elseif ($zero_book == 1) : ?>
                <form method=post action='https://word-note.main.jp/settings.php'>

                    <div class='settings_card'>
                        【質問】
                        <br>
                        <textarea name='question' type='text' rows='2' cols='40'><?php echo $question ?></textarea>
                    </div>
                    <br>
                    <div class='settings_card'>
                        【解答】
                        <br>
                        <textarea name='answer' type='text' rows='2' cols='40'>
                            <?php echo $answer ?>
                        </textarea>
                    </div>

                    <!--$settings_bookname = mysqli_query($link, "SELECT * FROM book_name");-->


                    <br>
                    <div class='settings_card'>
                        【所属単語帳】<br>
                        <select name='book'>
                            <?php $settings_bookname = revealbook();

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
                    <input type=hidden name='word_id' value=<?php echo $word_id ?>>
                    <input type=hidden name='book_id' value=<?php echo $_POST['book_id'] ?>>


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
            <input type=hidden name='word_id' value=<?php echo $word_id ?>>
            <input type=hidden name='book_id' value=<?php echo $_POST['book_id'] ?>>
            <input type=hidden name='settings' value='delete'>
            <input type=hidden name='question' value='<?php echo $question ?>'>
            <div style='text-align:center;'>
                <button class='clear_button'>
                    <img src='./img/iconmonstr-warning-6-64.png' width='46' height='46' style='float:left; margin-top:0.5em'>
                    <h2 style='float:left;'>
                        この単語を削除する
                    </h2>
                </button>
        </form>
        </div>

    <?php endif;

    ?>
<?php else : ?>


    <br>
    うまくスタートできませんでした…
    <br>
    <br>
    <div>
        <a href='https://word-note.main.jp/index.php'>
            もどる
        </a>
    </div>

<?php endif;



?>

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

    function settings() {

    }



    function yeahBtn() {

        const sankaku = document.getElementById("sankaku");
        const batu = document.getElementById("batu");


        if (sankaku.className != 'hidden_button') {
            sankaku.className = "hidden_button";
        }
        if (batu.className != 'hidden_button') {
            batu.className = "hidden_button";
        }


    }
</script>