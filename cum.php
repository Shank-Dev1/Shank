<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory and Webhook Setup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container h1 {
            text-align: center;
        }
        .form-container input[type="text"], 
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Set Up Directory and Webhook</h1>
    <form action="process.php" method="get">
        <label for="dir">Directory Name:</label>
        <input type="text" id="dir" name="dir" required>

        <label for="web">Webhook URL:</label>
        <input type="text" id="web" name="web" required>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
