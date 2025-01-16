<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class MyParent extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['Name_Father', 'Job_Father', 'Name_Mother', 'Job_Mother'];

    protected $table = 'MyParents';

    public function nationalityFather()
    {
        return $this->belongsTo(Nationality::class, 'Nationality_Father_id');
    }

    public function religionFather()
    {
        return $this->belongsTo(Religion::class, 'Religion_Father_id');
    }

    public function nationalityMother()
    {
        return $this->belongsTo(Nationality::class, 'Nationality_Mother_id');
    }

    public function religionMother()
    {
        return $this->belongsTo(Religion::class, 'Religion_Mother_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'Parent_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
