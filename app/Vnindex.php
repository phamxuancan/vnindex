<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vnindex extends Model
{
    protected $table = 'vnindexs';
    protected $fillable = [
        'code', 'thamchieu', 'khoiluong','nnmua','nnban','ngaythang','created_at','updated_at'
    ];
    public function stock()
    {
        return $this->hasOne('App\Stock','symbol','code');
    }
}   
