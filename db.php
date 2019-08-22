<?php
    // SQLiteデータベース「dinner.db」を使う
    $db = new PDO('sqlite:dinner.db');
    // 許される食事を定義する
    $meals = array('breakfast', 'lunch', 'dinner');
    // サブミットされたフォームパラメータの「meal」が、
    // 「breakfast」、「lunch」、「dinner」のいずれかであるかを確認する
    if (in_array($_POST['meal'], $meals)) {
        // その場合、指定された食事のすべての料理を取得する
        $stmt = $db->prepare('SELECT dish,price FROM meals WHERE meal LIKE ?');
        $stmt->execute(array($_POST['meal']));
        $rows = $stmt->fetchAll();
        // データベース内に全く料理が見つからなければ、その旨を報告する
        if (count($rows) == 0) {
            print "No dishes available.";
        } else {
            // HTMLテーブルに各料理と値段を
            // 行として出力する
            print '<table><tr><th>Dish</th><th>Price</th></tr>';
            foreach ($rows as $row) {
                print "<tr><td>$row[0]</td><td>$row[1]</td></tr>";
            }
            print "</table>";
        }
    } else {
        // このメッセージはサブミットされたパラメータの「meal」が
        // 「breakfast」、「lunch」、「dinner」のいずれでもない場合に出力する
        print "Unknown meal.";
    }
?>
