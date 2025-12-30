<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class AdminRoomController extends Controller
{
    /**
     * Display a listing of the rooms.
     */
    public function index()
    {
        $rooms = Room::orderBy('id', 'desc')->paginate(20);
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        return view('admin.rooms.create');
    }
    /**
     * Store a newly created room in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'capacity' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'description' => 'required|string',
            'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // generate unique slug
        $baseSlug = Str::slug($data['name']);
        $slug = $baseSlug;
        $i = 1;
        while (Room::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }

        $mainImageUrl = null;
        // If a file was uploaded, try Cloudinary when configured, otherwise use local storage
        if ($request->hasFile('main_image')) {
            $useCloudinary = env('CLOUDINARY_URL') || env('CLOUDINARY_CLOUD_NAME') || env('CLOUDINARY_KEY');

            if ($useCloudinary) {
                try {
                    $uploaded = Cloudinary::uploadApi()->upload(
                        $request->file('main_image')->getRealPath(),
                        ['folder' => 'goldenwaveee/rooms']
                    );

                    $mainImageUrl = $uploaded['secure_url'] ?? ($uploaded['url'] ?? null);
                } catch (\Exception $e) {
                    Log::error('Cloudinary upload error: ' . $e->getMessage());
                    // fallback to local
                    try {
                        $path = $request->file('main_image')->store('rooms', 'public');
                        $mainImageUrl = Storage::url($path);
                        session()->flash('warning', 'Gagal unggah ke Cloudinary; gambar disimpan lokal.');
                    } catch (\Exception $ex) {
                        Log::error('Local storage error: ' . $ex->getMessage());
                        return redirect()->back()->withErrors(['main_image' => 'Gagal mengunggah gambar: upload Cloudinary dan penyimpanan lokal gagal.'])->withInput();
                    }
                }
            } else {
                try {
                    $path = $request->file('main_image')->store('rooms', 'public');
                    $mainImageUrl = Storage::url($path);
                } catch (\Exception $ex) {
                    Log::error('Local storage error: ' . $ex->getMessage());
                    return redirect()->back()->withErrors(['main_image' => 'Gagal mengunggah gambar ke penyimpanan lokal.'])->withInput();
                }
            }
        }

        Room::create([
            'slug' => $slug,
            'name' => $data['name'],
            'price_per_night' => $data['price'],
            'max_guests' => $data['capacity'] ?? null,
            'quantity' => $data['quantity'] ?? 1,
            'description' => $data['description'],
            'main_image' => $mainImageUrl,
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Room berhasil ditambahkan');
}


    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'description' => 'nullable|string',
            'main_image' => 'nullable|image|max:2048',
        ]);

        // handle uploaded image -> try Cloudinary when configured, else local
        if ($request->hasFile('main_image')) {
            $useCloudinary = env('CLOUDINARY_URL') || env('CLOUDINARY_CLOUD_NAME') || env('CLOUDINARY_KEY');

            if ($useCloudinary) {
                try {
                    $uploaded = Cloudinary::uploadApi()->upload(
                        $request->file('main_image')->getRealPath(),
                        ['folder' => 'goldenwaveee/rooms']
                    );

                    $data['main_image'] = $uploaded['secure_url'] ?? ($uploaded['url'] ?? null);
                } catch (\Exception $e) {
                    Log::error('Cloudinary upload error: ' . $e->getMessage());
                    try {
                        $path = $request->file('main_image')->store('rooms', 'public');
                        $data['main_image'] = Storage::url($path);
                        session()->flash('warning', 'Gagal unggah ke Cloudinary; gambar disimpan lokal.');
                    } catch (\Exception $ex) {
                        Log::error('Local storage error: ' . $ex->getMessage());
                        return redirect()->back()->withErrors(['main_image' => 'Gagal mengunggah gambar: upload Cloudinary dan penyimpanan lokal gagal.'])->withInput();
                    }
                }
            } else {
                try {
                    $path = $request->file('main_image')->store('rooms', 'public');
                    $data['main_image'] = Storage::url($path);
                } catch (\Exception $ex) {
                    Log::error('Local storage error: ' . $ex->getMessage());
                    return redirect()->back()->withErrors(['main_image' => 'Gagal mengunggah gambar ke penyimpanan lokal.'])->withInput();
                }
            }
        }

        // ensure slug uniqueness (exclude current room)
        $baseSlug = Str::slug($data['name']);
        $slug = $baseSlug;
        $i = 1;
        while (Room::where('slug', $slug)->where('id', '!=', $room->id)->exists()) {
            $slug = $baseSlug . '-' . $i++;
        }


        $room->update([
            'slug' => $slug,
            'name' => $data['name'],
            'price_per_night' => $data['price'] ?? $room->price_per_night,
            'max_guests' => $data['capacity'] ?? $room->max_guests,
            'quantity' => $data['quantity'] ?? $room->quantity,
            'description' => $data['description'] ?? $room->description,
            'main_image' => $data['main_image'] ?? $room->main_image,
        ]);

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar diperbarui.');
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar dihapus.');
    }
}
