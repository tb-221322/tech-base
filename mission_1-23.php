<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_1-23</title>
    </head>
    <body>
        <?php
        $people=array("Ken","Alice","Judy","BOSS","Bob");
        foreach($people as $who){
            if($who==BOSS){
                echo "Good morning "."BOSS"."<br>";
            }else{
                echo "Hi ".$who."<br>";
            }
        }
        ?>
    </body>
</html>