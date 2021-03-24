<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-3</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="name" placeholder="お名前"><br>
            <input type="text" name="comment" placeholder="コメント">
            <input type="submit" name="submit"><br>
            <br>
            <input type="number" name="deletenumber" placeholder="削除番号">
            <input type="submit" name="delete" value="削除">
        </form>
        <?php
        $filename="mission_3-3.txt";
        $name=$_POST["name"];
        $comment=$_POST["comment"];
        $deletenumber=$_POST["deletenumber"];
        $date=date("Y年m月d日 H時i分s秒");
        //ファイルが存在したら、そのファイルに保存されている最終行の投稿番号を取得し、それに＋1をする
        if(file_exists($filename)){
            //ファイルの中身を配列に格納
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            //配列の最終行を取得
            $hairetu=end($items);
            //最終行を分割
            $str=explode("<>",$hairetu);
            $number=$str[0]+1;
        }else{
            $number=1;
        }
        $connection="$number<>"."$name<>"."$comment<>"."$date";
        if(!empty($name)&&!empty($comment)){
            $fp1=fopen($filename,"a");
            fwrite($fp1,$connection.PHP_EOL);
            fclose($fp1);
        }
        if(!empty($deletenumber)){
            $arrays=file($filename,FILE_IGNORE_NEW_LINES);
            $fp2=fopen($filename,"w");
            foreach($arrays as $array){
                $str=explode("<>",$array);
                if($str[0]!=$deletenumber){
                    fwrite($fp2,"$str[0]<>"."$str[1]<>"."$str[2]<>"."$str[3]<>".PHP_EOL);
                }
            }fclose($fp2);
        }
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($items as $item){
                $str=explode("<>",$item);
                echo "$str[0] "."$str[1] "."$str[2] "."$str[3]"."<br>";
            }
        }
        ?>
    </body>
</html>