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
        
        
//        DB::table('users')->insert([
//            'firstname' => 'Tala',
//            'secondname' => 'Loubieh',
//            'username' => 'tala.loubieh',
//            'email' => 'tala.loubieh@wfp.org',
//            'password' => bcrypt('Welcome@123'),
//            'title' => 'Communication Officer',
//            'department' => 'PI',
//            'created_at' => $now,
//            'updated_at' => $now,
//        ]);
//
//        User::create(
//                array(
//                    'firstname' => 'Derick',
//                    'secondname' => 'Ruganuza',
//                    'username' => 'derick.ruganuza',
//                    'email' => 'derick.ruganuza@wfp.org',
//                    'password' => bcrypt('3@viruses'),
//                    'title' => 'IT Operation Assistant',
//                    'department' => 'IT',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'John',
//                    'secondname' => 'Msocha',
//                    'username' => 'john.msocha',
//                    'email' => 'john.msocha@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'National IT Officer',
//                    'department' => 'IT',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Daudi',
//                    'secondname' => 'Kabalika',
//                    'username' => 'daudi.kabalika',
//                    'email' => 'daudi.kabalika@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Senior IT Operations Associate ',
//                    'department' => 'IT',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Michael',
//                    'secondname' => 'Dunford',
//                    'username' => 'michael.dunford',
//                    'email' => 'michael.dunford@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Country Director',
//                    'department' => 'Management',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Fizza',
//                    'secondname' => 'Moloo',
//                    'username' => 'fizza.moloo',
//                    'email' => 'fizza.moloo@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'National PSP Officer',
//                    'department' => 'PI',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Max',
//                    'secondname' => 'Wohlgemuth',
//                    'username' => 'max.wohlgemuth',
//                    'email' => 'max.wohlgemuth@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Communication Officer',
//                    'department' => 'PI',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Alice',
//                    'secondname' => 'Maro',
//                    'username' => 'alice.maro',
//                    'email' => 'alice.maro@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Communication Associate',
//                    'department' => 'PI',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Pauline',
//                    'secondname' => 'Paul',
//                    'username' => 'pauline.paul',
//                    'email' => 'pauline.paul@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'WFP Intern Public Information',
//                    'department' => 'PI',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Antonio',
//                    'secondname' => 'Baez',
//                    'username' => 'antonio.baez',
//                    'email' => 'antonio.baez@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Head of Finace',
//                    'department' => 'Finance',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Octavian',
//                    'secondname' => 'Machumu',
//                    'username' => 'octavian.machumu',
//                    'email' => 'octavian.machumu@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Finace Associate',
//                    'department' => 'Finance',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Orestes',
//                    'secondname' => 'Sotta',
//                    'username' => 'orestes.sotta',
//                    'email' => 'orestes.sotta@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Finace Associate',
//                    'department' => 'Finance',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Judith',
//                    'secondname' => 'Eliakim',
//                    'username' => 'judith.eliakim',
//                    'email' => 'judith.eliakim@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'IT Intern',
//                    'department' => 'IT',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
        
//        User::create(
//                array(
//                    'firstname' => 'Meshack',
//                    'secondname' => 'Manase',
//                    'username' => 'meshack.manase',
//                    'email' => 'meshack.manase@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Finance Assistant',
//                    'department' => 'Finance',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Rosemary',
//                    'secondname' => 'Max',
//                    'username' => 'rosemary.rax',
//                    'email' => 'rosemary.rax@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'National Finance Officer',
//                    'department' => 'Finance',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Tiziana',
//                    'secondname' => 'Zoccheddu',
//                    'username' => 'tiziana.zoccheddu',
//                    'email' => 'tiziana.zoccheddu@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Head Of Programme Unit',
//                    'department' => 'Programme',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Juvenal',
//                    'secondname' => 'Kisanga',
//                    'username' => 'juvenal.kisanga',
//                    'email' => 'juvenal.kisanga@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'National Programme Officer (VAM)',
//                    'department' => 'Programme',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Evelyn',
//                    'secondname' => 'Mkanda',
//                    'username' => 'evelyn.mkanda',
//                    'email' => 'evelyn.mkanda@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Senior Procurement Officer',
//                    'department' => 'Logistics',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Riaz',
//                    'secondname' => 'Lodhi',
//                    'username' => 'riaz.lodhi',
//                    'email' => 'riaz.lodhi@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Head of Logistics Unit',
//                    'department' => 'Logistics',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Mahamud',
//                    'secondname' => 'Mabuyu',
//                    'username' => 'mahamud.mabuyu',
//                    'email' => 'mahamud.mabuyu@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'National Logistics Officer',
//                    'department' => 'Logistics',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Rosemary',
//                    'secondname' => 'Tirweshobwa',
//                    'username' => 'rosemary.tirweshobwa',
//                    'email' => 'rosemary.tirweshobwa@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'HR Associate',
//                    'department' => 'HR',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Carolyne',
//                    'secondname' => 'Wasley',
//                    'username' => 'carolyne.wasley',
//                    'email' => 'carolyne.wasley@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Admin Assistant',
//                    'department' => 'Admin',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
        
//        User::create(
//                array(
//                    'firstname' => 'Semanga',
//                    'secondname' => 'Ngosingosi',
//                    'username' => 'semanga.ngosingosi',
//                    'email' => 'semanga.ngosingosi@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Senior Programme Assistant (CBT)',
//                    'department' => 'Programme',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
//        
//        User::create(
//                array(
//                    'firstname' => 'Asia',
//                    'secondname' => 'Lashikoni',
//                    'username' => 'asia.lashikoni',
//                    'email' => 'asia.lashikoni@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'HR Assistant',
//                    'department' => 'HR',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
        
//        User::create(
//                array(
//                    'firstname' => 'Sylvester',
//                    'secondname' => 'Mishamo',
//                    'username' => 'sylvester.mishamo',
//                    'email' => 'sylvester.mishamo@wfp.org',
//                    'password' => bcrypt('Welcome@123'),
//                    'title' => 'Driver',
//                    'department' => 'Admin',
//                    'created_at' => $now,
//                    'updated_at' => $now
//                )
//        );
        
        User::create(
                array(
                    'firstname' => 'Admin Derick',
                    'secondname' => 'Ruganuza',
                    'username' => 'admruganuzad',
                    'email' => 'admruganuzad@wfp.org',
                    'password' => bcrypt('Welcome@123'),
                    'title' => 'Administrator',
                    'department' => 'Administrators',
                    'created_at' => $now,
                    'updated_at' => $now
                )
        );
        
    }

}
