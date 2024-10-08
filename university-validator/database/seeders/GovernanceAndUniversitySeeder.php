<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Governance;
use App\Models\University;

class GovernanceAndUniversitySeeder extends Seeder
{
    public function run()
    {
        // Seed Governance data
        $bavaria = Governance::create([
            'name' => 'Bavaria',
           
        ]);

        $berlin = Governance::create([
            'name' => 'Berlin',
           
        ]);

        $badenWuerttemberg = Governance::create([
            'name' => 'Baden-Württemberg',
           
        ]);

        // Seed University data, associating each university with a governance
        University::create([
            'name' => 'Ludwig Maximilian University of Munich',
            
            'governance_id' => $bavaria->id,
        ]);

        University::create([
            'name' => 'University of Berlin',
           
            'governance_id' => $berlin->id,
        ]);

        University::create([
            'name' => 'University of Stuttgart',
            
            'governance_id' => $badenWuerttemberg->id,
        ]);
    }
}
