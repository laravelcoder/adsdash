<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AssetsCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateAssetsCategory()
    {
        $admin = \App\User::find(1);
        $assets_category = factory('App\AssetsCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $assets_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_categories.index'))
                ->clickLink('Add new')
                ->type("title", $assets_category->title)
                ->press('Save')
                ->assertRouteIs('admin.assets_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $assets_category->title);
        });
    }

    public function testEditAssetsCategory()
    {
        $admin = \App\User::find(1);
        $assets_category = factory('App\AssetsCategory')->create();
        $assets_category2 = factory('App\AssetsCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $assets_category, $assets_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_categories.index'))
                ->click('tr[data-entry-id="' . $assets_category->id . '"] .btn-info')
                ->type("title", $assets_category2->title)
                ->press('Update')
                ->assertRouteIs('admin.assets_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='title']", $assets_category2->title);
        });
    }

    public function testShowAssetsCategory()
    {
        $admin = \App\User::find(1);
        $assets_category = factory('App\AssetsCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $assets_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.assets_categories.index'))
                ->click('tr[data-entry-id="' . $assets_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='title']", $assets_category->title);
        });
    }

}
