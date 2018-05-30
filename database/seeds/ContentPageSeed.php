<?php

use Illuminate\Database\Seeder;

class ContentPageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'About us', 'page_text' => '<p>Sample text</p>
', 'excerpt' => 'Sample excerpt', 'featured_image' => '', 'template_id' => 3,],
            ['id' => 2, 'title' => 'BASIC EXAMPLE', 'page_text' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
', 'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'featured_image' => null, 'template_id' => null,],
            ['id' => 3, 'title' => 'Ad Dash', 'page_text' => '<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h5>Monthly Recap Report</h5>

<div class="card-tools">
<div class="btn-group">
<div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a> <a class="dropdown-item" href="#">Separated link</a></div>
</div>
</div>
</div>
<!-- /.card-header -->

<div class="card-body">
<div class="row">
<div class="col-md-8">
<p><strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong></p>

<div class="chart"><!-- Sales Chart Canvas --></div>
<!-- /.chart-responsive --></div>
<!-- /.col -->

<div class="col-md-4">
<p><strong>Goal Completion</strong></p>

<div class="progress-group">Add Products to Cart <strong>160</strong>/200

<div class="progress progress-sm">
<div class="progress-bar bg-primary" style="width: 80%">&nbsp;</div>
</div>
</div>
<!-- /.progress-group -->

<div class="progress-group">Complete Purchase <strong>310</strong>/400

<div class="progress progress-sm">
<div class="progress-bar bg-danger" style="width: 75%">&nbsp;</div>
</div>
</div>
<!-- /.progress-group -->

<div class="progress-group">Visit Premium Page <strong>480</strong>/800

<div class="progress progress-sm">
<div class="progress-bar bg-success" style="width: 60%">&nbsp;</div>
</div>
</div>
<!-- /.progress-group -->

<div class="progress-group">Send Inquiries <strong>250</strong>/500

<div class="progress progress-sm">
<div class="progress-bar bg-warning" style="width: 50%">&nbsp;</div>
</div>
</div>
<!-- /.progress-group --></div>
<!-- /.col --></div>
<!-- /.row --></div>
<!-- ./card-body -->

<div class="card-footer">
<div class="row">
<div class="col-sm-3 col-6">
<div class="description-block border-right">17%
<h5>$35,210.43</h5>
TOTAL REVENUE</div>
<!-- /.description-block --></div>
<!-- /.col -->

<div class="col-sm-3 col-6">
<div class="description-block border-right">0%
<h5>$10,390.90</h5>
TOTAL COST</div>
<!-- /.description-block --></div>
<!-- /.col -->

<div class="col-sm-3 col-6">
<div class="description-block border-right">20%
<h5>$24,813.53</h5>
TOTAL PROFIT</div>
<!-- /.description-block --></div>
<!-- /.col -->

<div class="col-sm-3 col-6">
<div class="description-block">18%
<h5>1200</h5>
GOAL COMPLETIONS</div>
<!-- /.description-block --></div>
</div>
<!-- /.row --></div>
<!-- /.card-footer --></div>
<!-- /.card --></div>
<!-- /.col --></div>
', 'excerpt' => null, 'featured_image' => null, 'template_id' => 2,],

        ];

        foreach ($items as $item) {
            \App\ContentPage::create($item);
        }
    }
}
