<?php
// Perhatikan namespace-nya harus mencakup folder Admin
namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class AdminRoomController extends Controller
{
    // Index, Create, Store, Edit, Update, Destroy untuk pengelolaan kamar oleh Admin
    public function index() { /* Logic tampilkan daftar kamar */ return view('admin.rooms.index'); }
    // ... metode CRUD lainnya
    
}

