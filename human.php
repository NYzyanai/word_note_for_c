<!DOCTYPE html>
<html>

<head>
    <meta charaset="UTF-8">
    <title>作った人</title>
    <!--単語帳を作ろう！
        ログイン機能があったらいいよね
        追加・削除・更新・読み込み機能(MySQL)機能を備えているのが必須
        ブラウザで動作確認ができること
        コードが閲覧できること-->

    <link rel="stylesheet" href="./main.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<?php
echo "<header class='header'>
            <div class='main_title'>
            <a href='http://word-note.main.jp/index.php'><p>自分の、<br>自分による、<br>自分のための単語帳</p></a>
            </div>";
echo "<div class='sub_title'>
                <form method=post action='http://word-note.main.jp/book.php'><input type='hidden' name='settings' value='settings'><input type=hidden name='book_id' value =" . $_POST['openbook'] . "><button class='settings_button'><img src='/img/iconmonstr-gear-6-32.png'></button></form>
            </div></header>";

echo "<body>
        <div style='text-align:center;'>
        <h2>
            作った人
        </h2>
        <br>
        NY　
        <a href=" . "'https://twitter.com/round_ny_'" . ">
            @round_ny
        </a>
        <br>
        何かありましたら[info★word-note.main.jp]まで。
        <br>
※★は@に変えてください
        <br>

                    </div>
        <br>
<h3>【禁止事項】</h3>
ユーザーは，本サービスの利用にあたり，以下の行為をしてはなりません。

<ul>
<li>法令または公序良俗に違反する行為</li>
<li>犯罪行為に関連する行為</li>
<li>本サービスの内容等，本サービスに含まれる著作権，商標権ほか知的財産権を侵害する行為</li>
<li>製作者，ほかのユーザー，またはその他第三者のサーバーまたはネットワークの機能を破壊したり，妨害したりする行為</li>
<li>本サービスによって得られた情報を商業的に利用する行為</li>
<li>本サービスの運営を妨害するおそれのある行為</li>
<li>不正アクセスをし，またはこれを試みる行為</li>
<li>本サービスに関する個人情報等を収集または蓄積する行為</li>
<li>不正な目的を持って本サービスを利用する行為</li>
<li>本サービスの他のユーザーまたはその他の第三者に不利益，損害，不快感を与える行為</li>
<li>他のユーザーに成りすます行為</li>
<li>製作者が許諾しない本サービス上での宣伝，広告，勧誘，または営業行為</li>
<li>面識のない異性との出会いを目的とした行為</li>
<li>本サービスに関連して，反社会的勢力に対して直接または間接に利益を供与する行為</li>
<li>その他，製作者が不適切と判断する行為</li>
</ul>

<h3>【サービスの継続】</h3>
製作者は，ユーザーに事前に通知することなく本サービスの全部または一部の提供を停止または中断することができるものとします。
<ul>
<li>本サービスにかかるコンピュータシステムの保守点検または更新を行う場合</li>
<li>地震，落雷，火災，停電または天災などの不可抗力により，本サービスの提供が困難となった場合</li>
<li>コンピュータまたは通信回線等が事故により停止した場合</li>
<li>その他，当社が本サービスの提供が金銭的事情などから困難と判断した場合</li>
<li>製作者は，本サービスの提供の停止または中断により，ユーザーまたは第三者が被ったいかなる不利益または損害についても，一切の責任を負わないものとします。</li>
</ul>

<h3>【アクセス制限について】</h3>
製作者は，ユーザーが以下のいずれかに該当する場合には，事前の通知なく，ユーザーに対して，本サービスの全部もしくは一部の利用を制限し，またはユーザーとしての登録を抹消することができるものとします。
<ul>
<li>本規約のいずれかの条項に違反した場合</li>
<li>その他，当社が本サービスの利用を適当でないと判断した場合</li>
</ul>
製作者は，本条に基づき当社が行った行為によりユーザーに生じた損害について，一切の責任を負いません。

        
        <body>";
?>