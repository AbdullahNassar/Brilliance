<?php
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

// Admin \\
Auth::routes();

Route::group(['prefix' => 'auth' , 'namespace' => 'Auth'], function () {
    Route::post('sitelogout', 'LogoutController@sitelogout')->name('sitelogout');
    Route::get('/{provider}', 'LoginController@redirectToProvider')->name('login.provider');
    Route::get('/{provider}/callback', 'LoginController@handleProviderCallback');
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'HomeController@dashboard')->name('dashboard');
        Route::get('/markAsRead', 'HomeController@markAsRead')->name('markAsRead');
        Route::get('/speaks', 'HomeController@speaks')->name('speaks');
        Route::get('/profile/{id}', 'HomeController@profile')->name('admin.profile');

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'programs', 'namespace' => 'Programs'], function () {
            Route::get('/', ['as' => 'admin.programs', 'uses' => 'ProgramsController@index']);
            Route::get('/add', ['as' => 'programs.add', 'uses' => 'ProgramsController@add']);
            Route::post('/insert', ['as' => 'programs.insert', 'uses' => 'ProgramsController@insert']);
            Route::get('/edit/{id}', ['as' => 'programs.edit', 'uses' => 'ProgramsController@edit']);
            Route::post('/update', ['as' => 'programs.update', 'uses' => 'ProgramsController@update']);
            Route::get('/delete', ['as' => 'program.destroy', 'uses' => 'ProgramsController@destroy']);
            Route::post('/publish/{id}', ['as' => 'programs.publish', 'uses' => 'ProgramsController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'programs.unpublish', 'uses' => 'ProgramsController@unpublish']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'universities', 'namespace' => 'Programs'], function () {
            Route::get('/', ['as' => 'admin.universities', 'uses' => 'UniversitiesController@index']);
            Route::get('/add', ['as' => 'universities.add', 'uses' => 'UniversitiesController@add']);
            Route::post('/insert', ['as' => 'universities.insert', 'uses' => 'UniversitiesController@insert']);
            Route::get('/edit/{id}', ['as' => 'universities.edit', 'uses' => 'UniversitiesController@edit']);
            Route::post('/update', ['as' => 'universities.update', 'uses' => 'UniversitiesController@update']);
            Route::get('/delete', ['as' => 'university.destroy', 'uses' => 'UniversitiesController@destroy']);
            Route::post('/publish/{id}', ['as' => 'universities.publish', 'uses' => 'UniversitiesController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'universities.unpublish', 'uses' => 'UniversitiesController@unpublish']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'programcourses', 'namespace' => 'Programs'], function () {
            Route::get('/', ['as' => 'admin.program.courses', 'uses' => 'ProgramCoursesController@index']);
            Route::get('/add', ['as' => 'program.courses.add', 'uses' => 'ProgramCoursesController@add']);
            Route::post('/insert', ['as' => 'program.courses.insert', 'uses' => 'ProgramCoursesController@insert']);
            Route::get('/edit/{id}', ['as' => 'program.courses.edit', 'uses' => 'ProgramCoursesController@edit']);
            Route::post('/update', ['as' => 'program.courses.update', 'uses' => 'ProgramCoursesController@update']);
            Route::get('/delete', ['as' => 'program.courses.destroy', 'uses' => 'ProgramCoursesController@destroy']);
            Route::post('/publish/{id}', ['as' => 'program.courses.publish', 'uses' => 'ProgramCoursesController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'program.courses.unpublish', 'uses' => 'ProgramCoursesController@unpublish']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'programintakes', 'namespace' => 'Programs'], function () {
            Route::get('/', ['as' => 'admin.program.intakes', 'uses' => 'ProgramIntakesController@index']);
            Route::get('/add', ['as' => 'program.intakes.add', 'uses' => 'ProgramIntakesController@add']);
            Route::post('/insert', ['as' => 'program.intakes.insert', 'uses' => 'ProgramIntakesController@insert']);
            Route::get('/edit/{id}', ['as' => 'program.intakes.edit', 'uses' => 'ProgramIntakesController@edit']);
            Route::post('/update', ['as' => 'program.intakes.update', 'uses' => 'ProgramIntakesController@update']);
            Route::get('/delete', ['as' => 'program.intakes.destroy', 'uses' => 'ProgramIntakesController@destroy']);
            Route::post('/publish/{id}', ['as' => 'program.intakes.publish', 'uses' => 'ProgramIntakesController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'program.intakes.unpublish', 'uses' => 'ProgramIntakesController@unpublish']);
            Route::post('/addGrades', ['as' => 'program.intakes.addGrades', 'uses' => 'ProgramIntakesController@addGrades']);
            Route::get('/intake/{id}', ['as' => 'program.intake.profile', 'uses' => 'ProgramIntakesController@intake']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'diploms', 'namespace' => 'Diploms'], function () {
            Route::get('/', ['as' => 'admin.diploms', 'uses' => 'DiplomsController@index']);
            Route::get('/add', ['as' => 'diploms.add', 'uses' => 'DiplomsController@add']);
            Route::post('/insert', ['as' => 'diploms.insert', 'uses' => 'DiplomsController@insert']);
            Route::get('/edit/{id}', ['as' => 'diploms.edit', 'uses' => 'DiplomsController@edit']);
            Route::post('/update', ['as' => 'diploms.update', 'uses' => 'DiplomsController@update']);
            Route::get('/delete', ['as' => 'diplom.destroy', 'uses' => 'DiplomsController@destroy']);
            Route::post('/publish/{id}', ['as' => 'diploms.publish', 'uses' => 'DiplomsController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'diploms.unpublish', 'uses' => 'DiplomsController@unpublish']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'diplomcourses', 'namespace' => 'Diploms'], function () {
            Route::get('/', ['as' => 'admin.diplom.courses', 'uses' => 'DiplomCoursesController@index']);
            Route::get('/add', ['as' => 'diplom.courses.add', 'uses' => 'DiplomCoursesController@add']);
            Route::post('/insert', ['as' => 'diplom.courses.insert', 'uses' => 'DiplomCoursesController@insert']);
            Route::get('/edit/{id}', ['as' => 'diplom.courses.edit', 'uses' => 'DiplomCoursesController@edit']);
            Route::post('/update', ['as' => 'diplom.courses.update', 'uses' => 'DiplomCoursesController@update']);
            Route::get('/delete', ['as' => 'diplom.courses.destroy', 'uses' => 'DiplomCoursesController@destroy']);
            Route::post('/publish/{id}', ['as' => 'diplom.courses.publish', 'uses' => 'DiplomCoursesController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'diplom.courses.unpublish', 'uses' => 'DiplomCoursesController@unpublish']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'diplomintakes', 'namespace' => 'Diploms'], function () {
            Route::get('/', ['as' => 'admin.diplom.intakes', 'uses' => 'DiplomIntakesController@index']);
            Route::get('/add', ['as' => 'diplom.intakes.add', 'uses' => 'DiplomIntakesController@add']);
            Route::post('/insert', ['as' => 'diplom.intakes.insert', 'uses' => 'DiplomIntakesController@insert']);
            Route::get('/edit/{id}', ['as' => 'diplom.intakes.edit', 'uses' => 'DiplomIntakesController@edit']);
            Route::post('/update', ['as' => 'diplom.intakes.update', 'uses' => 'DiplomIntakesController@update']);
            Route::get('/delete', ['as' => 'diplom.intakes.destroy', 'uses' => 'DiplomIntakesController@destroy']);
            Route::post('/publish/{id}', ['as' => 'diplom.intakes.publish', 'uses' => 'DiplomIntakesController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'diplom.intakes.unpublish', 'uses' => 'DiplomIntakesController@unpublish']);
            Route::post('/addGrades', ['as' => 'diplom.intakes.addGrades', 'uses' => 'DiplomIntakesController@addGrades']);
            Route::get('/intake/{id}', ['as' => 'diplom.intake.profile', 'uses' => 'DiplomIntakesController@intake']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'corporates', 'namespace' => 'Corporates'], function () {
            Route::get('/', ['as' => 'admin.corporates', 'uses' => 'CorporatesController@index']);
            Route::get('/profile/{id}', ['as' => 'corporates.profile', 'uses' => 'CorporatesController@profile']);
            Route::get('/add', ['as' => 'corporates.add', 'uses' => 'CorporatesController@add']);
            Route::post('/addActivity', ['as' => 'corporates.addActivity', 'uses' => 'CorporatesController@addActivity']);
            Route::post('/insert', ['as' => 'corporates.insert', 'uses' => 'CorporatesController@insert']);
            Route::get('/edit/{id}', ['as' => 'corporates.edit', 'uses' => 'CorporatesController@edit']);
            Route::get('/activity/{id}', ['as' => 'corporates.activity', 'uses' => 'CorporatesController@activity']);
            Route::post('/update', ['as' => 'corporates.update', 'uses' => 'CorporatesController@update']);
            Route::get('/delete', ['as' => 'corporates.destroy', 'uses' => 'CorporatesController@destroy']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'halls', 'namespace' => 'Halls'], function () {
            Route::get('/', ['as' => 'admin.halls', 'uses' => 'HallsController@index']);
            Route::get('/add', ['as' => 'halls.add', 'uses' => 'HallsController@add']);
            Route::get('/schedule/{id}', ['as' => 'halls.schedule', 'uses' => 'HallsController@schedule']);
            Route::get('/final-schedule', ['as' => 'halls.schedules', 'uses' => 'HallsController@schedules']);
            Route::post('/insert', ['as' => 'halls.insert', 'uses' => 'HallsController@insert']);
            Route::get('/edit/{id}', ['as' => 'halls.edit', 'uses' => 'HallsController@edit']);
            Route::post('/update', ['as' => 'halls.update', 'uses' => 'HallsController@update']);
            Route::get('/delete', ['as' => 'halls.destroy', 'uses' => 'HallsController@destroy']);
            Route::post('/publish/{id}', ['as' => 'halls.publish', 'uses' => 'HallsController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'halls.unpublish', 'uses' => 'HallsController@unpublish']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'trainingcourses', 'namespace' => 'TrainingCourses'], function () {
            Route::get('/', ['as' => 'admin.trainingcourses', 'uses' => 'TrainingCoursesController@index']);
            Route::get('/add', ['as' => 'trainingcourses.add', 'uses' => 'TrainingCoursesController@add']);
            Route::post('/insert', ['as' => 'trainingcourses.insert', 'uses' => 'TrainingCoursesController@insert']);
            Route::get('/edit/{id}', ['as' => 'trainingcourses.edit', 'uses' => 'TrainingCoursesController@edit']);
            Route::post('/update', ['as' => 'trainingcourses.update', 'uses' => 'TrainingCoursesController@update']);
            Route::get('/delete', ['as' => 'trainingcourses.destroy', 'uses' => 'TrainingCoursesController@destroy']);
            Route::post('/publish/{id}', ['as' => 'trainingcourses.publish', 'uses' => 'TrainingCoursesController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'trainingcourses.unpublish', 'uses' => 'TrainingCoursesController@unpublish']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'trainingcategories', 'namespace' => 'TrainingCategories'], function () {
            Route::get('/', ['as' => 'admin.trainingcategories', 'uses' => 'TrainingCategoriesController@index']);
            Route::get('/add', ['as' => 'trainingcategories.add', 'uses' => 'TrainingCategoriesController@add']);
            Route::post('/insert', ['as' => 'trainingcategories.insert', 'uses' => 'TrainingCategoriesController@insert']);
            Route::get('/edit/{id}', ['as' => 'trainingcategories.edit', 'uses' => 'TrainingCategoriesController@edit']);
            Route::post('/update', ['as' => 'trainingcategories.update', 'uses' => 'TrainingCategoriesController@update']);
            Route::get('/delete', ['as' => 'trainingcategories.destroy', 'uses' => 'TrainingCategoriesController@destroy']);
            Route::post('/publish/{id}', ['as' => 'trainingcategories.publish', 'uses' => 'TrainingCategoriesController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'trainingcategories.unpublish', 'uses' => 'TrainingCategoriesController@unpublish']);
        });

        Route::group(['prefix' => 'student', 'namespace' => 'Students'], function () {
            Route::get('/', ['as' => 'admin.students', 'uses' => 'StudentsController@index']);
            Route::get('/upload/{id}', ['as' => 'admin.students.upload', 'uses' => 'StudentsController@uploadIndex']);
            Route::get('/addSchedule/{id}', ['as' => 'admin.students.schedule', 'uses' => 'StudentsController@scheduleIndex']);
            Route::get('/addSchedules', ['as' => 'admin.students.schedules', 'uses' => 'StudentsController@schedulesIndex']);
            Route::get('/addcourses', ['as' => 'admin.students.courses', 'uses' => 'StudentsController@coursesIndex']);
            Route::post('/insertSchedules', ['as' => 'students.insertSchedules', 'uses' => 'StudentsController@insertSchedules']);
            Route::post('/insertSchedule', ['as' => 'students.insertSchedule', 'uses' => 'StudentsController@insertSchedule']);
            Route::post('/insertCourses', ['as' => 'students.insertCourses', 'uses' => 'StudentsController@addCourses']);
            Route::post('/insertGrades', ['as' => 'students.insertGrades', 'uses' => 'StudentsController@addGrades']);
            Route::post('/insertProgress', ['as' => 'students.insertProgress', 'uses' => 'StudentsController@insertProgress']);
            Route::get('/profile/{id}', ['as' => 'students.profile', 'uses' => 'StudentsController@profile']);
            Route::get('/documents/{id}', ['as' => 'students.documents', 'uses' => 'StudentsController@documents']);
            Route::post('/upload', ['as' => 'documents.upload', 'uses' => 'StudentsController@upload']);
            Route::get('/schedule/{id}', ['as' => 'students.schedule', 'uses' => 'StudentsController@schedule']);
            Route::get('/progress/{id}', ['as' => 'students.progress', 'uses' => 'StudentsController@progress']);
            Route::get('/add', ['as' => 'students.add', 'uses' => 'StudentsController@add']);
            Route::post('/insert', ['as' => 'students.insert', 'uses' => 'StudentsController@insert']);
            Route::get('/edit/{id}', ['as' => 'students.edit', 'uses' => 'StudentsController@edit']);
            Route::post('/update', ['as' => 'students.update', 'uses' => 'StudentsController@update']);
            Route::get('/delete', ['as' => 'student.destroy', 'uses' => 'StudentsController@destroy']);
            Route::get('/programs', ['as' => 'ajaxdata.programs', 'uses' => 'StudentsController@programs']);
            Route::get('/program_intake', ['as' => 'ajaxdata.program_intake', 'uses' => 'StudentsController@program_intake']);
            Route::get('/program_course', ['as' => 'ajaxdata.program_course', 'uses' => 'StudentsController@program_course']);
            Route::get('/courses', ['as' => 'ajaxdata.courses', 'uses' => 'StudentsController@courses']);
            Route::get('/diploms', ['as' => 'ajaxdata.diploms', 'uses' => 'StudentsController@diploms']);
            Route::get('/diplom_intake', ['as' => 'ajaxdata.diplom_intake', 'uses' => 'StudentsController@diplom_intake']);
            Route::get('/diplom_course', ['as' => 'ajaxdata.diplom_course', 'uses' => 'StudentsController@diplom_course']);
            Route::get('/grades', ['as' => 'student.grades', 'uses' => 'StudentsController@grades']);
            Route::get('/attendance', ['as' => 'students.attendance', 'uses' => 'StudentsController@attendance']);
            Route::get('/studentsAttendance', ['as' => 'ajaxdata.studentsAttendance', 'uses' => 'StudentsController@studentsAttendance']);
            Route::post('/addAttendance', ['as' => 'students.addAttendance', 'uses' => 'StudentsController@addAttendance']);
            Route::post('/corporate', ['as' => 'students.insert.corporate', 'uses' => 'StudentsController@corporate']);
            Route::get('/payment/{id}', ['as' => 'students.payment', 'uses' => 'StudentsController@payment']);
            Route::post('/addPayment', ['as' => 'students.addPayment', 'uses' => 'StudentsController@addPayment']);
            Route::get('/pay/{id}', ['as' => 'students.pay', 'uses' => 'StudentsController@pay']);
            Route::get('/print/{id}', ['as' => 'students.print', 'uses' => 'StudentsController@print']);
            Route::post('/addPay', ['as' => 'students.addPay', 'uses' => 'StudentsController@addPay']);
            Route::get('/multi-pay', ['as' => 'students.multipay', 'uses' => 'StudentsController@multipay']);
            Route::post('/add-multi-pay', ['as' => 'students.addmultipay', 'uses' => 'StudentsController@addmultipay']);
            Route::get('/edit-payment/{id}', ['as' => 'plan.edit', 'uses' => 'StudentsController@plan']);
            Route::post('/edit-pay', ['as' => 'payment.edit', 'uses' => 'StudentsController@editPlan']);
        });

        Route::group(['prefix' => 'applicants', 'namespace' => 'Students'], function () {
            Route::get('/', ['as' => 'admin.applicants', 'uses' => 'StudentsController@applicants']);
            Route::get('/upload-applicant/{id}', ['as' => 'admin.applicants.upload', 'uses' => 'StudentsController@uploadIndex']);
            Route::get('/edit-applicant/{id}', ['as' => 'applicants.edit', 'uses' => 'StudentsController@edit']);
            Route::get('/payment-applicant/{id}', ['as' => 'applicants.payment', 'uses' => 'StudentsController@payment']);
            Route::get('/pay-applicant/{id}', ['as' => 'applicants.pay', 'uses' => 'StudentsController@pay']);
            Route::post('/convert/{id}', ['as' => 'applicants.convert', 'uses' => 'StudentsController@convert']);
            Route::get('/payment-print/{id}', ['as' => 'applicants.payment.print', 'uses' => 'StudentsController@paymentPrint']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'employee', 'namespace' => 'Employees'], function () {
            Route::get('/', ['as' => 'admin.employees', 'uses' => 'EmployeesController@index']);
            Route::get('/upload/{id}', ['as' => 'admin.employees.upload', 'uses' => 'EmployeesController@uploadIndex']);
            Route::get('/profile/{id}', ['as' => 'employees.profile', 'uses' => 'EmployeesController@profile']);
            Route::get('/documents/{id}', ['as' => 'employees.documents', 'uses' => 'EmployeesController@documents']);
            Route::post('/upload', ['as' => 'employees.documents.upload', 'uses' => 'EmployeesController@upload']);
            Route::get('/add', ['as' => 'employees.add', 'uses' => 'EmployeesController@add']);
            Route::post('/insert', ['as' => 'employees.insert', 'uses' => 'EmployeesController@insert']);
            Route::get('/edit/{id}', ['as' => 'employees.edit', 'uses' => 'EmployeesController@edit']);
            Route::post('/update', ['as' => 'employees.update', 'uses' => 'EmployeesController@update']);
            Route::get('/delete', ['as' => 'employee.destroy', 'uses' => 'EmployeesController@destroy']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'doctor', 'namespace' => 'Doctors'], function () {
            Route::get('/', ['as' => 'admin.doctors', 'uses' => 'DoctorsController@index']);
            Route::get('/upload/{id}', ['as' => 'admin.doctors.upload', 'uses' => 'DoctorsController@uploadIndex']);
            Route::get('/addSchedule/{id}', ['as' => 'admin.doctors.schedule', 'uses' => 'DoctorsController@scheduleIndex']);
            Route::post('/insertSchedule', ['as' => 'doctors.insertSchedule', 'uses' => 'DoctorsController@insertSchedule']);
            Route::get('/profile/{id}', ['as' => 'doctors.profile', 'uses' => 'DoctorsController@profile']);
            Route::get('/documents/{id}', ['as' => 'doctors.documents', 'uses' => 'DoctorsController@documents']);
            Route::post('/upload', ['as' => 'doctorsdocuments.upload', 'uses' => 'DoctorsController@upload']);
            Route::get('/schedule/{id}', ['as' => 'doctors.schedule', 'uses' => 'DoctorsController@schedule']);
            Route::get('/add', ['as' => 'doctors.add', 'uses' => 'DoctorsController@add']);
            Route::post('/insert', ['as' => 'doctors.insert', 'uses' => 'DoctorsController@insert']);
            Route::get('/edit/{id}', ['as' => 'doctors.edit', 'uses' => 'DoctorsController@edit']);
            Route::post('/update', ['as' => 'doctors.update', 'uses' => 'DoctorsController@update']);
            Route::get('/delete', ['as' => 'doctor.destroy', 'uses' => 'DoctorsController@destroy']);
            Route::get('/programs', ['as' => 'ajaxdata.programs', 'uses' => 'DoctorsController@programs']);
            Route::get('/program_intake', ['as' => 'ajaxdata.program_intake', 'uses' => 'DoctorsController@program_intake']);
            Route::get('/program_course', ['as' => 'ajaxdata.program_course', 'uses' => 'DoctorsController@program_course']);
            Route::get('/courses', ['as' => 'ajaxdata.courses', 'uses' => 'DoctorsController@courses']);
            Route::get('/diploms', ['as' => 'ajaxdata.diploms', 'uses' => 'DoctorsController@diploms']);
            Route::get('/diplom_intake', ['as' => 'ajaxdata.diplom_intake', 'uses' => 'DoctorsController@diplom_intake']);
            Route::get('/diplom_course', ['as' => 'ajaxdata.diplom_course', 'uses' => 'DoctorsController@diplom_course']);
            Route::post('/corporate', ['as' => 'doctors.insert.corporate', 'uses' => 'DoctorsController@corporate']);
        });

        Route::group(['prefix' => 'marketing', 'namespace' => 'MarketingLead'], function () {
            Route::get('/leads', ['as' => 'admin.marketing.leads', 'uses' => 'MarketingLeadsController@index']);
            Route::get('/add', ['as' => 'marketing.leads.add', 'uses' => 'MarketingLeadsController@add']);
            Route::post('/insert', ['as' => 'marketing.leads.insert', 'uses' => 'MarketingLeadsController@insert']);
            Route::get('/edit/{id}', ['as' => 'marketing.leads.edit', 'uses' => 'MarketingLeadsController@edit']);
            Route::post('/update', ['as' => 'marketing.leads.update', 'uses' => 'MarketingLeadsController@update']);
            Route::get('/delete', ['as' => 'marketing.leads.destroy', 'uses' => 'MarketingLeadsController@destroy']);
            Route::post('/publish/{id}', ['as' => 'marketing.leads.publish', 'uses' => 'MarketingLeadsController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'marketing.leads.unpublish', 'uses' => 'MarketingLeadsController@unpublish']);
            Route::get('/upload', ['as' => 'marketing.leads.upload', 'uses' => 'MarketingLeadsController@upload']);
            Route::post('/insertData', ['as' => 'marketing.leads.insertData', 'uses' => 'MarketingLeadsController@insertData']);
            Route::get('/marketing-assigned-leads', ['as' => 'marketing.leads.assigned', 'uses' => 'MarketingLeadsController@assigned']);
            Route::get('/marketing-unassigned-leads', ['as' => 'marketing.leads.unassigned', 'uses' => 'MarketingLeadsController@unassigned']);
            Route::post('/assign', ['as' => 'marketing.leads.assign', 'uses' => 'MarketingLeadsController@assign']);
            Route::get('/sales', ['as' => 'marketing.sales.leads', 'uses' => 'MarketingLeadsController@sales']);
            Route::get('/status-follow', ['as' => 'marketing.leads.follow', 'uses' => 'MarketingLeadsController@followleads']);
            Route::get('/status-potential', ['as' => 'marketing.leads.potential', 'uses' => 'MarketingLeadsController@potentialleads']);
            Route::get('/status-hold', ['as' => 'marketing.leads.hold', 'uses' => 'MarketingLeadsController@holdleads']);
            Route::get('/status-noAnswer', ['as' => 'marketing.leads.noAnswer', 'uses' => 'MarketingLeadsController@noAnswerleads']);
            Route::get('/status-interested', ['as' => 'marketing.leads.interested', 'uses' => 'MarketingLeadsController@interestedleads']);
            Route::get('/status-outOfReach', ['as' => 'marketing.leads.outOfReach', 'uses' => 'MarketingLeadsController@outOfReachleads']);
            Route::get('/status-closed', ['as' => 'marketing.leads.closed', 'uses' => 'MarketingLeadsController@closedleads']);
            Route::get('/temperature-warm', ['as' => 'marketing.leads.warm', 'uses' => 'MarketingLeadsController@warm']);
            Route::get('/temperature-cold', ['as' => 'marketing.leads.cold', 'uses' => 'MarketingLeadsController@cold']);
            Route::get('/temperature-hot', ['as' => 'marketing.leads.hot', 'uses' => 'MarketingLeadsController@hot']);
            Route::get('/leads-report', ['as' => 'marketing.leads.report', 'uses' => 'MarketingLeadsController@leadsReport']);
            Route::get('/tickets', ['as' => 'marketing.sales.tickets', 'uses' => 'MarketingLeadsController@tickets']);
            Route::get('/tickets-report', ['as' => 'marketing.sales.tickets.report', 'uses' => 'MarketingLeadsController@ticketsReport']);
            Route::post('/approve/{id}', ['as' => 'ticket.approve', 'uses' => 'MarketingLeadsController@approve']);
            Route::post('/reject/{id}', ['as' => 'ticket.reject', 'uses' => 'MarketingLeadsController@reject']);
        });

        Route::group(['prefix' => 'sales', 'namespace' => 'SalesLead'], function () {
            Route::get('/leads', ['as' => 'admin.sales.leads', 'uses' => 'SalesLeadsController@index']);
            Route::get('/activity-report', ['as' => 'sales.activities.report', 'uses' => 'SalesLeadsController@activitiesReport']);
            Route::get('/sales-manager-leads', ['as' => 'admin.sales.manager.leads', 'uses' => 'SalesLeadsController@manager']);
            Route::get('/advisors-leads', ['as' => 'admin.sales.advisors.leads', 'uses' => 'SalesLeadsController@advisors']);
            Route::get('/advisor-leads', ['as' => 'admin.sales.advisor.leads', 'uses' => 'SalesLeadsController@advisor']);
            Route::get('/add', ['as' => 'sales.leads.add', 'uses' => 'SalesLeadsController@add']);
            Route::post('/insert', ['as' => 'sales.leads.insert', 'uses' => 'SalesLeadsController@insert']);
            Route::get('/edit/{id}', ['as' => 'sales.leads.edit', 'uses' => 'SalesLeadsController@edit']);
            Route::post('/update', ['as' => 'sales.leads.update', 'uses' => 'SalesLeadsController@update']);
            Route::get('/delete', ['as' => 'sales.leads.destroy', 'uses' => 'SalesLeadsController@destroy']);
            Route::post('/publish/{id}', ['as' => 'sales.leads.publish', 'uses' => 'SalesLeadsController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'sales.leads.unpublish', 'uses' => 'SalesLeadsController@unpublish']);
            Route::get('/upload', ['as' => 'sales.leads.upload', 'uses' => 'SalesLeadsController@upload']);
            Route::post('/insertData', ['as' => 'sales.leads.insertData', 'uses' => 'SalesLeadsController@insertData']);
            Route::get('/sales-assigned-leads', ['as' => 'sales.leads.assigned', 'uses' => 'SalesLeadsController@assigned']);
            Route::get('/sales-unassigned-leads', ['as' => 'sales.leads.unassigned', 'uses' => 'SalesLeadsController@unassigned']);
            Route::post('/assign', ['as' => 'sales.leads.assign', 'uses' => 'SalesLeadsController@assign']);
            Route::get('/ticket', ['as' => 'sales.tickets.add', 'uses' => 'SalesLeadsController@ticket']);
            Route::get('/activity/{id}', ['as' => 'sales.activity.add', 'uses' => 'SalesLeadsController@activity']);
            Route::post('/activity', ['as' => 'sales.activity.insert', 'uses' => 'SalesLeadsController@insertActivity']);
            Route::get('/profile/{id}', ['as' => 'lead.profile', 'uses' => 'SalesLeadsController@profile']);
            Route::get('/follow', ['as' => 'sales.leads.follow', 'uses' => 'SalesLeadsController@follow']);
            Route::get('/potential', ['as' => 'sales.leads.potential', 'uses' => 'SalesLeadsController@potential']);
            Route::get('/hold', ['as' => 'sales.leads.hold', 'uses' => 'SalesLeadsController@hold']);
            Route::get('/noAnswer', ['as' => 'sales.leads.noAnswer', 'uses' => 'SalesLeadsController@noAnswer']);
            Route::get('/interested', ['as' => 'sales.leads.interested', 'uses' => 'SalesLeadsController@interested']);
            Route::get('/outOfReach', ['as' => 'sales.leads.outOfReach', 'uses' => 'SalesLeadsController@outOfReach']);
            Route::get('/closed', ['as' => 'sales.leads.closed', 'uses' => 'SalesLeadsController@closed']);
            Route::get('/status-follow', ['as' => 'sales.manager.follow', 'uses' => 'SalesLeadsController@followleads']);
            Route::get('/status-potential', ['as' => 'sales.manager.potential', 'uses' => 'SalesLeadsController@potentialleads']);
            Route::get('/status-hold', ['as' => 'sales.manager.hold', 'uses' => 'SalesLeadsController@holdleads']);
            Route::get('/status-noAnswer', ['as' => 'sales.manager.noAnswer', 'uses' => 'SalesLeadsController@noAnswerleads']);
            Route::get('/status-interested', ['as' => 'sales.manager.interested', 'uses' => 'SalesLeadsController@interestedleads']);
            Route::get('/status-outOfReach', ['as' => 'sales.manager.outOfReach', 'uses' => 'SalesLeadsController@outOfReachleads']);
            Route::get('/status-closed', ['as' => 'sales.manager.closed', 'uses' => 'SalesLeadsController@closedleads']);
            Route::post('/convert', ['as' => 'sales.leads.convert', 'uses' => 'SalesLeadsController@convert']);
            Route::get('/leads-report', ['as' => 'sales.leads.report', 'uses' => 'SalesLeadsController@leadsReport']);
            Route::get('/contacts', ['as' => 'sales.contacts', 'uses' => 'SalesLeadsController@contacts']);
        });

        Route::group(['prefix' => 'tickets', 'namespace' => 'SalesTicket'], function () {
            Route::get('/', ['as' => 'admin.tickets', 'uses' => 'SalesTicketsController@index']);
            Route::get('/add', ['as' => 'tickets.add', 'uses' => 'SalesTicketsController@add']);
            Route::post('/insert', ['as' => 'tickets.insert', 'uses' => 'SalesTicketsController@insert']);
            Route::get('/edit/{id}', ['as' => 'tickets.edit', 'uses' => 'SalesTicketsController@edit']);
            Route::post('/update', ['as' => 'tickets.update', 'uses' => 'SalesTicketsController@update']);
            Route::get('/delete', ['as' => 'tickets.destroy', 'uses' => 'SalesTicketsController@destroy']);
            Route::post('/publish/{id}', ['as' => 'tickets.publish', 'uses' => 'SalesTicketsController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'tickets.unpublish', 'uses' => 'SalesTicketsController@unpublish']);
            Route::get('/upload', ['as' => 'tickets.upload', 'uses' => 'SalesTicketsController@upload']);
            Route::post('/insertData', ['as' => 'tickets.insertData', 'uses' => 'SalesTicketsController@insertData']);
            Route::get('/pending', ['as' => 'tickets.pending', 'uses' => 'SalesTicketsController@pending']);
            Route::get('/approved', ['as' => 'tickets.approved', 'uses' => 'SalesTicketsController@approved']);
            Route::get('/rejected', ['as' => 'tickets.rejected', 'uses' => 'SalesTicketsController@rejected']);
        });

        Route::group([ 'namespace' => 'MarketingLead'], function () {
            Route::get('/campaigns', ['as' => 'admin.marketing.campaigns', 'uses' => 'MarketingLeadsController@index']);
            Route::get('/add', ['as' => 'marketing.leads.add', 'uses' => 'MarketingLeadsController@add']);
            Route::post('/insert', ['as' => 'marketing.leads.insert', 'uses' => 'MarketingLeadsController@insert']);
            Route::get('/edit/{id}', ['as' => 'marketing.leads.edit', 'uses' => 'MarketingLeadsController@edit']);
            Route::post('/update', ['as' => 'marketing.leads.update', 'uses' => 'MarketingLeadsController@update']);
            Route::get('/delete', ['as' => 'marketing.leads.destroy', 'uses' => 'MarketingLeadsController@destroy']);
            Route::post('/publish/{id}', ['as' => 'marketing.leads.publish', 'uses' => 'MarketingLeadsController@publish']);
            Route::post('/unpublish/{id}', ['as' => 'marketing.leads.unpublish', 'uses' => 'MarketingLeadsController@unpublish']);
            Route::get('/upload', ['as' => 'marketing.leads.upload', 'uses' => 'MarketingLeadsController@upload']);
            Route::post('/insertData', ['as' => 'marketing.leads.insertData', 'uses' => 'MarketingLeadsController@insertData']);
        });

        Route::group(['middleware' =>['permission:admin'],'prefix' => 'users', 'namespace' => 'Users'], function () {
            Route::get('/', ['as' => 'admin.users', 'uses' => 'UsersController@index']);
            Route::get('/add', ['as' => 'users.add', 'uses' => 'UsersController@add']);
            Route::post('/insert', ['as' => 'users.insert', 'uses' => 'UsersController@insert']);
            Route::get('/edit/{id}', ['as' => 'users.edit', 'uses' => 'UsersController@edit']);
            Route::post('/update', ['as' => 'users.update', 'uses' => 'UsersController@update']);
            Route::get('/delete', ['as' => 'user.destroy', 'uses' => 'UsersController@destroy']);
            Route::get('/students', ['as' => 'users.students', 'uses' => 'UsersController@students']);
            Route::get('/doctors', ['as' => 'users.doctors', 'uses' => 'UsersController@doctors']);
            Route::get('/operation', ['as' => 'users.operation', 'uses' => 'UsersController@operation']);
            Route::get('/finance', ['as' => 'users.finance', 'uses' => 'UsersController@finance']);
            Route::get('/sales', ['as' => 'users.sales', 'uses' => 'UsersController@sales']);
            Route::get('/marketing', ['as' => 'users.marketing', 'uses' => 'UsersController@marketing']);
            Route::get('/corporate', ['as' => 'users.corporate', 'uses' => 'UsersController@corporate']);
        });
    });
});
Route::get('/', 'HomeController@dashboard')->name('welcome');