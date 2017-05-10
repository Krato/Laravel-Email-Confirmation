<?php
if (config('app.debug') == true) {
    \Artisan::call('view:clear');
}
Route::group(['middleware' => ['web']], function () {
    Route::get('email/{hash}', 'ConfirmController@postConfirm')->name('confirm.email');
    Route::get('repeat', 'ConfirmController@getRepeatConfirm')->name('confirm.repeat');
    Route::get('successfull', 'ConfirmController@getSuccessfull')->name('confirm.successfull');
    Route::get('re-sent', 'ConfirmController@getResent')->name('confirm.re-sent');
    Route::get('warning', 'ConfirmController@getWarning')->name('confirm.warning');
    // Route::post( 'email',       'ConfirmController@postConfirm' )->name('confirm.email');
    Route::post('repeat', 'ConfirmController@postRepeatConfirm')->name('confirm.repeat');
});
