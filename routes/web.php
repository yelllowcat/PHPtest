<?php


use lib\Route;

Route::get('/', function(){
    echo 'Home page';
});

Route::get('/contact', function(){
    echo 'Contact page';
});

Route::get('/about', function(){
    echo 'About page';
});

Route::post('/contact', function(){
    echo 'Contact form submitted';
});

Route::get("/courses/:slug", function($slug){
    echo 'El curso es' . $slug;
});

Route::dispatch();