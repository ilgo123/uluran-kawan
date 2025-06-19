<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Panggil CategorySeeder yang sudah kita buat sebelumnya
        $this->call(CategorySeeder::class);
        $this->command->info('Categories seeded.');

        // 2. Buat User spesifik untuk Admin dan testing
        $admin = User::factory()->create([
            'name' => 'Admin Uluran Kawan',
            'email' => 'admin@uluran.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $testUser = User::factory()->create([
            'name' => 'User Test',
            'email' => 'user@uluran.test',
            'password' => Hash::make('password'),
        ]);

        $this->command->info('Admin and Test User created.');

        // 3. Buat banyak user dummy
        $users = User::factory(20)->create();
        $this->command->info('20 dummy users created.');

        // 4. Buat campaign untuk setiap user
        $categories = Category::all();
        foreach (User::all() as $user) {
            Campaign::factory(rand(1, 3))->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);
        }
        $this->command->info('Campaigns created for each user.');

        // 5. Buat donasi dari user ke campaign yang aktif
        $activeCampaigns = Campaign::where('status', 'active')->get();
        foreach ($activeCampaigns as $campaign) {
            // Setiap campaign aktif akan menerima beberapa donasi dari user acak
            $donors = $users->random(rand(5, 15));
            foreach ($donors as $donor) {
                Donation::factory()->create([
                    'user_id' => $donor->id,
                    'campaign_id' => $campaign->id,
                ]);
            }
        }
        $this->command->info('Donations created for active campaigns.');

        // 6. Buat ulasan untuk campaign yang sudah selesai
        $completedCampaigns = Campaign::where('status', 'completed')->get();
        foreach ($completedCampaigns as $campaign) {
            $reviewers = $users->random(rand(2, 5));
            foreach ($reviewers as $reviewer) {
                // Pastikan user tidak mereview campaignnya sendiri
                if ($reviewer->id !== $campaign->user_id) {
                    Review::factory()->create([
                        'campaign_id' => $campaign->id,
                        'reviewer_id' => $reviewer->id,
                        'reviewee_id' => $campaign->user_id,
                    ]);
                }
            }
        }
        $this->command->info('Reviews created for completed campaigns.');
    }
}
