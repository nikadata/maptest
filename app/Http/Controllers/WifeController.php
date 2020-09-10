<?php

namespace App\Http\Controllers;
use App\Household;
use App\Wife;
use App\Stat;
use App\CoresidentSpouse;
use Illuminate\Http\Request;

class WifeController extends Controller
{
    public function delWife($wife_id)
    {
        //Wife object
        $wife = Wife::findOrFail($wife_id);
        //Belongs to household
        $household_id = $wife->household_id;
        $stats = Stat::where('household_id', $household_id)->get();
        $count = $stats->filter(function($item) {
            return $item->id;
        })->first();
        //Subtract 1 from count
        --$count->household_count;
        $count->save();
        //Delete flag from household
        $household = Household::findOrFail($household_id);
        $household->wife = 0;
        $household->save();
        //Delete specified wife from database
        Wife::destroy($wife_id);
        //Redirect back to page
        return redirect()->back();
    }
    public function delResidentSpouse($spouse_id)
    {
        //Spouse object
        $spouse = CoresidentSpouse::findOrFail($spouse_id);
        //Belongs to household
        $household_id = $spouse->household_id;
        $stats = Stat::where('household_id', $household_id)->get();
        $count = $stats->filter(function($item) {
            return $item->id;
        })->first();
        //Subtract 1 from count
        --$count->household_count;
        $count->save();
        //Delete flag from household
        $household = Household::findOrFail($household_id);
        $household->coresident_spouse = 0;
        $household->save();
        //Delete specified coresident from database
        CoresidentSpouse::destroy($spouse_id);
        //Redirect back to page
        return redirect()->back();
    }
}
