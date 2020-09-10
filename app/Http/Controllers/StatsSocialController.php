<?php

namespace App\Http\Controllers;
use App\Charts\SampleChart;
use App\Household;
use App\Village;
use App\SocialClass as Social;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatsSocialController extends Controller
{
    //
    public function __construct( Social $socials)
    {
        $this->socials = $socials->all();

    }
    public function open_social_stats(){
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $data=[];
      $data['now']=Carbon::now();

      //Create Chart object
      $rom_social=new SampleChart;
      //Load api reference
      $api=url('/social_data_rom');
      //
      $socials=$this->socials->sortby('social_name');
      //Assign label
      foreach ($socials as $social) {
        $label[]=$social->social_name;
      }

      $rom_social->labels($label)->load($api);
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
      return view('charts/social/open_social',['rom_social'=>$rom_social],$data);
    }
    public function response_social()
    {
      //This function
      $roms=array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');
      $rom_social=new SampleChart;
      $data=[];
      $data['now']=Carbon::now();
      //Households save to array
      $socials=$this->socials->sortby('social_name');
      //Assign label
      foreach ($socials as $social) {
        $label[]=$social->social_name;
      }

      $social_households=DB::table('households')
                    ->join('social_classes','households.socialclass_id','=','social_classes.id')
                    ->select(DB::raw('social_name, count(*) as count'))
                    ->whereIn('nationality',$roms)
                    ->groupby('social_name')
                      ->get();
      $flag=0;
      foreach($label as $labelname){
          foreach ($social_households as $social){
              if($labelname==$social->social_name){
                  $socialstat[$social->social_name]=$social->count;
                  $flag++;
                  }
              }
          //If array name doesnt exist add name and give value=0
          if($flag==0){
              $socialstat[$labelname]=0;
              }
          //Reset flag
          $flag=0;
          }
      //Copy array totat to array household
      foreach($socialstat as $househ){
        $sum[]=$househ;
      }
      //Coresident
      //Coresidents social data
      $social_coresidents=DB::table('coresidents')
      ->select(DB::raw('resident_class, count(*) as count'))
      ->whereIn('resident_nation',$roms)
      ->groupby('resident_class')
        ->get();

        $flag=0;
        foreach ($socialstat as $name=>$key){
          foreach ($social_coresidents as $co_social){
            if($co_social->resident_class==$name){
              $socialstat[$name]+=$co_social->count;
              $costat[$name]=$co_social->count;
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
      //Create total bar
      foreach ($socialstat as $social=>$value){
        $total[]=$value;
      }

      //End housholds save to array

      //Graphs
      $rom_social->dataset('Total', 'bar', $total)->color('#0000FF')->backgroundColor('#87CEFA');
      $rom_social->dataset('Households', 'bar', $sum)->color('#00ff00');
      $rom_social->dataset('Coresidents', 'bar', $cor)->color('#ff0000');
      //coresident social data
      return $rom_social->api();

    }
}
