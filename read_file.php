<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'ClassAutoLoad.php';

$ObjLayout->header();
$ObjLayout->navbar();
// $ObjLayout->banner();
$ObjLayout->read_file();
$ObjLayout->footer();