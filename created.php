<!DOCTYPE html>
<html>
    <head>
        <meta charaset="UTF-8">
        <title>新規登録</title>
        <!--単語帳を作ろう！
        ログイン機能があったらいいよね
        追加・削除・更新・読み込み機能(MySQL)機能を備えているのが必須
        ブラウザで動作確認ができること
        コードが閲覧できること-->
        
        <link rel="stylesheet" href="main.css" />
            
    </head>


    <body>


        
    <?php 
    //echo '入力値の確認をお願いします';
    //echo '<br><br>';
    //echo $_POST['nm'];
    //echo '<br><br>';
    //echo $_POST['pw'];
    //echo '<br><br>';
    //echo 'こちらで間違い無いですか？';

    ?>



    <?php
    //$create_id=$_POST['create_id'];
    //echo $user;
    //$create_password= $_POST['create_password'];


    include('http://word-note.main.jp/login_safe.php');


    
    // 接続状況をチェックします
    if (mysqli_connect_errno()) {
        die("データベースに接続できません:" . mysqli_connect_error() . "\n");
    } else {
        //echo "データベースの接続に成功しました。\n";
    }

    // 文字化け防止
    mysqli_set_charset($link, "utf8");

    // SELECT文の発行

    /*$result = mysqli_query($link, "USE word_note");
    if (!$result) {
        die("クエリーが失敗");
    }*/


    //$result_create = mysqli_query($link, "CREATE USER  $create_id . IDENTIFIED BY ' $create_password . '");
    
    //echo "CREATE USER . $create_id . IDENTIFIED BY ' . $create_password . '";
  
    $result_create = mysqli_query($link, "CREATE USER  testaccount identified by '0828'");
  
    if (!mysqli_query($link, "CREATE USER  testaccount identified by '0828'")) {
        printf("Errormessage: %s\n", mysqli_error($link));
    }

    if (!$result_create) {
        //printf(mysqli_error($result_create));
    }else{
        echo"アカウントを作成しました"."<br>";
        echo "ID:".$create_id;
        echo "<br>"."で次からログインが可能です";
        echo "<form action="."http://word-note.main.jp/index.php"." method="."post"."><button>戻る</button></form>";
    }

    // データの取得及び取得データの表示

    // MySQLの切断
    $close = mysqli_close($link);
    if ($close){
        //echo "<p>切断成功</p>";
    }
    ?>
    </body>
</html>