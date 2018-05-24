<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProfileTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateProfile()
    {
        $admin = \App\User::find(1);
        $profile = factory('App\Profile')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $profile) {
            $browser->loginAs($admin)
                ->visit(route('admin.profiles.index'))
                ->clickLink('Add new')
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.profiles.index')
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Profile::first()->image . "']");
        });
    }

    public function testEditProfile()
    {
        $admin = \App\User::find(1);
        $profile = factory('App\Profile')->create();
        $profile2 = factory('App\Profile')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $profile, $profile2) {
            $browser->loginAs($admin)
                ->visit(route('admin.profiles.index'))
                ->click('tr[data-entry-id="' . $profile->id . '"] .btn-info')
                ->attach("image", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.profiles.index')
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Profile::first()->image . "']");
        });
    }

    public function testShowProfile()
    {
        $admin = \App\User::find(1);
        $profile = factory('App\Profile')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $profile) {
            $browser->loginAs($admin)
                ->visit(route('admin.profiles.index'))
                ->click('tr[data-entry-id="' . $profile->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='created_by']", $profile->created_by->name);
        });
    }

}
