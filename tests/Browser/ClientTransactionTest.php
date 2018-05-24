<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientTransactionTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClientTransaction()
    {
        $admin = \App\User::find(1);
        $client_transaction = factory('App\ClientTransaction')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_transaction) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_transactions.index'))
                ->clickLink('Add new')
                ->select("project_id", $client_transaction->project_id)
                ->select("transaction_type_id", $client_transaction->transaction_type_id)
                ->select("income_source_id", $client_transaction->income_source_id)
                ->type("title", $client_transaction->title)
                ->type("description", $client_transaction->description)
                ->type("amount", $client_transaction->amount)
                ->select("currency_id", $client_transaction->currency_id)
                ->type("transaction_date", $client_transaction->transaction_date)
                ->press('Save')
                ->assertRouteIs('admin.client_transactions.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $client_transaction->project->title)
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $client_transaction->transaction_type->title)
                ->assertSeeIn("tr:last-child td[field-key='income_source']", $client_transaction->income_source->title)
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_transaction->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $client_transaction->description)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $client_transaction->amount)
                ->assertSeeIn("tr:last-child td[field-key='currency']", $client_transaction->currency->title)
                ->assertSeeIn("tr:last-child td[field-key='transaction_date']", $client_transaction->transaction_date);
        });
    }

    public function testEditClientTransaction()
    {
        $admin = \App\User::find(1);
        $client_transaction = factory('App\ClientTransaction')->create();
        $client_transaction2 = factory('App\ClientTransaction')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_transaction, $client_transaction2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_transactions.index'))
                ->click('tr[data-entry-id="' . $client_transaction->id . '"] .btn-info')
                ->select("project_id", $client_transaction2->project_id)
                ->select("transaction_type_id", $client_transaction2->transaction_type_id)
                ->select("income_source_id", $client_transaction2->income_source_id)
                ->type("title", $client_transaction2->title)
                ->type("description", $client_transaction2->description)
                ->type("amount", $client_transaction2->amount)
                ->select("currency_id", $client_transaction2->currency_id)
                ->type("transaction_date", $client_transaction2->transaction_date)
                ->press('Update')
                ->assertRouteIs('admin.client_transactions.index')
                ->assertSeeIn("tr:last-child td[field-key='project']", $client_transaction2->project->title)
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $client_transaction2->transaction_type->title)
                ->assertSeeIn("tr:last-child td[field-key='income_source']", $client_transaction2->income_source->title)
                ->assertSeeIn("tr:last-child td[field-key='title']", $client_transaction2->title)
                ->assertSeeIn("tr:last-child td[field-key='description']", $client_transaction2->description)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $client_transaction2->amount)
                ->assertSeeIn("tr:last-child td[field-key='currency']", $client_transaction2->currency->title)
                ->assertSeeIn("tr:last-child td[field-key='transaction_date']", $client_transaction2->transaction_date);
        });
    }

    public function testShowClientTransaction()
    {
        $admin = \App\User::find(1);
        $client_transaction = factory('App\ClientTransaction')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_transaction) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_transactions.index'))
                ->click('tr[data-entry-id="' . $client_transaction->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project']", $client_transaction->project->title)
                ->assertSeeIn("td[field-key='transaction_type']", $client_transaction->transaction_type->title)
                ->assertSeeIn("td[field-key='income_source']", $client_transaction->income_source->title)
                ->assertSeeIn("td[field-key='title']", $client_transaction->title)
                ->assertSeeIn("td[field-key='description']", $client_transaction->description)
                ->assertSeeIn("td[field-key='amount']", $client_transaction->amount)
                ->assertSeeIn("td[field-key='currency']", $client_transaction->currency->title)
                ->assertSeeIn("td[field-key='transaction_date']", $client_transaction->transaction_date);
        });
    }

}
