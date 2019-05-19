<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];
    public $timestamps = true;
    public function articles() {
        return $this->belongsToMany('App\Article', 'article_tag', 'article_id', 'tag_id');
      }
}
