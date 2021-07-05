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


    <?php







 echo "<header class='header'>
            <div class='main_title'>
            <a href='https://word-note.main.jp/index.php'><p>自分の、<br>自分による、<br>自分のための単語帳</p></a>
            </div>";
            echo "<div class='sub_title'>
            <p>the word note of me,<br>by me,<br>for me</p>

            </div></header>";
?>



    <?php
        include('./login_safe.php');
        $book_name= $_POST['book_name'];
        $book_memo= $_POST['book_memo'];

        mysqli_set_charset($link, "utf8");

        $totalcount=mysqli_query($link, "select *  from book_name");
        
	$totalcount_num=mysqli_num_rows($totalcount);
//echo $totalcount_num."YEAH";
        if($totalcount_num+1<20){
            //20個以上は作れないようにする
            $create_book_result= mysqli_query($link, "INSERT INTO book_name (book_id,book_name,book_memo,last_access_date,created_date) VALUES (NULL, '".$book_name."', '".$book_memo."',default,NULL)");
            
            if(!$create_book_result){
                die("クエリーが失敗");
            }else{
                echo "<p style='text-align:center;'>単語帳【".$book_name."】を作成しました！</p>";
            }
        }else{
            echo "<h1>単語帳の数が20個を超えています！<br>さすがに多いので20個以下にしてください！</h1>";
        }


        //echo "<br><br><div class='settings_card'><a href="."'https://word-note.main.jp/index.php'".">さっそく単語を登録する</a></div>";
echo"<form action='https://word-note.main.jp/index.php' ><button class='createbookbutton'>さっそく単語を登録する</button></form>";
    echo "<form method=post action='https://word-note.main.jp/index.php'>
        <button class='clear_button'>
        <input type=hidden name='openbook' value='".$_POST['book_id']."'>
        <img src='./img/iconmonstr-undo-1-32.png'>
        もどる
        </button>
        </form>";


    ?>

    </body>
</html>