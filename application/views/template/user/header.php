<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/fav.png') ?>" />
    <style>
       .navbar {
    background: white; /* Gradien dari biru muda ke biru */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.9); 
}

.navbar-nav .nav-link.active {
    color: black !important;
    border-bottom: 2px solid #007bff;
    padding-bottom: 0.5rem;
}

.navbar-nav .nav-link:hover {
    color: #007bff !important;
}


.profile-icon {
    margin-left: auto;
}


#profileButton {
    border: 2px solid #828282; /* Border abu-abu */
    border-radius: 8px; /* Membuat sudut border menjadi kotak dengan radius yang halus */
    padding: 5px 10px; /* Ruang di dalam tombol */
    background-color: transparent; /* Latar belakang transparan mengikuti navbar */
    color: #828282; /* Warna teks/icon */
    box-shadow: none; /* Menghilangkan shadow pada klik */
}

#profileButton i {
    margin-right: 3px; /* Jarak antara icon dan teks */
}

#profileButton:hover {
    background-color: transparent; /* Efek latar belakang saat dihover, transparan */
    
}



.welcome {
    text-align: center;
    margin-top: 20px;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}

.card-title {
    font-weight: bold;
}

.card-text {
    margin-bottom: 5px;
}

.navbar-nav .nav-link {
    margin-right: 15px; /* Jarak antar link */
}

.profile-icon .nav-link {
    font-weight: bold; /* Memberikan penekanan pada link profil */
}

header {
    background-color: #007bff; /* Warna latar belakang biru */
}

.sticky-top {
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    z-index: 1030; /* pastikan navbar tetap di atas elemen lain */
}

.badge-gradient {
    background: linear-gradient(135deg, #808080, #b0b0b0); /* Warna abu-abu gradient */
    color: white; /* Warna teks badge */
}

.navbar-nav .nav-link.active {
    color: #007bff !important; /* Warna biru */
    font-weight: bold; /* Opsional: membuat teks lebih tebal */
}




    </style>
    <!-- Di header view -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>



