<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use SoftDeletes;

    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable = [
        'Name',
        'email',
        'password',
        'Gender_id',
        'Nationality_id',
        'Date_Birth',
        'Grade_id',
        'Classroom_id',
        'Section_id',
        'Parent_id',
        'Religion_id',
        'Academic_Year',
    ];
    protected $guarded =[];

    // علاقة بين الطلاب والانواع لجلب اسم النوع في جدول الطلاب

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    // علاقة بين الطلاب والمراحل الدراسية لجلب اسم المرحلة في جدول الطلاب

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }


    // علاقة بين الطلاب الصفوف الدراسية لجلب اسم الصف في جدول الطلاب

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo(Section::class, 'Section_id');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function Nationality()
    {
        return $this->belongsTo(Nationality::class, 'Nationality_id');
    }


    public function parent()
    {
        return $this->belongsTo(MyParent::class, 'Parent_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'Religion_id');
    }



//    // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
//    public function student_account()
//    {
//        return $this->hasMany('App\Models\StudentAccount', 'student_id');
//    }

//    // علاقة بين جدول الطلاب وجدول الحضور والغياب
//    public function attendance()
//    {
//        return $this->hasMany('App\Models\Attendance', 'student_id');
//    }

}
