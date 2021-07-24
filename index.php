<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>Word_note</title>
    <link rel="stylesheet" href="main.css" />
    <link rel="icon" href="./favicon.ico" id="favicon">
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
    <p>
        20210718 追加改修中　もし変な点があれば下部報告フォームをご利用ください
    </p>
    <?php
    mysqli_set_charset($link, "utf8");
    include('./login_safe.php');
    include('./function.php');
    revealbook();

    while ($row_book = mysqli_fetch_assoc($result_book)) {
        //配列にしちゃう？
        $open_book_id = $row_book["book_id"];
        $open_book_name = $row_book["book_name"];
    ?>
        <form method=post action='https://word-note.main.jp/openbook.php'>
            <?php
            echo "<input type=hidden name='openbook' value=" . $open_book_id . ">";
            ?>
            <button class='bookindex'>
                <?php echo $open_book_name ?>
            </button>
        </form>
    <?php
    }
    ?>
    <form action='./create_book.php'>
        <button class='createbookbutton'>
            あたらしい単語帳を作る
        </button>
    </form>
    <div style="text-align:center;">
        <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSf6u2CD9OHCPeYrSV7NDmlLVEzj9WjdDp_FVRGxsy4Yz3JSRg/viewform?embedded=true" width="640" height="372" frameborder="0" marginheight="0" marginwidth="0">読み込んでいます…</iframe>
    </div>
</body>

</html>