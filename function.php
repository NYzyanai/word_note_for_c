<?php

function updatebook()
{
    include('./login_safe.php');
    $nowweight = $_POST['weight'];
    $addweight = $_POST['addweight'];
    $total_weight = $nowweight + $addweight;
    $update_book = mysqli_query($link, "update words set last_answer_date ='" . $now . "' where word_id='" . $_POST['word_id'] . "'");
    $update_book = mysqli_query($link, "update words set word_weight='" . $total_weight . "' where word_id='" . $_POST['word_id'] . "'");
}

function revealbook()
{
    include('./login_safe.php');   
    global $result_book; $result_book = mysqli_query($link, "SELECT * FROM book_name");
    if (!$result_book) {
        die("クエリーが失敗");
        //mysqli_error(mysqli $result_book);
    }
    if(!empty($result_book)){
        $echo ="revealbook呼ばれているよ";
        //echo "revealbook呼ばれているよ";
    }
}



function are_there_words($book_id){

    $there_word = 0;

    include('./login_safe.php');   
    global $result_open_book;$result_open_book = mysqli_query($link, "SELECT * FROM words where book_id=" . $book_id . "");
    while ($open_book = mysqli_fetch_assoc($result_open_book)) {
        $there_word++;
    }

    return $there_word;
}

?>