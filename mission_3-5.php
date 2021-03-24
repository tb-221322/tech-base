<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_3-5</title>
    </head>
    <body>
        <?php
        //変数定義
        $filename="mission_3-5.txt";
        $name=$_POST["name"];
        $comment=$_POST["comment"];
        $date=date("Y年m月d日 H時i分s秒");
        $deletenumber=$_POST["deletenumber"];
        $editnumber=$_POST["editnumber"];
        $editnum=$_POST["editnum"];
        $password1=$_POST["password1"];
        $password2=$_POST["password2"];
        $password3=$_POST["password3"];
        //ファイルが存在したら、そのファイルに保存されている最終行の投稿番号を取得し、それに+1をする
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
        $connection="$number<>"."$name<>"."$comment<>"."$date<>";
        //パスワードにoguchanmanと入力されたら名前、コメントを書き込むことができる
        if(!empty($password1)&&$password1!="oguchanman"){
            echo "パスワードが違います";
        }elseif($password1=="oguchanman"){
            if(!empty($name)&&!empty($comment)&&empty($editnum)){
                $fp1=fopen($filename,"a");
                fwrite($fp1,$connection.PHP_EOL);
                fclose($fp1);
            }
        }
        //パスワードにoguchanmanと入力されたら削除できる
        if(!empty($password2)&&$password2!="oguchanman"){
            echo "パスワードが違います";
        }elseif($password2=="oguchanman"){
            if(!empty($deletenumber)){
                $items1=file($filename,FILE_IGNORE_NEW_LINES);
                $fp2=fopen($filename,"w");
                foreach($items1 as $item1){
                    $str1=explode("<>",$item1);
                    if($str1[0]!=$deletenumber){
                        fwrite($fp2,"$str1[0]<>"."$str1[1]<>"."$str1[2]<>"."$str1[3]<>".PHP_EOL);
                    }
                }
                fclose($fp2);
            }
        }
        //パスワードにoguchanmanと入力されたら編集できる
        if(!empty($password3)&&$password3!="oguchanman"){
            echo "パスワードが違います";
        }elseif($password3=="oguchanman"){
            if(!empty($editnumber)){
                $items2=file($filename,FILE_IGNORE_NEW_LINES);
                $fp3=fopen($filename,"r");
                foreach($items2 as $item2){
                    $str2=explode("<>",$item2);
                    if($str2[0]==$editnumber){
                        $editname=$str2[1];
                        $editcomment=$str2[2];
                        $editednumber=$str2[0];
                    }
                }fclose($fp3);
            }
        }
        //編集する
        if($password1=="oguchanman"){
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
        }
        ?>
        <form action="" method="post">
            <input type="text" name="name" placeholder="お名前" value="<?php echo $editname?>"><br>
            <input type="text" name="comment" placeholder="コメント" value="<?php echo $editcomment?>"><br>
            <input type="hidden" name="editnum" value="<?php echo $editednumber?>"><br>
            <input type="password" name="password1" placeholder="パスワード">
            <input type="submit" name="submit"><br>
            <br>
            <input type="number" name="deletenumber" placeholder="削除対象番号"><br>
            <input type="password" name="password2" placeholder="パスワード">
            <input type="submit" name="delete" value="削除"><br>
            <br>
            <input type="number" name="editnumber" placeholder="編集対象番号"><br>
            <input type="password" name="password3" placeholder="パスワード">
            <input type="submit" name="edit" value="編集">
        </form>
        <?php
        if(file_exists($filename)){
            $items=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($items as $item){
                 $str4=explode("<>",$item);
                echo "$str4[0] "."$str4[1] "."$str4[2] "."$str4[3]"."<br>";
            }
        }
        ?>
    </body>
</html>