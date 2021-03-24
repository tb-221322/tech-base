<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-1</title>
    </head>
    <body>
        <form action="" method="post">
            名前:<input type="txt" name="name" placeholder="お名前"><br>
            コメント:<input type="txt" name="comment" placeholder="コメント"><br>
            <input type="submit" name="submit">
        </form>
        <?php
        $filename="mission_3-1.txt";
        $x=$_POST["name"];
        $y=$_POST["comment"];
        //ファイルの名前を決める、xに名前を、yにコメントを代入
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            $number=count($items)+1;
        }else{
            $number=1;
        }
        //ファイルが存在しないとき、すなわち初めて投稿するときはnumberに1を代入
        //ファイルが存在するときは要素の個数+1
        $date=date("Y年m月d日 H時i分s秒");
        $connection="$number<>"."$x<>"."$y<>"."$date<>";
        if(!empty($_POST["name"])&&!empty($_POST["comment"])){
            //フォーム欄が空でないとき
        $fp=fopen($filename,"a");
        fwrite($fp,$connection.PHP_EOL);
        fclose($fp);
        }
        ?>
    </body>
</html>