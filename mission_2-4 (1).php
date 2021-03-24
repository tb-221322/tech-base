<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-4</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="txt" name="str" placeholder="コメント">
            <input type="submit" name="submit">
        </form>
        <?php
        $filename="mission_2-4.txt";
        if(!empty($_POST["str"])){
            //コメント欄が空でないとき
            $x=$_POST["str"];
            $fp=fopen($filename,"a");
            fwrite($fp,$x.PHP_EOL);
            fclose($fp);
        }
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($items as $item){
                echo "おめでとう!by"."$item<br>";
            }
        }
        ?>
    </body>
</html>