<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_1-27-1</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="number" name="number" placeholder="数字を入力してください">
            <input type="submit" name="submit">
        </form>
        <?php
        $number=$_POST["number"];
        $filename="mission_1-27-1.txt";
        $fp=fopen($filename,"a");
        fwrite($fp,$number.PHP_EOL);
        fclose($fp);
        echo "書き込み成功!<br>";
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($items as $item){
                if($item%3==0&&$item%5==0){
                    echo "FizzBuzz ";
                }elseif($item%3==0){
                    echo "Fizz ";
                }elseif($item%5==0){
                    echo "Buzz ";
                }else{
                    echo "$item " ;
                }
            }
        }
        ?>
    </body>
</html>