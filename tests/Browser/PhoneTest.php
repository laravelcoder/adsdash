<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PhoneTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreatePhone()
    {
        $admin = \App\User::find(1);
        $phone = factory('App\Phone')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $phone) {
            $browser->loginAs($admin)
                ->visit(route('admin.phones.index'))
                ->clickLink('Add new')
                ->type("phone_number", $phone->phone_number)
                ->select("contact_id", $phone->contact_id)
                ->select("agent_id", $phone->agent_id)
                ->select("company_id", $phone->company_id)
                ->press('Save')
                ->assertRouteIs('admin.phones.index')
                ->assertSeeIn("tr:last-child td[field-key='phone_number']", $phone->phone_number)
                ->assertSeeIn("tr:last-child td[field-key='contact']", $phone->contact->first_name)
                ->assertSeeIn("tr:last-child td[field-key='agent']", $phone->agent->first_name)
                ->assertSeeIn("tr:last-child td[field-key='company']", $phone->company->name);
        });
    }

    public function testEditPhone()
    {
        $admin = \App\User::find(1);
        $phone = factory('App\Phone')->create();
        $phone2 = factory('App\Phone')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $phone, $phone2) {
            $browser->loginAs($admin)
                ->visit(route('admin.phones.index'))
                ->click('tr[data-entry-id="' . $phone->id . '"] .btn-info')
                ->type("phone_number", $phone2->phone_number)
                ->select("contact_id", $phone2->contact_id)
                ->select("agent_id", $phone2->agent_id)
                ->select("company_id", $phone2->company_id)
                ->press('Update')
                ->assertRouteIs('admin.phones.index')
                ->assertSeeIn("tr:last-child td[field-key='phone_number']", $phone2->phone_number)
                ->assertSeeIn("tr:last-child td[field-key='contact']", $phone2->contact->first_name)
                ->assertSeeIn("tr:last-child td[field-key='agent']", $phone2->agent->first_name)
                ->assertSeeIn("tr:last-child td[field-key='company']", $phone2->company->name);
        });
    }

    public function testShowPhone()
    {
        $admin = \App\User::find(1);
        $phone = factory('App\Phone')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $phone) {
            $browser->loginAs($admin)
                ->visit(route('admin.phones.index'))
                ->click('tr[data-entry-id="' . $phone->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='phone_number']", $phone->phone_number)
                ->assertSeeIn("td[field-key='contact']", $phone->contact->first_name)
                ->assertSeeIn("td[field-key='agent']", $phone->agent->first_name)
                ->assertSeeIn("td[field-key='company']", $phone->company->name);
        });
    }

}
