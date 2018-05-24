<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientTransactionTypeTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientTransactionType()
    {
        $admin = \App\User::find(1);
        $client_transaction_type = factory('App\ClientTransactionType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_transaction_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_transaction_types.index'))
                ->clickLink('Add new')
                ->type("title", $client_transaction_type->title)
                ->press('Save')
                ->assertRouteIs('admin.client_transaction_types.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_transaction_type->title);
        });
    }

    public function testEditClientTransactionType()
    {
        $admin = \App\User::find(1);
        $client_transaction_type = factory('App\ClientTransactionType')->create();
        $client_transaction_type2 = factory('App\ClientTransactionType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_transaction_type, $client_transaction_type2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_transaction_types.index'))
                ->click('tr[data-entry-id="' . $client_transaction_type->id . '"] .btn-info')
                ->type("title", $client_transaction_type2->title)
                ->press('Update')
                ->assertRouteIs('admin.client_transaction_types.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_transaction_type2->title);
        });
    }

    public function testShowClientTransactionType()
    {
        $admin = \App\User::find(1);
        $client_transaction_type = factory('App\ClientTransactionType')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_transaction_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_transaction_types.index'))
                ->click('tr[data-entry-id="' . $client_transaction_type->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $client_transaction_type->title);
        });
    }

}
