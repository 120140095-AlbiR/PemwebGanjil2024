<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = trim($_POST['age']);
    $dob = trim($_POST['dob']);
    $file = $_FILES['file'];

    // Server-side validation
    if (strlen($name) < 3) $errors[] = "Name must be at least 3 characters.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (!is_numeric($age) || $age < 1) $errors[] = "Age must be a positive number.";
    if (empty($dob)) $errors[] = "Date of Birth cannot be empty.";
    if ($file['type'] !== 'text/plain') $errors[] = "Only .txt files are allowed.";
    if ($file['size'] > 1024 * 1024) $errors[] = "File size must be less than 1MB.";

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: form.php");
        exit;
    }

    // Process file
    $fileContent = file_get_contents($file['tmp_name']);
    $_SESSION['data'] = [
        'name' => $name,
        'email' => $email,
        'age' => $age,
        'dob' => $dob,
        'fileContent' => $fileContent,
        'userAgent' => $_SERVER['HTTP_USER_AGENT'],
    ];

    header("Location: result.php");
    exit;
}
