const display = document.getElementById("display");
const totalDisplay = document.getElementById("total-display");
const calculateDisplay = document.getElementById("calculate-display");
const redordsDisplay = document.getElementById("records-display");
const listContainer = document.getElementById("item-list");

let current = "";
let total = 0;
let isMultiplying = false;
let multiplyValue = 0;
const TAX_RATE = 0.1;
let itemList = []; // [{ price: 1000, quantity: 1 }, ...]

/**
 * ディスプレイの値を更新する関数
 * @param {string} value - 表示する値。nullの場合はcurrentディスプレイ
 * @param {*} value 
 */
function updateDisplay(value = null) {
    display.textContent = value !== null ? value : current || "0";
}

/**
 * 数字を追加する関数
 * @param {*} num 
 */
function addNumber(strNum) {
    // すでに current が "0" で、さらに "0", "00", "000" を入力しようとしている場合
    if (current === "0" && /^0+$/.test(strNum)) {
        return;
    }

    // 先頭が "0" のとき、次に数字を入れるなら上書き
    if (current === "0" && /^\d$/.test(strNum)) {
        current = strNum;
    } else {
        current += strNum;
    }

    updateDisplay();
}

/**
 * 演算子を追加する関数
 * @param {*} operator 
 */
function clearAll() {
    current = "";
    total = 0;
    multiplyValue = 0;
    isMultiplying = false;

    updateDisplay();
}

/**
 * 計算を行う関数
 * @param {*} op 
 */
function calculate(op) {
    if (op === "*") {
        multiplyValue = parseFloat(current) || 0;
        current = "";
        isMultiplying = true;
    } else if (op === "+") {
        if (isMultiplying) {
            current = (multiplyValue * (parseFloat(current) || 0)).toString();
            isMultiplying = false;
        }
        total += parseFloat(current) || 0;
        current = "";

        updateDisplay(total.toFixed());
    }
}

/**
 * アイテムを追加する関数
 * @returns 
 */
function addItem() {
    if (!current) return;
    if (current <= 0) return;

    const value = parseFloat(current);
    if (isNaN(value)) return;

    itemList.push({ price: value, quantity: 1 }); // 単価＋数量
    current = "";

    // レジディスプレイを更新
    updateDisplay();

    // 商品リストを更新
    updateRecordsDisplay();
}

/**
 * アイテムリストを表示する関数
 */
function renderItemList() {
    listContainer.innerHTML = "";

    itemList.forEach((item, index) => {
        const subtotal = item.price * item.quantity;

        const li = document.createElement("li");
        li.className = "flex justify-between items-center py-2 border-b";

        li.innerHTML = `
            <div class="text-xl">
                <div>${item.price.toFixed()} × ${item.quantity}</div>
                <div class="text-xs text-gray-500">小計：${subtotal.toFixed()} 円</div>
            </div>
            <div class="flex space-x-1">
                <button onclick="changeQuantity(${index}, -1)" class="p-2 px-4 bg-gray-300 rounded">−</button>
                <button onclick="changeQuantity(${index}, 1)" class="p-2 px-4 bg-gray-300 rounded">＋</button>
                <button onclick="removeItem(${index})" class="p-2 px-4 bg-red-400 text-white rounded">削除</button>
            </div>
        `;

        listContainer.appendChild(li);
    });
}

/**
 * アイテムの数量を変更する関数
 * @param {*} index 
 * @param {*} delta 
 */
function changeQuantity(index, delta) {
    const item = itemList[index];
    item.quantity += delta;

    if (item.quantity < 1) {
        item.quantity = 1;
    }

    // 商品リストを更新
    updateRecordsDisplay();
}

function removeItem(index) {
    itemList.splice(index, 1); // 指定のアイテムを削除
    renderItemList(); // 再描画
    hideSalesArea();  // 表示更新
    totalDisplay.value = ""; // 合計表示リセット

    updateRecordsDisplay();
}

/**
 * 税込み計算を行う関数
 */
function calculateTax() {
    const totalWithoutTax = itemList.reduce((sum, item) => sum + item.price * item.quantity, 0);
    const taxed = (totalWithoutTax * (1 + TAX_RATE)).toFixed();

    total = parseFloat(taxed);
    totalDisplay.value = total.toFixed();

    if (total > 0) {
        showSalesArea();
    } else {
        hideSalesArea();
    }
}

function updateRecordsDisplay() {
    // 商品リストを更新
    renderItemList();
    // 計上非表示
    hideSalesArea();
    if (itemList.length > 0) {
        showCalculateDisplay();
    } else {
        hideCalculateDisplay();
    }
}

function showCalculateDisplay() {
    calculateDisplay.classList.remove("hidden");
}

function hideCalculateDisplay() {
    calculateDisplay.classList.add("hidden");
}

function showSalesArea() {
    redordsDisplay.classList.remove("hidden");
}

function hideSalesArea() {
    redordsDisplay.classList.add("hidden");
}