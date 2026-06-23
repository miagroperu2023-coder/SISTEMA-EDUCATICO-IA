<?php

use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\compendium\CompendiumController;
use App\Http\Controllers\admin\course\CourseController;
use App\Http\Controllers\admin\level\LevelController;
use App\Http\Controllers\admin\pay\PayController;
use App\Http\Controllers\admin\plan\PlanController;
use App\Http\Controllers\admin\post\PostController;
use App\Http\Controllers\admin\price\PriceController;
use App\Http\Controllers\admin\profile\ProfileController;
use App\Http\Controllers\admin\read\ReadController;
use App\Http\Controllers\admin\resource\ResourceController;
use App\Http\Controllers\admin\role\RoleController;
use App\Http\Controllers\admin\user\UserController;
use App\Http\Controllers\admin\whatsapp\WhatsAppController;
use Illuminate\Support\Facades\Route;




/**RUTA PARA LOS ROLES Y PERMISOS */
Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.roles.index');
Route::get('/admin/permisos/create', [RoleController::class, 'create'])->name('admin.permissions.create');
Route::post('/admin/permisos/store', [RoleController::class, 'store'])->name('admin.permissions.store');
Route::put('/admin/role/update/{role}', [RoleController::class, 'update'])->name('admin.permissions.update');
Route::get('/admin/role/edit/{role}', [RoleController::class, 'edit'])->name('admin.roles.edit');
Route::delete('/admin/role/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

Route::get('/admin/profile/{user}', [ProfileController::class, 'index'])->name('admin.profile.index');


Route::get('/admin/user', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.users.store');
Route::put('/admin/user/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::get('/admin/user/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');


Route::get('/admin/course/index', [CourseController::class, 'index'])->name('admin.courses.index');
Route::get('/admin/course/show/{course:slug}', [CourseController::class, 'show'])->name('admin.courses.show');
Route::post('/admin/course/approved/{course:slug}', [CourseController::class, 'approved'])->name('admin.courses.approved');


Route::get('/admin/price/index', [PriceController::class, 'index'])->name('admin.prices.index');
Route::get('/admin/category/index', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('/admin/level/index', [LevelController::class, 'index'])->name('admin.levels.index');
Route::get('/admin/resource/index', [ResourceController::class, 'index'])->name('admin.resources.index');
Route::get('/admin/reads/index', [ReadController::class, 'index'])->name('admin.reads.index');
Route::get('/admin/pays/index', [PayController::class, 'index'])->name('admin.pays.index');
Route::get('/admin/pays/por-atender', [PayController::class, 'list'])->name('admin.pays.list');

Route::get('/admin/compemdium/index', [CompendiumController::class, 'index'])->name('admin.compendiums.index');

Route::get('/admin/post/index', [PostController::class, 'index'])->name('admin.posts.index');
Route::post('/admin/post/store', [PostController::class, 'store'])->name('admin.posts.store');
Route::get('/admin/post/list', [PostController::class, 'list'])->name('admin.posts.list');
Route::get('/admin/post/show/{post}', [PostController::class, 'show'])->name('admin.posts.show');
Route::put('/admin/post/update/{post}', [PostController::class , 'update'])->name('admin.posts.update');


//rutas de cupones y planes
Route::get('/admin/plan/preunicursos', [PlanController::class, 'index'])->name('admin.plan.index');
Route::get('/admin/plan/create', [PlanController::class, 'create'])->name('admin.plan.create');
Route::post('/admin/plan/store', [PlanController::class , 'store'])->name('admin.plan.store');
Route::get('/admin/plan/edit/{plan}', [PlanController::class, 'edit'])->name('admin.plan.edit');
Route::delete('/admin/plan/destroy/{plan}', [PlanController::class, 'destroy'])->name('admin.plan.destroy');


//ruta para mandar mensajes de whasap
Route::get('/admin/whatsapp/index', [WhatsAppController::class , 'index'])->name('admin.whatsapp.index');
Route::post('/admin/whatsapp/send', [WhatsAppController::class , 'send'])->name('admin.whatsapp.send');