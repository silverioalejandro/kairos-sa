<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['token.verify']], function () {

});
