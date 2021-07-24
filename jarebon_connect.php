<?php
session_start();
       $link = mysqli_connect('mysql153.phy.lolipop.lan', 'LAA1320822', 'SQL0828temp', 'LAA1320822-wordnote');

if(!empty($_SESSION['nm'])){

    if($_SESSION['nm']=="yeah" && $_SESSION['pw']=='82805991'){
       $link = mysqli_connect('mysql153.phy.lolipop.lan', 'LAA1320822', 'SQL0828temp', 'LAA1320822-wordnote');
    
    $_SESSION['err']="clear";
    echo 'ここだよ1';
    }
}elseif(!empty($_POST['nm'])){
    if($_POST['nm']=="yeah" && $_POST['pw']=='82805991'){
    $link = mysqli_connect('mysql153.phy.lolipop.lan', 'LAA1320822', 'SQL0828temp', 'LAA1320822-wordnote');
    
    $_SESSION['nm'] ='yeah';
    $_SESSION['pw'] = '82805991';
    //$_SESSION['err']="clear";
	echo "ここきてる？";
}
   echo 'ここだよ2';

}else{
   
}
