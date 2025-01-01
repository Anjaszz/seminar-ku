<!DOCTYPE html>
<html lang="en">
<head>
   <title>Home</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://cdn.tailwindcss.com"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
   <style>
       @keyframes float {
           0% { transform: translateY(0px); }
           50% { transform: translateY(-10px); }
           100% { transform: translateY(0px); }
       }
       
       .animate-float {
           animation: float 3s ease-in-out infinite;
       }

       @keyframes slideIn {
           from { opacity: 0; transform: translateY(20px); }
           to { opacity: 1; transform: translateY(0); }
       }

       .card-animate {
           animation: slideIn 0.5s ease-out forwards;
       }

       .popup-overlay {
           backdrop-filter: blur(5px);
           background: rgba(0, 0, 0, 0.7);
           opacity: 0;
           transition: opacity 0.3s ease;
       }

       .popup-overlay.show {
           opacity: 1;
       }

       .gradient-text {
           background: linear-gradient(to right, #3b82f6, #8b5cf6);
           -webkit-background-clip: text;
           -webkit-text-fill-color: transparent;
       }

       .typing-effect {
           overflow: hidden;
           white-space: nowrap;
           border-right: 2px solid transparent;
           color: white;
           font-size: 1.25rem;
       }
   </style>
</head>
<body class="bg-gray-50">
   <!-- Hero Section -->
   <header class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-600">
       <div class="absolute inset-0">
           <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 opacity-90"></div>
           <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"30\" height=\"30\" viewBox=\"0 0 30 30\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z\" fill=\"rgba(255,255,255,0.1)\"%3E%3C/path%3E%3C/svg%3E')] opacity-20"></div>
       </div>
       <div class="relative py-16 px-4 sm:px-6 lg:px-8">
           <div class="text-center">
               <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl animate-float">
                   Selamat datang, <?php echo $nama_mahasiswa; ?>!
               </h1>
               <p class="mt-6 text-xl text-gray-100 typing-effect" id="typing-text"></p>
           </div>
       </div>
   </header>

   <!-- Seminar Section -->
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
       <h2 class="flex items-center space-x-2 text-3xl font-bold gradient-text mb-8">
           <i class="fas fa-list-alt"></i>
           <span>Daftar Seminar</span>
       </h2>

       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
           <?php if (!empty($seminar_data)): ?>
               <?php foreach ($seminar_data as $index => $seminar): 
                   $today = new DateTime();
                   $seminar_date = new DateTime($seminar->tgl_pelaksana);
                   $remaining_days = $today->diff($seminar_date)->days;
               ?>
                   <div class="card-animate" style="animation-delay: <?php echo $index * 0.1; ?>s">
                       <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden">
                           <img src="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>" 
                                class="w-full h-48 object-cover cursor-pointer hover:scale-105 transition-transform duration-300" 
                                data-image="<?php echo base_url('uploads/poster/' . $seminar->lampiran); ?>"
                                alt="Seminar Image">
                           
                           <div class="p-6">
                               <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                                   <?php echo $seminar->nama_seminar; ?>
                               </h3>
                               
                               <div class="space-y-2 mb-4">
                                   <p class="flex items-center text-gray-600">
                                       <i class="fas fa-calendar-alt w-5"></i>
                                       <span class="ml-2"><?php echo date('d M Y', strtotime($seminar->tgl_pelaksana)); ?></span>
                                   </p>
                                   <p class="flex items-center text-gray-600">
                                       <i class="fas fa-tags w-5"></i>
                                       <span class="ml-2">Rp <?php echo number_format($seminar->harga_tiket, 0, ',', '.'); ?></span>
                                   </p>
                               </div>
                               <div class="flex items-center space-x-3 bg-gray-50 rounded-lg p-3 mb-4">
<!-- In view: -->
<div class="w-full bg-gray-200 rounded-full h-2.5">
    <div class="h-full rounded-full transition-all duration-500 
        <?php 
            if($seminar->remaining_days <= 7) {
                echo 'bg-red-500';
            } else if($seminar->remaining_days <= 14) {
                echo 'bg-yellow-500';
            } else {
                echo 'bg-green-500';
            }
        ?>"
        style="width: <?php echo number_format($seminar->progress, 0); ?>%">
    </div>
</div>
        <div class="flex items-center space-x-2 min-w-fit">
            <i class="fas fa-clock text-gray-600"></i>
            <span class="font-bold 
                <?php
                    if($seminar->remaining_days <= 7) echo 'text-red-500';
                    else if($seminar->remaining_days <= 14) echo 'text-yellow-500'; 
                    else echo 'text-green-500';
                ?>">
                <?php echo $seminar->remaining_days; ?>
            </span>
            <span class="text-sm text-gray-600">Hari tersisa</span>
        </div>
    </div>
                               <div class="flex items-center justify-between">
                                   <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                       <?php echo $remaining_days; ?> Hari Lagi
                                   </span>
                                   
                                   <div class="flex space-x-2">
                                       <?php if ($seminar->is_history): ?>
                                           <a href="<?php echo base_url('user/home/seminar_history/' . $seminar->id_seminar); ?>" 
                                              class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                               <i class="fas fa-history"></i> History
                                           </a>
                                       <?php elseif ($seminar->is_slot_habis): ?>
                                           <button class="px-4 py-2 bg-red-100 text-red-600 rounded-lg cursor-not-allowed" disabled>
                                               <i class="fas fa-times"></i> Habis
                                           </button>
                                       <?php elseif (isset($seminar->is_registered) && $seminar->id_stsbyr == 1): ?>
                                           <button class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg cursor-not-allowed" disabled>
                                               <i class="fas fa-check"></i> Diikuti
                                           </button>
                                       <?php elseif ($seminar->is_registered): ?>
                                           <a href="<?php echo base_url('payment/bayar/' . $seminar->id_seminar); ?>" 
                                              class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors duration-200">
                                               <i class="fas fa-money-bill"></i> Bayar
                                           </a>
                                       <?php else: ?>
                                           <button class="daftar-seminar px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200"
                                                   data-seminar-id="<?php echo $seminar->id_seminar; ?>">
                                               <i class="fas fa-user-plus"></i> Daftar
                                           </button>
                                       <?php endif; ?>
                                       
                                       <a href="<?php echo base_url('user/home/detail/' . $seminar->id_seminar); ?>" 
                                          class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                                           <i class="fas fa-info-circle"></i> Detail
                                       </a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               <?php endforeach; ?>
           <?php else: ?>
               <div class="col-span-full text-center py-12">
                   <div class="bg-gray-50 rounded-lg p-8">
                       <i class="fas fa-calendar-times text-4xl text-gray-400 mb-4"></i>
                       <p class="text-gray-600">Tidak ada seminar yang tersedia saat ini.</p>
                   </div>
               </div>
           <?php endif; ?>
       </div>
   </div>

   <!-- Image Popup -->
   <div class="popup-overlay fixed inset-0 z-50 hidden items-center justify-center" id="popup-overlay" onclick="closePopup()">
       <div class="relative max-w-4xl mx-auto p-4" onclick="event.stopPropagation()">
           <button class="absolute top-2 right-2 text-white hover:text-gray-300" onclick="closePopup()">
               <i class="fas fa-times text-2xl"></i>
           </button>
           <img src="" alt="Popup Image" class="max-h-[90vh] max-w-full rounded-lg shadow-2xl" id="popup-image">
       </div>
   </div>

   <script>
       // Flash Messages
       <?php if ($this->session->flashdata('message_success')): ?>
           Swal.fire({
               icon: 'success',
               title: 'Berhasil',
               text: '<?php echo $this->session->flashdata('message_success'); ?>',
               showConfirmButton: false,
               timer: 2000
           });
       <?php endif; ?>

       <?php if ($this->session->flashdata('message_error')): ?>
           Swal.fire({
               icon: 'error',
               title: 'Gagal',
               text: '<?php echo $this->session->flashdata('message_error'); ?>',
               showConfirmButton: false,
               timer: 2000
           });
       <?php endif; ?>

       // Typing effect
       const typingText = "Nikmati pengalaman seminar yang seru dan menarik.";
       const typingElement = document.getElementById('typing-text');
       let index = 0;

       function type() {
           if (index < typingText.length) {
               typingElement.textContent += typingText.charAt(index);
               index++;
               setTimeout(type, 100);
           } else {
               setTimeout(() => {
                   typingElement.textContent = "";
                   index = 0;
                   type();
               }, 2000);
           }
       }

       type();

       // Image popup
       document.querySelectorAll('[data-image]').forEach(image => {
           image.addEventListener('click', function() {
               const imageSrc = this.getAttribute('data-image');
               document.getElementById('popup-image').src = imageSrc;
               document.getElementById('popup-overlay').classList.remove('hidden');
               document.getElementById('popup-overlay').classList.add('flex');
           });
       });

       function closePopup() {
           document.getElementById('popup-overlay').classList.add('hidden');
           document.getElementById('popup-overlay').classList.remove('flex');
       }

       // Registration confirmation
       document.querySelectorAll('.daftar-seminar').forEach(button => {
           button.addEventListener('click', function() {
               const seminarId = this.getAttribute('data-seminar-id');
               Swal.fire({
                   title: 'Apakah Anda yakin ingin mendaftar?',
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonText: 'Ya',
                   cancelButtonText: 'Tidak',
                   confirmButtonColor: '#10B981',
                   cancelButtonColor: '#6B7280',
               }).then((result) => {
                   if (result.isConfirmed) {
                       window.location.href = '<?php echo base_url('user/home/daftar/'); ?>' + seminarId;
                   }
               });
           });
       });
   </script>
</body>
</html>