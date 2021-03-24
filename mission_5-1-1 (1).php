<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_5-1</title>
    </head>
    <body>
        <?php
        //変数定義
        $name=$_POST["name"];
        $comment=$_POST["comment"];
        $deletenumber=$_POST["deletenumber"];
        $editnumber=$_POST["editnumber"];
        $password1=$_POST["password1"];
        $password2=$_POST["password2"];
        $password3=$_POST["password3"];
        $editnum=$_POST["editnum"];
        $date=date("Y年m月d日 H時i分s秒");
        //データベース接続
        $dsn='mysql:dbname=keijiban2;host=localhost';
        $user='ogu';
        $password='chan';
        $pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
        //新規投稿機能(パスワードを設定し名前、コメントを書き込む)
        if(!empty($name)&&!empty($comment)&&empty($editnum)&&!empty($password1)){
                //データベースに投稿内容を入力
                $sql=$pdo->prepare("INSERT INTO keijiban2 (name, comment, date, password) VALUE (:name, :comment, :date, :password)");
                $sql->bindParam(':name',$name,PDO::PARAM_STR);//nameに$nameを代入
                $sql->bindParam(':comment',$comment,PDO::PARAM_STR);//commentに$commentを代入
                $sql->bindParam(':date',$date,PDO::PARAM_STR);//dateに$dateを代入
                $sql->bindParam(':password',$password1,PDO::PARAM_STR);//passwordに$password1を代入
                $sql->execute();
                echo "新規投稿されました";
        }
        //削除機能(設定したパスワードが入力されたら削除できる)
        if(!empty($deletenumber)&&!empty($password2)){
            //keijiban2のidの値が$deletenumberのデータを抽出
            $id=$deletenumber;
            $sql='SELECT * FROM keijiban2 WHERE id=:id ';
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            $results=$stmt->fetchAll();
            foreach($results as $row){
            //投稿番号と$deletenumberが一致、削除したいデータのパスワードを正しく入力出来たら
            if($deletenumber==$row['id']&&$password2==$row['password']){
                //削除
                $id=$deletenumber;
                $sql='delete from keijiban2 where id=:id';
                $stmt=$pdo->prepare($sql);
                $stmt->bindParam(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                echo "削除できました";
            }else{
                echo "パスワードが違います";
            }
            }
        }
        //編集準備
        if(!empty($editnumber)&&!empty($password3)){
            //keijiban2のidの値が$editnumberのデータを抽出
            $id=$editnumber;
            $sql='SELECT * FROM keijiban2 WHERE id=:id';
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            $results=$stmt->fetchAll();
            foreach($results as $row){
            //投稿番号と$editnumberが一致、編集したいデータのパスワードを正しく入力出来たら
            if($row['id']==$editnumber&&$password3==$row['password']){
                $editname=$row['name'];
                $editcomment=$row['comment'];
                $editednumber=$editnumber;
            }else{
                echo "パスワードが違います";
            }
            }
        }
        //編集機能(設定したパスワードが入力されたら編集できる)
        if(!empty($name)&&!empty($comment)&&!empty($editnum)&&!empty($password1)){
            //keijiban2のidの値が$editnumのデータを抽出
            $id=$editnum;
            $sql='SELECT * FROM keijiban2 WHERE id=:id';
            $stmt=$pdo->prepare($sql);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            $results=$stmt->fetchAll();
            foreach($results as $row){
            //投稿番号と$editnumが一致、編集したいデータのパスワードを正しく入力出来たら
            if($row['id']==$editnum&&$password1==$row['password']){
                //編集
                $id=$editnum;
                $sql='UPDATE keijiban2 SET name=:name,comment=:comment,date=:date WHERE id=:id';
                $stmt=$pdo->prepare($sql);
                $stmt->bindParam(':name',$name,PDO::PARAM_STR);
                $stmt->bindParam(':comment',$comment,PDO::PARAM_STR);
                $stmt->bindParam(':date',$date,PDO::PARAM_STR);
                $stmt->bindParam(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                echo "編集できました";
            }else{
                echo "パスワードが違います";
            }
            }
            
        }
        ?>
        <form action="" method="post">
            <!--投稿フォーム-->
            <input type="text" name="name" placeholder="お名前" value="<?php echo$editname;?>"><br>
            <input type="text" name="comment" placeholder="コメント" value="<?php echo$editcomment;?>"><br>
            <input type="hidden" name="editnum" value="<?php echo$editednumber;?>"><br>
            <input type="password" name="password1" placeholder="パスワードを入力して下さい">
            <input type="submit" name="submit"><br>
            <br>
            <!--削除フォーム-->
            <input type="number" name="deletenumber" placeholder="削除対象番号"><br>
            <input type="password" name="password2" placeholder="パスワードを入力して下さい"> 
            <input type="submit" name="delete" value="削除"><br>
            <br>
            <!--編集フォーム-->
            <input type="number" name="editnumber" placeholder="編集対象番号"><br>
            <input type="password" name="password3" placeholder="パスワードを入力して下さい">
            <input type="submit" name="edit" value="編集">
        </form>
        <?php
        //表示機能
        $sql='SELECT * FROM keijiban2';
        $stmt=$pdo->query($sql);
        $results=$stmt->fetchAll();
        foreach($results as $row){
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['date'].'<br>';
            echo "<hr>";
        }
        ?>
    </body>
</html>