<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ["section_name","discrption","creat_by"];

    public function product()
    {
        return $this->hasMany("App\Product","section_id","id");
    }

    public function invoice()
    {
        return $this->hasMany("App\Invoice","section_id","id");
    }
}
