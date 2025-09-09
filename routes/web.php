<?php

use App\Livewire\Staff\StaffWire;
use App\Livewire\Hr\DashboardWire;
use App\Livewire\Staff\StaffFormWire;
use Illuminate\Support\Facades\Route;
use App\Livewire\Document\DocumentWire;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Livewire\Attendance\AttendanceWire;
use App\Livewire\Document\DocumentFormWire;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Livewire\Attendance\AttendanceFormWire;
use App\Livewire\Attendance\AttendanceCalendarWire;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardWire::class)->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Staff Management
    Route::get('/staff', App\Livewire\Staff\StaffWire::class)->name('staff.index');
    Route::get('/staff/create', App\Livewire\Staff\StaffFormWire::class)->name('staff.create');
    Route::get('/staff/{id}/edit', App\Livewire\Staff\StaffFormWire::class)->name('staff.edit');

    // Attendance Management
    Route::get('/attendance', App\Livewire\Attendance\AttendanceWire::class)->name('attendance.index');
    Route::get('/attendance/create', App\Livewire\Attendance\AttendanceFormWire::class)->name('attendance.create');
    Route::get('/attendance/{id}/edit', App\Livewire\Attendance\AttendanceFormWire::class)->name('attendance.edit');
    Route::get('/attendance/calendar', AttendanceCalendarWire::class)->name('attendance.calendar');

    // Documents Management
    Route::get('/documents', App\Livewire\Document\DocumentWire::class)->name('documents.index');
    Route::get('/documents/create', App\Livewire\Document\DocumentFormWire::class)->name('documents.create');
    Route::get('/documents/{id}/edit', App\Livewire\Document\DocumentFormWire::class)->name('documents.edit');

    // Notifications Management
    Route::get('/notifications', App\Livewire\Notification\NotificationWire::class)->name('notifications.index');

    // Work Check Management
    Route::get('/work-checks', App\Livewire\WorkCheck\WorkCheckIndex::class)->name('work-checks.index');
    Route::get('/work-checks/create', App\Livewire\WorkCheck\WorkCheckCreate::class)->name('work-checks.create');
    Route::get('/work-checks/{id}/edit', App\Livewire\WorkCheck\WorkCheckEdit::class)->name('work-checks.edit');

    // Settings
    Route::get('/settings', App\Livewire\Settings\SettingsIndex::class)->name('settings.index');
    Route::get('/settings/notifications', App\Livewire\Settings\NotificationSettings::class)->name('settings.notifications');
    Route::get('/settings/branding', App\Livewire\Settings\BrandingSettings::class)->name('settings.branding');

    // Document Download Route (Regular Controller)
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
        ->name('documents.download');
});

require __DIR__ . '/auth.php';
