<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AudienceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAudience()
    {
        $admin = \App\User::find(1);
        $audience = factory('App\Audience')->make();

        $relations = [
            factory('App\Contactcompany')->create(), 
            factory('App\Contactcompany')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $audience, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.audiences.index'))
                ->clickLink('Add new')
                ->type("name", $audience->name)
                ->type("value", $audience->value)
                ->select('select[name="companies[]"]', $relations[0]->id)
                ->select('select[name="companies[]"]', $relations[1]->id)
                ->press('Save')
                ->assertRouteIs('admin.audiences.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $audience->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $audience->value)
                ->assertSeeIn("tr:last-child td[field-key='companies'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='companies'] span:last-child", $relations[1]->name);
        });
    }

    public function testEditAudience()
    {
        $admin = \App\User::find(1);
        $audience = factory('App\Audience')->create();
        $audience2 = factory('App\Audience')->make();

        $relations = [
            factory('App\Contactcompany')->create(), 
            factory('App\Contactcompany')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $audience, $audience2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.audiences.index'))
                ->click('tr[data-entry-id="' . $audience->id . '"] .btn-info')
                ->type("name", $audience2->name)
                ->type("value", $audience2->value)
                ->select('select[name="companies[]"]', $relations[0]->id)
                ->select('select[name="companies[]"]', $relations[1]->id)
                ->press('Update')
                ->assertRouteIs('admin.audiences.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $audience2->name)
                ->assertSeeIn("tr:last-child td[field-key='value']", $audience2->value)
                ->assertSeeIn("tr:last-child td[field-key='companies'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='companies'] span:last-child", $relations[1]->name);
        });
    }

    public function testShowAudience()
    {
        $admin = \App\User::find(1);
        $audience = factory('App\Audience')->create();

        $relations = [
            factory('App\Contactcompany')->create(), 
            factory('App\Contactcompany')->create(), 
        ];

        $audience->companies()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $audience, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.audiences.index'))
                ->click('tr[data-entry-id="' . $audience->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $audience->name)
                ->assertSeeIn("td[field-key='value']", $audience->value)
                ->assertSeeIn("tr:last-child td[field-key='companies'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='companies'] span:last-child", $relations[1]->name);
        });
    }

}
