<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-4</title>
    </head>
    <body>
        <?php
        $filename="mission_3-4.txt";
        $name=$_POST["name"];
        $comment=$_POST["comment"];
        $date=date("Y年m月d日 H時i分s秒");
        $deletenumber=$_POST["deletenumber"];
        $editnumber=$_POST["editnumber"];
        $editnum=$_POST["editnum"];
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
        //名前、コメントをファイルに書き込む
        if(!empty($name)&&!empty($comment)&&empty($editnum)){
            $fp1=fopen($filename,"a");
            fwrite($fp1,$connection.PHP_EOL);
            fclose($fp1);
        }
        //削除対象番号が入力された場合、その番号以外の投稿をもう一度入力し直す
        if(!empty($deletenumber)){
        //ファイルの中身を配列に格納しておく
        $items1=file($filename,FILE_IGNORE_NEW_LINES);
        //wモードでファイルをオープンし、ファイルの中身を空にする
            $fp2=fopen($filename,"w");
            foreach($items1 as $item1){
                $str1=explode("<>",$item1);
                if($str1[0]!=$deletenumber){
                    fwrite($fp2,"$str1[0]<>"."$str1[1]<>"."$str1[2]<>"."$str1[3]<>".PHP_EOL);
                }//if閉じ
            }//ループ閉じ
            fclose($fp2);
        }//if閉じ
        //編集対象番号が入力された場合
        if(!empty($editnumber)){
            $items2=file($filename,FILE_IGNORE_NEW_LINES);
            $fp3=fopen($filename,"r");
            foreach($items2 as $item2){
                $str2=explode("<>",$item2);
                if($str2[0]==$editnumber){
                $editednumber=$str2[0];
                $editname=$str2[1];
                $editcomment=$str2[2];
                }
            }fclose($fp3);
        }
        if(!empty($name)&&!empty($comment)&&!empty($editnum)){
            $items3=file($filename,FILE_IGNORE_NEW_LINES);
            $fp4=fopen($filename,"w");
            foreach($items3 as $item3){
                $str3=explode("<>",$item3);
                if($str3[0]==$editnum){
                    fwrite($fp4,"$editnum<>"."$name<>"."$comment<>"."$date<>".PHP_EOL);
                }else{
                    fwrite($fp4,$item3.PHP_EOL);
                }
            }fclose($fp4);
        }
        ?>
        <form action="" method="post">
            <input type="text" name="name" placeholder="お名前" value="<?php echo $editname;?>"><br>
            <input type="text" name="comment" placeholder="コメント" value="<?php echo $editcomment;?>"><br>
            <input type="hidden" name="editnum" value="<?php echo $editednumber;?>"> 
            <input type="submit" name="submit"><br>
            <br>
            <input type="number" name="deletenumber" placeholder="削除対象番号">
            <input type="submit" name="delete" value="削除"><br>
            <br>
            <input type="number" name="editnumber" placeholder="編集対象番号">
            <input type="submit" name="edit" value="編集">
        </form>
        <?php 
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($items as $item){
                $str3=explode("<>",$item);
                echo "$str3[0] "."$str3[1] "."$str3[2] "."$str3[3]"."<br>";
            }
        }
        ?>
    </body>
</html>