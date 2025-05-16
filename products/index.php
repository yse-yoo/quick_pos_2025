<?php
require_once '../app.php';

// DB接続
$pdo = Database::getInstance();
$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<?php include COMPONENT_DIR . 'Head.php'; ?>

<body>
    <?php include COMPONENT_DIR . 'Nav.php'; ?>

    <main class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">商品一覧</h1>

        <a href="products/create.php" class="inline-block mb-4 bg-sky-500 text-white px-4 py-2 rounded">商品を追加</a>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">コード</th>
                    <th class="border px-4 py-2">商品名</th>
                    <th class="border px-4 py-2">価格</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($product['code']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($product['name']) ?></td>
                        <td class="border px-4 py-2"><?= number_format($product['price']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>