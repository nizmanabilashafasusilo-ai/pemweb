<?php
// Perhatikan namespace-nya harus mencakup folder Admin
namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
                'quantity' => 'nullable|integer',
                'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            ]);


            if ($request->hasFile('main_image')) {
                $data['main_image'] = $request->file('main_image')->store('rooms', 'public');
            }

            // Map form fields to actual DB columns
            if (isset($data['price'])) {
                $data['price_per_night'] = $data['price'];
                unset($data['price']);
            }
            if (isset($data['capacity'])) {
                $data['max_guests'] = $data['capacity'];
                unset($data['capacity']);
            }

            // Ensure quantity has a value (DB requires it)
            if (!isset($data['quantity']) || $data['quantity'] === null) {
                $data['quantity'] = 1;
            }

            // Generate unique slug from name for DB (slug column required)
            if (isset($data['name'])) {
                $base = Str::slug($data['name']);
                $slug = $base;
                $i = 1;
                while (Room::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $data['slug'] = $slug;
            }

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
                'main_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',
            ]);

            if ($request->hasFile('main_image')) {
                // delete old image if exists
                if ($room->main_image) {
                    Storage::disk('public')->delete($room->main_image);
                }
                $data['main_image'] = $request->file('main_image')->store('rooms', 'public');
            }
            // Map form fields to actual DB columns for update
            if (isset($data['price'])) {
                $data['price_per_night'] = $data['price'];
                unset($data['price']);
            }
            if (isset($data['capacity'])) {
                $data['max_guests'] = $data['capacity'];
                unset($data['capacity']);
            }

            // Update slug if name changed (ensure unique, ignore current record)
            if (isset($data['name'])) {
                $base = Str::slug($data['name']);
                $slug = $base;
                $i = 1;
                while (Room::where('slug', $slug)->where('id', '<>', $room->id)->exists()) {
                    $slug = $base . '-' . $i++;
                }
                $data['slug'] = $slug;
            }

            $room->update($data);
            return redirect()->route('admin.rooms.index')->with('success', 'Kamar diperbarui.');
        }

        public function destroy(Room $room)
        {
            $room->delete();
            return redirect()->route('admin.rooms.index')->with('success', 'Kamar dihapus.');
        }
    // ... metode CRUD lainnya
    
}

