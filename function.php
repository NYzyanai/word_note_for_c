<?php

function updatebook($nowweight, $addweight, $word_id)
{
    include('./login_safe.php');

    $total_weight = $nowweight + $addweight;
    $update_book_result = mysqli_query(
        $link,
        "update words set last_answer_date ='"
            . $now . "' ,
      word_weight='" .
            $total_weight . "' 
      where word_id='" . $word_id . "'"
    );

    return $update_book_result;
}

function revealbook()
{
    include('./login_safe.php');
    global $result_book;
    $result_book = mysqli_query($link, "SELECT * FROM book_name");
    if (!$result_book) {
        die("クエリーが失敗");
        //mysqli_error(mysqli $result_book);
    }
    if (!empty($result_book)) {
        $echo = "revealbook呼ばれているよ";
        //echo "revealbook呼ばれているよ";
    }
}

function openbook($book_id)
{
    //引数に初期値を設定しておくと、省略可能
    include('./login_safe.php');

    $result_open_book =
        mysqli_query(
            $link,
            "SELECT * FROM book_name where book_id=" . $book_id . ""
        );

    return  $result_open_book;
}


function are_there_words($book_id)
{

    $there_word = 0;

    include('./login_safe.php');
    global $result_open_book;
    $result_open_book = mysqli_query($link, "SELECT * FROM words where book_id=" . $book_id . "");
    while ($open_book = mysqli_fetch_assoc($result_open_book)) {
        $there_word++;
    }

    return $there_word;
}

function resist_word($book, $question, $answer)
{
    include('./login_safe.php');
    mysqli_query(
        $link,
        "INSERT INTO words (book_id,word_id,question,answer,word_memo,last_answer_date,word_weight) 
    VALUES 
    ('" . $book . "', NULL, '"
            . $question . "','"
            . $answer . "',null,null,default)"
    );
}

//本を作る
function create_book($book_name, $book_memo)
{
    include('./login_safe.php');

    //全ての本を数える
    $totalcount = mysqli_query($link, "select *  from book_name");
    $totalcount_num = mysqli_num_rows($totalcount);


    if ($totalcount_num < 20) {
        //20個以上は作れないようにする
        $create_book_result =
            mysqli_query(
                $link,
                "INSERT INTO book_name 
            (book_id,book_name,book_memo,last_access_date,created_date) 
            VALUES 
            (NULL, '" . $book_name . "', '" . $book_memo . "',default,NULL)"
            );

        if (!$create_book_result) {
            die("クエリーが失敗");
        } else {
            $result_book_no = mysqli_query($link, "select book_id from book_name where book_name='" . $book_name . "'");
            $row_book = mysqli_fetch_assoc($result_book_no);
            $return_result_book = $row_book['book_id'];
            return $return_result_book;
        }
    }
}


function rewrite_card(){

}

function pre_delete_card(){

}

function delete_card(){

}

function rewrite_book(){

}

function pre_delete_book(){

}

function delete_book(){

    
}