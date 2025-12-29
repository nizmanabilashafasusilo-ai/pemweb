<?php
// Perhatikan namespace-nya harus mencakup folder Admin
namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class AdminRoomController extends Controller
{
    // Index, Create, Store, Edit, Update, Destroy untuk pengelolaan kamar oleh Admin
        public function index()
        {
            $rooms = Room::orderBy('id', 'desc')->paginate(20);
            return view('admin.rooms.index', compact('rooms'));
        }

        public function create()
        {
                $rooms = Room::orderBy('id', 'desc')->get();
                return view('admin.rooms.create', compact('rooms'));
        }
    
        public function store(Request $request)
        {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'capacity' => 'nullable|integer',
            ]);

            $room = Room::create($data);

            return redirect()->route('admin.rooms.show', $room)->with('success', 'Kamar dibuat.');
        }

        public function show(Room $room)
        {
            return view('admin.rooms.show', compact('room'));
        }


        public function edit(Room $room)
        {
            return view('admin.rooms.edit', compact('room'));
        }

        public function update(Request $request, Room $room)
        {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'nullable|numeric',
                'capacity' => 'nullable|integer',
            ]);

            $room->update($data);
            return Redirect::route('admin.rooms.index')->with('success', 'Kamar diperbarui.');
        }

        public function destroy(Room $room)
        {
            $room->delete();
            return Redirect::route('admin.rooms.index')->with('success', 'Kamar dihapus.');
        }
    // ... metode CRUD lainnya
    
}

