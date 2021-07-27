<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>Jarebon</title>
    <link rel="stylesheet" href="jarebon.css" />
    <link rel="icon" href="./favicon.ico" id="favicon">
</head>


<body>
    <header class="header">
        <div class="main_title">
            <a href='https://word-note.main.jp/jarebon.php'>
                <p>
                    じゃれ本<br>
                    〜エクストリームババア〜
                </p>
            </a>
        </div>

        <div class="sub_title">
            <p>
                終わりだよもう
                <br>
                何もかも
            </p>
        </div>
    </header>
    <?php
    mysqli_set_charset($link, "utf8");

    /*

    流れ
    
    1の人が開いて何も見つからないとき
        初めのフォームを入力
    1の人がひらいて何か見つかったとき
        その投稿のloopを取得
        同ループで4人目が入力しているとき、自分がまだ入力していない。
        同ループで4人目が入力していないとき、一個前のループで4人目が入力しているか調べる。
            もし、一個前のループで4人目が入力していないときは、まち。
            もし、一個前のループで4人目が入力しているときは、自分が入力するべき。

    2,3,4の人がひらいて何も見つからないとき
        ループを1と強引に設定する
        1のループで自分のid-1の人が入力しているとき、自分がまだ入力していない。
        1のループで自分のid-1の人が入力していないとき、まち。

    もし、ひらいて何か見つかったとき
        その投稿のloopを取得
        ループ＋１で一個前の人が入力しているとき、自分がまだ入力していないから入力するべき
        ループ＋１で一個前の人が入力していないとき、まち。

    */


    include('./jarebon_connect.php');
    $jarebon_people_id = $_POST['jarebon_people_id'];
    $jarebon_open = mysqli_query($link, "SELECT * FROM jarebon where name_id='" . $jarebon_people_id . "' order by loop2 desc limit 1");


    $thereword = 0;
    while ($jarebon_book_open = mysqli_fetch_assoc($jarebon_open)) {
        $thereword = 1;
        $jarebon_loop = $jarebon_book_open["loop2"];
        $jarebon_honbun = $jarebon_book_open['honbun'];
    }

    //何も見つからなかったとき
    if ($thereword == 0) {
        if ($jarebon_people_id == 1) {
            echo "初めての文言を入力してください";
        } else {
            $jarebon_loop = 1;
            /*1のループで自分のid-1の人が入力しているとき、自分がまだ入力していない。
            1のループで自分のid-1の人が入力していないとき、まち。*/
            $jarebon_open = mysqli_query($link, "SELECT * FROM jarebon where name_id=" . ($jarebon_people_id - 1) . " and loop2='" . $jarebon_loop . "'");

            $thereword = 0;
            while ($jarebon_book_open = mysqli_fetch_assoc($jarebon_open)) {
                $thereword = 1;
                $jarebon_loop = $jarebon_book_open["loop2"];
                $jarebon_honbun = $jarebon_book_open['honbun'];
            }

            if ($thereword == 1) {
                echo "一週目を入力してください";
            } else {
                echo "一個前の人が入力してくれていないのでまち";
            }
        }
    } else {
        //なんか見つかったとき
        /* 1の人がひらいて何か見つかったとき

       その投稿のloopを取得
        同ループで4人目が入力しているとき、自分がまだ入力していない。
        同ループで4人目が入力していないとき、一個前のループで4人目が入力しているか調べる。
            もし、一個前のループで4人目が入力していないときは、まち？それはありえない。。
            もし、一個前のループで4人目が入力しているときは、自分が入力するべき?
            多分そんなことはない。。
       */

        if ($jarebon_people_id == 1) {
            $jarebon_open = mysqli_query($link, "SELECT * FROM jarebon where name_id= 4  and loop2='" . $jarebon_loop . "'");
            $thereword = 0;
            while ($jarebon_book_open = mysqli_fetch_assoc($jarebon_open)) {
                $thereword = 1;
                //$jarebon_loop = $jarebon_book_open["loop2"];
                $jarebon_honbun = $jarebon_book_open['honbun'];
            }

            if ($thereword == 1) {
                //echo "入力してください";
                echo "<div class='bookindex'>";
                echo $jarebon_honbun;
                echo "</div>";
    ?>

                <form action="https://word-note.main.jp/jarebon.php" method="post">
                    <p>続きを入れてね</p>
                    <?php
                    echo "<input type='hidden' name='loop2' value='"
                        . ($jarebon_loop+1) .
                        "'>";
                    echo "<input type='hidden' name='name_id' value='"
                        . $jarebon_people_id .
                        "'>";

                    ?>
                    <textarea type="text" name="book_text" required></textarea>
                    <input type="hidden" name="ikuwayo" value=1>
                    <input type="submit" text="作成！">
                </form>
            <?php
            } else {
                //同ループで4人目が入力していないとき、一個前のループで4人目が入力しているか調べる。
                echo "まち";
            }
        } else {

            /*もし、ひらいて何か見つかったとき
            その投稿のloopを取得
            ループ＋１で一個前の人が入力しているとき、自分がまだ入力していないから入力するべき
            ループ＋１で一個前の人が入力していないとき、まち。*/
            //echo ($jarebon_people_id - 1);
            //echo $jarebon_loop + 1 ;
            $jarebon_open = mysqli_query($link, "SELECT * FROM jarebon where name_id='" . ($jarebon_people_id - 1) . "'   and loop2='" . ($jarebon_loop + 1) . "'");

            $thereword = 0;
            while ($jarebon_book_open = mysqli_fetch_assoc($jarebon_open)) {
                $thereword = 1;
                //$jarebon_loop = $jarebon_book_open["loop2"];
                $jarebon_honbun = $jarebon_book_open['honbun'];
            }

            if ($thereword == 1) {
                //echo "入力してください";

                echo "<div class='bookindex'>";
                echo $jarebon_honbun;
                echo "</div>";
            ?>



                <form action="https://word-note.main.jp/jarebon.php" method="post">
                    <p>続きを入れてね</p>
                    <?php
                    echo "<input type='hidden' name='loop2' value='"
                        . ($jarebon_loop+1) .
                        "'>";
                    echo "<input type='hidden' name='name_id' value='"
                        . $jarebon_people_id .
                        "'>";

                    ?>
                    <textarea type="text" name="book_text" required></textarea>
                    <input type="hidden" name="ikuwayo" value=1>
                    <input type="submit" text="作成！">
                </form>
    <?php
            } else {
                echo "一個前の人が入力してくれていないため、まち";
            }
        }
        /*
        

            もし、ひらいて何か見つかったとき
            その投稿のloopを取得
            ループ＋１で一個前の人が入力しているとき、自分がまだ入力していないから入力するべき
            ループ＋１で一個前の人が入力していないとき、まち。*/
    }
    //何か見つかったとき

    //開いた人のIDを受けて開く
    /*$jarebon_open =
        mysqli_query($link, "SELECT * FROM jarebon where name_id='" . $jarebon_people_id . "' order by loop2 limit 1");

    $thereword = 0;
    //開く
    while ($jarebon_book_open = mysqli_fetch_assoc($jarebon_open)) {
        //配列にしちゃう？
        $thereword = 1;
        $jarebon_loop = $jarebon_book_open["loop2"];
        if (empty($jarebon_loop)) {
            $jarebon_loop = null;
        }
        $jarebon_honbun = $jarebon_book_open['honbun'];
    }

    echo $jarebon_loop;

    if ($jarebon_people_id == 1) {
        echo "あなたは１人目のお客様";
        //id４の人の一個前のloopの本を開く
        if ($jarebon_loop == 0) {
            //$jarebon_before_loop = $jarebon_loop - 1;
            echo "ちょっと待ってね";
        } else {
            $jarebon_before_loop = $jarebon_loop ;
            $jarebon_open_detail = mysqli_query($link, "SELECT * FROM jarebon where name_id=4 and loop2='" . $jarebon_before_loop . "'");

            while ($jarebon_book_open_detail = mysqli_fetch_assoc($jarebon_open_detail)) {
                //配列にしちゃう？
                $therebeforeword = 1;
                $jarebon_before_people_id = 4;
                //$jarebon_before_loop = $jarebon_book_open_detail["loop2"];
                $jarebon_before_honbun = $jarebon_book_open_detail['honbun'];
            }


            //もしループ番号が同じ２人目のデータが入っていたら、入力フォームを表示しない
            $jarebon_open_next_detail = mysqli_query($link, "SELECT * FROM jarebon where name_id=2 and loop2='" . $jarebon_loop+1 . "'");


            $tmp = null;

            while ($jarebon_book_next_open_detail_dead = mysqli_fetch_assoc($jarebon_open_next_detail)) {
                $tmp = $jarebon_book_next_open_detail_dead['honbun'];
            }

            if ($tmp == null) {


                echo "<div class='bookindex'>";
                echo $jarebon_before_honbun;
                echo "</div>";
                echo $tmp;
    ?>

                <form action="https://word-note.main.jp/jarebon.php" method="post">
                    <p>続きを入れてね</p>
                    <?php
                    echo "<input type='hidden' name='loop2' value='"
                        . $jarebon_loop .
                        "'>";
                    echo "<input type='hidden' name='name_id' value='"
                        . $jarebon_people_id .
                        "'>";

                    ?>
                    <textarea type="text" name="book_text" required></textarea>
                    <input type="hidden" name="ikuwayo" value=1>
                    <input type="submit" text="作成！">
                </form>
    <?php
            } else {
                echo "ちょっと待ってね";
            }
        }
    } else {
        //id-1の人の同じloopの本を開く
        $jarebon_people_before_id = $jarebon_people_id - 1;
        if ($jarebon_loop == 1) {
            echo "一周目";
        } else {

            $jarebon_open_detail =
                mysqli_query(
                    $link,
                    "SELECT * FROM jarebon where name_id='" . $jarebon_people_before_id . "' and loop2='" . $jarebon_loop . "'"
                );
            $therebeforeword = 0;
            while ($jarebon_book_open_detail = mysqli_fetch_assoc($jarebon_open_detail)) {
                //配列にしちゃう？
                $therebeforeword = 1;
                $jarebon_before_honbun = $jarebon_book_open_detail['honbun'];
            }
        }


        if ($jarebon_people_id == 4) {
            $jarebon_open_next_detail = mysqli_query($link, "SELECT * FROM jarebon where name_id=1 and loop2=" . ($jarebon_loop + 1) . "'");
        } else {
            $jarebon_open_next_detail = mysqli_query($link, "SELECT * FROM jarebon where name_id=" . ($jarebon_pepople_id + 1) . " and loop2=" . $jarebon_loop . "'");
        }
        $tmp = null;

        while ($jarebon_book_next_open_detail_dead = mysqli_fetch_assoc($jarebon_open_next_detail)) {
            $tmp = $jarebon_book_next_open_detail_dead['honbun'];
            echo "あるよ";
        }



        echo "<div class='bookindex'>";
        echo $jarebon_before_honbun;
        echo "</div>";
        if ($tmp == null) {

            echo "<div style='text-align:center;'>
                    <form action='https://word-note.main.jp/jarebon.php' method='post'>
                        <p>続きを入れてね</p>";

            echo "<input type='hidden' name='loop2' value='"
                . $jarebon_loop .
                "'>";
            echo "<input type='hidden' name='name_id' value='"
                . $jarebon_people_id .
                "'>";


            echo "<textarea type='hidden' name='honbun' required></textarea><br>
                        <input type='hidden' name='ikuwayo' value=1>
                        <input type='submit' text='作成！'>
                    </form>
                </div>";
        } else {
            echo "ちょっと待ってね";
        }
    }*/
    /*
    <form method=post action='https://word-note.main.jp/jarebon.php'>
        <?php
        echo "<input type=hidden name='jarebon_people_id' value=" . $jarebon_people_id . ">";
        ?>

    </form>
    */
    ?>


</body>

</html>