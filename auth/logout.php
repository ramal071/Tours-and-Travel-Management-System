<?php

session_start();
session_unset();
session_destroy();

header("location: http://localhost/udemy/ceylon_travel/")
?>