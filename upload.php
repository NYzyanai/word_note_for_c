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




    <!--ここでUPLOADされたら下記の処理-->
    <?php

    if ($_POST['style'] == 'upload') :


        if (is_uploaded_file($_FILES["csvfile"]["tmp_name"])) {
            $file_tmp_name = $_FILES["csvfile"]["tmp_name"];
            $file_name = $_FILES["csvfile"]["name"];

            //拡張子を判定
            if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
                $err_msg = 'CSVファイルのみ対応しています。';
            } else {
                //ファイルをdataディレクトリに移動
                if (move_uploaded_file($file_tmp_name, "../../data/uploaded/" . $file_name)) {
                    //後で削除できるように権限を644に
                    chmod("../../data/uploaded/" . $file_name, 0644);
                    $msg = $file_name . "をアップロードしました。";
                    $file = '../../data/uploaded/' . $file_name;
                    $fp   = fopen($file, "r");

                    //配列に変換する
                    while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
                        $asins[] = $data;
                    }
                    fclose($fp);
                    //ファイルの削除
                    unlink('../../data/uploaded/' . $file_name);
                } else {
                    $err_msg = "ファイルをアップロードできません。";
                }
            }
        } else {
            $err_msg = "ファイルが選択されていません。";
        }

    else :
    ?>
        ここでアップロードできます！
        <form action="'./upload.php" method="post" enctype="multipart/form-data">
            CSVファイル：<br>
            <input type="file" name="csvfile" size="30"><br>
            <input type='hidden' name='style' value='upload'>
            <input type="submit" name="submit" value="アップロード">
        </form>
    <?php
    endif;

    ?>
</body>

</html>