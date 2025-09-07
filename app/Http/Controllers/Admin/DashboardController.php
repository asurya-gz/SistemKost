<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kamar;
use App\Models\TypeKamar;
use App\Models\Booking;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = $this->getDashboardStats();
        $recentActivities = $this->getRecentActivities();
        $monthlyData = $this->getMonthlyData();
        
        return view('admin.dashboard', compact('stats', 'recentActivities', 'monthlyData'));
    }
    
    private function getDashboardStats()
    {
        $totalUsers = User::where('role', 'pengguna')->count();
        $totalRooms = Kamar::count();
        $availableRooms = Kamar::where('status_kamar', 'Tersedia')->count();
        $occupiedRooms = Kamar::where('status_kamar', 'Dihuni')->count();
        $totalTypeKamar = TypeKamar::count();
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_amount');
        
        // Calculate occupancy rate
        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100) : 0;
        
        // This month stats
        $thisMonthUsers = User::where('role', 'pengguna')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count();
        
        $thisMonthBookings = Booking::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        
        $thisMonthRevenue = Booking::where('status', 'confirmed')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('total_amount');
        
        // Today stats
        $todayUsers = User::where('role', 'pengguna')
            ->whereBetween('created_at', [Carbon::today(), Carbon::tomorrow()])
            ->count();
        
        // This week stats
        $thisWeekBookings = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        
        return [
            'total_users' => $totalUsers,
            'total_rooms' => $totalRooms,
            'available_rooms' => $availableRooms,
            'occupied_rooms' => $occupiedRooms,
            'total_type_kamar' => $totalTypeKamar,
            'total_bookings' => $totalBookings,
            'pending_bookings' => $pendingBookings,
            'confirmed_bookings' => $confirmedBookings,
            'total_revenue' => $totalRevenue,
            'occupancy_rate' => $occupancyRate,
            'this_month_users' => $thisMonthUsers,
            'this_month_bookings' => $thisMonthBookings,
            'this_month_revenue' => $thisMonthRevenue,
            'today_users' => $todayUsers,
            'this_week_bookings' => $thisWeekBookings,
        ];
    }
    
    private function getRecentActivities()
    {
        $activities = collect();
        
        // Recent user registrations
        $recentUsers = User::where('role', 'pengguna')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($user) {
                return [
                    'type' => 'user_registered',
                    'title' => 'User baru mendaftar',
                    'description' => $user->name . ' bergabung dengan sistem',
                    'time' => $user->created_at->diffForHumans(),
                    'icon' => 'user',
                    'color' => 'green'
                ];
            });
        
        // Recent bookings
        $recentBookings = Booking::with(['user', 'kamar'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($booking) {
                return [
                    'type' => 'booking_created',
                    'title' => 'Booking baru dibuat',
                    'description' => $booking->user->name . ' memesan ' . $booking->kamar->nama_kamar,
                    'time' => $booking->created_at->diffForHumans(),
                    'icon' => 'home',
                    'color' => 'blue'
                ];
            });
        
        // Recent type kamar additions
        $recentTypes = TypeKamar::latest()
            ->take(3)
            ->get()
            ->map(function ($type) {
                return [
                    'type' => 'type_added',
                    'title' => 'Tipe kamar baru ditambahkan',
                    'description' => 'Tipe "' . $type->nama . '" telah dibuat',
                    'time' => $type->created_at->diffForHumans(),
                    'icon' => 'clipboard',
                    'color' => 'purple'
                ];
            });
        
        $activities = $activities->merge($recentUsers)
            ->merge($recentBookings)
            ->merge($recentTypes)
            ->sortByDesc(function ($activity) {
                return Carbon::parse($activity['time']);
            })
            ->take(8);
        
        return $activities->values();
    }
    
    private function getMonthlyData()
    {
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->format('M Y');
            
            $bookings = Booking::whereBetween('created_at', [
                $date->startOfMonth()->copy(),
                $date->endOfMonth()->copy()
            ])->count();
            
            $revenue = Booking::where('status', 'confirmed')
                ->whereBetween('created_at', [
                    $date->startOfMonth()->copy(),
                    $date->endOfMonth()->copy()
                ])->sum('total_amount');
            
            $months[] = [
                'month' => $monthName,
                'bookings' => $bookings,
                'revenue' => $revenue
            ];
        }
        
        return collect($months);
    }
    
    public function exportPdf()
    {
        $stats = $this->getDashboardStats();
        $recentActivities = $this->getRecentActivities();
        $monthlyData = $this->getMonthlyData();
        
        $data = [
            'stats' => $stats,
            'recentActivities' => $recentActivities,
            'monthlyData' => $monthlyData,
            'generated_at' => Carbon::now()->format('d F Y H:i:s')
        ];
        
        $pdf = Pdf::loadView('admin.dashboard.pdf', $data);
        return $pdf->download('dashboard-report-' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
    
    public function exportExcel()
    {
        $stats = $this->getDashboardStats();
        $monthlyData = $this->getMonthlyData();
        
        $filename = 'dashboard-data-' . Carbon::now()->format('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($stats, $monthlyData) {
            $file = fopen('php://output', 'w');
            
            // Dashboard Statistics
            fputcsv($file, ['DASHBOARD STATISTICS']);
            fputcsv($file, ['Metric', 'Value']);
            fputcsv($file, ['Total Users', $stats['total_users']]);
            fputcsv($file, ['Total Rooms', $stats['total_rooms']]);
            fputcsv($file, ['Available Rooms', $stats['available_rooms']]);
            fputcsv($file, ['Occupied Rooms', $stats['occupied_rooms']]);
            fputcsv($file, ['Occupancy Rate (%)', $stats['occupancy_rate']]);
            fputcsv($file, ['Total Bookings', $stats['total_bookings']]);
            fputcsv($file, ['Pending Bookings', $stats['pending_bookings']]);
            fputcsv($file, ['Confirmed Bookings', $stats['confirmed_bookings']]);
            fputcsv($file, ['Total Revenue', 'Rp ' . number_format($stats['total_revenue'], 0, ',', '.')]);
            fputcsv($file, ['']);
            
            // Monthly Data
            fputcsv($file, ['MONTHLY DATA']);
            fputcsv($file, ['Month', 'Bookings', 'Revenue']);
            foreach ($monthlyData as $data) {
                fputcsv($file, [$data['month'], $data['bookings'], $data['revenue']]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}