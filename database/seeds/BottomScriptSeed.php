<?php

use Illuminate\Database\Seeder;

class BottomScriptSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'script' => 'plugins/sparkline/jquery.sparkline.min.jS', 'name' => 'sparkline', 'jquery' => 0,],
            ['id' => 2, 'script' => 'plugins/chartjs-old/Chart.min.js', 'name' => 'charts', 'jquery' => 0,],
            ['id' => 3, 'script' => 'dist/js/pages/dashboard2.js', 'name' => 'dash-2', 'jquery' => 0,],
            ['id' => 4, 'script' => '<script src="../../plugins/jquery/jquery.min.js"></script>', 'name' => 'jquery.min', 'jquery' => 0,],
            ['id' => 5, 'script' => '<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>', 'name' => 'bootstrap.js', 'jquery' => 0,],
            ['id' => 6, 'script' => '<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>', 'name' => 'jquery.slimscroll', 'jquery' => 1,],
            ['id' => 7, 'script' => '<script src="../../plugins/fastclick/fastclick.js"></script> <!-- AdminLTE App -->', 'name' => 'fastclick', 'jquery' => 0,],
            ['id' => 8, 'script' => '<script src="../../dist/js/adminlte.min.js"></script>', 'name' => 'adminlte', 'jquery' => 0,],
            ['id' => 9, 'script' => '<script src="../../dist/js/demo.js"></script>', 'name' => 'demo', 'jquery' => 0,],

        ];

        foreach ($items as $item) {
            \App\BottomScript::create($item);
        }
    }
}
