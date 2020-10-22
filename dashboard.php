<?php
//1.  DB接続します

try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage()); //できなかったときにエラーメッセージ出す
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM ogiri_answer"); //すでにあるのをとるからバインドは不要
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    $view .= '<table border="1"><tr><th>Q</th><th>設問</th><th>投稿者</th><th>アイディア</th></tr>';


    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= "<tr>";
        $view .= '<td>' . $result['id_question'] . '</td>';
        $view .= '<td>' . $result['question'] . '</td>';
        $view .= '<td>' . $result['id_user'] . '</td>';
        $view .= '<td>' . $result['answer'] . '</td>';
        $view .= "</tr>";
    }
    $view .= '</table>';
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ogiri</title>
    <script src="js/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrap">
        <header>
        <h1 class ="text-center">Ideathon</h1>
        </header>
        <main>
          <div class="b-container">
              <button type="button" id="return" class ="sbtn">戻る</button>
          </div>
          <div>
            <div class="container jumbotron"><?= $view ?></div>
          </div>
        </main>

<script>
    $("#return").on("click",function(){
        location.href = "question.php";
    });
</script>

</body>
</html>
