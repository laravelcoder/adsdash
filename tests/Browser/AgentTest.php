<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AgentTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $agent) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->clickLink('Add new')
                ->select("company_id", $agent->company_id)
                ->type("first_name", $agent->first_name)
                ->type("last_name", $agent->last_name)
                ->type("phone1", $agent->phone1)
                ->type("phone2", $agent->phone2)
                ->type("email", $agent->email)
                ->type("skype", $agent->skype)
                ->type("address", $agent->address)
                ->attach("photo", base_path("tests/_resources/test.jpg"))
                ->type("about", $agent->about)
                ->press('Save')
                ->assertRouteIs('admin.agents.index')
                ->assertSeeIn("tr:last-child td[field-key='company']", $agent->company->name)
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $agent->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $agent->last_name)
                ->assertSeeIn("tr:last-child td[field-key='phone1']", $agent->phone1)
                ->assertSeeIn("tr:last-child td[field-key='phone2']", $agent->phone2)
                ->assertSeeIn("tr:last-child td[field-key='email']", $agent->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $agent->skype)
                ->assertSeeIn("tr:last-child td[field-key='address']", $agent->address);
        });
    }

    public function testEditAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->create();
        $agent2 = factory('App\Agent')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $agent, $agent2) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->click('tr[data-entry-id="' . $agent->id . '"] .btn-info')
                ->select("company_id", $agent2->company_id)
                ->type("first_name", $agent2->first_name)
                ->type("last_name", $agent2->last_name)
                ->type("phone1", $agent2->phone1)
                ->type("phone2", $agent2->phone2)
                ->type("email", $agent2->email)
                ->type("skype", $agent2->skype)
                ->type("address", $agent2->address)
                ->attach("photo", base_path("tests/_resources/test.jpg"))
                ->type("about", $agent2->about)
                ->press('Update')
                ->assertRouteIs('admin.agents.index')
                ->assertSeeIn("tr:last-child td[field-key='company']", $agent2->company->name)
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $agent2->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $agent2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='phone1']", $agent2->phone1)
                ->assertSeeIn("tr:last-child td[field-key='phone2']", $agent2->phone2)
                ->assertSeeIn("tr:last-child td[field-key='email']", $agent2->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $agent2->skype)
                ->assertSeeIn("tr:last-child td[field-key='address']", $agent2->address);
        });
    }

    public function testShowAgent()
    {
        $admin = \App\User::find(1);
        $agent = factory('App\Agent')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $agent) {
            $browser->loginAs($admin)
                ->visit(route('admin.agents.index'))
                ->click('tr[data-entry-id="' . $agent->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='company']", $agent->company->name)
                ->assertSeeIn("td[field-key='first_name']", $agent->first_name)
                ->assertSeeIn("td[field-key='last_name']", $agent->last_name)
                ->assertSeeIn("td[field-key='phone1']", $agent->phone1)
                ->assertSeeIn("td[field-key='phone2']", $agent->phone2)
                ->assertSeeIn("td[field-key='email']", $agent->email)
                ->assertSeeIn("td[field-key='skype']", $agent->skype)
                ->assertSeeIn("td[field-key='address']", $agent->address)
                ->assertSeeIn("td[field-key='about']", $agent->about)
                ->assertSeeIn("td[field-key='created_by']", $agent->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $agent->created_by_team->name);
        });
    }

}
