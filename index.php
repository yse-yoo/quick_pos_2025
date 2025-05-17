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

    <main class="mt-10 flex">
        <div class="w-1/2">
            <?php include COMPONENT_DIR . 'Register.php' ?>
        </div>
        <div class="w-1/2">
            <?php include COMPONENT_DIR . 'QR.php' ?>

            <?php include COMPONENT_DIR . 'SalesRecord.php' ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.js"></script>
    <script src="js/app.js" defer></script>
    <script src="js/qr_reader.js" defer></script>
</body>


</html>