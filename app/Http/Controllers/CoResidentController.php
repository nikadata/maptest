<?php

namespace App\Http\Controllers;
use App\Household;
use App\Stat as Stat;
use Illuminate\Http\Request;
use App\Coresident;


class CoResidentController extends Controller
{
    public function delResident($resident_id)
    {
        //Coresident object
        $coresident = Coresident::findOrFail($resident_id);
        //Belongs to household
        $household_id = $coresident->household_id;
        $stats = Stat::where('household_id', $household_id)->get();
        $count = $stats->filter(function($item) {
            return $item->id;
        })->first();
        //Subtract 1 from count
        --$count->household_count;
        $count->save();
        //Delete flag from household
        $household = Household::findOrFail($household_id);
        $household->coresident = 0;
        $household->save();
        //Delete specified coresident from database
        Coresident::destroy($resident_id);
        //Redirect back to page
        return redirect()->back();
    }
}
