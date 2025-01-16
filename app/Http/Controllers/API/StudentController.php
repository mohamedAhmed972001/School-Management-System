<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Student;
use App\Traits\ModelHandler;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    use ModelHandler;

    public function __construct()
    {
        // تعيين الموديل الخاص بـ Student
        $this->setModel(new Student());
    }

    // @desc    Get all students
    // @route   GET /api/v1/students
    // @access  Public
    public function getStudents(Request $request)
    {
        return $this->getAll($request);
    }

    // @desc    Get specific student by id
    // @route   GET /api/v1/students/{id}
    // @access  Public
    public function getStudent($id)
    {
        return $this->getOne($id);
    }

// @desc    Create a new student
// @route   POST /api/v1/students
// @access  Private/Admin-Manager
    public function createStudent(StoreStudentRequest $request)
    {
        // التحقق من صحة البيانات المرسلة
        $validatedData = $request->validated();

        // تعيين الأعمدة التي تدعم الترجمة
        $translatableColumns = ['Name'];

        // إنشاء الطالب
        $student = $this->createOne($validatedData, $translatableColumns);


        // إرجاع الاستجابة مع الطالب والصورة (إذا كانت موجودة)
       return $student;
    }

    // @desc    Update specific student
    // @route   PUT /api/v1/students/{id}
    // @access  Private/Admin-Manager
    public function updateStudent(StoreStudentRequest $request, $id)
    {
        $validatedData = $request->validated();
        $translatableColumns = ['name']; // مثال على الأعمدة القابلة للترجمة إذا كان هناك حاجة لها
        return $this->updateOne($validatedData, $translatableColumns, $id);
    }

    // @desc    Delete specific student
    // @route   DELETE /api/v1/students/{id}
    // @access  Private/Admin
    public function deleteStudent($id)
    {
        return $this->deleteOne($id);
    }

    // @desc    Get the gender associated with a specific student
    // @route   GET /api/v1/students/{studentId}/gender
    // @access  Public
    public function getGenderByStudent($studentId)
    {
        return $this->getParentRecordByChild('gender', $studentId);
    }

    // @desc    Get the nationality associated with a specific student
    // @route   GET /api/v1/students/{studentId}/nationality
    // @access  Public
    public function getNationalityByStudent($studentId)
    {
        return $this->getParentRecordByChild('nationality', $studentId);
    }

    // @desc    Get the grade associated with a specific student
    // @route   GET /api/v1/students/{studentId}/grade
    // @access  Public
    public function getGradeByStudent($studentId)
    {
        return $this->getParentRecordByChild('grade', $studentId);
    }

    // @desc    Get the classroom associated with a specific student
    // @route   GET /api/v1/students/{studentId}/classroom
    // @access  Public
    public function getClassroomByStudent($studentId)
    {
        return $this->getParentRecordByChild('classroom', $studentId);
    }

    // @desc    Get the section associated with a specific student
    // @route   GET /api/v1/students/{studentId}/section
    // @access  Public
    public function getSectionByStudent($studentId)
    {
        return $this->getParentRecordByChild('section', $studentId);
    }

    // @desc    Get all images for a specific student
    // @route   GET /api/v1/students/{studentId}/images
    // @access  Public
    public function getImages($studentId)
    {
        return $this->getRelatedRecordsByParent('images', $studentId);
    }

    // @desc    Get the parent associated with a specific student
    // @route   GET /api/v1/students/{studentId}/parent
    // @access  Public
    public function getParentByStudent($studentId)
    {
        return $this->getParentRecordByChild('myparent', $studentId);
    }

    // @desc    Get all students for a specific nationality
    // @route   GET /api/v1/nationalities/{nationalityId}/students
    // @access  Public
    public function getStudentsByNationality($nationalityId)
    {
        return $this->getRelatedRecordsByParent('students', $nationalityId);
    }

    // @desc    Get all students for a specific gender
    // @route   GET /api/v1/genders/{genderId}/students
    // @access  Public
    public function getStudentsByGender($genderId)
    {
        return $this->getRelatedRecordsByParent('students', $genderId);
    }

    /**
     * @desc    Add an image for a student
     * @route   POST /api/v1/students/{studentId}/add_image
     * @access  Private/Admin
     */

    public function AddImage( Request $request,$id)
    {
        return $this->addImagetomodel($request,$id);

    }

    /**
     * @desc    Update an image for a student
     * @route   POST /api/v1/students/{studentId}/update_image
     * @access  Private/Admin
     */

    public function UpdateImage( Request $request,$id)
    {
        return $this->updateImageInModel($request,$id);

    }

    /**
     * @desc    Delete an image for a student
     * @route   DELETE /api/v1/students/{studentId}/delete_image
     * @access  Private/Admin
     */
    public function DeleteImage($id)
    {
        return $this->deleteImageFromModel( $id);
    }

    /**
     * @desc    Retrieve all images for a specific student
     * @route   GET /api/v1/students/{studentId}/images
     * @access  Private/Admin
     */
    public function showImages($id)
    {
        return $this->getImagesForModel($id);
    }

    /**
     * @desc    Download a specific image for a student
     * @route   GET /api/v1/students/{studentId}/images/{imageId}/download
     * @access  Private/Admin
     */
    public function downloadImage($studentId, $imageId)
    {
        return $this->downloadImageForModel($studentId, $imageId);
    }



    // @desc    Get all students with soft deletes (including deleted students)
    // @route   GET /api/v1/students/soft_deleted
    // @access  Private/Admin
    public function getSoftDeletedStudents(Request $request)
    {
        return $this->getAll($request, true);
    }




}
