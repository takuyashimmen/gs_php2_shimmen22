<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$id_question = $_POST['id_question'];
$question = $_POST['question'];
$id_user = $_POST['id_user'];
$answer = $_POST['answer'];
// POSTの場合はパスワードも送ってみる。

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

//2. DB接続します
try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage()); //できなかったときにエラーメッセージ出す
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO ogiri_answer(id_answer,id_question,question,time,id_user,answer,liked) VALUES(NULL,:id_question,:question,sysdate(),:id_user,:answer,0)"); //直接入れると怖いのでバインド変数はさむ
$stmt->bindValue(':id_question', h($id_question), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT) //バインド変数に何を入れるか定義
$stmt->bindValue(':question', h($question), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT) //バインド変数に何を入れるか定義
$stmt->bindValue(':id_user',h($id_user), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':answer', h($answer), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //結果が$statusに入る
console.log($answer);

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
//   //５．index.phpへリダイレクト
//   header ('Location: index.php');
}
?>
