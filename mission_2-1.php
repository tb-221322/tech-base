<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_2-1</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="txt" name="str" value="コメント">
            <input type="submit" name="submit">
        </form>
        <?php
        $x=$_POST["str"];
        echo $x."を受け付けました<br>";
        ?>
    </body>
</html>