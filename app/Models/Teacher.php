<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;

    // تحديد الأعمدة المترجمة
    public $translatable = ['Name'];
    protected $fillable = [
        'Name',
        'Address',
        'Joining_Date',
        'Gender_id',
        'Specialization_id',
        'password',
        'email'
    ];
    // تحديد الجدول
    protected $table = 'teachers';

    // الحقول القابلة للملء
    protected $guarded = [];

    // العلاقة مع التخصص
    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }

    // العلاقة مع الجنس
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }



}

