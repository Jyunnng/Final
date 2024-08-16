<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $published_date = $_POST['published_date'];

   
    $stmt = $conn->prepare("INSERT INTO books (title, author, published_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $published_date);

    if ($stmt->execute()) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
