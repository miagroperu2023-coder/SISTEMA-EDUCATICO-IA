<?php

use App\Http\Controllers\instructor\InstructorAudienceController;
use App\Http\Controllers\instructor\InstructorCourseController;
use App\Http\Controllers\instructor\instructorExamController;
use App\Http\Controllers\instructor\InstructorGoalController;
use App\Http\Controllers\instructor\InstructorLessonController;
use App\Http\Controllers\instructor\instructorQuestionController;
use App\Http\Controllers\instructor\InstructorRequirementController;
use App\Http\Controllers\instructor\InstructorSectionController;
use App\Http\Controllers\instructor\InstructorStudentController;
use App\Http\Controllers\instructor\InstructorTopicController;
use App\Http\Controllers\instructor\ProfileController;
use Illuminate\Support\Facades\Route;




/**RUTA PARA LOS INSTRUTORES O PORFESORES QUE VAN A SUBIR SUS CURSOS*/
//can:VALIDA SI TIENE EL PERMISO DE "Leer cursos" ->que esta unida con el rol del usuario "Admin o Instructor"
Route::get('/course/instructor', [InstructorCourseController::class, 'index'])->name('admin.instructor.course.index');
Route::get('/course/instructor/create', [InstructorCourseController::class, 'create'])->name('admin.instructor.course.create');
Route::post('/course/instructor/store', [InstructorCourseController::class, 'store'])->name('admin.instructor.course.store');
Route::get('/course/instructor/edit/{course:slug}', [InstructorCourseController::class, 'edit'])->name('admin.instructor.course.edit');
Route::put('/course/instructor/update/{course:slug}', [InstructorCourseController::class, 'update'])->name('admin.instructor.course.update');
Route::post('/course/instructor/status/{course:slug}', [InstructorCourseController::class , 'status'])->name('admin.instructor.course.status');

Route::get('/admin/instructor/profile/{user:name}', [ProfileController::class , 'index'])->name('admin.instructor.profile.index');

Route::get('/section/instructor/index/{course:slug}',[InstructorSectionController::class, 'index'])->name('admin.instructor.section.index');

Route::get('/lesson/instructor/index/{course:slug}', [InstructorLessonController::class , 'index'])->name('admin.instructor.lesson.index');

Route::get('/goal/instructor/index/{course:slug}', [InstructorGoalController::class, 'index'])->name('admin.instructor.goal.index');

Route::get('/requirement/instructor/index/{course:slug}', [InstructorRequirementController::class, 'index'])->name('admin.instructor.requirement.index');

Route::get('/audience/instructor/index/{course:slug}', [InstructorAudienceController::class, 'index'])->name('admin.instructor.audience.index');

Route::get('/topics/instructor/index', [InstructorTopicController::class, 'index'])->name('admin.instructor.topic.index');

Route::get('/question/instructor/index', [instructorQuestionController::class, 'index'])->name('admin.instructor.question.index');

Route::get('/exam/instructor/index', [instructorExamController::class, 'index'])->name('admin.instructor.exam.index');

Route::get('/student/instructor/index/{course:slug}', [InstructorStudentController::class, 'index'])->name('admin.instructor.student.index');