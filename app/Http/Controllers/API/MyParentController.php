<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MyParent;
use App\Traits\ModelHandler;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMyParentRequest;

class MyParentController extends Controller
{
    use ModelHandler;

    public function __construct()
    {
        // تعيين الموديل الخاص بـ MyParent
        $this->setModel(new MyParent());
    }

    // @desc    Get all parents
    // @route   GET /api/v1/parents
    // @access  Public
    public function getParents(Request $request)
    {
        return $this->getAll($request);
    }

    // @desc    Get specific parent by id
    // @route   GET /api/v1/parents/{id}
    // @access  Public
    public function getParent($id)
    {
        return $this->getOne($id);
    }

    // @desc    Create a new parent
    // @route   POST /api/v1/parents
    // @access  Private/Admin
    public function createParent(StoreMyParentRequest $request)
    {
        $translatableColumns = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];
        $validatedData = $request->validated();
        return $this->createOne($validatedData,$translatableColumns);
    }

    // @desc    Update specific parent
    // @route   PUT /api/v1/parents/{id}
    // @access  Private/Admin
    public function updateParent(StoreMyParentRequest $request, $id)
    {
        $translatableColumns = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];
        $validatedData = $request->validated();
        return $this->updateOne($validatedData, $translatableColumns, $id);
    }

    // @desc    Delete specific parent
    // @route   DELETE /api/v1/parents/{id}
    // @access  Private/Admin
    public function deleteParent($id)
    {
        return $this->deleteOne($id);
    }

    // @desc    Get the father's religion for a specific parent
// @route   GET /api/v1/parents/{parentId}/father/religion
// @access  Public
    public function getFatherReligion($parentId)
    {
        // استرجاع الدين للأب باستخدام العلاقة
        $parent = $this->model::findOrFail($parentId);
        return response()->json([
            'religion' => $parent->religionFather
        ]);
    }

// @desc    Get the mother's religion for a specific parent
// @route   GET /api/v1/parents/{parentId}/mother/religion
// @access  Public
    public function getMotherReligion($parentId)
    {
        // استرجاع الدين للأم باستخدام العلاقة
        $parent = $this->model::findOrFail($parentId);
        return response()->json([
            'religion' => $parent->religionMother
        ]);
    }

// @desc    Get the father's nationality for a specific parent
// @route   GET /api/v1/parents/{parentId}/father/nationality
// @access  Public
    public function getFatherNationality($parentId)
    {
        // استرجاع الجنسية للأب باستخدام العلاقة
        $parent = $this->model::findOrFail($parentId);
        return response()->json([
            'nationality' => $parent->nationalityFather
        ]);
    }

// @desc    Get the mother's nationality for a specific parent
// @route   GET /api/v1/parents/{parentId}/mother/nationality
// @access  Public
    public function getMotherNationality($parentId)
    {
        // استرجاع الجنسية للأم باستخدام العلاقة
        $parent = $this->model::findOrFail($parentId);
        return response()->json([
            'nationality' => $parent->nationalityMother
        ]);
    }

    // @desc    Get all students for a specific parent
    // @route   GET /api/v1/parents/{parentId}/students
    // @access  Public
    public function getStudentsByParent($parentId)
    {
        return $this->getRelatedRecordsByParent('students', $parentId);
    }

    /**
     * @desc    Add an image for a Parent
     * @route   POST /api/v1/parents/{parentId}/add_image
     * @access  Private/Admin
     */

    public function AddImage( Request $request,$id)
    {
        return $this->addImagetomodel($request,$id);

    }

    /**
     * @desc    Update an image for a Parent
     * @route   PUT /api/v1/parents/{ParentId}/update_image
     * @access  Private/Admin
     */

    public function UpdateImage( Request $request,$id)
    {
        return $this->updateImageInModel($request,$id);

    }
    /**
     * @desc    Delete an image for a Parent
     * @route   DELETE /api/v1/parents/{ParentId}/delete_image
     * @access  Private/Admin
     */
    public function DeleteImage($id)
    {
        return $this->deleteImageFromModel( $id);
    }

    /**
     * @desc    Retrieve all images for a specific Parent
     * @route   GET /api/v1/parents/{ParentId}/images
     * @access  Private/Admin
     */
    public function showImages($id)
    {
        return $this->getImagesForModel($id);
    }

    /**
     * @desc    Download a specific image for a Parent
     * @route   GET /api/v1/parents/{ParentId}/images/{imageId}/download
     * @access  Private/Admin
     */
    public function downloadImage($studentId, $imageId)
    {
        return $this->downloadImageForModel($studentId, $imageId);
    }


}
