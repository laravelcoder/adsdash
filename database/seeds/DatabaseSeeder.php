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
        
        $this->call(AdSeed::class);
        $this->call(ContactCompanySeed::class);
        $this->call(TeamSeed::class);
        $this->call(AgentSeed::class);
        $this->call(ContentCategorySeed::class);
        $this->call(ContentPageSeed::class);
        $this->call(TemplateSeed::class);
        $this->call(BottomScriptSeed::class);
        $this->call(ClipdbSeed::class);
        $this->call(ContactSeed::class);
        $this->call(ProviderSeed::class);
        $this->call(NetworkSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(PhoneSeed::class);
        $this->call(RoleSeed::class);
        $this->call(StationSeed::class);
        $this->call(StylesheetSeed::class);
        $this->call(UserBaseSeed::class);
        $this->call(UserSeed::class);
        $this->call(VariableSeed::class);
        $this->call(BottomScriptSeedPivot::class);
        $this->call(ContentPageSeedPivot::class);
        $this->call(RoleSeedPivot::class);
        $this->call(TemplateSeedPivot::class);
        $this->call(UserSeedPivot::class);

    }
}
