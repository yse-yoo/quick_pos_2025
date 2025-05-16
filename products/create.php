<?php
require_once '../app.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = (int)($_POST['price'] ?? 0);
    $code = $_POST['code'] ?? '';

    if ($name && $price > 0) {
        $pdo = Database::getInstance();
        $sql = "INSERT INTO products (code, name, price) VALUES (:code, :name, :price)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':code' => $code, ':name' => $name, ':price' => $price]);
        header('Location: ./');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<?php include COMPONENT_DIR . 'Head.php'; ?>

<body>
    <?php include COMPONENT_DIR . 'Nav.php'; ?>

    <main class="max-w-xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">商品登録</h1>

        <form method="post" class="space-y-4 bg-white p-6 shadow rounded">
            <div>
                <label class="block mb-1">商品コード</label>
                <input type="text" name="code" required class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">商品名</label>
                <input type="text" name="name" required class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block mb-1">価格</label>
                <input type="number" name="price" required class="w-full border p-2 rounded">
            </div>
            <button class="bg-green-500 text-white px-4 py-2 rounded">登録</button>
        </form>
    </main>
</body>

</html>