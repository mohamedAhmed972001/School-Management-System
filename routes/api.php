<?php

use App\Http\Controllers\API\ClassroomController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\MyParentController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\ParentAttachmentController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function()
	{
		return View::make('hello');
	});
    Route::prefix('v1')->group(function () {
        // Routes for grades
        Route::get('/grades', [GradeController::class, 'getGrades']);
        Route::get('/grades/{id}', [GradeController::class, 'getGrade']);
        Route::post('/grades', [GradeController::class, 'createGrade']);
        Route::put('/grades/{id}', [GradeController::class, 'updateGrade']);
        Route::delete('/grades/{id}', [GradeController::class, 'deleteGrade']);
        Route::get('/grades/{gradeId}/classrooms', [GradeController::class, 'getClassroomsByGrade']);// Get all classrooms of a specific grade
        Route::get('/grades/{gradeId}/Sections', [GradeController::class, 'getSectionsByGrade']);// Get all Sections of a specific grade
        Route::get('/grades/{gradeId}/students', [GradeController::class, 'getStudentsByGrade']);

        // Routes for classrooms
        Route::get('/classrooms', [ClassroomController::class, 'getClassrooms']);
        Route::get('/classrooms/{id}', [ClassroomController::class, 'getClassroom']);
        Route::post('/classrooms', [ClassroomController::class, 'createClassroom']);
        Route::put('/classrooms/{id}', [ClassroomController::class, 'updateClassroom']);
        Route::delete('/classrooms/{id}', [ClassroomController::class, 'deleteClassroom']);
        Route::get('/classrooms/{classroomId}/grade', [ClassroomController::class, 'getGradeByClassroom']);// Get the grade of a specific classroom
        Route::get('/classrooms/{classroomId}/Sections', [ClassroomController::class, 'getSectionsByClassroom']);// Get all Sections of a specific Classroom
        Route::get('/classrooms/{classroomId}/students', [ClassroomController::class, 'getStudentsByClassroom']);

        // Routes for sections
        Route::get('/sections', [SectionController::class, 'getSections']); // Get all sections
        Route::get('/sections/{id}', [SectionController::class, 'getSection']); // Get specific section by ID
        Route::post('/sections', [SectionController::class, 'createSection']); // Create a new section
        Route::put('/sections/{id}', [SectionController::class, 'updateSection']); // Update a specific section
        Route::delete('/sections/{id}', [SectionController::class, 'deleteSection']); // Delete a specific section
        Route::get('/sections/{sectionId}/grade', [SectionController::class, 'getGradeBySection']); // Get the grade of a specific section
        Route::get('/sections/{sectionId}/classroom', [SectionController::class, 'getClassroomBySection']); // Get the classroom of a specific section
        Route::get('/sections/{sectionId}/teachers', [SectionController::class, 'getTeachersBySection']);
        Route::get('/sections/{sectionId}/students', [SectionController::class, 'getStudentsBySection']);

        // Routes for MyParents
        Route::get('/parents', [MyParentController::class, 'getParents']); // Get all parents
        Route::get('/parents/{id}', [MyParentController::class, 'getParent']); // Get specific parent by ID
        Route::post('/parents', [MyParentController::class, 'createParent']); // Create a new parent
        Route::put('/parents/{id}', [MyParentController::class, 'updateParent']); // Update a specific parent
        Route::put('/parents/{id}/update_image', [MyParentController::class, 'updateImage']);
        Route::delete('/parents/{id}', [MyParentController::class, 'deleteParent']); // Delete a specific parent
        Route::delete('/parents/{id}/delete_image', [MyParentController::class, 'DeleteImage']);

        Route::get('/parents/{parentId}/father/religion', [MyParentController::class, 'getFatherReligion']); // Get father's religion
        Route::get('/parents/{parentId}/mother/religion', [MyParentController::class, 'getMotherReligion']); // Get mother's religion
        Route::get('/parents/{parentId}/father/nationality', [MyParentController::class, 'getFatherNationality']); // Get father's nationality
        Route::get('/parents/{parentId}/mother/nationality', [MyParentController::class, 'getMotherNationality']); // Get mother's nationality
        Route::post('/parents/{id}/add_image', [MyParentController::class, 'AddImage']);
        Route::get('/parents/{parentId}/students', [MyParentController::class, 'getStudentsByParent']);
        Route::get('/parents/{id}/images', [MyParentController::class, 'showImages']);
        Route::get('/parents/{studentId}/images/{imageId}/download', [MyParentController::class, 'downloadImage']);

        // Routes for ParentAttachment
        Route::post('/parents/attachments', [ParentAttachmentController::class, 'uploadAttachment']);
        Route::get('/parents/{parentId}/attachments', [ParentAttachmentController::class, 'index']);
        Route::delete('/parents/attachments/{id}', [ParentAttachmentController::class, 'destroy']);

        // Routes for teachers
        Route::get('/teachers', [TeacherController::class, 'getTeachers']); // Get all teachers
        Route::get('/teachers/{id}', [TeacherController::class, 'getTeacher']); // Get specific teacher by ID
        Route::post('/teachers', [TeacherController::class, 'createTeacher']); // Create a new teacher
        Route::put('/teachers/{id}', [TeacherController::class, 'updateTeacher']); // Update a specific teacher
        Route::put('/teachers/{id}/update_image', [TeacherController::class, 'UpdateImage']);
        Route::post('/teachers/{id}/add_image', [TeacherController::class, 'AddImage']);
        Route::delete('/teachers/{id}', [TeacherController::class, 'deleteTeacher']); // Delete a specific teacher
        Route::delete('/teachers/{id}/delete_image', [TeacherController::class, 'DeleteImage']);
        Route::get('/teachers/{teacherId}/specialization', [TeacherController::class, 'getTeacherSpecialization']); // Get the teacher's specialization for a specific teacher
        Route::get('/teachers/{teacherId}/gender', [TeacherController::class, 'getTeacherGender']); // Get the teacher's gender for a specific teacher
        Route::get('/teachers/{teacherId}/sections', [TeacherController::class, 'getSectionsByTeacher']);
        Route::get('/teachers/{id}/images', [TeacherController::class, 'showImages']);
        Route::get('/teachers/{id}/images/{imageId}/download', [TeacherController::class, 'downloadImage']);

        // Routes for Students
        Route::get('/students', [StudentController::class, 'getStudents']); // Get all students
        Route::get('/students/{id}', [StudentController::class, 'getStudent']); // Get specific student by ID
        Route::post('/students', [StudentController::class, 'createStudent']); // Create a new student
        Route::put('/students/{id}', [StudentController::class, 'updateStudent']); // Update a specific student
        Route::put('/students/{id}/update_image', [StudentController::class, 'UpdateImage']);
        Route::delete('/students/{id}', [StudentController::class, 'deleteStudent']); // Delete a specific student
        Route::delete('/students/{id}/delete_image', [StudentController::class, 'DeleteImage']);
        Route::get('/students/{studentId}/gender', [StudentController::class, 'getGenderByStudent']); // Get gender
        Route::get('/students/{studentId}/nationality', [StudentController::class, 'getNationalityByStudent']); // Get nationality
        Route::get('/students/{studentId}/grade', [StudentController::class, 'getGradeByStudent']); // Get grade
        Route::get('/students/{studentId}/classroom', [StudentController::class, 'getClassroomByStudent']); // Get classroom
        Route::get('/students/{studentId}/section', [StudentController::class, 'getSectionByStudent']); // Get section
        Route::get('/students/{studentId}/parent', [StudentController::class, 'getParentByStudent']); // Get parent
        Route::get('/students/{studentId}/academic_year', [StudentController::class, 'getAcademicYearByStudent']); // Get academic year
        Route::get('/students/soft_deleted', [StudentController::class, 'getSoftDeletedStudents']); // Get soft deleted students
        Route::post('/students/{id}/add_image', [StudentController::class, 'AddImage']);
        Route::get('/genders/{genderId}/students', [StudentController::class, 'getStudentsByGender']);
        Route::get('/nationalities/{nationalityId}/students', [StudentController::class, 'getStudentsByNationality']);
        Route::get('/students/{id}/images', [StudentController::class, 'showImages']);
        Route::get('/students/{studentId}/images/{imageId}/download', [StudentController::class, 'downloadImage']);

    });


});


