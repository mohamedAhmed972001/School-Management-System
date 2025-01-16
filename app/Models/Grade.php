<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasTranslations;
    protected $fillable = [
        'Name'
    ];
    public $translatable = ['Name'];

    protected $table = 'Grades';
    public $timestamps = true;

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'Grade_id');
    }
    public function sections()
    {
        return $this->hasMany(Section::class, 'Grade_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'Grade_id');
    }

}
