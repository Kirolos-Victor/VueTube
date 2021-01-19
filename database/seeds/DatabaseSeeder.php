<?php

use App\Models\User;
use App\Models\Channel;
use App\Models\Subscription;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
       // $this->call(UserSeeder::class);
        $user1 = factory(User::class)->create([
                    'email' => 'admin@admin.com'
               ]);

                $user2 = factory(User::class)->create([
                    'email' => 'test@test.com'
                ]);

                $channel1 = factory(Channel::class)->create([
                    'user_id' => $user1->id
                ]);

                $channel2 = factory(Channel::class)->create([
                    'user_id' => $user2->id
                ]);
               $channel1->subscribers()->create([
                            'user_id'=>$user1->id
                        ]);
                        $channel2->subscribers()->create([
                           'user_id'=>$user2->id
                        ]);

                factory(Subscription::class, 5)->create([
                    'channel_id' => $channel1->id,
                ]);

                factory(Subscription::class, 5)->create([

                    'channel_id' => $channel2->id,

                ]);
    }
}
