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