@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Pengaturan Profil</h1>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @if (session('status'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('status') }}</span>
                        </div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="university" class="block text-sm font-medium text-gray-700">Asal Universitas</label>
                            <input type="text" name="university" id="university"
                                value="{{ old('university', $user->university) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('university')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio Singkat</label>
                            <textarea name="bio" id="bio" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('bio', $user->bio) }}</textarea>
                        </div>

                        <div>
                            <label for="student_id_card_path" class="block text-sm font-medium text-gray-700">Upload
                                Scan/Foto KTM</label>
                            <input type="file" name="student_id_card_path" id="student_id_card_path"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            @if ($user->student_id_card_path)
                                <p class="text-xs text-gray-500 mt-2">KTM sudah diunggah. Upload file baru akan menggantikan
                                    yang lama dan memerlukan verifikasi ulang oleh admin.</p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Status Verifikasi:
                                <span class="font-bold {{ $user->is_verified ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ $user->is_verified ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                </span>
                            </p>
                            @error('student_id_card_path')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>
                        <p class="text-lg font-semibold">Ubah Password</p>
                        <p class="text-sm text-gray-500">Kosongkan jika Anda tidak ingin mengubah password.</p>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('password')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                                Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="mt-1 block w-full rounded-md border-train-300 shadow-sm">
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-emerald-600 text-white py-2 px-4 rounded-lg hover:bg-emerald-700">Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
            <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Ulasan yang Anda Terima</h2>
                <div class="space-y-6">
                    @forelse ($user->reviewsReceived as $review)
                        <div class="border-b pb-4">
                            <div class="flex items-center mb-1">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <span class="text-yellow-400 text-xl">&#9733;</span>
                                @endfor
                                @for ($i = $review->rating; $i < 5; $i++)
                                    <span class="text-gray-300 text-xl">&#9733;</span>
                                @endfor
                            </div>
                            <p class="text-gray-600">"{{ $review->comment }}"</p>
                            <p class="text-xs text-gray-500 mt-2">oleh {{ $review->reviewer->name }} -
                                {{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Anda belum menerima ulasan apapun.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
