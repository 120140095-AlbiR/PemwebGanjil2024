<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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
        .form-container {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            border-radius: 10px;
            width: 400px;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateForm(event) {
            let isValid = true;
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const age = document.getElementById('age');
            const dob = document.getElementById('dob');
            const file = document.getElementById('file');
            const errors = document.querySelectorAll('.error');
            errors.forEach(error => error.textContent = '');

            if (name.value.trim().length < 3) {
                document.getElementById('nameError').textContent = "Name must be at least 3 characters.";
                isValid = false;
            }
            if (!email.value.includes('@')) {
                document.getElementById('emailError').textContent = "Invalid email format.";
                isValid = false;
            }
            if (isNaN(age.value) || age.value < 1) {
                document.getElementById('ageError').textContent = "Age must be a positive number.";
                isValid = false;
            }
            if (!dob.value) {
                document.getElementById('dobError').textContent = "Date of Birth cannot be empty.";
                isValid = false;
            }
            if (file.files.length === 0) {
                document.getElementById('fileError').textContent = "Please upload a .txt file.";
                isValid = false;
            } else if (file.files[0].type !== 'text/plain') {
                document.getElementById('fileError').textContent = "Only .txt files are allowed.";
                isValid = false;
            } else if (file.files[0].size > 1024 * 1024) {
                document.getElementById('fileError').textContent = "File size must be less than 1MB.";
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <div class="form-container">
        <form action="process.php" method="post" enctype="multipart/form-data" onsubmit="validateForm(event)">
            <h1>Registration Form</h1>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
                <div class="error" id="nameError"></div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
                <div class="error" id="emailError"></div>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age">
                <div class="error" id="ageError"></div>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob">
                <div class="error" id="dobError"></div>
            </div>
            <div class="form-group">
                <label for="file">Upload a .txt file:</label>
                <input type="file" id="file" name="file" accept=".txt" required>
                <div class="error" id="fileError"></div>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

