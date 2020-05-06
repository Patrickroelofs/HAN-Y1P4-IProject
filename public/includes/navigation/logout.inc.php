<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/core/init.php';

session_unset();
session_destroy();

Redirect::to('../../index.php');