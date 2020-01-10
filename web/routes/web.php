<?php

Auth::routes();

Route::group(['prefix' => '{currentScholarYear}', 'middleware' => 'auth'], function() {
	// Administration area routes
	Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function() {
	    Route::resource('departements', 'DepartementController');
	    Route::resource('classes', 'ClassController');
	    Route::resource('modules', 'ModuleController');
	    Route::resource('students', 'StudentController');
	    Route::resource('teachers', 'TeacherController');
	    Route::resource('courses', 'CourseController');
	    Route::resource('admins', 'AdminController');
	   	Route::delete('files/{id}', 'FileController@destroy')->name('files.delete');
	});

	// Students area routes
	Route::group(['prefix' => 'student', 'namespace' => 'Student', 'middleware' => 'student'], function() {
	    Route::get('dashboard', 'PagesController@dashboard')->name('student.dashboard');
	    Route::get('classe', 'PagesController@classe')->name('student.students.classe');
	    Route::get('course/{id}', 'PagesController@course')->name('student.students.course');
	    Route::get('courses-calendar', 'PagesController@coursesCalendar')->name('student.students.course_calendar');
	});

	// Teachers area routes
	Route::group(['prefix' => 'teacher', 'middleware' => 'teacher'], function() {
	    Route::get('dashboard', 'Teacher\PagesController@dashboard')->name('teacher.dashboard');
	    Route::get('course/{id}', 'Teacher\PagesController@course')->name('teacher.course');
	    Route::get('courses-calendar', 'Teacher\PagesController@coursesCalendar')->name('teacher.course_calendar');
	    Route::delete('files/{id}', 'Admin\FileController@destroy')->name('teacher.files.delete');
	    Route::post('courses/{id}/save-document', 'Admin\CourseController@saveDocument')->name('teacher.courses.save_document');
	});

	// Api routes
	Route::group(['prefix' => 'api'], function() {
	    Route::get('courses/{id}/messages', 'Api\ChatController@courseMessages');
	    Route::post('courses/{id}/messages', 'Api\ChatController@addCourseMessages');
	    Route::get('classes/{classeId}/courses', 'Admin\ClassController@courses');
	    Route::get('teachers/{teacherId}/courses', 'Admin\TeacherController@courses');
	});

	// Shared Routes
	Route::group(['namespace' => 'Shared'], function() {
		Route::get('profile', 'SharedController@profile')->name('shared.profile');
	});
});

Route::get('test', function () {
	dd(App\Helpers\Helper::getCurrentYear());
});
