<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ChannelTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateChannel()
    {
        $admin = \App\User::find(1);
        $channel = factory('App\Channel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $channel) {
            $browser->loginAs($admin)
                ->visit(route('admin.channels.index'))
                ->clickLink('Add new')
                ->type("channel", $channel->channel)
                ->type("channel_name", $channel->channel_name)
                ->press('Save')
                ->assertRouteIs('admin.channels.index')
                ->assertSeeIn("tr:last-child td[field-key='channel']", $channel->channel)
                ->assertSeeIn("tr:last-child td[field-key='channel_name']", $channel->channel_name);
        });
    }

    public function testEditChannel()
    {
        $admin = \App\User::find(1);
        $channel = factory('App\Channel')->create();
        $channel2 = factory('App\Channel')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $channel, $channel2) {
            $browser->loginAs($admin)
                ->visit(route('admin.channels.index'))
                ->click('tr[data-entry-id="' . $channel->id . '"] .btn-info')
                ->type("channel", $channel2->channel)
                ->type("channel_name", $channel2->channel_name)
                ->press('Update')
                ->assertRouteIs('admin.channels.index')
                ->assertSeeIn("tr:last-child td[field-key='channel']", $channel2->channel)
                ->assertSeeIn("tr:last-child td[field-key='channel_name']", $channel2->channel_name);
        });
    }

    public function testShowChannel()
    {
        $admin = \App\User::find(1);
        $channel = factory('App\Channel')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $channel) {
            $browser->loginAs($admin)
                ->visit(route('admin.channels.index'))
                ->click('tr[data-entry-id="' . $channel->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='channel']", $channel->channel)
                ->assertSeeIn("td[field-key='channel_name']", $channel->channel_name);
        });
    }

}
