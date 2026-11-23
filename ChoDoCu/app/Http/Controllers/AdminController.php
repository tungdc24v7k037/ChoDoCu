<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
   

public function index()
{
    $year = now()->year;
    $month = now()->month;

    // Thống kê tổng quan
    $totalUsers = User::count();

    // Tin đang bán = tin đang được đăng công khai
    $totalListings = Listing::where('status', 'published')->count();

    $pendingListings = Listing::where('status', 'pending')->count();

    // Thống kê kiểm duyệt trong tháng
    $approvedThisMonth = Listing::whereIn(
        'status', ['published', 'sold']
    )
        ->whereYear('updated_at', $year)
        ->whereMonth('updated_at', $month)
        ->count();

    $rejectedThisMonth = Listing::where('status', 'rejected')
        ->whereYear('updated_at', $year)
        ->whereMonth('updated_at', $month)
        ->count();

    $pendingThisMonth = Listing::where('status', 'pending')
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->count();

    $processedThisMonth = $approvedThisMonth + $rejectedThisMonth;

    $moderationTotal = $processedThisMonth + $pendingThisMonth;

    $moderationRate = $moderationTotal > 0
        ? round($processedThisMonth / $moderationTotal * 100, 2)
        : 0;

    // Thống kê tin đăng theo 12 tháng
    $monthlyRaw = Listing::selectRaw(
        'MONTH(created_at) AS month, COUNT(*) AS total'
    )
        ->whereYear('created_at', $year)
        ->groupByRaw('MONTH(created_at)')
        ->pluck('total', 'month');

    // Thống kê người dùng mới theo 12 tháng
    $usersRaw = User::selectRaw(
        'MONTH(created_at) AS month, COUNT(*) AS total'
    )
        ->whereYear('created_at', $year)
        ->groupByRaw('MONTH(created_at)')
        ->pluck('total', 'month');

    $monthlyListings = [];
    $monthlyUsers = [];

    for ($i = 1; $i <= 12; $i++) {
        $monthlyListings[] = (int) ($monthlyRaw[$i] ?? 0);
        $monthlyUsers[] = (int) ($usersRaw[$i] ?? 0);
    }

    // 5 tin chờ duyệt mới nhất
    $recentPending = Listing::with('user')
        ->where('status', 'pending')
        ->latest('created_at')
        ->take(5)
        ->get();

    // Chưa có bảng reports
    $totalReports = null;

    return view('admin.dashboard', compact(
        'year',
        'totalUsers',
        'totalListings',
        'pendingListings',
        'totalReports',
        'approvedThisMonth',
        'rejectedThisMonth',
        'pendingThisMonth',
        'moderationRate',
        'monthlyListings',
        'monthlyUsers',
        'recentPending'
    ));
}


}