<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'description', 'type',
        'target_amount', 'current_amount', 'item_name', 'image_path',
        'status', 'deadline',
        'is_success_story', 'type', 'item_name'
    ];

    protected $casts = [
        'deadline'         => 'date',
        'is_success_story' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
