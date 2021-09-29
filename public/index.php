<?php

use Dotenv\Dotenv;
use Illuminate\Validation\Validator;
use App\Validation\Rules\AlnumRule;

session_start();
require_once '../vendor/autoload.php';
require_once '../src/Support/helpers.php';
require_once '../routes/web.php';
$dotenv = Dotenv::createImmutable(base_path());
$dotenv->load();


app()->run();

var_dump(app()->db->query('SELECT * FROM users')->id);


