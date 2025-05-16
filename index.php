<?php
require_once "app.php";

$message = "レジを入力してください";
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include COMPONENT_DIR . "Head.php"; ?>

<body>
    <?php include COMPONENT_DIR . "Nav.php"; ?>

    <main class="flex">
        <?php include COMPONENT_DIR . 'Register.php' ?>

        <?php include COMPONENT_DIR . 'SalesRecord.php' ?>
    </main>

    <!-- モーダル本体（最初は非表示） -->
    <div id="qr-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-xl p-6 w-[90%] max-w-md relative">
            <!-- 閉じるボタン -->
            <button id="close-modal" class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl font-bold">&times;</button>

            <!-- QRコードリーダー -->
            <div id="reader" class="p-4 border rounded w-full"></div>
            <div id="qr-result" class="mt-4 text-green-600 font-bold text-center"></div>
        </div>
    </div>

    <script src="js/app.js"></script>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="js/qr_reader.js"></script>
</body>


</html>