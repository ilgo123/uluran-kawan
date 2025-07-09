<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'university', 'bio', 'student_id_card_path', 'is_verified', 'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
        ];
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'reviewee_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'participant_one_id')
                    ->orWhere('participant_two_id', $this->id);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    // Method baru untuk mengecek hak memberikan ulasan
    public function canReview(Campaign $campaign): bool
    {
        // Kondisi 1: Campaign harus sudah 'completed'
        if ($campaign->status !== 'completed') {
            return false;
        }

        // Kondisi 2: User harus pernah berdonasi sukses ke campaign ini
        $hasDonated = $this->donations()
            ->where('campaign_id', $campaign->id)
            ->where('status', 'success')
            ->exists();

        if (!$hasDonated) {
            return false;
        }

        // Kondisi 3: User belum pernah memberikan ulasan untuk campaign ini
        $hasReviewed = Review::where('reviewer_id', $this->id)
            ->where('campaign_id', $campaign->id)
            ->exists();

        return !$hasReviewed;
    }
}
