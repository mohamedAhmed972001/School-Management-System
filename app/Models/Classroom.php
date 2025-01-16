<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasTranslations;
    protected $table = 'Classrooms';
    protected $fillable = [
        'Name',
        'Notes',
        'Grade_id'
    ];
    public $timestamps = true;
    public array $translatable = ['Name'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }
    public function sections()
    {
        return $this->hasMany(Section::class, 'Classroom_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'Classroom_id');
    }

}
