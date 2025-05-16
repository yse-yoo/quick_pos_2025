<?php
// 共通ファイル読み込み
require_once "../app.php";

// 年月プルダウンデータ
$years = range(date('Y'), 2023);
$months = range(1, 12);

// 年月の初期値
$current_year = $_GET['year'] ?? date('Y');
$current_month = $_GET['month'] ?? date('n');

// 売上一覧
$salesService = new SalesService();
if ($current_year > 0 && $current_month > 0) {
    // 年月が指定されている場合
    $sales = $salesService->getSalesByMonth($current_year, $current_month);
} else {
    // 年月が指定されていない場合
    $sales = $salesService->getAllSales();
}

// 総売上金額
$total_sales = $salesService->getTotalSales($sales);

function selected($value, $target)
{
    if ($value == $target) return "selected";
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include COMPONENT_DIR . "Head.php"; ?>

<body>

    <?php include COMPONENT_DIR . "Nav.php"; ?>

    <h1 class="text-2xl font-bold text-center p-6">売上管理</h1>

    <div class="p-3 text-center">
        <form action="" method="get">
            <div class="flex justify-center items-center space-x-2">
                <select name="year" class="mr-2 p-2 border">
                    <option value="">年</option>
                    <?php foreach ($years as $year) : ?>
                        <option value="<?= $year ?>" <?= selected($year, $current_year) ?>><?= $year ?></option>
                    <?php endforeach ?>
                </select>
                <select name="month" class="mr-2 p-2 border">
                    <option value="">月</option>
                    <?php foreach ($months as $month) : ?>
                        <option value="<?= $month ?>" <?= selected($month, $current_month) ?>><?= $month ?></option>
                    <?php endforeach ?>
                </select>
                <button class="bg-sky-500 text-white px-3 py-2 rounded">検索</button>
                <a class="border px-3 py-2 rounded" href="sales/">クリア</a>
            </div>
        </form>
    </div>

    <h3 class="text-xl text-center p-3">
        <label for="">総売上</label>
        <span class="text-3xl font-bold"><?= number_format($total_sales) ?></span>
        <span class="text-md">円</span>
    </h3>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">売上日時</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">売上高</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">レセプトNo</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php if ($sales) : ?>
                <?php foreach ($sales as $sale) : ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $sale['created_at'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= number_format($sale['price']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-400"><?= $sale['receipt_number'] ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>

</body>

</html>