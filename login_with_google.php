<?php
require_once 'vendor/autoload.php'; // Memuat Google API Client Library

// Konfigurasi OAuth 2.0
$clientID = '329500161153-3ah68d5lk3gedbfoevvmel0a9vb0dopu.apps.googleu';
$clientSecret = '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 ';
$redirectUri = 'http://localhost/project/login.php';

// Inisialisasi objek OAuth 2.0
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email'); // Mengakses informasi alamat email pengguna

// Jika pengguna belum login dengan Google, arahkan mereka ke halaman login Google
if (!isset($_GET['code'])) {
    $authURL = $client->createAuthUrl();
    header('Location: ' . filter_var($authURL, FILTER_SANITIZE_URL));
} else {
    // Tangani callback dari Google setelah login
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    $oauth = new Google_Service_Oauth2($client);
    $userData = $oauth->userinfo->get();
    
    // Di sini Anda dapat menggunakan informasi pengguna dari Google untuk login atau registrasi sesuai kebutuhan aplikasi Anda
    // Contoh: Anda bisa mencocokkan email dari Google dengan data di database Anda dan login atau mendaftar pengguna

    // Setelah berhasil login, Anda bisa mengarahkan pengguna ke halaman utama atau melakukan tindakan lain yang diperlukan
    header('Location: home.php');
}
?>
