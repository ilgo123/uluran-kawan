{{-- @csrf
<div class="space-y-4">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Campaign</label>
        <input type="text" name="title" id="title" value="{{ old('title', $campaign->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
        <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $campaign->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="target_amount" class="block text-sm font-medium text-gray-700">Target Dana (Rp)</label>
        <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount', $campaign->target_amount ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('target_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi / Cerita</label>
        <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('description', $campaign->description ?? '') }}</textarea>
        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="image_path" class="block text-sm font-medium text-gray-700">Gambar Utama Campaign</label>
        <input type="file" name="image_path" id="image_path" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
        @error('image_path') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
</div> --}}

@csrf
{{-- Kita gunakan Alpine.js untuk state management sederhana --}}
<div x-data="{ type: '{{ old('type', $campaign->type ?? 'dana') }}' }" class="space-y-4">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul Campaign</label>
        <input type="text" name="title" id="title" value="{{ old('title', $campaign->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
        <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $campaign->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Input untuk memilih Tipe Bantuan --}}
    <div>
        <label for="type" class="block text-sm font-medium text-gray-700">Tipe Bantuan</label>
        <select name="type" id="type" x-model="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            <option value="dana">Galang Dana</option>
            <option value="barang">Bantuan Barang</option>
        </select>
    </div>

    {{-- Input ini hanya muncul jika tipenya 'dana' --}}
    <div x-show="type === 'dana'">
        <label for="target_amount" class="block text-sm font-medium text-gray-700">Target Dana (Rp)</label>
        <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount', $campaign->target_amount ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('target_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    {{-- Input ini hanya muncul jika tipenya 'barang' --}}
    <div x-show="type === 'barang'">
        <label for="item_name" class="block text-sm font-medium text-gray-700">Nama Barang yang Dibutuhkan</label>
        <input type="text" name="item_name" id="item_name" value="{{ old('item_name', $campaign->item_name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('item_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi / Cerita</label>
        <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ old('description', $campaign->description ?? '') }}</textarea>
        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
    <div>
        <label for="image_path" class="block text-sm font-medium text-gray-700">Gambar Utama Campaign</label>
        <input type="file" name="image_path" id="image_path" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
        @error('image_path') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>
</div>
