<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Member;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserDashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama aplikasi.
     */
    public function index()
    {
        // Mengumpulkan data agregat untuk ditampilkan di dashboard
        $stats = [
            'total_members' => Member::count(),
            'total_events' => Event::count(),
            'total_products' => Product::count(),
        ];

        // Mengambil 3 acara/berita terbaru
        $latestEvents = Event::latest()->take(3)->get()->map(fn ($event) => [
            'id' => $event->id,
            'title' => $event->title,
            'image_url' => $event->image,
            'created_at' => $event->created_at,
        ]);

        // Mengambil 4 produk terbaru
        $latestProducts = Product::latest()->take(4)->get()->map(fn ($product) => [
            'id' => $product->id,
            'name' => $product->name,
            'price' => 'Rp ' . number_format($product->price, 0, ',', '.'),
            'image_url' => $product->image,
        ]);

        return Inertia::render('Dashboard', [
            'stats' => $stats,
            'latestEvents' => $latestEvents,
            'latestProducts' => $latestProducts,
        ]);
    }
}