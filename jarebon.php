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
                    じゃれ本
                    <br>
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
    <p>

    </p>
    <?php
    
    mysqli_set_charset($link, "utf8"); 
    include('./jarebon_connect.php');

    if($_POST['ikuwayo']){

        //echo $_POST['name_id'];
        //echo $_POST['honbun'];
        //echo $_POST['loop'];
       if(empty($_POST['loop2'])){
        $jarebon_name = mysqli_query($link, "insert into jarebon (name_id,loop2,honbun,id_word) VALUES ('".$_POST['name_id']."',1,'".$_POST['honbun']."' ,0)");
  
       }else{

        if($_POST['name_id']==1){
            $jarebon_name = mysqli_query($link, "insert into jarebon (name_id,loop,honbun,id_word)VALUES ('".$_POST['name_id']."','".($_POST['loop2']+1)."','".$_POST['honbun']."' ,0)");
        
        }else{
            $jarebon_name = mysqli_query($link, "insert into jarebon (name_id,loop,honbun,id_word) VALUES ('".$_POST['name_id']."','".$_POST['loop2']."','".$_POST['honbun']."' ,0);)");
 
        }
       }
       if(empty($jarebon_name)){
           "unchi!!!";
       }
    }
   
    //include('./function.php');
     
    global $jarebon_name; $jarebon_name = mysqli_query($link, "SELECT * FROM jarebon_people");
    
    if (!$jarebon_name) {
        die("クエリーが失敗");
        //mysqli_error(mysqli $result_book);
    }
    
    if(!empty($jarebon_name)){
        $echo ="revealbook呼ばれているよ";
        //echo "revealbook呼ばれているよ";
    }


    while ($jarebon_name_open = mysqli_fetch_assoc($jarebon_name)) {
        //配列にしちゃう？
        $jarebon_people_id = $jarebon_name_open["name_id"];
        $jarebon_people_name = $jarebon_name_open["name"];
    ?>
        <form method=post action='https://word-note.main.jp/jarebon_open.php'>
            <?php
            echo "<input type=hidden name='jarebon_people_id' value=" . $jarebon_people_id . ">";
            ?>
            <button class='bookindex'>
                <?php echo $jarebon_people_name ?>
                </button>
        </form>
    <?php
    }
    ?>
</body>

</html>