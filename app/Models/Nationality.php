<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable =['Name'];
    //protected $guarded =[];
    public function students()
    {
        return $this->hasMany(Student::class, 'Nationality_id');
    }
}
