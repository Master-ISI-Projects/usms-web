<?php

Auth::routes();

Route::group(['prefix' => '{currentScholarYear}', 'middleware' => 'auth'], function() {
	// Administration area routes
	Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function() {
	    Route::resource('departements', 'DepartementController');
	    Route::resource('options', 'OptionController');
	    Route::resource('semesters', 'SemesterController');
	    Route::resource('modules', 'ModuleController');
	    Route::resource('exams', 'ExamController');
	    Route::resource('marks', 'MarkController');
	    Route::resource('news', 'NewsController');
	    Route::resource('notifications', 'NotificationController');
	    Route::resource('attachements', 'AttachementController');
	    Route::resource('events', 'EventController');
	    Route::resource('classes', 'ClasseController');
	    Route::resource('students', 'StudentController');
	    Route::resource('teachers', 'TeacherController');
	    Route::resource('admins', 'AdminController');

	    Route::resource('settings', 'SettingController');
	    // Pages
	    Route::get('dashboard', 'PagesController@dashboard')->name('admin.dashboard');
	});

	// Shared Routes
	Route::group(['namespace' => 'Shared'], function() {
		Route::get('profile', 'SharedController@profile')->name('shared.profile');
	});
});

