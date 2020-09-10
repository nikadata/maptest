<?php

namespace App\Http\Controllers;
use App\Charts\SampleChart;
use App\Household;
use App\Village;
use App\Fiscal as Fiscal;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsFiscalController extends Controller
{
    //
    public function __construct( Fiscal $fiscals)
    {
        $this->fiscals = $fiscals->all();

    }
    public function open_fiscal_stats(){
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $data=[];
      $data['now']=Carbon::now();

      //Create Chart object
      $rom_fiscal=new SampleChart;
      //Load api reference
      $api=url('/fiscal_data_rom');
      //
      $fiscals=$this->fiscals;
      //Assign label
      foreach ($fiscals as $fiscal) {
        $label[]=$fiscal;

      }
      /*start
      //Households save to array
      $fiscal_households=DB::table('households')
                    ->select(DB::raw('fiscal, count(*) as count'))
                    ->whereIn('nationality',$roms)
                    ->groupby('fiscal')
                      ->get();

      foreach ($fiscal_households as $fiscal){
        $fiscalstat[$fiscal->fiscal]=$fiscal->count;
      }
      $flag=0;
      foreach($label as $labelname){
          foreach ($fiscal_households as $fiscal){
              if($labelname==$fiscal->fiscal){
                  $fiscalstat[$fiscal->fiscal]=$fiscal->count;
                  $flag++;
                  }
              }
          //If array name doesnt exist add name and give value=0
          if($flag==0){
              $fiscalstat[$labelname]=0;
              }
          //Reset flag
          $flag=0;
          }
      //Copy array totat to array household
      foreach($fiscalstat as $househ){
        $sum[]=$househ;
      }
      //return $sum;

      //Coresident
      $fiscal_coresidents=DB::table('coresidents')
                    ->select(DB::raw('resident_fiscal, count(*) as count'))
                    ->whereIn('resident_nation',$roms)
                    ->groupby('resident_fiscal')
                      ->get();

      $flag=0;
      foreach ($fiscalstat as $name=>$key){
        foreach ($fiscal_coresidents as $co_fiscal){
            if($co_fiscal->resident_fiscal==$name){
                  $fiscalstat[$name]+=$co_fiscal->count;
                  $costat[$name]=$co_fiscal->count;
                  $flag++;
                  }
            }
            if($flag==0){
              $costat[$name]=0;
              }
            $flag=0;
        }
      foreach($costat as $co){
              $cor[]=$co;
              }
      //return $cor;
      end */
      $rom_fiscal->labels($label)->load($api);
      //General data
      $data['household_records']=Household::count();
      $data['roms']=DB::table('households')
                      ->whereIn('households.nationality',$roms)
                      ->count();
      //$data['romstotal']=DB::table('village_stats')->sum('village_stats.roms_count');
      $data['romstotal']=DB::table('nations')->sum('total');
      $data['village_records']=Village::count();
      //
      //return
      return view('charts/fiscal/open_fiscal',['rom_fiscal'=>$rom_fiscal],$data);
    }
    public function response_fiscal()
    {
      //This function
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $rom_fiscal=new SampleChart;
      $data=[];
      $data['now']=Carbon::now();
      //
      $fiscals=$this->fiscals;
      //Assign label
      foreach ($fiscals as $fiscal) {
        $label[]=$fiscal;
      }
      //Households save to array
      $fiscal_households=DB::table('households')
                    ->select(DB::raw('fiscal, count(*) as count'))
                    ->whereIn('nationality',$roms)
                    ->groupby('fiscal')
                      ->get();

      foreach ($fiscal_households as $fiscal){
        $fiscalstat[$fiscal->fiscal]=$fiscal->count;
      }
      $flag=0;
      foreach($label as $labelname){
          foreach ($fiscal_households as $fiscal){
              if($labelname==$fiscal->fiscal){
                  $fiscalstat[$fiscal->fiscal]=$fiscal->count;
                  $flag++;
                  }
              }
          //If array name doesnt exist add name and give value=0
          if($flag==0){
              $fiscalstat[$labelname]=0;
              }
          //Reset flag
          $flag=0;
          }
      //Copy array totat to array household
      foreach($fiscalstat as $househ){
        $sum[]=$househ;
      }
      //return $sum;
      //
      //Coresident
      $fiscal_coresidents=DB::table('coresidents')
                    ->select(DB::raw('resident_fiscal, count(*) as count'))
                    ->whereIn('resident_nation',$roms)
                    ->groupby('resident_fiscal')
                      ->get();

      $flag=0;
      foreach ($fiscalstat as $name=>$key){
        foreach ($fiscal_coresidents as $co_fiscal){
            if($co_fiscal->resident_fiscal==$name){
                  $fiscalstat[$name]+=$co_fiscal->count;
                  $costat[$name]=$co_fiscal->count;
                  $flag++;
                  }
            }
            if($flag==0){
              $costat[$name]=0;
              }
            $flag=0;
        }
      foreach($costat as $co){
              $cor[]=$co;
              }
      //return $cor;
      //Create total bar
      foreach ($fiscalstat as $fiscal=>$value){
        $total[]=$value;
      }
      //End housholds save to array

      //Graphs
      $rom_fiscal->dataset('Total', 'bar', $total)->color('#0000FF')->backgroundColor('#87CEFA');
      $rom_fiscal->dataset('Households', 'bar', $sum)->color('#00ff00');
      $rom_fiscal->dataset('Coresidents', 'bar', $cor)->color('#ff0000');
      //coresident fiscal data
      return $rom_fiscal->api();

    }
}
