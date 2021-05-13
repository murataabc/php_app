<?php
    require_once(__DIR__ . '/functions.php');
    define('DSN', 'mysql:host=localhost;dbname=phpapp;charset=utf8mb4');
    $pdo = new PDO(
        DSN,
        'phpappuser',
        'phpapppass',
        [
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = filter_input(INPUT_GET, 'action');
        switch ($action) {
            case 'add':
                add($pdo);
                break;
            case 'delete':
                delete($pdo);
                break;
            default:
                exit;
        }
        header('Location: ' . 'http://' . $_SERVER['HTTP_HOST'] . '/php_app');
    }
    $stmt = $pdo->query("SELECT * FROM taxes");
    $taxes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>PHP App</title>
</head>
<body>
    <form action="?action=add" method="post">
        開始日<input type="date" name="start_date">
        税率<input type="number" name="tax_rate">
        <button>send</button>
    </form>
    <form action="?action=delete" method="post">
        <table>
            <thead>
                <tr>
                    <th>開始日</th>
                    <th>税率</th>
                    <th>選択</th>
                </tr>
            </thead>
            <tbody>
                <? foreach($taxes as $tax): ?>
                    <tr id="<?=$tax['id'] ?>">
                        <td><?=$tax['start_date'] ?></td>
                        <td><?=$tax['tax_rate'] ?></td>
                        <td><input type="checkbox" name="id_datas[]" value="<?=$tax['id'] ?>"></td>
                    </tr>
                <? endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><button>削除</button></td>
                </tr>
            </tbody>
        </table>
    </form>

    <form name='calc'>
        <input type="number" name="amount">
        <button>計算</button>
    </form>
    <div id="calc_result">
        <ul></ul>
    </div>
    <script src="js/main.js"></script>
</body>
</html>