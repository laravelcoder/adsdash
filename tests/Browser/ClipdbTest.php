<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClipdbTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateClipdb()
    {
        $admin = \App\User::find(1);
        $clipdb = factory('App\Clipdb')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $clipdb) {
            $browser->loginAs($admin)
                ->visit(route('admin.clipdbs.index'))
                ->clickLink('Add new')
                ->select("ad_id", $clipdb->ad_id)
                ->type("clip_label", $clipdb->clip_label)
                ->type("link_to_clip", $clipdb->link_to_clip)
                ->attach("video_upload", base_path("tests/_resources/test.jpg"))
                ->attach("image_upload", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.clipdbs.index')
                ->assertSeeIn("tr:last-child td[field-key='ad']", $clipdb->ad->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='clip_label']", $clipdb->clip_label)
                ->assertSeeIn("tr:last-child td[field-key='link_to_clip']", $clipdb->link_to_clip)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Clipdb::first()->video_upload . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Clipdb::first()->image_upload . "']");
        });
    }

    public function testEditClipdb()
    {
        $admin = \App\User::find(1);
        $clipdb = factory('App\Clipdb')->create();
        $clipdb2 = factory('App\Clipdb')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $clipdb, $clipdb2) {
            $browser->loginAs($admin)
                ->visit(route('admin.clipdbs.index'))
                ->click('tr[data-entry-id="' . $clipdb->id . '"] .btn-info')
                ->select("ad_id", $clipdb2->ad_id)
                ->type("clip_label", $clipdb2->clip_label)
                ->type("link_to_clip", $clipdb2->link_to_clip)
                ->attach("video_upload", base_path("tests/_resources/test.jpg"))
                ->attach("image_upload", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.clipdbs.index')
                ->assertSeeIn("tr:last-child td[field-key='ad']", $clipdb2->ad->ad_label)
                ->assertSeeIn("tr:last-child td[field-key='clip_label']", $clipdb2->clip_label)
                ->assertSeeIn("tr:last-child td[field-key='link_to_clip']", $clipdb2->link_to_clip)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Clipdb::first()->video_upload . "']")
                ->assertVisible("img[src='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/thumb/" . \App\Clipdb::first()->image_upload . "']");
        });
    }

    public function testShowClipdb()
    {
        $admin = \App\User::find(1);
        $clipdb = factory('App\Clipdb')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $clipdb) {
            $browser->loginAs($admin)
                ->visit(route('admin.clipdbs.index'))
                ->click('tr[data-entry-id="' . $clipdb->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='ad']", $clipdb->ad->ad_label)
                ->assertSeeIn("td[field-key='clip_label']", $clipdb->clip_label)
                ->assertSeeIn("td[field-key='link_to_clip']", $clipdb->link_to_clip)
                ->assertSeeIn("td[field-key='created_by']", $clipdb->created_by->name)
                ->assertSeeIn("td[field-key='created_by_team']", $clipdb->created_by_team->name);
        });
    }

}
