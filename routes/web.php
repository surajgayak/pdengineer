<?php




use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/frontend.php';

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    require __DIR__ . '/backend/profile.php';
    require __DIR__ . '/backend/dashboard.php';
    require __DIR__ . '/backend/role.php';
    require __DIR__ . '/backend/permission.php';
    require __DIR__ . '/backend/user.php';
    require __DIR__ . '/backend/tracking_bank_guarantee.php';
    require __DIR__ . '/backend/tracking_project.php';
    require __DIR__ . '/backend/setting.php';

});


