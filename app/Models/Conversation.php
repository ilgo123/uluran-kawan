<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['participant_one_id', 'participant_two_id', 'campaign_id'];

    public function messages() { return $this->hasMany(Message::class); }
    public function participantOne() { return $this->belongsTo(User::class, 'participant_one_id'); }
    public function participantTwo() { return $this->belongsTo(User::class, 'participant_two_id'); }
}
