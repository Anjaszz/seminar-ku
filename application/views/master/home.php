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
                          <h3 class="text-3xl font-extrabold text-white">
                          <?php if ($b->title === 'Total Pemasukan'): ?>
                                    Rp <?= number_format($b->total, 0, ',', '.') ?>
                                <?php else: ?>
                                    <?= $b->total ?>
                                <?php endif; ?>
                          </h3>
                          <p class="text-white mt-1"><?= $b->title ?></p>
                      </div>
                      <a href="<?= $b->link ?>" class="text-white/90 hover:text-white transition-all duration-300">
                          <i class="fa fa-<?= $b->icon ?> text-2xl transform group-hover:rotate-12 group-hover:scale-110 transition-transform duration-300 text-white"></i>
                      </a>
                  </div>
              </div>
              <div class="absolute -bottom-4 left-0 right-0 h-16 overflow-hidden">
    <svg viewBox="0 0 500 150" preserveAspectRatio="none" class="h-full w-full">
        <path d="M0,50 C150,150 350,0 500,50 L500,150 L0,150 Z" fill="rgba(255,255,255,0.2)"></path>
        <path d="M0,70 C150,170 350,20 500,70 L500,150 L0,150 Z" fill="rgba(255,255,255,0.1)"></path>
    </svg>
</div>
          </div>
      <?php } ?>
  </div>
</div>

<div class="container mx-auto px-4 mt-8">
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Analisis Pendapatan</h2>
                <p class="text-gray-500 text-sm">Tren pendapatan bulanan tahun <?= date('Y') ?></p>
            </div>
            <div class="flex gap-2">
                <select id="chartType" class="px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="year">Tahun Ini</option>
                    <option value="6months">6 Bulan Terakhir</option>
                    <option value="3months">3 Bulan Terakhir</option>
                </select>
            </div>
        </div>
        
        <!-- Ringkasan statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-blue-600 mb-1">Total Pendapatan</p>
                <h4 class="text-lg font-bold text-blue-900" id="totalIncome">Rp 0</h4>
            </div>
            <div class="p-4 bg-green-50 rounded-lg">
                <p class="text-sm text-green-600 mb-1">Rata-rata Bulanan</p>
                <h4 class="text-lg font-bold text-green-900" id="avgIncome">Rp 0</h4>
            </div>
            <div class="p-4 bg-purple-50 rounded-lg">
                <p class="text-sm text-purple-600 mb-1">Pertumbuhan</p>
                <h4 class="text-lg font-bold text-purple-900" id="growth">0%</h4>
            </div>
        </div>

        <!-- Canvas untuk grafik -->
        <div class="relative" style="height: 400px;">
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
</div>



<script>
document.querySelectorAll('a[href]').forEach(link => {
   link.addEventListener('click', (e) => {
       e.preventDefault();
       window.location.href = link.getAttribute('href');
   });
});

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('incomeChart').getContext('2d');
    let chart;
    
    // Data dari PHP
    const rawData = <?php echo json_encode($monthly_income); ?>;
    
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number);
    }

    function processData(data, period = 'year') {
        let filtered = [...data];
        const now = new Date();
        
        if (period === '6months') {
            filtered = data.slice(-6);
        } else if (period === '3months') {
            filtered = data.slice(-3);
        }

        const labels = filtered.map(item => {
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            return months[item.month - 1];
        });
        
        const values = filtered.map(item => item.total);

        // Update summary statistics
        const total = values.reduce((a, b) => a + b, 0);
        const avg = total / values.length;
        const growth = values.length > 1 ? 
            ((values[values.length - 1] - values[values.length - 2]) / values[values.length - 2] * 100) : 0;

        document.getElementById('totalIncome').textContent = formatRupiah(total);
        document.getElementById('avgIncome').textContent = formatRupiah(avg);
        document.getElementById('growth').textContent = `${growth.toFixed(1)}%`;
        document.getElementById('growth').style.color = growth >= 0 ? '#065f46' : '#991b1b';

        return { labels, values };
    }

    function createChart(data) {
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Pendapatan',
                    data: data.values,
                    borderColor: '#3B82F6',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#FFF',
                    pointBorderColor: '#3B82F6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#1F2937',
                        bodyColor: '#1F2937',
                        borderColor: '#E5E7EB',
                        borderWidth: 1,
                        padding: 12,
                        boxPadding: 6,
                        usePointStyle: true,
                        callbacks: {
                            label: function(context) {
                                return formatRupiah(context.raw);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F3F4F6'
                        },
                        ticks: {
                            font: {
                                size: 12
                            },
                            callback: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    }
                }
            }
        });
    }

    // Initial chart creation
    const initialData = processData(rawData);
    chart = createChart(initialData);

    // Handle period changes
    document.getElementById('chartType').addEventListener('change', function(e) {
        const newData = processData(rawData, e.target.value);
        chart.destroy();
        chart = createChart(newData);
    });
});
</script>