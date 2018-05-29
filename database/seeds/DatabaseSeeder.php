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
        
        $this->call(TeamSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(AdSeed::class);
        $this->call(ContactCompanySeed::class);
        $this->call(AgentSeed::class);
        $this->call(ClipdbSeed::class);
        $this->call(ContactSeed::class);
        $this->call(ContentCategorySeed::class);
        $this->call(TemplateSeed::class);
        $this->call(ContentPageSeed::class);
        $this->call(ProviderSeed::class);
        $this->call(NetworkSeed::class);
        $this->call(PhoneSeed::class);
        $this->call(StationSeed::class);
        $this->call(UserBaseSeed::class);
        $this->call(VariableSeed::class);
        $this->call(ContentPageSeedPivot::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);

    }
}
