@extends('layouts.app')
@section('title', 'Buat Campaign Baru')
@section('content')
<div class="container mx-auto py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Formulir Campaign Baru</h1>
        <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @include('campaigns.partials.form-control')
            <div class="mt-6">
                <button type="submit" class="w-full bg-emerald-600 text-white py-2 px-4 rounded-lg hover:bg-emerald-700">Ajukan Campaign</button>
            </div>
        </form>
    </div>
</div>
@endsection
