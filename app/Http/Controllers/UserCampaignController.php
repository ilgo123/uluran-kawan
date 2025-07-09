<?php
namespace App\Http\Controllers;

use App\Filament\Resources\CampaignResource;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserCampaignController extends Controller
{
    // Menampilkan form untuk membuat campaign baru
    public function create()
    {
        $categories = Category::all();
        return view('campaigns.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'image_path'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type'          => 'required|in:dana,barang',
            // 'target_amount' dan 'item_name' divalidasi berdasarkan 'type'
            'target_amount' => 'required_if:type,dana|nullable|numeric|min:10000',
            'item_name'     => 'required_if:type,barang|nullable|string|max:255',
        ]);

        $imagePath = $request->file('image_path')->store('campaigns', 'public');

        $campaign = Campaign::create([
            'user_id'       => auth()->id(),
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title) . '-' . uniqid(),
            'description'   => $request->description,
            'image_path'    => $imagePath,
            'status'        => 'pending',
            'type'          => $request->type,
            'target_amount' => $request->target_amount, // Akan null jika tipe barang
            'item_name'     => $request->item_name,     // Akan null jika tipe dana
        ]);

        $admins = User::where('role', 'admin')->get();

        if ($admins->isNotEmpty()) {
            // 4. Buat notifikasi
            Notification::make()
                ->title('Campaign Butuh Persetujuan!')
                ->body("Campaign baru untuk '{$campaign->title}' telah dibuat dan menunggu persetujuan.")
                ->info() // Tipe notifikasi info (biru) atau warning (kuning)
                ->actions([
                    Action::make('edit')                                             // 'edit' adalah nama internal untuk aksi ini
                        ->label('Lihat & Edit Pesanan')                                  // Teks yang akan muncul di tombol
                        ->button()                                                       // Membuatnya tampil sebagai tombol (bukan link biasa)
                        ->url(CampaignResource::getUrl('edit', ['record' => $campaign])) // 4. URL dinamis ke halaman edit
                        ->markAsRead(),                                                  // Otomatis tandai notifikasi sebagai "dibaca" saat diklik
                ])
                ->sendToDatabase($admins); // 5. Kirim notifikasi HANYA ke admin
        }

        return redirect()->route('dashboard')->with('success', 'Campaign berhasil dibuat dan sedang menunggu persetujuan admin.');
    }

    // Menyimpan campaign baru ke database
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'target_amount' => 'required|numeric|min:10000',
    //     ]);

    //     $imagePath = $request->file('image_path')->store('campaigns', 'public');

    //     $campaign = Campaign::create([
    //         'user_id' => auth()->id(),
    //         'category_id' => $request->category_id,
    //         'title' => $request->title,
    //         'slug' => Str::slug($request->title) . '-' . uniqid(),
    //         'description' => $request->description,
    //         'image_path' => $imagePath,
    //         'target_amount' => $request->target_amount,
    //         'status' => 'pending',
    //         'type' => 'dana',
    //     ]);

    //     $admins = User::where('role', 'admin')->get();

    //     if ($admins->isNotEmpty()) {
    //         // 4. Buat notifikasi
    //         Notification::make()
    //             ->title('Campaign Butuh Persetujuan!')
    //             ->body("Campaign baru untuk '{$campaign->title}' telah dibuat dan menunggu persetujuan.")
    //             ->info() // Tipe notifikasi info (biru) atau warning (kuning)
    //             ->actions([
    //                 Action::make('edit') // 'edit' adalah nama internal untuk aksi ini
    //                     ->label('Lihat & Edit Pesanan') // Teks yang akan muncul di tombol
    //                     ->button() // Membuatnya tampil sebagai tombol (bukan link biasa)
    //                     ->url(CampaignResource::getUrl('edit', ['record' => $campaign])) // 4. URL dinamis ke halaman edit
    //                     ->markAsRead(), // Otomatis tandai notifikasi sebagai "dibaca" saat diklik
    //             ])
    //             ->sendToDatabase($admins); // 5. Kirim notifikasi HANYA ke admin
    //     }

    //     return redirect()->route('dashboard')->with('success', 'Campaign berhasil dibuat dan sedang menunggu persetujuan admin.');
    // }

    // Menampilkan form untuk mengedit campaign
    public function edit(Campaign $campaign)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $user->id !== $campaign->user_id) {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        $categories = Category::all();
        return view('campaigns.edit', compact('campaign', 'categories'));
    }

    public function update(Request $request, Campaign $campaign)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $user->id !== $campaign->user_id) {
            abort(403, 'AKSI TIDAK DIIZINKAN.');
        }

        $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'image_path'    => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type'          => 'required|in:dana,barang',
            'target_amount' => 'required_if:type,dana|nullable|numeric|min:10000',
            'item_name'     => 'required_if:type,barang|nullable|string|max:255',
        ]);

        // Update data
        $campaign->fill($request->only([
            'title', 'description', 'category_id', 'type', 'target_amount', 'item_name',
        ]));
        $campaign->slug = Str::slug($request->title) . '-' . uniqid();

        if ($request->hasFile('image_path')) {
            $campaign->image_path = $request->file('image_path')->store('campaigns', 'public');
        }

        $campaign->save();

        return redirect()->route('dashboard')->with('success', 'Campaign berhasil diperbarui.');
    }

    // Mengupdate campaign di database
    // public function update(Request $request, Campaign $campaign)
    // {
    //     $user = auth()->user();

    //     if ($user->role !== 'admin' && $user->id !== $campaign->user_id) {
    //         abort(403, 'AKSI TIDAK DIIZINKAN.');
    //     }

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'category_id' => 'required|exists:categories,id',
    //         'image_path' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // 'sometimes' berarti tidak wajib diisi
    //         'target_amount' => 'required|numeric|min:10000',
    //     ]);

    //     $campaign->title = $request->title;
    //     $campaign->slug = Str::slug($request->title) . '-' . uniqid();
    //     $campaign->description = $request->description;
    //     $campaign->category_id = $request->category_id;
    //     $campaign->target_amount = $request->target_amount;

    //     if ($request->hasFile('image_path')) {
    //         // Hapus gambar lama jika ada
    //         // Storage::disk('public')->delete($campaign->image_path);
    //         $campaign->image_path = $request->file('image_path')->store('campaigns', 'public');
    //     }

    //     $campaign->save();

    //     return redirect()->route('dashboard')->with('success', 'Campaign berhasil diperbarui.');
    // }
}
