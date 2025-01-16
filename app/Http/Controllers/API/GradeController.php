<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Traits\ModelHandler;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGradeRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class GradeController extends Controller
{
    use ModelHandler;

    public function __construct()
    {
        $this->setModel(new Grade());
    }

    // @desc    Get all grades
    // @route   GET /api/v1/grades
    // @access  Public
    public function getGrades(Request $request)
    {
        return $this->getAll($request);
    }

    // @desc    Get specific grade by id
    // @route   GET /api/v1/grades/{id}
    // @access  Public
    public function getGrade($id)
    {
        return $this->getOne($id);
    }

    // @desc    Create a grade
    // @route   POST  /api/v1/grades
    // @access  Private/Admin-Manager
    public function createGrade(StoreGradeRequest $request)
    {
        $existingGrade = $this->model::whereJsonContains('name->en', $request->Name['en'])
            ->orWhereJsonContains('name->ar', $request->Name['ar'])
            ->exists();

        if ($existingGrade) {
            return response()->json([
                'message' => 'Grade name already exists in one of the languages.',
            ], 400);
        }
        $validatedData = $request->validated();
        $translatableColumns = ['Name'];

        return $this->createOne($validatedData, $translatableColumns);
    }


    // @desc    Update specific grade
    // @route   PUT /api/v1/grades/{id}
    // @access  Private/Admin-Manager
    public function updateGrade(StoreGradeRequest $request, $id)
    {
        $existingGrade = $this->model::whereJsonContains('name->en', $request->Name['en'])
            ->orWhereJsonContains('name->ar', $request->Name['ar'])
            ->exists();

        if ($existingGrade) {
            return response()->json([
                'message' => 'Grade name already exists in one of the languages.',
            ], 400);
        }
        $validatedData = $request->validated();
        $translatableColumns = ['Name'];

        return $this->updateOne($validatedData, $translatableColumns,$id);
    }


    // @desc    Delete specific grade
// @route   DELETE /api/v1/grades/{id}
// @access  Private/Admin
    public function deleteGrade($id)
    {
        // Check if there are classrooms associated with the grade
        $hasClassrooms = Classroom::where('Grade_id', $id)->exists();

        if ($hasClassrooms) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete the grade because it has associated classrooms.'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Proceed to delete the grade if no classrooms are linked
        $this->deleteOne($id);

        return response()->json([
            'status' => true,
            'message' => 'Grade deleted successfully.'
        ], Response::HTTP_OK);
    }


    // @desc    Get all classrooms for a specific grade
    // @route   GET /api/v1/grades/{gradeId}/classrooms
    // @access  Public
    public function getClassroomsByGrade($gradeId)
    {
        return $this->getRelatedRecordsByParent('classrooms',$gradeId);
    }

    // @desc    Get all sections for a specific grade
    // @route   GET /api/v1/grades/{gradeId}/sections
    // @access  Public
    public function getSectionsByGrade($gradeId)
    {
        return $this->getRelatedRecordsByParent('sections',$gradeId);
    }

    // @desc    Get all students for a specific grade
    // @route   GET /api/v1/grades/{gradeId}/students
    // @access  Public
    public function getStudentsByGrade($gradeId)
    {
        return $this->getRelatedRecordsByParent('students', $gradeId);
    }

}
