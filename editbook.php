<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_date = $_POST['published_date'];

    $sql = "UPDATE books SET title='$title', author='$author', published_date='$published_date' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error updating book: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 50%;
            margin: auto;
            overflow: hidden;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
        }

        form {
            background-color: #ecf0f1;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }

        label, input, textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="date"], textarea {
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Book</h1>
        <form method="post" action="editbook.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo $row['author']; ?>" required>

            <label for="published_date">Published Date:</label>
            <input type="date" id="published_date" name="published_date" value="<?php echo $row['published_date']; ?>" required>

            <input type="submit" value="Update Book">
        </form>
    </div>
</body>
</html>
