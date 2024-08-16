<?php
include 'db.php';

$sql = "SELECT id, title, author, published_date FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['published_date']}</td>
                <td>
                    <a href='editbook.php?id={$row['id']}' class='button'>Edit</a>
                    <a href='deletebook.php?id={$row['id']}' class='button delete'>Delete</a>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No books found</td></tr>";
}

$conn->close();
?>
