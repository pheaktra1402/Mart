<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function dashboard(){
    return view('admins.dashboard',[
        'totalCustomers'  => User::where('role', 'customer')->count(),
            'totalProducts'   => Product::count(),
            'totalCategories' => Category::count(),
            'outOfStock'      => Product::where('stock', 0)->count(),

            'lowStock' => Product::with('category')
                ->where('stock', '<=', 10)
                ->orderBy('stock')
                ->take(5)
                ->get(),
             'recentCustomers' => User::where('role', 'customer')
                ->latest()
                ->take(5)
                ->get(),]);
   }
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
