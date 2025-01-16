<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Traits\ModelHandler;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClassroomRequest;
use Symfony\Component\HttpFoundation\Response;

class ClassroomController extends Controller
{
    use ModelHandler;

    public function __construct()
    {
        // تعيين الموديل الخاص بـ Classroom
        $this->setModel(new Classroom());
    }

    // @desc    Get all classrooms
    // @route   GET /api/v1/classrooms
    // @access  Public
    public function getClassrooms(Request $request)
    {
        return $this->getAll($request);
    }

    // @desc    Get specific classroom by id
    // @route   GET /api/v1/classrooms/{id}
    // @access  Public
    public function getClassroom($id)
    {
        return $this->getOne($id);
    }

    // @desc    Create a classroom
    // @route   POST  /api/v1/classrooms
    // @access  Private/Admin-Manager
    public function createClassroom(StoreClassroomRequest $request)
    {

        $existingClassroom = $this->model::whereJsonContains('name->en', $request->Name['en'])
            ->orWhereJsonContains('name->ar', $request->Name['ar'])
            ->exists();

        if ($existingClassroom) {
            return response()->json([
                'message' => 'Classroom name already exists in one of the languages.',
            ], 400);
        }

        $validatedData = $request->validated();
        $translatableColumns = ['Name'];

        return $this->createOne($validatedData, $translatableColumns);
    }

    // @desc    Update specific classroom
    // @route   PUT /api/v1/classrooms/{id}
    // @access  Private/Admin-Manager
    public function updateClassroom(StoreClassroomRequest $request, $id)
    {

        $existingClassroom = $this->model::whereJsonContains('name->en', $request->Name['en'])
            ->orWhereJsonContains('name->ar', $request->Name['ar'])
            ->exists();

        if ($existingClassroom) {
            return response()->json([
                'message' => 'Classroom name already exists in one of the languages.',
            ], 400);
        }

        $validatedData = $request->validated();
        $translatableColumns = ['Name'];

        return $this->updateOne($validatedData, $translatableColumns, $id);
    }

    // @desc    Delete specific classroom
    // @route   DELETE /api/v1/classrooms/{id}
    // @access  Private/Admin
    public function deleteClassroom($id)
    {
        return $this->deleteOne($id);
    }



    // @desc    Get the grade for a specific classroom
    // @route   GET /api/v1/classrooms/{classroomId}/grade
    // @access  Public
    public function getGradeByClassroom($classroomId)
    {
        return $this->getParentRecordByChild('grade',$classroomId);
    }
    // @desc    Get all sections for a specific classroom
    // @route   GET /api/v1/classrooms/{classroomId}/sections
    // @access  Public
    public function getSectionsByClassroom($classroomId)
    {
        return $this->getRelatedRecordsByParent('sections',$classroomId);
    }

    // @desc    Get all students for a specific classroom
    // @route   GET /api/v1/classrooms/{classroomId}/students
    // @access  Public
    public function getStudentsByClassroom($classroomId)
    {
        return $this->getRelatedRecordsByParent('students', $classroomId);
    }





}
