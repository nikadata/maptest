<?php

namespace App\Http\Controllers;

use App\CoresidentChild;
use App\Child;
use App\Household;
use App\Stat;
use Illuminate\Http\Request;



class ChildController extends Controller
{
    public function delResidentChild($residentchild_id)
    {
        //Coresident child object
        $child = CoresidentChild::findOrFail($residentchild_id);
        //Belongs to household
        $household_id = $child->household_id;
        $stats = Stat::where('household_id', $household_id)->get();
        $count = $stats->filter(function($item) {
            return $item->id;
        })->first();
        //Subtract 1 from count
        --$count->household_count;
        $count->save();
        //Delete flag from household
        $household = Household::findOrFail($household_id);
        $household->coresident_child = 0;
        $household->save();
        //Delete specified child from database
        CoresidentChild::destroy($residentchild_id);
        //Redirect to index
        return redirect()->back();
    }

    public function delChild($child_id)
    {
        //Child object
        $child = Child::findOrFail($child_id);
        //Belongs to household
        $household_id = $child->household_id;
        $stats = Stat::where('household_id', $household_id)->get();
        $count = $stats->filter(function($item) {
            return $item->id;
        })->first();
        //Subtract 1 from count
        --$count->household_count;
        $count->save();
        //Delete flag from household
        $household = Household::findOrFail($household_id);
        $household->children = 0;
        $household->save();
        //Delete specified child from database
        Child::destroy($child_id);
        //Redirect to index
        return redirect()->back();
    }
}
