<!-- Tambahkan di header untuk animasi -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<div class="min-h-screen bg-gray-50">
    <!-- Hero Section dengan Poster -->
    <div class="relative overflow-hidden bg-white">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center" data-aos="fade-up">
                <!-- Poster Image -->
                <div class="relative group">
                    <div class="relative overflow-hidden rounded-lg shadow-xl transition-transform duration-300 transform hover:scale-105">
                        <img 
                            src="<?= base_url('uploads/poster/' . $lampiran) ?>" 
                            alt="<?= $nama_seminar ?>"
                            class="w-full h-auto object-cover transition-all duration-300"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>

                <!-- Seminar Info -->
                <div class="space-y-6" data-aos="fade-left" data-aos-delay="200">
                    <h1 class="text-4xl font-bold text-gray-900"><?= $nama_seminar ?></h1>
                    
                    <!-- Info Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Tanggal -->
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal</p>
                                    <p class="font-semibold"><?= $tgl_pelaksanaan ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Lokasi</p>
                                    <p class="font-semibold"><?= $nama_provinsi ?></p>
                                    <p class="text-sm text-gray-600"><?= $detail_lokasi ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Harga -->
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-yellow-100 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Harga Tiket</p>
                                    <p class="font-semibold"><?= $harga_tiket ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Slot -->
                        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Slot Tersedia</p>
                                    <p class="font-semibold"><?= $slot_tiket ?> Tickets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistik Tiket -->
    <div class="bg-gray-50 py-2">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($seminar_box as $index => $sb): ?>
                <div data-aos="zoom-in" data-aos-delay="<?= $index * 100 ?>">
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-full bg-<?= $sb->color ?>-100">
                                <i class="fa fa-<?= $sb->icon ?> text-<?= $sb->color ?>-600 text-xl"></i>
                            </div>
                            <p class="text-2xl font-bold text-<?= $sb->color ?>-600"><?= $sb->total ?></p>
                        </div>
                        <h3 class="mt-4 text-gray-600 font-medium"><?= $sb->title ?></h3>
                        <p class="text-sm text-gray-500">Tickets</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<!-- Pembicara Section -->
<div class="bg-gray-50 py-16">
   <div class="container mx-auto px-4">
       <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Pembicara</h2>
       
       <?php if(empty($pembicara)): ?>
           <div data-aos="fade-up" class="flex flex-col items-center justify-center p-8">
               <div class="relative w-64 h-64 mb-8">
                   <!-- Empty State Illustration -->
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-full h-full text-gray-300">
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm13-4c0 .87-.13 1.71-.37 2.5M19 0a7 7 0 0 1 1.63 4.5"/>
                   </svg>
                   
                   <!-- Animated Circles -->
                   <div class="absolute inset-0 flex items-center justify-center">
                       <span class="animate-ping absolute inline-flex h-32 w-32 rounded-full bg-blue-100 opacity-75"></span>
                       <span class="relative inline-flex rounded-full h-24 w-24 bg-blue-50"></span>
                   </div>
               </div>
               
               <div class="text-center">
                   <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Pembicara</h3>
                   <p class="text-gray-500 max-w-md mx-auto leading-relaxed">
                       Seminar ini belum memiliki pembicara yang terdaftar. Informasi pembicara akan ditampilkan segera setelah tersedia.
                   </p>
               </div>
           </div>
       <?php else: ?>
           <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
               <?php foreach ($pembicara as $index => $p): ?>
                   <div class="group" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                       <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                           <div class="relative h-48">
                               <div class="absolute inset-0 bg-gray-200 animate-pulse"></div>
                               <img 
                                   src="<?= base_url("uploads/pembicara/{$p->foto}") ?>" 
                                   alt="<?= $p->nama_pembicara ?>"
                                   class="w-full h-full object-cover relative z-10"
                                   onload="this.parentElement.querySelector('.animate-pulse').remove()"
                               >
                               <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-20"></div>
                           </div>
                           <div class="relative z-30 p-6">
                               <div class="absolute -top-8 right-6">
                                   <div class="bg-blue-500 text-white p-2 rounded-lg shadow-lg">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                       </svg>
                                   </div>
                               </div>
                               <h3 class="text-xl font-bold mb-2 text-gray-800"><?= $p->nama_pembicara ?></h3>
                               <p class="text-gray-600 text-sm leading-relaxed"><?= $p->latar_belakang ?></p>
                               <div class="mt-4 pt-4 border-t border-gray-100">
                                   <div class="flex items-center text-sm text-gray-500">
                                       <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                       </svg>
                                       <span>Professional Speaker</span>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               <?php endforeach; ?>
           </div>
       <?php endif; ?>
   </div>
</div>

<!-- Sponsor Section -->
<div class="bg-white py-16">
   <div class="container mx-auto px-4">
       <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">Sponsor</h2>
       
       <?php if(empty($sponsor)): ?>
           <div data-aos="fade-up" class="flex flex-col items-center justify-center p-8">
               <div class="relative w-64 h-64 mb-8">
                   <!-- Empty State Illustration -->
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-full h-full text-gray-300">
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.27 6.96L12 12.01l8.73-5.05M12 22.08V12"/>
                   </svg>
                   
                   <!-- Animated Elements -->
                   <div class="absolute inset-0 flex items-center justify-center">
                       <div class="relative">
                           <span class="animate-pulse absolute -inset-1 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full blur opacity-75"></span>
                           <span class="relative inline-flex rounded-full h-24 w-24 bg-gradient-to-r from-blue-50 to-purple-50"></span>
                       </div>
                   </div>
               </div>
               
               <div class="text-center">
                   <h3 class="text-2xl font-bold text-gray-800 mb-2">Seminar Tanpa Sponsor</h3>
                   <p class="text-gray-500 max-w-md mx-auto leading-relaxed">
                       Seminar ini diselenggarakan secara independen tanpa melibatkan sponsor eksternal.
                   </p>
                   <div class="mt-6 flex justify-center space-x-4">
                       <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 text-blue-600 text-sm font-medium">
                           <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                           </svg>
                           Independent Event
                       </span>
                       <span class="inline-flex items-center px-4 py-2 rounded-full bg-purple-50 text-purple-600 text-sm font-medium">
                           <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                           </svg>
                           Community Driven
                       </span>
                   </div>
               </div>
           </div>
       <?php else: ?>
           <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
               <?php foreach ($sponsor as $index => $s): ?>
                   <div class="group" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                       <div class="bg-white p-6 rounded-xl border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                           <div class="aspect-w-16 aspect-h-9">
                               <div class="relative w-full h-full flex items-center justify-center">
                                   <div class="absolute inset-0 bg-gray-200 animate-pulse rounded-lg"></div>
                                   <img 
                                       src="<?= base_url("uploads/sponsor/{$s->gambar}") ?>" 
                                       alt="<?= $s->nama_sponsor ?>"
                                       class="relative z-10 max-h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-110"
                                       onload="this.parentElement.querySelector('.animate-pulse').remove()"
                                   >
                               </div>
                           </div>
                           <div class="mt-4 text-center">
                               <h3 class="text-sm font-medium text-gray-700"><?= $s->nama_sponsor ?></h3>
                               <p class="mt-1 text-xs text-gray-500">Official Sponsor</p>
                           </div>
                       </div>
                   </div>
               <?php endforeach; ?>
           </div>
       <?php endif; ?>
   </div>
</div>


</div>

<script>
    AOS.init({
        duration: 800,
        once: true,
    });
</script>