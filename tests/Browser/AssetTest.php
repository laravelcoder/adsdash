<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AssetTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAsset()
    {
        $admin = \App\User::find(1);
        $asset = factory('App\Asset')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $asset) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets.index'))
                ->clickLink('Add new')
                ->select("category_id", $asset->category_id)
                ->type("serial_number", $asset->serial_number)
                ->type("title", $asset->title)
                ->attach("photo1", base_path("tests/_resources/test.jpg"))
                ->attach("photo2", base_path("tests/_resources/test.jpg"))
                ->attach("photo3", base_path("tests/_resources/test.jpg"))
                ->select("status_id", $asset->status_id)
                ->select("location_id", $asset->location_id)
                ->select("assigned_user_id", $asset->assigned_user_id)
                ->type("notes", $asset->notes)
                ->press('Save')
                ->assertRouteIs('admin.assets.index')
                ->assertSeeIn("tr:last-child td[field-key='category']", $asset->category->title)
                ->assertSeeIn("tr:last-child td[field-key='serial_number']", $asset->serial_number)
                ->assertSeeIn("tr:last-child td[field-key='title']", $asset->title)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Asset::first()->photo1 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Asset::first()->photo2 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Asset::first()->photo3 . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $asset->status->title)
                ->assertSeeIn("tr:last-child td[field-key='location']", $asset->location->title)
                ->assertSeeIn("tr:last-child td[field-key='assigned_user']", $asset->assigned_user->name)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $asset->notes);
        });
    }

    public function testEditAsset()
    {
        $admin = \App\User::find(1);
        $asset = factory('App\Asset')->create();
        $asset2 = factory('App\Asset')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $asset, $asset2) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets.index'))
                ->click('tr[data-entry-id="' . $asset->id . '"] .btn-info')
                ->select("category_id", $asset2->category_id)
                ->type("serial_number", $asset2->serial_number)
                ->type("title", $asset2->title)
                ->attach("photo1", base_path("tests/_resources/test.jpg"))
                ->attach("photo2", base_path("tests/_resources/test.jpg"))
                ->attach("photo3", base_path("tests/_resources/test.jpg"))
                ->select("status_id", $asset2->status_id)
                ->select("location_id", $asset2->location_id)
                ->select("assigned_user_id", $asset2->assigned_user_id)
                ->type("notes", $asset2->notes)
                ->press('Update')
                ->assertRouteIs('admin.assets.index')
                ->assertSeeIn("tr:last-child td[field-key='category']", $asset2->category->title)
                ->assertSeeIn("tr:last-child td[field-key='serial_number']", $asset2->serial_number)
                ->assertSeeIn("tr:last-child td[field-key='title']", $asset2->title)
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Asset::first()->photo1 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Asset::first()->photo2 . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Asset::first()->photo3 . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $asset2->status->title)
                ->assertSeeIn("tr:last-child td[field-key='location']", $asset2->location->title)
                ->assertSeeIn("tr:last-child td[field-key='assigned_user']", $asset2->assigned_user->name)
                ->assertSeeIn("tr:last-child td[field-key='notes']", $asset2->notes);
        });
    }

    public function testShowAsset()
    {
        $admin = \App\User::find(1);
        $asset = factory('App\Asset')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $asset) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets.index'))
                ->click('tr[data-entry-id="' . $asset->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='category']", $asset->category->title)
                ->assertSeeIn("td[field-key='serial_number']", $asset->serial_number)
                ->assertSeeIn("td[field-key='title']", $asset->title)
                ->assertSeeIn("td[field-key='status']", $asset->status->title)
                ->assertSeeIn("td[field-key='location']", $asset->location->title)
                ->assertSeeIn("td[field-key='assigned_user']", $asset->assigned_user->name)
                ->assertSeeIn("td[field-key='notes']", $asset->notes);
        });
    }

}
