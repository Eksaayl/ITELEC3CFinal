<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Details Form</title>
    <style>
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f1f1f1;
        }
        input[disabled], textarea[disabled] {
            cursor: not-allowed;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: not-allowed; /* Add this to indicate the button is static */
            border-radius: 4px;
        }
        button[disabled] {
            background-color: #cccccc; /* Make it look disabled */
        }
    </style>
</head>
<body>
    <div>
        <h2>User Details Form</h2>
        <form>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="John Doe" disabled>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="30" disabled>

            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="Software Engineer" disabled>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" disabled>John is an experienced software engineer working in full-stack development.
            </textarea>

            <label for="date_published">Date Published</label>
            <input type="date" id="date_published" name="date_published" value="2023-08-12" disabled>

            <button type="submit" disabled>Submit</button>
        </form>
    </div>
</body>
</html>
