

<?php

// controle de erros 
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

// forma magica de carregar as class 
require_once("core/autoload.php");

// Mas simples não existe, não acha !!!

// =============== MIDDLEWARE =================
// Route::middleware(verifyActiveApi::class);


// ================= ROUTES ===================

// Tickets
Route::get('/example', [Example::class, 'index']);
