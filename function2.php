<?php

function updatebook($nowweight, $addweight, $word_id)
{
    include('./login_safe.php');

    $total_weight = $nowweight + $addweight;
    $update_book_result = mysqli_query(
        $link,
        "update words2 set last_answer_date ='"
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

    $result_book = mysqli_query($link, "SELECT * FROM book_name");
    if (!$result_book) {
        die("クエリーが失敗");
        //mysqli_error(mysqli $result_book);
    }
    if (!empty($result_book)) {
        $echo = "revealbook呼ばれているよ";
        //echo "revealbook呼ばれているよ";
    }

    return $result_book;
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
    $result_open_book = mysqli_query($link, "SELECT * FROM words2 where book_id=" . $book_id . "");
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
        "INSERT INTO words2 (book_id,word_id,question,answer,word_memo,last_answer_date,word_weight) 
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

function book_id($book_name)
{
    include('./login_safe.php');
    $books_name = mysqli_query(
        $link,
        "select * from book_name where book_name='" . $book_name . "'"
    );
    while ($books_name_open = mysqli_fetch_assoc($books_name)) {
        $result_bookid = $books_name_open['book_id'];
    }
    return $result_bookid;
}

function countwords($book_id)
{
    include('./login_safe.php');
    $count_word = mysqli_query(
        $link,
        "select * from words2 where book_id='" . $book_id . "'"
    );
    $count_words_all = 0;
    while ($books_open = mysqli_fetch_assoc($count_word)) {
        $count_words_all++;
    }
    return $count_words_all;
}

function rewrite_card($question, $answer, $book_id, $word_id)
{
    include('./login_safe.php');

    $rewrite_bookname_result = mysqli_query(
        $link,
        "UPDATE words2
    set question='" . $question . "',
    answer='" . $answer . "',
    book_id='" . $book_id . "'
    WHERE word_id = '" . $word_id . "'"
    );

    return $rewrite_bookname_result;
}

function pre_delete_card()
{
}

function delete_card($word_id)
{
    include('./login_safe.php');
    $delete_card_result = mysqli_query(
        $link,
        "delete from words2 where word_id='" . $word_id . "' LIMIT 1"
    );
    return $delete_card_result;
}

function rewrite_book()
{
    include('./login_safe.php');
    $settings_bookname = mysqli_query($link, "SELECT * FROM book_name");

    return $settings_bookname;
    /*while ($set_bookname = mysqli_fetch_assoc($settings_bookname)) {
        echo "<option value=" . $set_bookname['book_id'] . ">" . $set_bookname['book_name'] . "
                    </option>";
    }*/
}

function pre_delete_book()
{
}

function delete_book($book_name_value)
{
    include('./login_safe.php');
    //まず全単語を退避させる

    mysqli_query($link, " update words2 set book_id=999 where book_id='" . $book_name_value . "'");

    $delete_book_result = mysqli_query($link, "delete from book_name where book_id='" . $book_name_value . "' limit 1");

    return $delete_book_result;
}

function answer_card($word_id, $kekka, $first_answer, $second_answer)
{

    include('./login_safe.php');

    //ここで回答した情報を書き換える
    $now = new DateTime();
    $next_answer_date = new DateTime();

    $now = $now->format('Y/m/d H:i:s');

    $clear_flag = 0;

    if ($kekka ==2) {
        if ($first_answer == 2 && $second_answer == 2) {
            $clear_flag = 1;
            //return sitaine
        }
        $next_answer_date = date('Y/m/d H:i:s', strtotime('+10 days'));
    } elseif ($kekka == 1) {
        $next_answer_date = date('Y/m/d H:i:s', strtotime('+2 days'));
    } elseif ($kekka == 0) {
        $next_answer_date = date('Y/m/d H:i:s', strtotime('+12 hours'));
    }

  
    $second_answer = $first_answer;
    $first_answer = $kekka;


    $result = mysqli_query($link, "update words2
     set
     last_answer_date='" . $now . "',
     next_answer_date ='" . $next_answer_date . "',
     first_answer= '" . $first_answer . "',
     second_answer= '" . $second_answer . "',
     clear_flag= '" . $clear_flag . "'
     where word_id='" . $word_id . "'"
    );

    return $result;
}
/*

    フラグかんり　

    まるは2
    罰は０
    三角は１
    今回のanswer,second_anser,first_answerがすべて丸の時
    clear_flagを立ててallモードでしか出ないようにする
    first_answerはsecond_answerへ
    second_answerは消える
    //もし、○なら10日間出題されない。○が3回連続になったらALLモードでしか出ない。
    //もし△なら2日間でない。ただし△が2回連続になったら翌日出る。
    //×翌日出る
    //つまり、2回前の解答内容を保持しておく必要がある。
    これロジックなんか変な気がする
    最終といた日とlast_answerの結果で毎回抽出するの大変じゃないかな
次のanswerdateを毎回入れたほうがいい気がしてきた
もしsannkakuなら、
answerdateを今日から＋２
もし罰なら
answerdateを明日にする　とか
もし丸なら
answerdateを10日後にする　みたいな
そしたらlastanswerdateを入れる意味って何だろう？と思ったけど、
もし「answerdate」を過ぎているものが複数件あった場合には
orderby lastanswerdateにしたほうがよさそう
じゃないかな
    */

/*include('./login_safe.php');
    if (!empty($word_id)) {
        $total_weight = $nowweight + $addweight;
        $now = date("Y/m/d H:i:s");

        mysqli_query($link, "update words set last_answer_date ='" . $now . "' where word_id='" . $word_id . "'");

        mysqli_query($link, "update words set word_weight='" . $total_weight . "' where word_id='" . $word_id . "'");
    }

    $there_word = 0;*/



function open_card($bookid)
{
    include('./login_safe.php');

    $open_card = mysqli_query($link, "SELECT * FROM words2 where book_id='" . $bookid . "' order by next_answer_date limit 1");

    //抽出の順番をここで決める必要がある。

    return $open_card;
}
