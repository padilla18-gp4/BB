<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "scheduling_system"
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>