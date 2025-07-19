<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Fungsi untuk mengecek apakah user sudah login
function is_logged_in() {
    return isset($_SESSION['id_user']);
}

// Fungsi untuk mengecek apakah user adalah admin
function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Fungsi untuk mengecek apakah user adalah user biasa
function is_user() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'user';
}

// Redirect ke login jika belum login
function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }
}

// Redirect jika bukan admin
function require_admin() {
    if (!is_admin()) {
        header("Location: ../login.php");
        exit;
    }
}

// Redirect jika bukan user biasa
function require_user() {
    if (!is_user()) {
        header("Location: ../login.php");
        exit;
    }
}
?>
