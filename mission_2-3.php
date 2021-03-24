<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-3</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="txt" name="str" placeholder="コメント">
            <input type="submit" name="submit">
        </form>
        <?php
        if(!empty($_POST["str"])){
            $x=$_POST["str"];
            $filename="mission_2-3.txt";
            $fp=fopen($filename,"a");
            fwrite($fp,$x.PHP_EOL);
            fclose($fp);
        }
        ?>
    </body>
</html>