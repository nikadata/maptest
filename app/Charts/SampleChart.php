<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SampleChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->displayLegend(true);
        //$this->displayAxes(10);
        //$this->barWidth(100);

        /*
        $this->labels(['One','Two','Three','Four','Five'])
        ->options([
          'legend'=>[
            'display'=>false
          ]
        ]);
        */
    }
}
