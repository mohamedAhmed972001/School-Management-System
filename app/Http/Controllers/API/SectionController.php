<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Traits\ModelHandler;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionRequest;
use Symfony\Component\HttpFoundation\Response;

class SectionController extends Controller
{
    use ModelHandler;

    public function __construct()
    {
        // تعيين الموديل الخاص بـ Section
        $this->setModel(new Section());
    }

    // @desc    Get all sections
    // @route   GET /api/v1/sections
    // @access  Public
    public function getSections(Request $request)
    {
        return $this->getAll($request);
    }

    // @desc    Get specific section by id
    // @route   GET /api/v1/sections/{id}
    // @access  Public
    public function getSection($id)
    {
        return $this->getOne($id);
    }

    // @desc    Create a section
    // @route   POST  /api/v1/sections
    // @access  Private/Admin-Manager
    public function createSection(StoreSectionRequest $request)
    {
        $existingClassroom = $this->model::whereJsonContains('name->en', $request->Name['en'])
            ->orWhereJsonContains('name->ar', $request->Name['ar'])
            ->exists();

        if ($existingClassroom) {
            return response()->json([
                'message' => 'Classroom name already exists in one of the languages.',
            ], 400);
        }

        $translatableColumns = ['Name'];
        $validatedData = $request->validated();
        $section=$this->createOne($validatedData,$translatableColumns);
        $section->teachers()->attach($request->teacher_id);
        return $section;
    }

    // @desc    Update specific section
    // @route   PUT /api/v1/sections/{id}
    // @access  Private/Admin-Manager
    public function updateSection(StoreSectionRequest $request, $id)
    {
        $existingClassroom = $this->model::whereJsonContains('name->en', $request->Name['en'])
            ->orWhereJsonContains('name->ar', $request->Name['ar'])
            ->exists();

        if ($existingClassroom) {
            return response()->json([
                'message' => 'Classroom name already exists in one of the languages.',
            ], 400);
        }
        $translatableColumns = ['Name'];
        // update pivot tABLE

        $validatedData = $request->validated();
        $section=$this->updateOne($validatedData, $translatableColumns, $id);
        if (isset($request->teacher_id)) {
            $section->teachers()->sync($request->teacher_id);
        } else {
            $section->teachers()->sync(array());
        }
        return $section;
    }

    // @desc    Delete specific section
    // @route   DELETE /api/v1/sections/{id}
    // @access  Private/Admin
    public function deleteSection($id)
    {
        return $this->deleteOne($id);
    }

    // @desc    Get the grade for a specific section
    // @route   GET /api/v1/sections/{sectionId}/grade
    // @access  Public
    public function getGradeBySection($sectionId)
    {
        return $this->getParentRecordByChild('grade', $sectionId);
    }

    // @desc    Get the classroom for a specific section
    // @route   GET /api/v1/sections/{sectionId}/classroom
    // @access  Public
    public function getClassroomBySection($sectionId)
    {
        return $this->getParentRecordByChild('classroom', $sectionId);
    }

    /**
     * @desc    Get teachers by section ID.
     * @route   GET /api/v1/sections/{sectionId}/teachers
     * @access  Public
     */
    public function getTeachersBySection($sectionId)
    {
        try {
            $section = Section::findOrFail($sectionId);

            $teachers = $section->teachers;

            return response()->json(['teachers' => $teachers]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // @desc    Get all students for a specific section
    // @route   GET /api/v1/sections/{sectionId}/students
    // @access  Public
    public function getStudentsBySection($sectionId)
    {
        return $this->getRelatedRecordsByParent('students', $sectionId);
    }

}
