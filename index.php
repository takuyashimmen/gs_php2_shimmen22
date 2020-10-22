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
            <div class="text-center">お名前を教えて下さい</div>
            <div class="text-center">
                 <input type="text" id="uname"></div>
            </div>    
            <div class="b-container">
               <button type="button" id="save" class ="sbtn">登録</button>
            </div>
        </main>
    </div>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- JQuery -->

    <script>
    //1.Save クリックイベント
    $("#save").on("click",function(){
        localStorage.setItem("uname",$("#uname").val());
        location.href = "question.php";
    });

    // uname自動入力
    window.onload = function(){
        const uname = localStorage.getItem("uname");
        $("#uname").val(uname);
    }


    </script>
<footer><small>-</small></footer>
</body>
</html>