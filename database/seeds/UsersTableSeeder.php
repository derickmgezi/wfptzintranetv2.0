<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $now = date('Y-m-d H:i:s');

        User::create(
                array(
                    'firstname' => 'Derick',
                    'secondname' => 'Ruganuza',
                    'username' => 'derick.ruganuza',
                    'email' => 'derick.ruganuza@wfp.org',
                    'password' => bcrypt('3@viruses'),
                    'title' => 'IT Operation Assistant',
                    'department' => 'IT',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );

        DB::table('users')->insert([
            'firstname' => 'Tala',
            'secondname' => 'Loubieh',
            'username' => 'tala.loubieh',
            'email' => 'tala.loubieh@wfp.org',
            'password' => bcrypt('Welcome@123'),
            'title' => 'Communication Officer',
            'department' => 'PI',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        
        User::create(
                array(
                    'firstname' => 'John',
                    'secondname' => 'Msocha',
                    'username' => 'john.msocha',
                    'email' => 'john.msocha@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'National IT Officer',
                    'department' => 'IT',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
        User::create(
                array(
                    'firstname' => 'Daudi',
                    'secondname' => 'Kabalika',
                    'username' => 'daudi.kabalika',
                    'email' => 'daudi.kabalika@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'Senior IT Operations Associate ',
                    'department' => 'IT',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
        User::create(
                array(
                    'firstname' => 'Michael',
                    'secondname' => 'Dunford',
                    'username' => 'michael.dunford',
                    'email' => 'michael.dunford@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'Country Director',
                    'department' => 'Management',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
        User::create(
                array(
                    'firstname' => 'Fizza',
                    'secondname' => 'Moloo',
                    'username' => 'fizza.moloo',
                    'email' => 'fizza.moloo@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'National PSP Officer',
                    'department' => 'PI',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
        User::create(
                array(
                    'firstname' => 'Max',
                    'secondname' => 'Wohlgemuth',
                    'username' => 'max.wohlgemuth',
                    'email' => 'max.wohlgemuth@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'Communication Officer',
                    'department' => 'PI',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
        User::create(
                array(
                    'firstname' => 'Alice',
                    'secondname' => 'Maro',
                    'username' => 'alice.maro',
                    'email' => 'alice.maro@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'Communication Associate',
                    'department' => 'PI',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
        User::create(
                array(
                    'firstname' => 'Pauline',
                    'secondname' => 'Paul',
                    'username' => 'pauline.paul',
                    'email' => 'pauline.paul@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'WFP Intern Public Information',
                    'department' => 'PI',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
    }

}
