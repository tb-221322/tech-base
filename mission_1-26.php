<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_1-26</title>
    </head>
    <body>
        <?php
        $str="Good Morning";
        $filename="mission_1-26.txt";
        $fp=fopen($filename,"a");
        fwrite($fp,$str.PHP_EOL);
        fclose($fp);
        echo "書き込み完了!<br>";
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($items as $item){
                echo $item."<br>";
            }
        }
        ?>
    </body>
</html>