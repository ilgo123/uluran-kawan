@props(['campaign'])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <a href="{{ route('campaigns.show', $campaign) }}">
        <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $campaign->image_path) }}" alt="{{ $campaign->title }}">
    </a>
    <div class="p-4">
        <a href="{{ route('campaigns.show', $campaign) }}" class="block text-lg font-bold text-gray-800 hover:text-emerald-600 truncate">
            {{ $campaign->title }}
        </a>
        <p class="text-sm text-gray-500 mt-1">oleh {{ $campaign->user->name }}</p>

        @if($campaign->type === 'dana')
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    @php
                        $percentage = ($campaign->target_amount > 0) ? ($campaign->current_amount / $campaign->target_amount) * 100 : 0;
                    @endphp
                    <div class="bg-emerald-600 h-2.5 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500">terkumpul dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                </div>
            </div>
        @else
            <div class="mt-4">
                <p class="text-sm font-bold text-emerald-600">Bantuan Barang</p>
                <p class="text-xs text-gray-500">{{ $campaign->item_name }}</p>
            </div>
        @endif
    </div>
</div>
