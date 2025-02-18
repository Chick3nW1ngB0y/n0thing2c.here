// Inisialisasi variabel
let cart = [];
let totalAmount = 0;

// Fungsi untuk menambahkan item ke keranjang
function addItem(name, price) {
    const item = { name, price };
    cart.push(item);
    calculateTotal();
    updateCartDisplay();
}

// Fungsi untuk menghapus item dari keranjang
function removeItem(name) {
    cart = cart.filter(item => item.name !== name);
    calculateTotal();
    updateCartDisplay();
}

// Fungsi untuk menghitung total harga
function calculateTotal() {
    totalAmount = cart.reduce((total, item) => total + item.price, 0);
}

// Fungsi untuk memproses pembayaran
function processPayment() {
    if (totalAmount > 0) {
        alert(`Pembayaran sebesar $${totalAmount.toFixed(2)} berhasil diproses!`);
        cart = [];
        totalAmount = 0;
        updateCartDisplay();
    } else {
        alert("Tidak ada item di keranjang untuk memproses pembayaran.");
    }
}

// Fungsi untuk memperbarui tampilan keranjang
function updateCartDisplay() {
    const cartDisplay = document.getElementById('cart');
    cartDisplay.innerHTML = '';

    cart.forEach(item => {
        const itemElement = document.createElement('div');
        itemElement.textContent = `${item.name}: $${item.price.toFixed(2)}`;
        cartDisplay.appendChild(itemElement);
    });

    const totalElement = document.createElement('div');
    totalElement.textContent = `Total: $${totalAmount.toFixed(2)}`;
    cartDisplay.appendChild(totalElement);
}

// Contoh penggunaan
addItem('Item 1', 10.00);
addItem('Item 2', 15.50);
removeItem('Item 1');
processPayment();
