<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentAttachment extends Model
{
    protected $fillable=['File_name','Parent_id'];
    public function parent()
    {
        return $this->belongsTo(MyParent::class, 'Parent_id');
    }

}
