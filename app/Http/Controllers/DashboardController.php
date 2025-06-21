<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Bayar;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Peserta; 
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        // --- PENGHITUNGAN DATA UNTUK KARTU STATISTIK ---

        // 1. STATISTIK PENGGUNA 
        $totalUsers = User::count();
        $usersThisMonth = User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $usersLastMonth = User::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->count();
        $userGrowth = $usersLastMonth > 0 ? (($usersThisMonth - $usersLastMonth) / $usersLastMonth) * 100 : ($usersThisMonth > 0 ? 100 : 0);

        // 2. STATISTIK PENDAFTARAN EVENT
       
        $totalEventRegistrations = Peserta::count();
        $eventRegistrationsThisMonth = Peserta::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $eventRegistrationsLastMonth = Peserta::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->count();
        $eventGrowth = $eventRegistrationsLastMonth > 0 ? (($eventRegistrationsThisMonth - $eventRegistrationsLastMonth) / $eventRegistrationsLastMonth) * 100 : ($eventRegistrationsThisMonth > 0 ? 100 : 0);

        // 3. STATISTIK BOOKING & PESANAN
        $totalBookings = Booking::count();
        $bookingsThisMonth = Booking::whereMonth('tanggal_booking', now()->month)->whereYear('tanggal_booking', now()->year)->count();
        $bookingsLastMonth = Booking::whereMonth('tanggal_booking', now()->subMonth()->month)->whereYear('tanggal_booking', now()->subMonth()->year)->count();
        $bookingGrowth = $bookingsLastMonth > 0 ? (($bookingsThisMonth - $bookingsLastMonth) / $bookingsLastMonth) * 100 : ($bookingsThisMonth > 0 ? 100 : 0);

        // 4. STATISTIK ITEM (ALAT SEWA & MENU)
        // Menjumlahkan total kuantitas dari item yang dibooking dan alat yang disewa
        $totalItemsSewa = Bayar::sum('jumlah'); // Asumsi 'jumlah' ada di tabel 'bayars'
        $totalItems = $totalItemsSewa;
        // (Perhitungan pertumbuhan untuk ini bisa lebih kompleks, untuk sementara kita tampilkan totalnya)


        // --- PENGHITUNGAN DATA UNTUK CHART ---

        // Get user registration trends (last 7 days)
        $userTrends = User::whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn($item) => [
                'date' => Carbon::parse($item->date)->format('D'),
                'count' => $item->count
            ]);
        
        // Data total untuk Pie Chart
        $totalEvents = Peserta::count();
        $totalOrders = Booking::count(); 
        $totalSewa = Bayar::count();


        // --- MENGIRIM DATA KE VIEW ---
        return Inertia::render('Dashboard', [
            'stats' => [
                [
                    'name' => 'Total Pengguna',
                    'value' => $totalUsers,
                    'change' => sprintf('%+.1f%%', $userGrowth),
                    'changeType' => $userGrowth >= 0 ? 'positive' : 'negative',
                    'icon' => 'UsersIcon',
                ],
                [
                    'name' => 'Pendaftaran Event Bulan Ini',
                    'value' => $eventRegistrationsThisMonth,
                    'change' => sprintf('%+.1f%%', $eventGrowth),
                    'changeType' => $eventGrowth >= 0 ? 'positive' : 'negative',
                    'icon' => 'CalendarDaysIcon',
                ],
                [
                    'name' => 'Booking Bulan Ini',
                    'value' => $bookingsThisMonth,
                    'change' => sprintf('%+.1f%%', $bookingGrowth),
                    'changeType' => $bookingGrowth >= 0 ? 'positive' : 'negative',
                    'icon' => 'ShoppingCartIcon',
                ],
                [
                    'name' => 'Total Item Disewa & Dipesan',
                    'value' => $totalItems,
                    'change' => '', 
                    'changeType' => 'positive',
                    'icon' => 'FishIcon',
                ]
            ],
            // Data ini untuk komponen UserCharts.vue Anda
            'chartData' => [
                'userTrends' => $userTrends,
                'totals' => [
                    'users' => $totalUsers,
                    'events' => $totalEvents,
                    'orders' => $totalOrders,
                    'sewa' => $totalSewa
                ]
            ]
        ]);
    }
}