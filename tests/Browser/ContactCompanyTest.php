<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ContactCompanyTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateContactCompany()
    {
        $admin = \App\User::find(1);
        $contact_company = factory('App\ContactCompany')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact_company) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_companies.index'))
                ->clickLink('Add new')
                ->type("name", $contact_company->name)
                ->type("address", $contact_company->address)
                ->type("website", $contact_company->website)
                ->type("email", $contact_company->email)
                ->press('Save')
                ->assertRouteIs('admin.contact_companies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $contact_company->name)
                ->assertSeeIn("tr:last-child td[field-key='address']", $contact_company->address)
                ->assertSeeIn("tr:last-child td[field-key='website']", $contact_company->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact_company->email);
        });
    }

    public function testEditContactCompany()
    {
        $admin = \App\User::find(1);
        $contact_company = factory('App\ContactCompany')->create();
        $contact_company2 = factory('App\ContactCompany')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact_company, $contact_company2) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_companies.index'))
                ->click('tr[data-entry-id="' . $contact_company->id . '"] .btn-info')
                ->type("name", $contact_company2->name)
                ->type("address", $contact_company2->address)
                ->type("website", $contact_company2->website)
                ->type("email", $contact_company2->email)
                ->press('Update')
                ->assertRouteIs('admin.contact_companies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $contact_company2->name)
                ->assertSeeIn("tr:last-child td[field-key='address']", $contact_company2->address)
                ->assertSeeIn("tr:last-child td[field-key='website']", $contact_company2->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact_company2->email);
        });
    }

    public function testShowContactCompany()
    {
        $admin = \App\User::find(1);
        $contact_company = factory('App\ContactCompany')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $contact_company) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_companies.index'))
                ->click('tr[data-entry-id="' . $contact_company->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $contact_company->name)
                ->assertSeeIn("td[field-key='address']", $contact_company->address)
                ->assertSeeIn("td[field-key='website']", $contact_company->website)
                ->assertSeeIn("td[field-key='email']", $contact_company->email);
        });
    }

}
