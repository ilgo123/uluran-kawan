<?php

namespace App\Events;

use App\Models\Campaign;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CampaignSubmitted
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Campaign $campaign,
    ) {}
}
