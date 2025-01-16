<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Traits\ModelHandler;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeacherRequest;

class TeacherController extends Controller
{
    use ModelHandler;

    public function __construct()
    {
        // تعيين الموديل الخاص بـ Teacher
        $this->setModel(new Teacher());
    }

    // @desc    Get all teachers
    // @route   GET /api/v1/teachers
    // @access  Public
    public function getTeachers(Request $request)
    {
        return $this->getAll($request);
    }

    // @desc    Get specific teacher by id
    // @route   GET /api/v1/teachers/{id}
    // @access  Public
    public function getTeacher($id)
    {
        return $this->getOne($id);
    }

    // @desc    Create a new teacher
    // @route   POST /api/v1/teachers
    // @access  Private/Admin
    public function createTeacher(StoreTeacherRequest $request)
    {
        $translatableColumns = ['Name']; // العمود المترجم
        $validatedData = $request->validated();
        return $this->createOne($validatedData, $translatableColumns);
    }

    // @desc    Update specific teacher
    // @route   PUT /api/v1/teachers/{id}
    // @access  Private/Admin
    public function updateTeacher(StoreTeacherRequest $request, $id)
    {
        $translatableColumns = ['Name']; // العمود المترجم
        $validatedData = $request->validated();
        return $this->updateOne($validatedData, $translatableColumns, $id);
    }

    // @desc    Delete specific teacher
    // @route   DELETE /api/v1/teachers/{id}
    // @access  Private/Admin
    public function deleteTeacher($id)
    {
        return $this->deleteOne($id);
    }

    // @desc    Get the teacher's specialization for a specific teacher
    // @route   GET /api/v1/teachers/{teacherId}/specialization
    // @access  Public
    public function getTeacherSpecialization($teacherId)
    {
        return $this->getParentRecordByChild('specialization', $teacherId);
    }

    // @desc    Get the teacher's gender for a specific teacher
    // @route   GET /api/v1/teachers/{teacherId}/gender
    // @access  Public
    public function getTeacherGender($teacherId)
    {
        return $this->getParentRecordByChild('gender', $teacherId);
    }

    /**
     * @desc    Get sections by teacher ID.
     * @route   GET /api/v1/teachers/{teacherId}/sections
     * @access  Public
     */
    public function getSectionsByTeacher($teacherId)
    {
        try {
            $teacher = Teacher::findOrFail($teacherId);
            $sections = $teacher->sections;

            return response()->json(['sections' => $sections]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * @desc    Add an image for a Teacher
     * @route   POST /api/v1/teachers/{teacherId}/add_image
     * @access  Private/Admin
     */

    public function AddImage( Request $request,$id)
    {
        return $this->addImagetomodel($request,$id);

    }

    /**
     * @desc    Update an image for a Teacher
     * @route   PUT /api/v1/teachers/{teacherId}/update_image
     * @access  Private/Admin
     */

    public function UpdateImage( Request $request,$id)
    {
        return $this->updateImageInModel($request,$id);

    }

    /**
     * @desc    Delete an image for a Teacher
     * @route   DELETE /api/v1/teachers/{teacherId}/delete_image
     * @access  Private/Admin
     */
    public function DeleteImage( $id)
    {
        return $this->deleteImageFromModel( $id);
    }

    /**
     * @desc    Retrieve all images for a specific Teacher
     * @route   GET /api/v1/teachers/{teacherId}/images
     * @access  Private/Admin
     */
    public function showImages($id)
    {
        return $this->getImagesForModel($id);
    }

    /**
     * @desc    Download a specific image for a Teacher
     * @route   GET /api/v1/teachers/{teacherId}/images/{imageId}/download
     * @access  Private/Admin
     */
    public function downloadImage($studentId, $imageId)
    {
        return $this->downloadImageForModel($studentId, $imageId);
    }


}
