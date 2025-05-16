function loadQRCode() {
    const modal = document.getElementById("qr-modal");
    modal.classList.remove("hidden");

    const resultElement = document.getElementById("qr-result");
    if (!window.Html5Qrcode) {
        resultElement.textContent = "QR読み取りライブラリが読み込まれていません。";
        return;
    }

    const qrCodeRegionId = "reader";
    const html5QrCode = new Html5Qrcode(qrCodeRegionId);

    const config = {
        fps: 10,
        qrbox: { width: 250, height: 250 }
    };

    function onScanSuccess(decodedText, decodedResult) {
        console.log("読み取り成功:", decodedText);
        resultElement.textContent = "読み取った内容: " + decodedText;

        console.log("QRコードの内容:", decodedText);

        // 1回だけ読み取ったら停止したい場合は↓
        html5QrCode.stop().then(() => {
            console.log("QRコードスキャンを停止しました。");
        });
    }

    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            const cameraId = devices[0].id;
            html5QrCode.start(cameraId, config, onScanSuccess);
        } else {
            resultElement.textContent = "カメラが検出されませんでした。";
        }
    }).catch(err => {
        resultElement.textContent = "カメラアクセスに失敗しました: " + err;
    });
}
