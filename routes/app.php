<?php
use Illuminate\Support\Facades\Route;


//Begin Route article_categories
Route::resource('article_categories', 'ArticleCategoryController');
//End Route article_categories
//Begin Route article
Route::resource('article', 'ArticleController');
//End Route article
//Begin Route people
Route::resource('people', 'PeopleController');
//End Route people
//Begin Route invitation
Route::resource('invitation', 'InvitationController');
//End Route invitation
//Begin Route invoice
Route::resource('invoice', 'InvoiceController');
//End Route invoice
//Begin Route purchase
Route::resource('purchase', 'PurchaseController');
//End Route purchase