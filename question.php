<?php
//1.  DB接続

try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db; charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage()); //できなかったときにエラーメッセージ出す
}

//２．質問取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM ogiri_question"); //すでにあるのをとるからバインドは不要
$status = $stmt->execute();


//３．質問表示
$question="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //JS引き渡し
    $json_list = json_encode( $result , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    //初期質問表示
    // $questionset = ($result[array_rand($result)]);
    // $question = $questionset['text'];
    // while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    // var_dump($result);
    // $view .= "<p>";
    // $view .= $result['indate'] .' '. $result['name'].' '.$result['text'];
    // $view .= "</p>";
//   }
}
?>


<!DOCTYPE html>
<html>
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
            <div class ="h-container">
                <div>WELCOME_</div>
                <div id="uname"></div>
                <div>! Continuity is the father of success!</div>
            </div>        
            <div>
                <img src="img/Q.jpg" width="20"  alt="ロゴ">
            </div>
            <div class ="q-container" id="question"><?= $question ?></div>
            <div class="text-center">回答</div>
            <div class="text-center">
                <textarea id="answer" class="answer"></textarea>
            </div>    
            <div class="b-container">
                <button type="button" id="save" class ="sbtn">投稿</button>
               <button type="button" id="change" class="cbtn">お題変更</button>
            </div>
        </main>
    </div>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- JQuery -->

    <script>
    //関数：ランダム質問表示
    function rand(){
        var js_list = JSON.parse('<?php echo $json_list; ?>');
        var i = js_list.length;
        var r = Math.floor(Math.random()*i)+1;
        var questionset = js_list[r];
        var question = questionset['question'];
        console.log(questionset);
        $("#question").html(question); 
        sessionStorage.setItem('questionset',JSON.stringify(questionset));
    }

    //ページロード時
    window.onload = function(){
        const uname = localStorage.getItem("uname")
        $("#uname").html(uname)
        rand();
    }

    //0.Change クリックイベント
    $("#change").on("click",function(){
        rand();
    });

    //1.Save クリックイベント
    $("#save").on("click",function(){
        const uname = localStorage.getItem("uname")
        var questionset = JSON.parse(sessionStorage.getItem('questionset'));
        xhr = new XMLHttpRequest();
        xhr.open('POST','insert.php', true);
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
        // //投稿時間取得
        // let now = new Date();  
        // let year = now.getFullYear(); 
        // let month = now.getMonth() + 1; 
        // let date = now.getDate();   
        // let day = now.getDay();   
        // let h = now.getHours();    
        // let m = now.getMinutes();  
        // var t = year+"年"+month+"月"+date+"日"+h+"時"+m+"分"
        // POSTする値を設定
        var request = "id_question=" + questionset["id_question"] + "&question=" + questionset["question"] + "&id_user=" + uname + "&answer=" + $("#answer").val();
        //******** ここ汚いので直したい$xhr動かないときある********
        console.log(request);
        xhr.send(request);
        location.href = "dashboard.php";
    });


    //2.clear クリックイベント
    // $("#clear").on("click",function(){
    //     localStorage.clear();
    //     $("#list").empty(); 
    //     // .remove使うとリスト自体がなくなる
    //     alert("OK");
    // });


    //3.ページ読み込み
    //保存データ取得表示
    // for(let i=1; i<localStorage.length; i++){
    //     const key = localStorage.key(i);
    //     const memo = localStorage.getItem(key);
    //     const html ='<tr><td>'+key+'</td><td>'+memo+'</td></tr>';
    //     $("#list").append(html);
    // }

    // ref.on("child_added", function(data){
    //     const v = data.val(); //送信されたオブジェクトを取得
    //     const k = data.key; //ユニークキーの取得
    //     const h = '<tr><td>'+v.question+'</td><td>'+v.uname+'</td><td>'+v.answer+'</td></tr>';
    //     $("#list").append(h);
    // });



    // uname自動入力




    </script>
<footer><small>-</small></footer>
</body>
</html>