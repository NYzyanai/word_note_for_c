<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>設定</title>
    <link rel="stylesheet" href="./main.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<header class="header">
    <div class="main_title">
        <a href='https://word-note.main.jp/index.php'>
            <p>自分の、<br>自分による、<br>自分のための単語帳</p>
        </a>
    </div>
    <div class='sub_title'>
        <p>the word note of me,<br>by me,<br>for me</p>
    </div>
</header>

<body id='page'>

    <?php


    //もし質問・解答が入っていて設定が「リライト」だった場合
    if (!empty($_POST['question']) && !empty($_POST['answer']) && 'rewrite' == $_POST['settings']) : ?>


        <!--カードの内容変更 -->

        <?php
        include('./login_safe.php');
        include('./function.php');

        $result_bookid = book_id($_POST['book']);
        $rewrite_bookname_result = rewrite_card($_POST['question'], $_POST['answer'], $result_bookid, $_POST['word_id']);

        if (!empty($rewrite_bookname_result)) : ?>

            【質問】<?php echo  $_POST['question'] ?>
            <br>
            【解答】<?php echo  $_POST['answer'] ?>
            <br>
            【単語帳】<?php echo  $_POST['book'] ?>
            <br>
            <br>に変更したよ！

        <?php else : ?>

            うまく変更できませんでした…

        <?php endif; ?>


        <form method=post action='https://word-note.main.jp/book.php'>
            <button id='return' class='clear_button'>
                <input type=hidden name='openbook' value='<?php $_POST[' book_id'] ?>'>
                <img src='./img/iconmonstr-undo-1-32.png'>
            </button>
        </form>
        <!--単語番号が指定されていて、設定が「削除」だった時 -->
    <?php elseif (!empty($_POST['word_id']) && 'delete' == $_POST['settings']) : ?>

        <form method=post action='https://word-note.main.jp/book.php'>
            <button class='clear_button'>
                <input type=hidden name='openbook' value='<?php echo $_POST['book_id'] ?>'>
                <img src='./img/iconmonstr-undo-1-32.png'>
                もどる
            </button>
        </form>
        <div style='text-align:center;'>
            <img src='./img/iconmonstr-warning-6-64.png' width='46' height='46' style='margin-top:0.5em'>
            <h3>
                本当に【<?php $_POST['question'] ?>】の単語を削除しますか？
            </h3>
            <p>
                ※この操作は取り消せません
            </p>
        </div>
        <br>
        <br>

        <form method=post style='text-align:center;'>
            <button class='clear_button' style='background-color: #ffd803; font-size:3vw; border-radius:10px;'>
                <input type=hidden name='settings' value='owaridayomou-nanimo-kamo'>
                <input type=hidden name='word_id' value='<?php echo $_POST[' word_id'] ?>'>
                <input type=hidden name='question' value='<?php echo $_POST['question'] ?>'>
                <input type=hidden name='book_id' value='<?php echo $_POST['book_id'] ?>'>
                削除する
            </button>
        </form>
        <!-- //削除確認画面で「終わりだよもう何もかも」が来たら -->
    <?php elseif ($_POST['settings'] == 'owaridayomou-nanimo-kamo') : ?>
        <?php
        include('./login_safe.php');
        //設定ミスった時のためにLIMIT 
        $delete_card_result = delete_card($_POST['word_id']);

        if (!empty($delete_card_result)) : ?>

        <?php else : ?>
            <p>【<?php echo $_POST['question'] ?>】を削除しました！ </p>
        <?php endif; ?>


        <?php if (countwords($_POST['book_id']) == 0) :
            //残り単語数で判別している
        ?>
            <form method=post action='https://word-note.main.jp/index.php'>
                <button id='return' class='clear_button'>
                    <img src='./img/iconmonstr-undo-1-32.png'>
                </button>
            </form>
        <?php else : ?>

            <form method=post action='https://word-note.main.jp/book.php'>
                <button id='return' class='clear_button'>
                    <img src='./img/iconmonstr-undo-1-32.png'>
                    <input type=hidden name='openbook' value='<?php echo  $_POST['book_id'] ?>'>
                    <input type=hidden name='book_id' value='<?php echo  $_POST['book_id'] ?>'>
                </button>
            </form>

        <?php endif; ?>
        <!--全部帰るとき-->

    <?php elseif ($_POST['settings'] == 'total_settings') : ?>
        <div style='float:left;'>
            <form method=post action='https://word-note.main.jp/index.php'>
                <button class='clear_button'>
                    <img src='./img/iconmonstr-undo-1-32.png'>
                </button>
            </form>
        </div>

        <div style='float:left;'>
            <h1 style='margin:0px;'>
                設定変更
            </h1>
        </div>
        <div class='clear'>
        </div>

        <div>
            <form method=post>
                <button class='clear_button settings_card' style='margin-top:10px; margin-bottom:10px;'>
                    <input type=hidden name='settings' value='book_change'>
                    <img src='./img/iconmonstr-synchronization-11-64.png' width='46' height='46' style='margin-top:0.5em'>
                    <h1>
                        単語帳の名前/メモを変えたい
                    </h1>
                </button>
            </form>
        </div>
        <div>
            <form method=post>
                <button class='clear_button settings_card' style='margin-top:10px; margin-bottom:10px;'>
                    <input type=hidden name='settings' value='book_delete'>
                    <img src='./img/iconmonstr-warning-6-64.png' width='46' height='46' style='margin-top:0.5em'>
                    <h1>
                        単語帳を消したい
                    </h1>
                </button>
            </form>
        </div>
        <div>
            <form method=post action='https://word-note.main.jp/human.php'>
                <button class='clear_button settings_card' style='margin-top:10px; margin-bottom:10px;'>
                    <h1>
                        作った人/利用規約
                    </h1>
                </button>
            </form>
        </div>

    <?php elseif ($_POST['settings'] == 'book_change') :

        //echo "気合で単語帳の名前か変更できるページ作る" ;
        include('./login_safe.php');
        include('./function.php');

    ?>


        <form method=post action='https://word-note.main.jp/index.php'>
            <button class='clear_button'>
                <img src='./img/iconmonstr-undo-1-32.png'>
                もどる
            </button>
        </form>

        <form method=post>
            <h2 class='settings_card' style='text-align:center; background-color:white;'>
                <select name='book2'>

                    <?php

                    $result_book = revealbook();
                    //ここはどうやってfunction化すればいいんだろう？

                    while ($set_bookname = mysqli_fetch_assoc($result_book)) {
                        echo "<option value=" . $set_bookname['book_id'] . ">" . $set_bookname['book_name'] . "
                    </option>";
                    } ?>
                </select>


                の単語帳を
                <br>
                <input type=hidden name='settings' value='book_update'>
                <input name='newtitle' required>
                </input>
                というタイトルに…
            </h2>
            <br>
            <div class='settings_card'>
                <button class='clear_button'>
                    <img src='./img/iconmonstr-synchronization-11-64.png' width='46' height='46' style='text-align:center;float:left;' margin-top:0.5em>
                    <h2>
                        変更！
                    </h2>
                </button>
            </div>
        </form>

    <?php elseif ($_POST['settings'] == 'book_delete') : ?>

        <!-- 単語帳消すページ作る" ; -->

        <form method=post action='https://word-note.main.jp/index.php'>
            <button class='clear_button'>
                <input type=hidden name='openbook' value='<?php echo $_POST[' book_id'] ?>'>
                <img src='./img/iconmonstr-undo-1-32.png'>
                もどる
            </button>
        </form>

        <body>
            <?php
            include('./login_safe.php');
            include('./function.php');
            ?>
            <form method=post>
                <div style='text-align:center;  margin-top:20px;'>
                    <select name='book_name_value'>
                        <?php
                        $result_book = revealbook();
                        while ($set_bookname_all = mysqli_fetch_assoc($result_book)) {
                            echo "<option value=" . $set_bookname_all['book_id'] . ">" . $set_bookname_all['book_name'] . "</option>";
                        };
                        ?>

                    </select>

                    <?php echo $set_bookname_all['book_name']; ?>
                    <?php echo $set_bookname_all['book_id']; ?>
                    <br>
                    <input type=hidden name='book_id' value="<?php echo  $set_bookname_all['book_id'] ?>">
                    <input type=hidden name='settings' value='book_delete_true'>

                    <h2>
                        の単語帳自体を…
                    </h2>

                    <button class='clear_button'>
                        <input type=hidden name='book_name' value="<?php $set_bookname_all['book_name'] ?>">
                        <input type=hidden name='book_name' value='あ'>
                        <img src='./img/iconmonstr-warning-6-64.png' width='46' height='46' style='float:left; margin-top:0.5em'>
                        <h2>
                            削除！
                        </h2>
                    </button>
                </div>
            </form>
        <?php elseif (!empty($_POST['book_name_value']) && 'book_delete_true' == $_POST['settings']) : ?>

            <?php
            include('./login_safe.php');
            include('./function.php');
            ?>
            <form method=post action='https://word-note.main.jp/index.php'>
                <button class='clear_button'>
                    <img src='./img/iconmonstr-undo-1-32.png'>
                    もどる
                </button>
            </form>

            <div style='text-align:center;'>
                <img src='./img/iconmonstr-warning-6-64.png' width='46' height='46' style='margin-top:0.5em'>
                <?php
                //echo $_POST['book_name_value'];

                $settings_bookname_all_delete = openbook($_POST['book_name_value']);

                //$settings_bookname_all_delete = mysqli_query($link, "SELECT * FROM book_name where book_id='" . $_POST['book_name_value'] . "'");
                while ($set_bookname_all_delete = mysqli_fetch_assoc($settings_bookname_all_delete)) {
                    $book_name = $set_bookname_all_delete['book_name'];
                };
                ?>
                <h3>
                    本当に【<?php echo $book_name ?>】の単語帳を削除しますか？
                </h3>
                <p>※この操作は取り消せません</p>

            </div>
            <br>
            <br>
            <br>
            <form method=post style='text-align:center;'>
                <input type=hidden name='settings' value='sayonara-nanimo-kamo'>
                <input type=hidden name='book_name_value' value='<?php echo $_POST['book_name_value'] ?>'>
                <button class='clear_button' style=' background-color: #ffd803; font-size:3vw; border-radius:10px;'>
                    削除する
                </button>
            </form>

        <?php elseif (!empty($_POST['book_name_value']) && 'sayonara-nanimo-kamo' == $_POST['settings']) : ?>

            <?php
            include('./login_safe.php');
            include('./function.php');
            //単語帳が存在していた場合には、bookidを999に退避させる 
            //まじで単語帳を削除する操作

            $delete_book_result = delete_book($_POST['book_name_value']);
            ?>


            <?php if (!$delete_book_result) : ?>
                消せなかった
            <?php else : ?>
                単語帳を削除しました！！
                <form method=post action='https://word-note.main.jp/index.php'>
                    <button id='return' class='clear_button'>
                        <img src='./img/iconmonstr-undo-1-32.png'>
                        もどる
                    </button>
                </form>
            <?php endif; ?>

        <?php
    elseif ($_POST['settings'] == 'book_update' && !empty($_POST['book2']) && !empty($_POST['newtitle'])) : ?>

            <?php
            include('./login_safe.php');

            //ここで削除前の本のタイトル取得しておく 


            $before_book = mysqli_query($link, "select book_name from book_name where book_id='" . $_POST['book2'] . "'");
            while ($title = mysqli_fetch_assoc($before_book)) {
                $before_book_name = $title['book_name'];
            }
            $update_book = mysqli_query($link, "update book_name
            set book_name='" . $_POST['newtitle'] . "'
            where book_id='" . $_POST['book2'] . "'");
            ?>
            <?php if (!$update_book) : ?>
                updateできなかった
            <?php else : ?>
                【<?php echo $before_book_name ?> 】を
                <br>
                【<?php echo $_POST['newtitle'] ?> 】
                というタイトルに
                <br>
                変更しました！

                <form method=post action='https://word-note.main.jp/index.php'>
                    <button id='return' class='clear_button'>
                        <img src='./img/iconmonstr-undo-1-32.png'>
                        もどる
                    </button>
                </form>

            <?php endif; ?>
        <?php else : ?>
            <?php if (!empty($result_bookid)) : ?>
                <?php echo $result_bookid; ?>
                不正な操作です
                <form method=post action='https://word-note.main.jp/book.php'>
                    <input type=hidden name='openbook' value='<?php $result_bookid ?>'>
                    <button id='return' class='clear_button'>
                        <img src='./img/iconmonstr-undo-1-32.png'>
                    </button>
                </form>
            <?php else : ?>
                <?php echo $_POST['book_name'] ?>
                と
                <?php $_POST['book_id'] ?>
                と
                <?php $_POST['settings'] ?>
                不正な操作かもしれないからTOPにいくよ
                <form method=post action='https://word-note.main.jp/index.php'>
                    <button id='return' class='clear_button'>
                        <img src='./img/iconmonstr-undo-1-32.png'>
                    </button>
                </form>
            <?php endif; ?>
        <?php endif; ?>




        <script>
            if (document.getElementById('return') != null) {

                //getelementedbyidできなかたときの返り血はnull
                setTimeout(function() {
                    document.getElementById('return').click();
                }, 2 * 1000);
            }
        </script>



        </body>

</html>