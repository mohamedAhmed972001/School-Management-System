<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherSection; // Import Model
use App\Models\Teacher;
use App\Models\Section;

class TeacherSectionController extends Controller
{
    /**
     * Attach a teacher to a section.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function attachTeacherToSection(Request $request)
    {
        $request->validate([
            'Teacher_id' => 'required|exists:teachers,id',
            'Section_id' => 'required|exists:sections,id',
        ]);

        TeacherSection::create([
            'Teacher_id' => $request->Teacher_id,
            'Section_id' => $request->Section_id,
        ]);

        return response()->json(['message' => 'Teacher attached to section successfully.']);
    }

    /**
     * Detach a teacher from a section.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function detachTeacherFromSection(Request $request)
    {
        $request->validate([
            'Teacher_id' => 'required|exists:teachers,id',
            'Section_id' => 'required|exists:sections,id',
        ]);

        TeacherSection::where('Teacher_id', $request->Teacher_id)
            ->where('Section_id', $request->Section_id)
            ->delete();

        return response()->json(['message' => 'Teacher detached from section successfully.']);
    }

    /**
     * Get sections by teacher ID.
     *
     * @param $teacherId
     * @return \Illuminate\Http\Response
     */
    public function getSectionsByTeacher($teacherId)
    {
        $teacher = Teacher::find($teacherId);
        if (!$teacher) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }

        $sections = $teacher->sections; // Uses the relationship defined in Teacher model
        return response()->json(['sections' => $sections]);
    }

    /**
     * Get teachers by section ID.
     *
     * @param $sectionId
     * @return \Illuminate\Http\Response
     */
    public function getTeachersBySection($sectionId)
    {
        $section = Section::find($sectionId);
        if (!$section) {
            return response()->json(['message' => 'Section not found'], 404);
        }

        $teachers = $section->teachers; // Uses the relationship defined in Section model
        return response()->json(['teachers' => $teachers]);
    }
}
