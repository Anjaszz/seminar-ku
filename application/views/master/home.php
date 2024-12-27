<!-- Breadcrumb -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


<!-- Stat Cards -->
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($box as $b) { ?>
          <?php
          $bgColors = [
              'blue' => 'bg-gradient-to-br from-blue-400 to-blue-600',
              'green' => 'bg-gradient-to-br from-green-400 to-green-600', 
              'yellow' => 'bg-gradient-to-br from-yellow-400 to-yellow-600',
              'red' => 'bg-gradient-to-br from-red-400 to-red-600'
          ];
          $bgColor = $bgColors[$b->color] ?? $bgColors['blue'];
          ?>
          <div class="group <?= $bgColor ?> rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:scale-105 transform transition-all duration-300 ease-in-out">
              <div class="p-6 relative">
                  <div class="flex justify-between items-center">
                      <div>
                          <h3 class="text-3xl font-extrabold text-white"><?= $b->total ?></h3>
                          <p class="text-white/90 mt-1"><?= $b->title ?></p>
                      </div>
                      <a href="<?= $b->link ?>" class="text-white/90 hover:text-white transition-all duration-300">
                          <i class="fa fa-<?= $b->icon ?> text-2xl transform group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300"></i>
                      </a>
                  </div>
              </div>
          </div>
      <?php } ?>
  </div>
</div>



<script>
document.querySelectorAll('a[href]').forEach(link => {
   link.addEventListener('click', (e) => {
       e.preventDefault();
       window.location.href = link.getAttribute('href');
   });
});
</script>