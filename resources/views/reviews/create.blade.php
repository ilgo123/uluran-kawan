@extends('layouts.app')
@section('title', 'Beri Ulasan')
@section('content')
    <div class="container mx-auto py-12 px-4">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow">
            <h1 class="text-2xl font-bold mb-2">Beri Ulasan untuk Campaign</h1>
            <p class="mb-6 text-gray-600">"{{ $campaign->title }}"</p>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rating Anda</label>
                        <div class="mt-1 flex flex-row-reverse justify-end items-center">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="rating{{ $i }}"
                                    value="{{ $i }}" class="hidden peer" required />
                                <label for="rating{{ $i }}"
                                    class="text-3xl cursor-pointer text-gray-300 peer-hover:text-yellow-400 hover:text-yellow-400 peer-checked:text-yellow-400">&#9733;</label>
                            @endfor
                        </div>
                        @error('rating')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700">Komentar Singkat</label>
                        <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            required minlength="10">{{ old('comment') }}</textarea>
                        @error('comment')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-emerald-600 text-white py-2 px-4 rounded-lg hover:bg-emerald-700">Kirim
                        Ulasan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
