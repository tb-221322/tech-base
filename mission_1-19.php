<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_1-19</title>
    </head>
    <body>
        <?php
        for($i=0;$i<=99;$i++){
            if($i%3==0&&$i%5==0){
                echo "FizzBuzz<br>";
            }elseif($i%3==0){
                echo "Fizz<br>";
            }elseif($i%5==0){
                echo "Buzz<br>";
            }else{
                echo $i;
                echo "<br>";
            }
        }
        ?>
    </body>
</html>