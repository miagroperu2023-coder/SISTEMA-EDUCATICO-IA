<?php

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\auth\LogoutController;
use App\Http\Controllers\admin\auth\RecoverController;
use App\Http\Controllers\admin\auth\RegisterController;
use App\Http\Controllers\admin\auth\SocialAuthController;
use App\Http\Controllers\admin\auth\SocialFacebookAuthController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\plan\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\visitador\bot\BotController;
use App\Http\Controllers\visitador\charts\ChartsController;
use App\Http\Controllers\visitador\post\PostController;
use App\Http\Controllers\visitador\compendium\CompendiumController;
use App\Http\Controllers\visitador\contact\ContactController;
use App\Http\Controllers\visitador\course\CourseController;
use App\Http\Controllers\visitador\course\CourseFreeController;
use App\Http\Controllers\visitador\examResponder\ExamFreeResponder;
use App\Http\Controllers\visitador\examResponder\ExamResponderController;
use App\Http\Controllers\visitador\home\HomeController;
use App\Http\Controllers\visitador\read\ReadController;
use App\Http\Controllers\visitador\simulacrum\SimulacrumController;
use App\Http\Controllers\visitador\solve\SolveController;
use App\Http\Controllers\visitador\testimonial\TestimonialController;
use Illuminate\Support\Facades\Route;


//COMPONENTE LIVEWIRE PARA SEGUIR EL CURSO
use App\Http\Livewire\CourseStatus;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*RUTAS DEL VISITADOR "ESCOLARES" */

Route::get('/', [HomeController::class, 'index'])->name('visitador.home.index');
Route::get('/contenido/{resource}', [HomeController::class, 'contenido'])->name('visitador.contenido');
Route::get('/panel', [HomeController::class, 'panel'])->name('visitador.panel');

//AUTH CON GOOGLE 
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('google.auth.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('google.auth.callback');


//AUTH CON FACEBOOK 
Route::get('/auth/facebook', [SocialFacebookAuthController::class, 'redirectToFacebook'])->name('facebook.auth.redirect');
Route::get('/auth/facebook/callback', [SocialFacebookAuthController::class, 'handleFacebookCallback'])->name('facebook.auth.callback');


//LOGIN Y REGISTER
Route::get('/admin/SingIn', [LoginController::class, 'index'])->name('login');
Route::post('/admin/SingIn', [LoginController::class, 'store'])->name('admin.login.store');

Route::get('/admin/Register', [RegisterController::class, 'index'])->name('admin.register.index');
Route::post('/admin/Register/store', [RegisterController::class, 'store'])->name('admin.register.store');

Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.index');

Route::get('/admin/recover', [RecoverController::class, 'recover'])->name('admin.recover');
Route::post('/admin/recover', [RecoverController::class, 'send'])->name('admin.send');
Route::get('/admin/recover/usuario', [RecoverController::class, 'index'])->name('admin.recover.index');
Route::post('/admin/recover/update', [RecoverController::class, 'update'])->name('admin.recover.update');
Route::post('/admin/logout', [LogoutController::class, 'logout'])->name('admin.logout');


//BUSQUEDA DEL CURSO Y MOSTRAR CURSO CON SU CONTENIDO
Route::get('/course', [CourseController::class, 'index'])->name('visitador.course.index');
Route::get('/course/show/{course:slug}', [CourseController::class, 'show'])->name('visitador.course.show');
Route::post('/course/{course}/enrolled', [CourseController::class, 'enrolled'])->middleware('auth')->name('visitador.course.enrolled');
Route::get('/course-status/{course:slug}', [CourseController::class, 'status'])->middleware('auth')->name('visitador.course.status');
Route::get('/list/course/student', [CourseController::class, 'courses'])->middleware('auth')->name('visitador.course.list');


//RUTA DE LOS CURSOS GRATIS PARA QUE SE INSCRIBAN SIN PAGAR
Route::get('/course/free', [CourseFreeController::class, 'index'])->name('visitador.course.free.index');
Route::get('/course/free/show/{course:slug}', [CourseFreeController::class, 'show'])->name('visitador.course.free.show');
Route::post('/course/free/{course:slug}/enrolled', [CourseFreeController::class, 'enrolled'])->middleware('auth')->name('visitador.course.free.enrolled');
Route::get('/list/course/free/student', [CourseFreeController::class, 'courses'])->middleware('auth')->name('visitador.course.free.list');


//CONTACTOS
Route::get('/contact-me', [ContactController::class, 'index'])->name('visitador.contact.index');

//TESTIMONIALES
Route::get('/testimoniales', [TestimonialController::class, 'index'])->name('visitador.testimonial.index');

//PARA VER LOS RECURSOS DE CADA CURSO
Route::get('/lectura', [ReadController::class, 'index'])->name('visitador.read.index');
Route::get('/lectura/show/{archive}', [ReadController::class, 'show'])->name('visitador.read.show');


//EXAMENES
Route::get('/examen/lista', [ExamResponderController::class, 'index'])->name('visitador.examenes.index');
Route::get('/examen/{exam:slug}/enrolled', [ExamResponderController::class, 'enrolled'])->name('visitador.examenes.enrolled');
Route::get('/examen/{exam:slug}/status/', [ExamResponderController::class, 'status'])->name('visitador.examenes.status');
Route::get('/examen/{exam:slug}/culminate/show', [ExamResponderController::class, 'show'])->name('visitador.examenes.show');
Route::post('/examen/retomar/status/{exam:slug}/{examUser}', [ExamResponderController::class, 'reset'])->name('visitador.examenes.reset');


//EXAMENES GRATIS
Route::get('/examen/free/lista', [ExamFreeResponder::class, 'index'])->name('visitador.examenes.free.index');
Route::get('/examen/free/{exam:slug}/enrolled', [ExamFreeResponder::class, 'enrolled'])->name('visitador.examenes.free.enrolled');
Route::get('/examen/free/{exam:slug}/status/', [ExamFreeResponder::class, 'status'])->name('visitador.examenes.free.status');
Route::get('/examen/free/{exam:slug}/culminate/show', [ExamFreeResponder::class, 'show'])->name('visitador.examenes.free.show');
Route::post('/examen/free/retomar/status/{exam:slug}/{examUser}', [ExamFreeResponder::class, 'reset'])->name('visitador.examenes.free.reset');


//PARA VER MI PLAN DE SUSCRIPCION
Route::get('/plan/{user}/status/suscription', [PlanController::class, 'index'])->name('visitador.plan.index');
Route::get('/plan/pasos/video/suscription', [PlanController::class, 'show'])->name('visitador.plan.show');


//MIS COMPENDIOS
Route::get('/compemdios', [CompendiumController::class, 'index'])->name('visitador.compendio.index');
Route::get('/compemdios/show/{archive}', [CompendiumController::class, 'show'])->name('visitador.compendio.show');


//RUTA DE LOS GRAFICOS
Route::get('/graficos/index', [ChartsController::class, 'index'])->name('visitador.graficos.index');
Route::get('/graficos/data', [ChartsController::class, 'dataChart'])->name('visitador.graficos.dataChart');

//TERMINOS Y CONDICIONES
Route::get('/preunicursos/terminos-y-condiciones', [ConditionController::class, 'index'])->name('visitador.condition.index');

//RUTA PARA LA LERTA DE LINK CAIDO
Route::post('/alerta/link/caida/administrador', [CourseController::class, 'alert'])->name('visitador.course.alert');

//RUTA PARA LAS PUBLICACIOPNES
Route::get('/post/comunidad/estudiantes', [PostController::class, 'index'])->name('visitador.post.index');
Route::get('/post/comunidad/comment/{post}', [PostController::class, 'comment'])->name('visitador.post.comment');

//RUTA PARA RESOLVER EL EXAMEN
Route::get('/post/resolve/{post}', [SolveController::class, 'index'])->name('visitador.resolve.index');
Route::post('/post/resolve/publish', [SolveController::class, 'firmar'])->name('visitador.solve.publish.save');


//SIMULACROS
Route::get('/simulacros-tipo-unfv/crear', [SimulacrumController::class, 'index'])->name('visitador.simulacrum.index');


//RUTA DEL CHAT BOT
Route::get('/bot/user/meesage', [BotController::class, 'index'])->name('visitador.bot.index');
Route::post('/preunicursos/chat-bot-man/conversation', [BotController::class, 'conversation'])->name('visitador.bot.conversation');
Route::get('/preunicursos/contenido-i-a/estudiante', [BotController::class , 'contenidoIA'])->name('visitador.bot.contenidoia');


//RUTAS PARA EL ADMIN
require base_path('routes/admin.php');


//RUTAS PARA EL INSTRUCTOR "profesor"
require base_path('routes/instructor.php');


//RUTAS PARA EL PAGO
require base_path('routes/payment.php');
