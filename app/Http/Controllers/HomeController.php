<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room; // Pastikan model sudah diimpor

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data untuk Beranda (Promo, Kamar Unggulan, dll.)
        $featured_rooms = Room::limit(3)->get();
        return view('home', compact('featured_rooms'));
    }
}