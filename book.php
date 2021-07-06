<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>login</title>
    <!--単語帳を作ろう！
        ログイン機能があったらいいよね
        追加・削除・更新・読み込み機能(MySQL)機能を備えているのが必須
        ブラウザで動作確認ができること
        コードが閲覧できること-->

    <link rel="stylesheet" href="./main.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<?php
//session_start();

if (!empty($_POST['openbook'])) {
    echo "<header class='header'>
            <div class='main_title'>
            <a href='https://word-note.main.jp/index.php'><p>自分の、<br>自分による、<br>自分のための単語帳</p></a>
            </div>";
    echo "<div class='sub_title'>
                <form method=post action='https://word-note.main.jp/book.php'><input type='hidden' name='settings' value='settings'><input type=hidden name='book_id' value =" . $_POST['openbook'] . "><button class='settings_button'><img src='/img/iconmonstr-gear-6-32.png'></button></form>
            </div></header>";



    //echo $_POST['openbook'];

    //echo $_POST['openbook'];

    //echo "一番目！！！";
    include('./login_safe.php');
    if ($link) {
        //echo "リンク立ってる";
    } else {
        //echo "リンク立っとらん";
    }

    $now = date("Y/m/d H:i:s");

    if (!empty($_POST['word_id'])) {

        //echo "koko";

        $nowweight = $_POST['weight'];
        $addweight = $_POST['addweight'];
        $total_weight = $nowweight + $addweight;
        $update_book = mysqli_query($link, "update words set last_answer_date ='" . $now . "' where word_id='" . $_POST['word_id'] . "'");
        $update_book = mysqli_query($link, "update words set word_weight='" . $total_weight . "' where word_id='" . $_POST['word_id'] . "'");
    }
$there_word=0;
  

    mysqli_set_charset($link, "");
    $open_book = mysqli_query($link, "SELECT * FROM words where book_id='" . $_POST['openbook'] . "' order by word_weight limit 1");

    while ($row_book = mysqli_fetch_assoc($open_book)) {
        $book_id = $row_book["book_id"];
        $word_id = $row_book["word_id"];
        $weight = $row_book["word_weight"];
        //$book_name=$row_book["book_name"];
        //echo "<h1>【".$book_name."】</h1>";
$there_word=1;
        echo "<h2 id='question' onclick='clickBtn2()'>" . $row_book["question"] . "</h2>";
        echo "<br>";
        echo "<h2 id='answer'>" . $row_book["answer"] . "</h2>";
        echo "<div id='putin_button'>";
        echo "<div id='batu'><form method=post action='https://word-note.main.jp/book.php'><input type=hidden name='openbook' value=" . $book_id . "><input type=hidden name='addweight' value=0.2><input type=hidden name='weight' value=" . $weight . "><input type=hidden name='word_id' value =" . $word_id . "><button class='clear_button' ><img src='./img/iconmonstr-smiley-3-240.png' class='iconcolor'></button></div>";
        echo "<div id='sankaku'><form method=post action='https://word-note.main.jp/book.php'><input type=hidden name='openbook' value=" . $book_id . "><input type=hidden name='addweight' value=0.5><input type=hidden name='weight' value=" . $weight . "><input type=hidden name='word_id' value =" . $word_id . "><button class='clear_button' ><img src='./img/iconmonstr-paperclip-2-240.png' class='iconcolor'></button></div>";
        echo "<div id='maru'><form method=post action='https://word-note.main.jp/book.php' name='form1'><input type=hidden name='openbook' value=" . $book_id . "><input type=hidden name='addweight' value=1><input type=hidden name='weight' value=" . $weight . "><input type=hidden name='word_id' value =" . $word_id . "><button class='clear_button'  onclick='yeahBtn()' ><img src='./img/iconmonstr-smiley-1-240.png' class='iconcolor' ></button><div class='clear'>
            </form></div></div>";



        echo "<div class='clear'></div>";
        echo "</div>";

        echo "<br><br><div  class='return'><a href=" . "'https://word-note.main.jp/index.php'" . ">もどる</a></div>";
    }



 if($there_word==0){
        echo "
    <div style='float:left;'>
        <form method=post action='https://word-note.main.jp/index.php'>
            <button  class='clear_button'>
                <img src='./img/iconmonstr-undo-1-32.png'>
            </button>
        </form>
    </div>";
        echo "単語を登録しましょう！<br><br>";
        echo "<form method=post action='https://word-note.main.jp/openbook.php'><input type=hidden name='openbook' value=".$book_id."><p>問題を登録する</p><input type=text name='question'><p>回答を登録する</p><input type=text name='answer'><br><button>登録！</button></form>";
 
}

/*   }else{
        echo "単語帳が".$count_word."件あります！";
        echo "<br><button>スタート</button>";
        echo "<form method=post action='https://localhost/openbook.php'><input type=hidden name='openbook' value=".$book_id."><p>問題を登録する</p><input type=text name='question'><p>回答を登録する</p><input type=text name='answer'><br><button>登録！</button></form>";
        echo "<br><div><a href="."'https://localhost/index.php'".">もどる</a></div>";
    }*/

    /*if(!empty($_POST['word_id'])){
    echo "<br>
    <p>設定</p>
    <br>
    <p>◆単語の質問・回答を変える</p>
    <p>◆単語を別の単語帳に移す</p>
    <p>◆単語を削除する</p>
    <br>
    <p>◆単語帳を続ける</p>
    <br>
    <p>◆ログアウトする</p>

    ";}*/

    

} elseif (!empty($_POST['settings'])) {
    echo "    <header class='header'>
        
        <form action='https://word-note.main.jp/index.php' method=post><div class='main_title'>
            <a href='https://word-note.main.jp/index.php'><p>自分の、<br>自分による、<br>自分のための単語帳</p></a>
        </div></form>

        <div class='sub_title'>
            <p>the word note of me,<br>by me,<br>for me</p>
        </div>


    </header>";


    //echo $_POST['book_id'];


    //echo "<form method=post action='https://localhost/book.php'><input type='hidden' name='settings' value='settings'><input type=hidden name='openbook' value='".$_POST['book_id']."'><button>◆単語帳を続ける(もどる)</button></form>";   
    echo "
                        <div>
                            <div>
                            <form method=post action='https://word-note.main.jp/book.php'>
                            <input type=hidden name='openbook' value='" . $_POST['book_id'] . "'>
                            <button  id='return'  class='clear_button'>
                            <img src='./img/iconmonstr-undo-1-32.png'>
                            </button></form></div>
                            <div>
                            <h1 style='margin:0; float:left;' >単語帳の設定</h1>
                            <div class='clear'></div>
                        </div>";
    //echo "<form action='https://localhost/index.php'><button>◆ログアウトする</button></form>";
    include('./login_safe.php');

    $setting_book = mysqli_query($link, "SELECT * FROM words where book_id='" . $_POST['book_id'] . "' order by word_weight limit 1");


    $zero_book = 0;
    while ($set_book = mysqli_fetch_assoc($setting_book)) {
        $word_id = $set_book['word_id'];
        //echo $word_id;
        //echo "--------------------<br>";
        $zero_book = 1;



        //echo "<input type='text' value=".$set_book['question']." >";
        /*echo "【質問】";
        echo "<br>";
        echo "<textarea type='text' rows='4' cols='40'>".$set_book['question']."</textarea>";
        echo "<br>";
        echo "【解答】";
        echo "<br>";
        echo "<textarea type='text' rows='4' cols='40'>".$set_book['answer']."</textarea>";
        echo "<br>";
        echo "【所属単語帳】<br>";
        echo "<select class="."wowwow"." name="."単語帳".">";
        $settings_bookname = mysqli_query ($link,"SELECT * FROM book_name");
        while ($set_bookname = mysqli_fetch_assoc($settings_bookname)) {
            $bookname=$set_bookname['book_name'];
            $book_id_result=$set_bookname['book_id'];
            if($book_id_result==$_POST['book_id']){
            echo "<option selected>".$bookname."</option>";
            }else{
                echo "<option>".$bookname."</option>";
            }
        }
        echo "
        </select><br><br>";*/
        //echo "<button>所属単語帳番号".$set_book['book_id']."</button>";
        // echo "<button>この単語の設定を変える!</button><br>";
        echo "<form method=post  action='https://word-note.main.jp/settings.php'>
        
        <div class='settings_card'>
        【質問】<br>
        <textarea name='question' type='text' rows='2' cols='40'>" . $set_book['question'] . "</textarea>
        </div>
        <br>
        <div class='settings_card'>
        【解答】<br>
        <textarea name='answer' type='text' rows='2' cols='40'>" . $set_book['answer'] . "</textarea>
        </div>
        ";
        $settings_bookname = mysqli_query($link, "SELECT * FROM book_name");
        echo "<br><div class='settings_card'>【所属単語帳】<br><select name='book'>";
        while ($set_bookname = mysqli_fetch_assoc($settings_bookname)) {
            $book_id_result = $set_bookname['book_id'];
            if ($book_id_result == $_POST['book_id']) {
                echo "<option selected>" . $set_bookname['book_name'] . "</option>";
            } else {
                echo "<option>" . $set_bookname['book_name'] . "</option>";
            }
        }
        echo "</select></div>
        <input type='hidden' name='settings' value='rewrite'>
        <input type=hidden name='word_id' value='" . $word_id . "'>
        <input type=hidden name='book_id' value=" . $_POST['book_id'] . ">";

        //echo "ここいじってる";
        echo "
        <br>
        <div style='text-align:center;'>
        <button class='clear_button'>
        <img src='./img/iconmonstr-synchronization-11-64.png' width='46' height='46' style='float:left; margin-top:0.5em'>
        <h2 style='float:left;'>この単語の設定を保存する</h2></button>
        </form>
        </div>
        <br>

        <form method=post action='./settings.php'>
        <input type=hidden name='word_id' value='" . $word_id . "'>
        <input type=hidden name='book_id' value='" . $_POST['book_id'] . "'>
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
        ";

        //ドロップダウンボックス作ってみるかー

    }

    if ($zero_book == 0) {
        echo "戻る";
    }
    //echo "ここ";
} else {
    echo "<header class='header'>
            <div class='main_title'>
            <a href='https://word-note.main.jp/index.php'><p>自分の、<br>自分による、<br>自分のための単語帳</p></a>
            </div></header>";
    echo "<br>";
    echo "うまくスタートできませんでした…";
    echo "<br>";
    echo "<br><div><a href=" . "'https://word-note.main.jp/index.php'" . ">もどる</a></div>";
}

?>

</div>

</body>

</html>

<script>
    //初期表示は非表示
    
    console.log(document.getElementById("answer")) 
    
    
    if(document.getElementById("answer")==null){
        console.log("nullだよー");
    }else{
        console.log("nullじゃないよー");
	document.getElementById("answer").style.visibility= "hidden";
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

        /*if(page.className==""){
            page.className='happy';
        }*/


        //document.form1.submit();
    }
</script>