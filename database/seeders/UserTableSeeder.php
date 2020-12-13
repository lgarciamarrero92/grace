<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use App\Models\Team;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 8; $i++) {
            $user = new User();
            $user->name = 'User' . $i;
            $user->email = 'user'.$i.'@grace.com';
            $user->password = bcrypt('12345678');
            $user->save();
            $user->ownedTeams()->save(Team::forceCreate([
                'user_id' => $user->id,
                'name' => explode(' ', $user->name, 2)[0]."'s Team",
                'personal_team' => true,
            ]));
        }
    }
}
