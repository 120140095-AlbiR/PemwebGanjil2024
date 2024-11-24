<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: form.php");
    exit;
}

$data = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .result-container {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            border-radius: 10px;
            width: 1000px;
        }
        .result-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        button {
            display: block;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h1>Registration Result</h1>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Name</td>
                <td><?= htmlspecialchars($data['name']) ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= htmlspecialchars($data['email']) ?></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><?= htmlspecialchars($data['age']) ?></td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td><?= htmlspecialchars($data['dob']) ?></td>
            </tr>
            <tr>
                <td>Uploaded File Content</td>
                <td><pre><?= htmlspecialchars($data['fileContent']) ?></pre></td>
            </tr>
            <tr>
                <td>Browser/OS</td>
                <td><?= htmlspecialchars($data['userAgent']) ?></td>
            </tr>
        </table>
    </div>
</body>
</html>
