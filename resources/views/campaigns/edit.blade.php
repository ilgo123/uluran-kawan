@extends('layouts.app')
@section('title', 'Edit Campaign')
@section('content')
<div class="container mx-auto py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Campaign: {{ $campaign->title }}</h1>
        <form action="{{ route('campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('campaigns.partials.form-control')
            <div class="mt-6">
                <button type="submit" class="w-full bg-emerald-600 text-white py-2 px-4 rounded-lg hover:bg-emerald-700">Update Campaign</button>
            </div>
        </form>
    </div>
</div>
@endsection
