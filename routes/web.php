<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Authenticated routesgroup -->
Route::middleware('auth')->group(function() {
    //Routes for starting page datatables Households
    Route::get('/', 'ContentsController@list')->name('list');
    Route::get('/household_search', 'ContentsController@search')->name('search');
    //Routes for starting page datatables Villages
    Route::get('/village_listing', 'VillageController@index')->name('village_list');
    Route::get('/village_search', 'VillageController@search')->name('village_search');


  Route::get('/start', 'ContentsController@load')->name('home');
  Route::get('/load', 'ContentsController@home')->name('load');
  //Admin

  Route::get('/households', 'HouseholdController@index')->name('households');
  Route::get('/country', 'CountryController@index')->name('country');
  Route::get('/skill', 'SkillController@index')->name('skill');
  Route::get('/social', 'SocialController@index')->name('social');
  Route::get('/source', 'SourceController@index')->name('source');
  Route::get('/county', 'CountyController@index')->name('county');
  Route::get('/district', 'DistrictController@index')->name('district');
  Route::get('/village', 'VillageController@index')->name('village');
  Route::get('/extended', 'ExtendedController@index')->name('extended');
  Route::get('/link', 'LinkController@index')->name('link');
  //Child
    Route::get('/child/{residentchild_id}', 'ChildController@delResidentChild')->name('del_resident_child');
    Route::get('/ch/{child_id}', 'ChildController@delChild')->name('del_child');
    //CoResidents
    Route::get('/coresident/{resident_id}', 'CoResidentController@delResident')->name('del_resident');
    Route::get('/coresident_spouse/{spouse_id}', 'WifeController@delResidentSpouse')->name('del_resident_spouse');
  //Tools for admin
  Route::get('/tools', 'ContentsController@index')->name('tools');
  Route::post('/tools', 'ContentsController@postAdminAssignRoles')->name('tools_assign');
  //District
  Route::get('/district/del{district_id}', 'DistrictController@delDistrict')->name('del_district');
  Route::get('/district/new', 'DistrictController@newDistrict')->name('new_district');
  Route::post('/district/new', 'DistrictController@newDistrict')->name('create_district');
  Route::get('/district/{district_id}', 'DistrictController@show')->name('show_district');
  Route::post('/district/{district_id}', 'DistrictController@modify')->name('update_district');
  Route::get('/init_stats', 'Statistics\ChartsController@init_district_stats');
  //Country
  Route::get('/country/del{country_id}', 'CountryController@delCountry')->name('del_country');
  Route::get('/country/new', 'CountryController@newCountry')->name('new_country');
  Route::post('/country/new', 'CountryController@newCountry')->name('create_country');
  Route::get('/country/{country_id}', 'CountryController@show')->name('show_country');
  Route::post('/country/{country_id}', 'CountryController@modify')->name('update_country');
  //County
  Route::get('/county/del{county_id}', 'CountyController@delCounty')->name('del_county');
  Route::get('/county/new', 'CountyController@newCounty')->name('new_county');
  Route::post('/county/new', 'CountyController@newCounty')->name('create_county');
  Route::get('/county/{county_id}', 'CountyController@show')->name('show_county');
  Route::post('/county/{county_id}', 'CountyController@modify')->name('update_county');
  //Households
  Route::get('/households/new', 'HouseholdController@newHousehold')->name('new_household');
  Route::post('/households/new', 'HouseholdController@newHousehold')->name('create_household');
  Route::get('/households/{household_id}', 'HouseholdController@show')->name('show_household');
  Route::get('/household_detail/{household_id}', 'HouseholdController@detail')->name('household_detail');
  Route::post('/households/{household_id}', 'HouseholdController@modify')->name('update_household');
    Route::get('/del/{household_id}', 'HouseholdController@delHousehold')->name('del_household');

  //Social
  Route::get('/social/del{social_id}', 'SocialController@delSocial')->name('del_social');
  Route::get('/social/new', 'SocialController@newSocial')->name('new_social');
  Route::post('/social/new', 'SocialController@newSocial')->name('create_social');
  Route::get('/social/{social_id}', 'SocialController@show')->name('show_social');
  Route::post('/social/{social_id}', 'SocialController@modify')->name('update_social');
  //Skill
  Route::get('/skill/del{skill_id}', 'SkillController@delSkill')->name('del_skill');
  Route::get('/skill/new', 'SkillController@newSkill')->name('new_skill');
  Route::post('/skill/new', 'SkillController@newSkill')->name('create_skill');
  Route::get('/skill/{skill_id}', 'SkillController@show')->name('show_skill');
  Route::post('/skill/{skill_id}', 'SkillController@modify')->name('update_skill');
  //Source
  Route::get('/source/del{source_id}', 'SourceController@delSource')->name('del_source');
  Route::get('/source/new', 'SourceController@newSource')->name('new_source');
  Route::post('/source/new', 'SourceController@newSource')->name('create_source');
  Route::get('/source/{source_id}', 'SourceController@show')->name('show_source');
  Route::post('/source/{source_id}', 'SourceController@modify')->name('update_source');
  //Village
  Route::get('/village/del{village_id}', 'VillageController@delVillage')->name('del_village');
  Route::get('/village/new', 'VillageController@newVillage')->name('new_village');
  Route::post('/village/new', 'VillageController@newVillage')->name('create_village');
  Route::get('/village/{village_id}', 'VillageController@show')->name('show_village');
  Route::post('/village/{village_id}', 'VillageController@modify')->name('update_village');
  Route::get('/stats_update', 'StatController@village_stats_update')->name('update_village_stats');
  Route::get('/list/{village_id}', 'ListController@list')->name('list_village');
  //Village test
  Route::get('/village/x/t', 'VillageController@testVillage')->name('newtest_village');
  Route::post('/village/x/t', 'VillageController@testVillage')->name('createtest_village');
  Route::post('/village/x/t', 'VillageController@testVillage')->name('updatetest_village');
  //Wife
    Route::get('/wife/{wife_id}', 'WifeController@delWife')->name('del_wife');
  //Extended
  Route::get('/extended/del{extended_id}', 'ExtendedController@delExtended')->name('del_extended');
  Route::get('/extended/new', 'ExtendedController@newExtended')->name('new_extended');
  Route::post('/extended/new', 'ExtendedController@newExtended')->name('create_extended');
  Route::get('/extended/{extended_id}', 'ExtendedController@show')->name('show_extended');
  Route::post('/extended/{extended_id}', 'ExtendedController@modify')->name('update_extended');
  //Link
  Route::get('/relate/{household_id}', 'LinkController@show')->name('relate');
  Route::post('/relate/{household_id}', 'LinkController@link')->name('link');
  //Table
  Route::get('/table', 'HouseholdController@tableindex')->name('households_table');
  Route::get('export', 'ClientController@export')->name('export');
});
/* Statiscal data Route

*/
//Routes not authenticated
Route::get('/report', 'ReportController@report')->name('report');
Route::get('/statistics', 'ReportController@index')->name('statistics');
Route::get('/update_statistics', 'ReportController@home')->name('update_statistics');

Route::get('/stats_village', 'Statistics\ChartsController@stats')->name('stats');

Route::get('/Ilfov', 'Statistics\RomsperVillageController@index')->name('ilfov');
Route::get('/ilfov_data_rom', 'Statistics\RomsperVillageController@response_rom')->name('ilfov_data_rom');
Route::get('/dambovita', 'Statistics\RomsperVillageController@indexDambovita')->name('dambovita');
Route::get('/dambovita_data_rom', 'Statistics\RomsperVillageController@response_dambovita')->name('dambovita_data_rom');
Route::get('/t', 'Statistics\RomsperVillageController@avgUpdate')->name('avgUpdate');

Route::get('/stats_data', 'Statistics\ChartsController@response')->name('stats_data');
Route::get('/stats_village_land', 'Statistics\ChartsController@stats_land')->name('statsland');
Route::get('/stats_land', 'Statistics\ChartsController@response_land')->name('stats_data_land');

Route::get('/stats_village_rom', 'StatsRomVillage@roms_village')->name('statsrom');
Route::get('/stats_data_rom', 'StatsRomVillage@response_rom')->name('stats_data_rom');

//Route::get('/stats_village_roms', 'ChartsController@stats_roms')->name('statsromsize');
//Route::get('/stats_data_roms', 'ChartsController@response_roms')->name('stats_data_roms');
//tables
Route::get('/open_table_rom', 'Statistics\ChartsController@open_table_rom')->name('open_table_rom');
Route::get('/export_rom', 'Statistics\ChartsController@export_table_rom')->name('export_table_rom');
//Rom size/averagesize
//Route::get('/open_table_roms', 'ChartsController@open_table_roms')->name('open_table_roms');
Route::get('/open_table_roms', 'StatsRomsizeController@open_table_roms')->name('open_table_roms');
Route::get('/stats_data_roms', 'StatsRomsizeController@response_roms')->name('stats_data_roms');
Route::get('/export_roms', 'Statistics\ChartsController@export_table_roms')->name('export_table_roms');
//Fiscal stats
Route::get('/open_table_fiscal', 'StatsFiscalController@open_fiscal_stats')->name('open_fiscal');
Route::get('/fiscal_data_rom', 'StatsFiscalController@response_fiscal')->name('fiscal_data_rom');
//Route::get('/export_table_fiscal', 'ChartsController@export_table_district')->name('export_table_district');
//Social stats
Route::get('/open_table_social', 'StatsSocialController@open_social_stats')->name('open_social');
Route::get('/social_data_rom', 'StatsSocialController@response_social')->name('social_data_rom');
//Distric stats
Route::get('/open_table_district', 'Statistics\ChartsController@open_table_district')->name('open_table_district');
Route::get('/export_table_district', 'Statistics\ChartsController@export_table_district')->name('export_table_district');
//Route::get('/open_table_skill', 'ChartsController@open_table_skill')->name('open_table_skill');
//Route::get('/export_table_skill', 'ChartsController@export_table_skill')->name('export_table_skill');

//StatSkillController
Route::get('/open_table_skill', 'StatSkillController@open_table_skill')->name('open_table_skill');
Route::get('/skill_data_rom', 'StatSkillController@response_skill')->name('skill_data_rom');
Route::get('/export_table_skill', 'StatSkillController@export_table_skill')->name('export_table_skill');

Route::get('/open_cat_table_skill', 'Statistics\StatSkillcatController@open_table_skill')->name('open_cat_table_skill');
Route::get('/skill_cat_data_rom', 'Statistics\StatSkillcatController@response_skill')->name('skill_cat_data_rom');
Route::get('/export_table_skill_cat', 'Statistics\StatSkillcatController@export_table_skill')->name('export_table_skill_cat');

Route::get('/ilfov/open_cat_table_skill', 'Statistics\StatSkillcatIlfovController@open_table_skill')->name('ilfov_cat_table_skill');
Route::get('/ilfov/skill_cat_data_rom', 'Statistics\StatSkillcatIlfovController@response_skill')->name('ilfov_cat_data_rom');
Route::get('/dambovita/open_cat_table_skill', 'Statistics\StatSkillcatDambovitaController@open_table_skill')->name('dambovita_cat_table_skill');
Route::get('/dambovita/skill_cat_data_rom', 'Statistics\StatSkillcatDambovitaController@response_skill')->name('dambovita_cat_data_rom');

//
//StatsPlaiController
Route::get('/plai', 'StatsPlaiController@plai')->name('plai');
Route::get('/plai_data', 'StatsPlaiController@response')->name('plai_data');
Route::get('/plasa', 'StatsPlaiController@plasa')->name('plasa');
Route::get('/plasa_data', 'StatsPlaiController@response_plasa')->name('plasa_data');
Route::get('/plaitest', 'StatsPlaiController@test')->name('plaitest');

//
Route::get('/open_table_nation', 'Statistics\ChartsController@open_table_nation')->name('open_table_nation');
Route::get('/export_table_nation', 'Statistics\ChartsController@export_table_nation')->name('export_table_nation');
//Standard Pyramid entire db
Route::get('/standard_table', 'Statistics\StandardPyramidController@standard')->name('standard');
Route::get('/standard_data', 'Statistics\StandardPyramidController@standard_response')->name('standard_data');
//Standard Pyramid entire Ilfov
Route::get('/standard_table_ilfov', 'Statistics\StandardPyramidIlfovController@standard')->name('standard_ilfov');
Route::get('/ilfov_standard_data', 'Statistics\StandardPyramidIlfovController@standard_response')->name('ilfov_standard_data');
//Standard Pyramid entire Dambovita
Route::get('/standard_table_dambovita', 'Statistics\StandardPyramidDambovitaController@standard')->name('standard_dambovita');
Route::get('/dambovita_standard_data', 'Statistics\StandardPyramidDambovitaController@standard_response')->name('dambovita_standard_data');

Route::get('/agepyramid', 'Statistics\AgePyramidController@index')->name('agepyramid');
Route::get('/agepyramid_data', 'Statistics\AgePyramidController@age_response')->name('agepyramid_data');
Route::get('/ilfov_agepyramid', 'Statistics\AgePyramidIlfovController@index')->name('agepyramid_ilfov');
Route::get('/ilfov_agepyramid_data', 'Statistics\AgePyramidIlfovController@age_response')->name('ilfov_agepyramid_data');
Route::get('/dambovita_agepyramid', 'Statistics\AgePyramidDambovitaController@index')->name('agepyramid_dambovita');
Route::get('/dambovita_agepyramid_data', 'Statistics\AgePyramidDambovitaController@age_response')->name('dambovita_agepyramid_data');

Route::get('/table_age', 'Statistics\ChartsController@table_age')->name('table_age');
Route::get('/export_table_age', 'Statistics\ChartsController@export_age')->name('export_age');
Route::get('/table_standard', 'Statistics\ChartsController@table_standard')->name('table_standard');
Route::get('/export_table_standard', 'Statistics\ChartsController@export_standard')->name('export_standard');

//Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    //'reset' => false, // Password Reset Routes...
    //'verify' => false, // Email Verification Routes...
]);
