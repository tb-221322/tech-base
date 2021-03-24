<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-2</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="txt" name="str" value="コメント">
            <input type="submit" name="submit">
        </form>
        <?php
        if(!empty($_POST["str"])){
            $x=$_POST["str"];
        $filename="mission_2-2.txt";
        $fp=fopen($filename,"w");
        fwrite($fp,$x.PHP_EOL);
        fclose($fp);
        if($x=="完成!"){
                echo "おめでとう!";
        }else{
                echo "$x";
        }
        }
        ?>
    </body>
</html>