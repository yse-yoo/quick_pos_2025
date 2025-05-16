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

    <script src="js/app.js"></script>
</body>


</html>