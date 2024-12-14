<?php

    include 'connect.php';

    setcookie('employee_id', '', time() - 1, '/');
    header('location: ../employee/login.php');
?>