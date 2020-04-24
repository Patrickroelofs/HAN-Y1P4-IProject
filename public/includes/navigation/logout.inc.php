<?php

require_once '../../../core/init.php';

//TODO: Improve logout to a better way

session_unset();
session_destroy();

Redirect::to('../../index.php');