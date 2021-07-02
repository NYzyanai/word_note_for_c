<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>WordNote</title>
    <!--単語帳を作ろう！
        ログイン機能があったらいいよね
        追加・削除・更新・読み込み機能(MySQL)機能を備えているのが必須
        ブラウザで動作確認ができること
        コードが閲覧できること-->
    <link rel="stylesheet" href="main.css" />

</head>

<body>
    <header class="header">
        <div class="main_title">
            <a href='https://word-note.main.jp/'>
                <p>
                    自分の、
                    <br>
                    自分による、
                    <br>
                    自分のための単語帳
                </p>
            </a>
        </div>

        <div class="sub_title">
            <form method=post action='https://word-note.main.jp/settings.php'><input type='hidden' name='settings' value='total_settings'><button class='settings_button'><img src='/img/iconmonstr-gear-6-32.png'></button></form>
        </div>
    </header>

    <?php
    session_start();
    ?>

    <?php


    //echo '入力値の確認をお願いします';
    //echo '<br><br>';
    //echo $_POST['nm'];
    echo '<br><br>';
    //echo $_POST['pw'];
    //echo '<br><br>';
    //echo 'こちらで間違い無いですか？';

    //echo "セッション";
    //echo $_SESSION['nm'];
    ?>



    <?php
    include('./login_safe.php');

    include('./login_safe.php');
    if ($link) {
        //echo "リンク立ってる";
    } else {
        //echo "リンク立っとらん";
    }
    $result = mysqli_query($link, "SELECT * from book_name");
    if (!$result) {
        die("クエリーが失敗");
        //mysqli_error(mysqli $result_book);
    }

    while ($row_book = mysqli_fetch_assoc($result)) {
        //echo $row_book['book_name'];
    }

    if (!empty($_POST['nm'])) {
        // $nm= $_POST['nm'];
        //$pw= $_POST['pw'];

    }




    //echo $nm;
    //echo $pw;


    if (!mysqli_connect_errno()) {
        if (session_status()) {
            //echo "ようこそ!";
            //echo "<br>設定";
        }


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

        // SELECT文の発行
        /*$result = mysqli_query($link, "SELECT id, name , password FROM user where name='" . $user . "' AND password='" . $pw . "'");*/
        /*if (! $create_book_result) {
                    die("クエリーが失敗");
                }*/

        /*$row_count = $result->num_rows;
                //echo $row_count."件数出た";
                if($nm=="" && $pw==""){
                    echo "不正なリクエストです";
                    echo "<br>";
                    echo "<form action="."https://localhost/index.php"." method="."post"."><button>戻る</button></form>";
                }else if($row_count==0){
                    echo "ID、もしくはパスワードが違います";
                    echo "<br>";
                    echo "<br>";
                    echo "<form action="."http://localhost/index.php"." method="."post"."><button>戻る</button></form>";
                    echo "<br>";
                    echo "<form action="."http://localhost/create_acount.php"." method="."post"."><button>新規登録</button></form>";
                }else{
                echo "認証成功!";
                echo "<br><br>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        //echo "id=" . $row["id"];
                        echo "ようこそ". $row["name"]."さん！";
                        //echo ",password=" . $row["password"] . "<br />";
                        $user_id=$row["id"]; 
                        $user_id="user_id=".$user_id;
                        //ここに単語帳の中身書いてみる？
                        
                    //該当したときの処理
                    }
                //echo $user_id;
                */
        $result_book = mysqli_query($link, "SELECT * FROM book_name");
        if (!$result_book) {
            die("クエリーが失敗");
            //mysqli_error(mysqli $result_book);
        }

        $first_book_flag = 0;
        /*$row_count_book = $result_book->num_rows_book;*/
        $count_word_book = 0;
        while ($row_book = mysqli_fetch_assoc($result_book)) {
            //echo "id=" . $row["id"];

            $all_book = $row_book["book_id"];
            //echo $row_book["book_id"].'冊目:【'.$row_book["book_name"].'】があります';


            //echo ",password=" . $row["password"] . "<br />";
            $book_id = $row_book["book_id"];

            //ここに単語帳の中身書いてみる？
            $count_word_book++;
            //echo $count_word_book;
            echo "<form method=post action='https://word-note.main.jp/openbook.php'>
                            <input type=hidden name='openbook' value=" . $count_word_book . ">
                            <button class='bookindex'>" . $row_book["book_name"] . "</button>
                        </form>";
            //該当したときの処理

        }

        //if($first_book_flag==0){

        echo "<form action='./create_book.php' ><button class='createbookbutton'>あたらしい単語帳を作る</button></form>";
        //<form><button class='createbookbutton'>設定</button></form>";
        //}
        //echo "<br><br><div><a href="."'http://localhost/index.php'".">ログアウト</a></div>";





        // データの取得及び取得データの表示

        // MySQLの切断
        //$close = mysqli_close($link);
        //if ($close){
        //    //echo "<p>切断成功</p>";
        //}
    } else {
        echo "ユーザーIDかパスワードが違います";
        echo "<br><br><div><a href=" . "'https://word-note.main.jp/index.php'" . ">もどる</a></div>";
    }
    ?>


</body>

</html>