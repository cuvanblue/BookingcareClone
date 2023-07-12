<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'getLogin'])->name('getlogin');
Route::get('/logout', [LoginController::class, 'logOut']);
Route::post('/login', [LoginController::class, 'postLogin']);


Route::get('/', [GuestController::class, 'getHomePage']);
Route::get('/clinics', [GuestController::class, 'getClinicsPage'])->name('clinics');
Route::get('/clinics/search', [GuestController::class, 'getSearchClinic']);
Route::get('/clinics/{id}', [GuestController::class, 'getClinicPage']);
Route::get('/clinics/{id}/search-doctor', [GuestController::class, 'getSearchDoctorByClinic']);
Route::get('/doctors/{doctorid}', [GuestController::class, 'getDoctorPage'])->name('doctors');
Route::get('/booking/{doctorid}/{date}/{timeindex}', [GuestController::class, 'getBookingPage']);
Route::post('/add-booking', [GuestController::class, 'postAddBooking']);

Route::get('/error', function () {
    return 'not found';
})->name('error');

Route::prefix('admin')->middleware(['checkadmin'])->group(function () {
    Route::get('/home', [AdminController::class, 'getHomePage'])->name('getadminhome');
    // route quản lý clinic
    Route::post('/edit', [AdminController::class, 'editCurrentAdmin']);
    Route::get('/clinics', [AdminController::class, 'getClinicsPage']);
    Route::get('/search-clinic', [AdminController::class, 'getSearchClinicsPage']);
    Route::post('/add-clinic', [AdminController::class, 'postAddClinic']);
    Route::post('/edit-clinic', [AdminController::class, 'postEditClinic']);
    Route::DELETE('/delete-clinic', [AdminController::class, 'deleteClinic']);

    // route quản lý doctor
    Route::get('/doctors', [AdminController::class, 'getDoctorsPage']);
    Route::post('/add-doctor', [AdminController::class, 'postAddDoctor']);
    Route::post('/edit-doctor', [AdminController::class, 'postEditDoctor']);
    Route::DELETE('/delete-doctor', [AdminController::class, 'deleteDoctor']);
    Route::get('/search-doctor', [AdminController::class, 'getSearchDoctorsPage']);

    // route quản lý lịch làm việc bác sĩ ( schedules)
    Route::get('/schedules', [AdminController::class, 'getSchedulesPage']);
    Route::post('/add-schedule', [AdminController::class, 'postAddSchedule']);
    Route::post('/edit-schedule', [AdminController::class, 'postEditSchedule']);
    Route::DELETE('/delete-schedule', [AdminController::class, 'deleteSchedule']);
    Route::get('/search-schedule', [AdminController::class, 'getSearchSchedulesPage']);

    // route quản lý lượt đăng ký khám ( booking )
    Route::get('/bookings', [AdminController::class, 'getBookingPage']);
    Route::post('/add-booking', [AdminController::class, 'postAddBooking']);
    Route::post('/edit-booking', [AdminController::class, 'postEditBooking']);
    Route::DELETE('/delete-booking', [AdminController::class, 'deleteBooking']);
    Route::get('/search-booking', [AdminController::class, 'getSearchBookingsPage']);

});
Route::prefix('clinic')->middleware(['checkclinic'])->group(function () {
    Route::get('/home', [ClinicController::class, 'getHomePage'])->name('getclinichome');
    Route::post('/edit', [ClinicController::class, 'editCurrentClinic']);
    // route quản lý doctor
    Route::get('/doctors', [ClinicController::class, 'getDoctorsPage']);
    Route::post('/add-doctor', [ClinicController::class, 'postAddDoctor']);
    Route::post('/edit-doctor', [ClinicController::class, 'postEditDoctor']);
    Route::DELETE('/delete-doctor', [ClinicController::class, 'deleteDoctor']);
    Route::get('/search-doctor', [ClinicController::class, 'getSearchDoctorsPage']);

    // route quản lý lịch làm việc bác sĩ ( schedules)
    Route::get('/schedules', [ClinicController::class, 'getSchedulesPage']);
    Route::post('/add-schedule', [ClinicController::class, 'postAddSchedule']);
    Route::post('/edit-schedule', [ClinicController::class, 'postEditSchedule']);
    Route::DELETE('/delete-schedule', [ClinicController::class, 'deleteSchedule']);
    Route::get('/search-schedule', [ClinicController::class, 'getSearchSchedulesPage']);

    // route quản lý lượt đăng ký khám ( booking )
    Route::get('/bookings', [ClinicController::class, 'getBookingPage']);
    Route::post('/add-booking', [ClinicController::class, 'postAddBooking']);
    Route::post('/edit-booking', [ClinicController::class, 'postEditBooking']);
    Route::DELETE('/delete-booking', [ClinicController::class, 'deleteBooking']);
    Route::get('/search-booking', [ClinicController::class, 'getSearchBookingsPage']);
});
Route::prefix('doctor')->middleware('checkdoctor')->group(function () {
    Route::get('/home', [DoctorController::class, 'getHomePage'])->name('getdoctorhome');
    Route::post('/edit', [DoctorController::class, 'editCurrentDoctor']);
    // route quản lý lịch làm việc bác sĩ ( schedules)
    Route::get('/schedules', [DoctorController::class, 'getSchedulesPage']);
    Route::post('/add-schedule', [DoctorController::class, 'postAddSchedule']);
    Route::post('/edit-schedule', [DoctorController::class, 'postEditSchedule']);
    Route::DELETE('/delete-schedule', [DoctorController::class, 'deleteSchedule']);
    Route::get('/search-schedule', [DoctorController::class, 'getSearchSchedulesPage']);

    // route quản lý lượt đăng ký khám ( booking )
    Route::get('/bookings', [DoctorController::class, 'getBookingPage']);
    Route::post('/add-booking', [DoctorController::class, 'postAddBooking']);
    Route::post('/edit-booking', [DoctorController::class, 'postEditBooking']);
    Route::DELETE('/delete-booking', [DoctorController::class, 'deleteBooking']);
    Route::get('/search-booking', [DoctorController::class, 'getSearchBookingsPage']);
});