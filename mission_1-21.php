<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_1-21</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="number" name="number"  placeholder="数字を入力してください">
            <input type="submit" name="submit">
        </form>
        <?php
        $number=$_POST["number"];
        if($number%3==0&&$number%5==0){
            echo "FizzBuzz";
        }elseif($number%3==0){
            echo "Fizz";
        }elseif($number%5==0){
            echo "Buzz";
        }else{
            echo $number; 
        }
        ?>
    </body>
</html>