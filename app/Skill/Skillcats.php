<?php

namespace App\Skill;

use Illuminate\Database\Eloquent\Model;
use App\Skill\Skill as Skill;


class Skillcats extends Model
{

    public function updateSkillCat($cat1, $cat2, $cat3, $cat4, $cat5, $cat6, $cat7, $district=null)
    {
      //Data for table
      $x = 0;

      //Load skills model
      $skills = Skill::all();
      //Load skillcats model
      $cats = $this->all();
      //First cat loop through skills model
      foreach ($skills as $skill)
      {
        foreach ($cat1 as $cat)
        {
            if($cat == $skill->skill_name)
            {
              switch($district)
              {
                case'Ilfov':
                $x = $x + $skill->ilfov_roms_count;
                break;
                case'Dambovita':
                $x = $x + $skill->dambovita_roms_count;
                break;
                default:
                $x = $x + $skill->roms_count;
              }
            }
          }
        }
      //Save summary
      $cat_value[] = $x;
      $x = 0;
      //Second cat loop through skills model
      foreach ($skills as $skill)
      {
        foreach ($cat2 as $cat)
        {
            if ($cat == $skill->skill_name)
            {
              switch($district)
              {
                case'Ilfov':
                $x = $x + $skill->ilfov_roms_count;
                break;
                case'Dambovita':
                $x = $x + $skill->dambovita_roms_count;
                break;
                default:
                $x = $x + $skill->roms_count;
              }
            }
          }
        }
      //Save summary
      $cat_value[] = $x;
      $x = 0;
      //Third cat loop through skills model
      foreach ($skills as $skill)
      {
        foreach ($cat3 as $cat)
        {
            if ($cat == $skill->skill_name)
            {
              switch($district)
              {
                case'Ilfov':
                $x = $x + $skill->ilfov_roms_count;
                break;
                case'Dambovita':
                $x = $x + $skill->dambovita_roms_count;
                break;
                default:
                $x = $x + $skill->roms_count;
              }
            }
          }
        }
      //Save summary
      $cat_value[] = $x;
      $x = 0;
      //Fourth cat loop through skills model
      foreach ($skills as $skill)
      {
        foreach ($cat4 as $cat)
        {
            if ($cat == $skill->skill_name)
            {
              switch($district)
              {
                case'Ilfov':
                $x = $x + $skill->ilfov_roms_count;
                break;
                case'Dambovita':
                $x = $x + $skill->dambovita_roms_count;
                break;
                default:
                $x = $x + $skill->roms_count;
              }
            }
          }
        }
      //Save summary
      $cat_value[] = $x;
      $x = 0;
      //Fift cat loop through skills model
      foreach ($skills as $skill)
      {
        foreach ($cat5 as $cat)
        {
            if ($cat == $skill->skill_name)
            {
              switch($district)
              {
                case'Ilfov':
                $x = $x + $skill->ilfov_roms_count;
                break;
                case'Dambovita':
                $x = $x + $skill->dambovita_roms_count;
                break;
                default:
                $x = $x + $skill->roms_count;
              }
            }
          }
        }
      //Save summary
      $cat_value[] = $x;
      $x = 0;
      //Sixt cat loop through skills model
      foreach ($skills as $skill)
      {
        foreach ($cat6 as $cat)
        {
            if ($cat == $skill->skill_name)
            {
              switch($district)
              {
                case'Ilfov':
                $x = $x + $skill->ilfov_roms_count;
                break;
                case'Dambovita':
                $x = $x + $skill->dambovita_roms_count;
                break;
                default:
                $x = $x + $skill->roms_count;
              }
            }
          }
        }
      //Save summary
      $cat_value[] = $x;
      $x = 0;
      //Seventh cat loop through skills model
      foreach ($skills as $skill)
      {
        foreach ($cat7 as $cat)
        {
            if ($cat == $skill->skill_name)
            {
              switch($district)
              {
                case'Ilfov':
                $x = $x + $skill->ilfov_roms_count;
                break;
                case'Dambovita':
                $x = $x + $skill->dambovita_roms_count;
                break;
                default:
                $x = $x + $skill->roms_count;
              }
            }
          }
        }
      //Save summary
      $cat_value[] = $x;

      //Storing number data
      //Procentage
      $total = 0;
      for($i=0;$i<7;$i++){
        $total = $total + $cat_value[$i];
        }
      $i = 0;
      foreach ($cats as $cat)
      {
        switch($district)
        {
          case'Ilfov':
          $cat->ilfov_skillcat_number = $cat_value[$i];
          $cat->ilfov_skillcat_pr = round(($cat_value[$i] / $total) * 100,1);
          break;
          case'Dambovita':
          $cat->dambovita_skillcat_number = $cat_value[$i];
          $cat->dambovita_skillcat_pr = round(($cat_value[$i] / $total) * 100,1);
          break;
          default:
          $cat->skillcat_number = $cat_value[$i];
          $cat->skillcat_pr = round(($cat_value[$i] / $total) * 100,1);
        }
        $cat->save();
        $i++;
      }
      //End
    }
}
