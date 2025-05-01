<?php

session_start();
if (isset($_SESSION['alert'])) {
    // Register a shutdown function to unset the alert after the request finishes
    register_shutdown_function(function () {
        unset($_SESSION['alert']);
    });
}