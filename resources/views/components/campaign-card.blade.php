@props(['campaign'])

@php
    $total = $campaign->donations_sum_amount ?? 0;
    $goal = $campaign->goal_amount ?? 1;
    $percentage = $goal > 0 ? min(100, ($total / $goal) * 100) : 0;
@endphp

<div class="bg-white rounded-2xl shadow-md overflow-hidden">
    <img src="{{ $campaign->image_url ?? '/images/default.jpg' }}"
         alt="{{ $campaign->title }}"
         class="w-full h-40 object-cover">

    <div class="p-4">
        <h3 class="text-md font-semibold mb-1 truncate">{{ $campaign->title }}</h3>
        <p class="text-sm text-gray-500 mb-2">oleh {{ $campaign->user->name ?? 'Anonim' }}</p>

        <div class="w-full bg-gray-200 h-2 rounded-full mb-2">
            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
        </div>

        <div class="flex justify-between text-sm font-medium">
            <span class="text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            <span class="text-gray-500">terkumpul dari Rp {{ number_format($goal, 0, ',', '.') }}</span>
        </div>
    </div>
</div>
