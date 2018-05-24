<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(ContactCompanySeed::class);
        $this->call(ContentPageSeed::class);
        $this->call(TeamSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(ProviderSeed::class);
        $this->call(NetworkSeed::class);
        $this->call(StationSeed::class);
        $this->call(UserBaseSeed::class);
        $this->call(VariableSeed::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);

    }
}
