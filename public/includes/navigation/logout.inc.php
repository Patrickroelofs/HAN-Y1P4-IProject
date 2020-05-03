<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

//TODO: Improve logout to a better way

session_unset();
session_destroy();

Redirect::to('../../index.php');