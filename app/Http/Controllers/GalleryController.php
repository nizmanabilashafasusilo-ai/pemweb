<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Gallery; // Jika sudah dibuat

class GalleryController extends Controller
{
    public function index()
    {
        // Ambil data galeri
        // $galleries = Gallery::all();
        return view('gallery'); // Asumsi view 'gallery.blade.php'
    }
}