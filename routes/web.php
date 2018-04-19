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
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/signout', 'AuthController@getsignout')->name('getsignout.auth');
    Route::get('/', function () {return view('welcome');})->name('welcome');
    Route::get('/selfcheckproduction','SelfcheckproductionController@index')->name('pages.selfcheckproduction.index');
    Route::get('/selfcheckproduction/add','SelfcheckproductionController@add')->name('pages.selfcheckproduction.add');
    Route::patch('/selfcheckproduction/add','SelfcheckproductionController@create')->name('pages.selfcheckproduction.create');
    Route::get('/selfcheckproduction/edit/{id}/{page}','SelfcheckproductionController@edit')->name('pages.selfcheckproduction.edit');
    Route::patch('/selfcheckproduction/edit/{id}/{page}','SelfcheckproductionController@update')->name('pages.selfcheckproduction.update');
    Route::get('/selfcheckproduction/autocomplete', 'SelfcheckproductionController@autocomplete')->name('pages.selfcheckproduction.autocomplete');
    Route::get('/selfcheckproduction/autocompletesupervisor', 'SelfcheckproductionController@autocompletesupervisor')->name('pages.selfcheckproduction.autocompletesupervisor');
    Route::get('/selfcheckproduction/autocompletesupervisorid', 'SelfcheckproductionController@autocompletesupervisorid')->name('pages.selfcheckproduction.autocompletesupervisorid');
    Route::get('/selfcheckproduction/pdf/{id}', 'PdfController@selfcheckproduction')->name('selfcheckproduction.pdf');
    
    Route::get('/auth','AuthController@index')->name('pages.auth.index');
    Route::get('/auth/add','AuthController@add')->name('pages.auth.add');
    Route::patch('/auth/add','AuthController@create')->name('pages.auth.create');
    Route::get('/auth/edit/{id}','AuthController@edit')->name('pages.auth.edit');
    Route::patch('/auth/edit/{id}','AuthController@update')->name('pages.auth.update');
    Route::get('/auth/delete/{id}','AuthController@destroy')->name('pages.auth.delete');
    
    Route::get('/role','RoleController@index')->name('pages.role.index');
    Route::get('/role/add',function () {return view('pages.role.add');});
    Route::patch('/role/add','RoleController@create')->name('pages.role.create');
    Route::get('/role/edit/{id}','RoleController@edit')->name('pages.role.edit');
    Route::patch('/role/edit/{id}','RoleController@update')->name('pages.role.update');
    Route::get('/role/delete/{id}','RoleController@destroy')->name('pages.role.delete');

    Route::get('/department','DepartmentController@index')->name('pages.department.index');
    Route::get('/department/add',function () {return view('pages.department.add');});
    Route::patch('/department/add','DepartmentController@create')->name('pages.department.create');
    Route::get('/department/edit/{id}','DepartmentController@edit')->name('pages.department.edit');
    Route::patch('/department/edit/{id}','DepartmentController@update')->name('pages.department.update');
    Route::get('/department/delete/{id}','DepartmentController@destroy')->name('pages.department.delete');

    Route::get('/subdepartment','SubdeparmentController@index')->name('pages.subdepartment.index');
    Route::get('/subdepartment/add',function () {return view('pages.subdepartment.add');});
    Route::patch('/subdepartment/add','SubdeparmentController@create')->name('pages.subdepartment.create');
    Route::get('/subdepartment/edit/{id}','SubdeparmentController@edit')->name('pages.subdepartment.edit');
    Route::patch('/subdepartment/edit/{id}','SubdeparmentController@update')->name('pages.subdepartment.update');
    Route::get('/subdepartment/delete/{id}','SubdeparmentController@destroy')->name('pages.subdepartment.delete');

    Route::get('/jobposition','JobpositionController@index')->name('pages.jobposition.index');
    Route::get('/jobposition/add',function () {return view('pages.jobposition.add');});
    Route::patch('/jobposition/add','JobpositionController@create')->name('pages.jobposition.create');
    Route::get('/jobposition/edit/{id}','JobpositionController@edit')->name('pages.jobposition.edit');
    Route::patch('/jobposition/edit/{id}','JobpositionController@update')->name('pages.jobposition.update');
    Route::get('/jobposition/delete/{id}','JobpositionController@destroy')->name('pages.jobposition.delete');

    Route::get('/customer','CustomerController@index')->name('pages.customer.index');
    Route::get('/customer/add',function () {return view('pages.customer.add');});
    Route::patch('/customer/add','CustomerController@create')->name('pages.customer.create');
    Route::get('/customer/edit/{id}','CustomerController@edit')->name('pages.customer.edit');
    Route::patch('/customer/edit/{id}','CustomerController@update')->name('pages.customer.update');
    Route::get('/customer/delete/{id}','CustomerController@destroy')->name('pages.customer.delete');
    
    Route::get('/productionline','ProductionlineController@index')->name('pages.productionline.index');
    Route::get('/productionline/add',function () {return view('pages.productionline.add');});
    Route::patch('/productionline/add','ProductionlineController@create')->name('pages.productionline.create');
    Route::get('/productionline/edit/{id}','ProductionlineController@edit')->name('pages.productionline.edit');
    Route::patch('/productionline/edit/{id}','ProductionlineController@update')->name('pages.productionline.update');
    Route::get('/productionline/delete/{id}','ProductionlineController@destroy')->name('pages.productionline.delete');
    
    Route::get('/model','ModelController@index')->name('pages.model.index');
    Route::get('/model/add',function () {return view('pages.model.add');});
    Route::patch('/model/add','ModelController@create')->name('pages.model.create');
    Route::get('/model/edit/{id}','ModelController@edit')->name('pages.model.edit');
    Route::patch('/model/edit/{id}','ModelController@update')->name('pages.model.update');
    Route::get('/model/delete/{id}','ModelController@destroy')->name('pages.model.delete');
    
    Route::get('/process','ProcessController@index')->name('pages.process.index');
    Route::get('/process/add',function () {return view('pages.process.add');});
    Route::patch('/process/add','ProcessController@create')->name('pages.process.create');
    Route::get('/process/edit/{id}','ProcessController@edit')->name('pages.process.edit');
    Route::patch('/process/edit/{id}','ProcessController@update')->name('pages.process.update');
    Route::get('/process/delete/{id}','ProcessController@destroy')->name('pages.process.delete');
    Route::get('/process/autocomplete', 'ProcessController@autocomplete')->name('pages.process.autocomplete');

    Route::get('/type','TypeController@index')->name('pages.type.index');
    Route::get('/type/add',function () {return view('pages.type.add');});
    Route::patch('/type/add','TypeController@create')->name('pages.type.create');
    Route::get('/type/edit/{id}','TypeController@edit')->name('pages.type.edit');
    Route::patch('/type/edit/{id}','TypeController@update')->name('pages.type.update');
    Route::get('/type/delete/{id}','TypeController@destroy')->name('pages.type.delete');
    
    Route::get('/material','MaterialController@index')->name('pages.material.index');
    Route::get('/material/add',function () {return view('pages.material.add');});
    Route::patch('/material/add','MaterialController@create')->name('pages.material.create');
    Route::get('/material/edit/{id}','MaterialController@edit')->name('pages.material.edit');
    Route::patch('/material/edit/{id}','MaterialController@update')->name('pages.material.update');
    Route::get('/material/delete/{id}','MaterialController@destroy')->name('pages.material.delete');
    
    Route::get('/lottag','LotTagController@index')->name('pages.lottag.index');
    Route::get('/lottag/add','LotTagController@add')->name('pages.lottag.add');
    Route::patch('/lottag/add','LotTagController@create')->name('pages.lottag.create');
    Route::get('/lottag/edit/{id}','LotTagController@edit')->name('pages.lottag.edit');
    Route::patch('/lottag/edit/{id}','LotTagController@update')->name('pages.lottag.update');
    Route::get('/lottag/edit/delete/img', 'LotTagController@deleteimg')->name('pages.lottag.deleteimg');
    Route::get('/lottag/delete/{id}','LotTagController@destroy')->name('pages.lottag.delete');
    Route::get('/lottag/pdf/{id}','PdfController@lottag')->name('lottag.pdf');
    
    Route::get('/delivery','DeliveryController@index')->name('pages.delivery.index');
    Route::get('/delivery/add','DeliveryController@add')->name('pages.delivery.add');
    Route::patch('/delivery/add','DeliveryController@create')->name('pages.delivery.create');
    Route::get('/delivery/edit/{id}','DeliveryController@edit')->name('pages.delivery.edit');
    Route::patch('/delivery/edit/{id}','DeliveryController@update')->name('pages.delivery.update');
    Route::get('/delivery/delete/{id}','DeliveryController@destroy')->name('pages.delivery.delete');
    Route::get('/delivery/autocomplete', 'DeliveryController@autocomplete')->name('pages.delivery.autocomplete');
    Route::get('/delivery/pdf/{id}','PdfController@delivery')->name('delivery.pdf');
    
    Route::get('/qpoint','QpointController@index')->name('pages.qpoint.index');
    Route::get('/qpoint/add','QpointController@add')->name('pages.qpoint.add');
    Route::patch('/qpoint/add','QpointController@create')->name('pages.qpoint.create');
    Route::get('/qpoint/edit/{id}','QpointController@edit')->name('pages.qpoint.edit');
    Route::patch('/qpoint/edit/{id}','QpointController@update')->name('pages.qpoint.update');
    Route::get('/qpoint/delete/{id}','QpointController@destroy')->name('pages.qpoint.delete');
    Route::get('/qpoint/autocomplete', 'QpointController@autocomplete')->name('pages.qpoint.autocomplete');
    
    Route::get('/preproductioncheck','PreProductionCheckController@index')->name('pages.preproductioncheck.index');
    Route::get('/preproductioncheck/add','PreProductionCheckController@add')->name('pages.preproductioncheck.add');
    Route::patch('/preproductioncheck/add','PreProductionCheckController@create')->name('pages.preproductioncheck.create');
    Route::get('/preproductioncheck/edit/{id}','PreProductionCheckController@edit')->name('pages.preproductioncheck.edit');
    Route::patch('/preproductioncheck/edit/{id}','PreProductionCheckController@update')->name('pages.preproductioncheck.update');
    Route::get('/preproductioncheck/delete/{id}','PreProductionCheckController@destroy')->name('pages.preproductioncheck.delete');
    Route::get('/preproductioncheck/autocomplete', 'PreProductionCheckController@autocomplete')->name('pages.preproductioncheck.autocomplete');
    
    Route::get('/historyselfcheckproduction','HistorySelfCheckProductionController@index')->name('pages.historyselfcheckproduction.index');
    // Route::get('/preproductioncheck/add','PreProductionCheckController@add')->name('pages.preproductioncheck.add');
    // Route::patch('/preproductioncheck/add','PreProductionCheckController@create')->name('pages.preproductioncheck.create');
    // Route::get('/preproductioncheck/edit/{id}','PreProductionCheckController@edit')->name('pages.preproductioncheck.edit');
    // Route::patch('/preproductioncheck/edit/{id}','PreProductionCheckController@update')->name('pages.preproductioncheck.update');
    // Route::get('/preproductioncheck/delete/{id}','PreProductionCheckController@destroy')->name('pages.preproductioncheck.delete');
    // Route::get('/historyselfcheckproduction/autocomplete', 'DeliveryController@autocomplete')->name('pages.historyselfcheckproduction.autocomplete');
    Route::get('/test', function () {
        return view('pages.test.index');
    });
});

