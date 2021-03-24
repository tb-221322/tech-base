<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-2</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="txt" name="name" placeholder="お名前"><br>
            <input type="txt" name="comment" placeholder="コメント"><br>
            <input type="submit" name="submit"><br>
        </form>
        <?php
        $filename="mission_3-2.txt";
        $x=$_POST["name"];
        $y=$_POST["comment"];
        $date=date("Y年m月d日 H時i分s秒");
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            $number=count($items)+1;
        }else{
            $number=1;
        }
        $connection="$number<>"."$x<>"."$y<>"."$date";
        if(!empty($x)&&!empty($y)){
            $fp=fopen($filename,"a");
            fwrite($fp,$connection.PHP_EOL);
            fclose($fp);
        }
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            //file関数でファイルを読み込み、配列に格納
            foreach($items as $item){
                $str=explode("<>",$item,4);
                echo "$str[0] "."$str[1] "."$str[2] "."$str[3]<br>";
            }
        }
        ?>
    </body>
</html>