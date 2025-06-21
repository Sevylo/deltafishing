<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    <main class="max-w-5xl mx-auto mt-12 p-6">
        
        <section class="mb-10">
            <h2 class="text-center text-2xl font-semibold text-gray-800 mb-4">Grafik Total Transaksi per Tanggal</h2>
            <div id="grafik-container" class="bg-white p-4 rounded-lg shadow">
                <canvas 
                    id="myChart" 
                    width="400" 
                    height="200"
                    data-labels="{{ json_encode($labels) }}"
                    data-values="{{ json_encode($data) }}"
                ></canvas>
            </div>
            <button onclick="downloadPDF()" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Download Grafik</button>
        </section>

        <section class="bg-white rounded-lg shadow p-6">
            <h2 class="text-center text-2xl font-semibold text-gray-800 mb-6">Daftar Transaksi</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-center">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="py-3 px-4 border">ID</th>
                            <th class="py-3 px-4 border">Nama</th>
                            <th class="py-3 px-4 border">Alamat</th>
                            <th class="py-3 px-4 border">No HP</th>
                            <th class="py-3 px-4 border">Jumlah</th>
                            <th class="py-3 px-4 border">Tanggal</th>
                            <th class="py-3 px-4 border">Total Harga</th>
                            <th class="py-3 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bayars as $bayar)
                        <tr class="even:bg-gray-100 hover:bg-gray-200">
                            <td class="py-2 px-4 border">{{ $bayar->id }}</td>
                            <td class="py-2 px-4 border">{{ $bayar->id }}</td>
                            <td class="py-2 px-4 border">{{ $bayar->id }}</td>
                            <td class="py-2 px-4 border">{{ $bayar->nohp }}</td>
                            <td class="py-2 px-4 border">{{ $bayar->jumlah }}</td>
                            <td class="py-2 px-4 border">{{ \Carbon\Carbon::parse($bayar->tanggal)->format('d M Y') }}</td>
                            <td class="py-2 px-4 border">Rp {{ number_format($bayar->total_harga, 0, ',', '.') }}</td>
                            <td class="py-2 px-4 border space-x-2">
                                <a href="{{ route('bayar.edit', $bayar->id) }}" class="inline-block bg-blue-500 text-white px-3 py-1 rounded text-sm font-medium hover:bg-blue-600">Edit</a>
                                <form action="{{ route('bayar.destroy', $bayar->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm font-medium hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    
    <script>
        function downloadPDF() {
            const chartContainer = document.getElementById('grafik-container');
            if (chartContainer) {
                html2canvas(chartContainer).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF({ orientation: 'landscape' });
                    const imgProps= pdf.getImageProperties(imgData);
                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                    pdf.save("grafik-transaksi.pdf");
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('myChart');

            if (canvas) {
                // 2. PERBAIKAN: Ambil data dari atribut data-* dan ubah kembali menjadi objek/array JavaScript
                const chartLabels = JSON.parse(canvas.dataset.labels || '[]');
                const chartData = JSON.parse(canvas.dataset.values || '[]');

                const ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Total Transaksi',
                            data: chartData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>