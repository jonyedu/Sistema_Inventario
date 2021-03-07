<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $randomNumber = rand(123, 789);

        $team = Team::factory()->create([
            'name' => "Hospital Leon Becerra C",
        ]);

        $jefePC = User::factory()->create([
            'name'           => "Jefe P&C $randomNumber",
            'email'          => "jefePC$randomNumber@gmail.com",
            'password'       => bcrypt('password'),
            'team_id'        => $team->id,
            'remember_token' => null,
        ]);
        $jefePC->roles()->sync(2);

        $randomNumber = rand(123, 789);
        $asistentePC = User::factory()->create([
            'name'           => "Asistente P&C $randomNumber",
            'email'          => "asistentePC$randomNumber@gmail.com",
            'password'       => bcrypt('password'),
            'team_id'        => $team->id,
            'remember_token' => null,
        ]);
        $asistentePC->roles()->sync(3);

        $randomNumber = rand(123, 789);
        $jefeBodega = User::factory()->create([
            'name'           => "Jefe de Bodega $randomNumber",
            'email'          => "jefeBodega$randomNumber@gmail.com",
            'password'       => bcrypt('password'),
            'team_id'        => $team->id,
            'remember_token' => null,
        ]);
        $jefeBodega->roles()->sync(4);

        
        
    }
}
