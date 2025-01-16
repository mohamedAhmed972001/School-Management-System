<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasTranslations;
    use HasTranslations;
    protected $table = 'Sections';
    protected $fillable = [
        'Name',
        'Status',
        'Grade_id',
        'Classroom_id'
    ];
    public $timestamps = true;
    public array $translatable = ['Name'];
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'Section_id');
    }


}
