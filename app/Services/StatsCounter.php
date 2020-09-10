<?php
namespace App\Services;
use App\Nationality;
use App\Nation as Nation;
use Illuminate\Support\Facades\DB;

class StatsCounter
{
  public $version;
  protected $roms;
  protected $youngest;
  protected $oldest;
  protected $totalromhouseholds;
  protected $householdsmin, $householdsmax;
  protected $wivesmin, $wivesmax;
  protected $childrenmin, $childrenmax;
  protected $coresidentsmin, $coresidentsmax;
  protected $coresidentspousemin, $coresidentspousemax;
  protected $coresidentchildrenmin, $coresidentchildrenmax;

  public function __construct()
  {
    $this->version = '3.9.3';
    $this->roms = array('Țigan','Țigan Ungurean', 'Căldărar','Ciurar','Fierar','Inar','Lăieș/Lăieț','Netot','Rudar','Ursar','Vătraş','Zavragiu','Zlătar');

  }

  public function getRoms()
  {
    return $this->roms;
  }

  public function countRomHouseholds()
  {
    // Count total Romani Households in DB
    return $this->totalromhouseholds = DB::table('households')
                    ->whereIn('households.nationality',$this->roms)
                    ->count();

  }

  public function getYoungest()
  {
    $youngest[]=$this->countHouseholdsMin();
    $youngest[]=$this->countWivesMin();
    $youngest[]=$this->countChildrenMin();
    $youngest[]=$this->countCoresidentsMin();
    $youngest[]=$this->countCoresidentSpouseMin();
    $youngest[]=$this->countCoresidentChildrenMin();

    return min($youngest);
  }

  public function getOldest()
  {
    $oldest[] = $this->countHouseholdsMax();
    $oldest[] = $this->countWivesMax();
    $oldest[] = $this->countChildrenMax();
    $oldest[] = $this->countCoresidentsMax();
    $oldest[] = $this->countCoresidentSpouseMax();
    $oldest[] = $this->countCoresidentChildrenMax();

    return max($oldest);
  }
  // Max / Min Roms data
  public function countHouseholdsMin()
  {
    // Minimum age of Households
    return $this->householdsmin = DB::table('households')
                  ->whereIn('households.nationality',$this->roms)
                  ->min('age');

  }

  public function countWivesMin()
  {
    // Minimum age of wives
    return $this->wivesmin = DB::table('wives')
                    ->whereIn('wife_nation',$this->roms)
                    ->min('wife_age');
  }

  public function countChildrenMin()
  {
    // Minimum age of children
    return $this->childrenmin = DB::table('households')
                  ->join('children','households.id','=','children.household_id')
                    ->whereIn('households.nationality',$this->roms)
                    ->min('children.child_age');
  }

  public function countCoresidentsMin()
  {
    // Minimum age of Coresidents
    return $this->coresidentsmin = DB::table('coresidents')
                  ->whereIn('resident_nation',$this->roms)
                  ->min('resident_age');
  }

  public function countCoresidentSpouseMin()
  {
    // Minimum age of Coresident Spouses
    return $this->coresidentspousemin = DB::table('coresident_spouses')
                  ->whereIn('spouse_nation',$this->roms)
                  ->min('spouse_age');
  }

  public function countCoresidentChildrenMin()
  {
    // Minimum age of Coresident children
    return $this->coresidentchildrenmin = DB::table('coresident_children')
                ->whereIn('child_nation',$this->roms)
                ->min('child_age');
  }
  // oldest
  public function countHouseholdsMax()
  {
    // Maximum age of Households
    return $this->householdsmax = DB::table('households')
                  ->whereIn('households.nationality',$this->roms)
                  ->max('age');
  }

  public function countWivesMax()
  {
    // Maximum age of wives
    return $this->wivesmax = DB::table('wives')
                    ->whereIn('wife_nation',$this->roms)
                    ->max('wife_age');
  }

  public function countChildrenMax()
  {
    // Maximum age of children
    return $this->childrenmax = DB::table('households')
                  ->join('children','households.id','=','children.household_id')
                    ->whereIn('households.nationality',$this->roms)
                    ->max('children.child_age');
  }

  public function countCoresidentsMax()
  {
    // Maximum age of Coresidents
    return $this->coresidentsmax = DB::table('coresidents')
                  ->whereIn('resident_nation',$this->roms)
                  ->max('resident_age');
  }

  public function countCoresidentSpouseMax()
  {
    // Maximum age of Coresident Spouses
    return $this->coresidentspousemax = DB::table('coresident_spouses')
                  ->whereIn('spouse_nation',$this->roms)
                  ->max('spouse_age');
  }

  public function countCoresidentChildrenMax()
  {
    // Maximum age of Coresident children
    return $this->coresidentchildrenmax = DB::table('coresident_children')
                ->whereIn('child_nation',$this->roms)
                ->max('child_age');

  }
}
 ?>
