<?php
    // フォームがサブミットされた場合にあいさつを出力する
    if ($_POST['user']) {
        print "Hello, ";
        //「user」というフォームパラメータでサブミットされたものを出力する
        print $_POST['user'];
        print "!";
    } else {
        // そうでなければ、フォームを出力する
        print <<<_HTML_
            <form method="post" action="$_SERVER[PHP_SELF]">
                Your Name: <input type="text" name="user" />
                <br/>
                <button type="submit">Say Hello</button>
            </form>
        _HTML_;
    }
?>
