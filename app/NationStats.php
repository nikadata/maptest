<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NationStats extends Model
{
    //
    public function update_nation_stats()
    {
      $nations = NationStats::all();
      $data['id'] = 1;
      $this->insert($data);
      $data['id'] = 2;
      $this->insert($data);
      $data['id'] = 3;
      $this->insert($data);
      $data['id'] = 4;
      $this->insert($data);
    }
}
