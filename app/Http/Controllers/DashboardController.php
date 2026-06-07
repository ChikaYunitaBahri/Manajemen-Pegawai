<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Employee::count();

        $aktif = Employee::where('status', 'aktif')->count();

        $nonaktif = Employee::where('status', 'nonaktif')->count();

        $latest = Employee::latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'total',
            'aktif',
            'nonaktif',
            'latest'
        ));
    }
}