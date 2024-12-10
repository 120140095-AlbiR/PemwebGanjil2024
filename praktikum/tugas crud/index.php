<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Book Management</h2>

    <!-- Add Book Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Add Book</h3>
        </div>
        <div class="card-body">
            <form action="index.php" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" name="book_name" placeholder="Book Name" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="number" class="form-control" name="number_of_books" placeholder="Number of Books" required>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="form-control" name="genre" placeholder="Genre" required>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" name="add" class="btn btn-primary">Add Book</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "book_management";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Add Book
    if (isset($_POST['add'])) {
        $book_name = $_POST['book_name'];
        $number_of_books = $_POST['number_of_books'];
        $genre = $_POST['genre'];

        $sql = "INSERT INTO books (book_name, number_of_books, genre) VALUES ('$book_name', $number_of_books, '$genre')";
        $conn->query($sql);
    }

    // Delete Book
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM books WHERE id=$id";
        $conn->query($sql);
    }

    // Update Book
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $book_name = $_POST['book_name'];
        $number_of_books = $_POST['number_of_books'];
        $genre = $_POST['genre'];

        $sql = "UPDATE books SET book_name='$book_name', number_of_books=$number_of_books, genre='$genre' WHERE id=$id";
        $conn->query($sql);
    }

    // Pagination
    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $result = $conn->query("SELECT COUNT(*) AS total FROM books");
    $total_books = $result->fetch_assoc()['total'];
    $total_pages = ceil($total_books / $limit);

    $sql = "SELECT * FROM books LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
    ?>

    <!-- Book Table -->
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Book Name</th>
            <th>Number of Books</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['book_name']; ?></td>
                <td><?php echo $row['number_of_books']; ?></td>
                <td><?php echo $row['genre']; ?></td>
                <td>
                    <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Book</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="index.php" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label for="book_name">Book Name</label>
                                    <input type="text" class="form-control" name="book_name" value="<?php echo $row['book_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="number_of_books">Number of Books</label>
                                    <input type="number" class="form-control" name="number_of_books" value="<?php echo $row['number_of_books']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="genre">Genre</label>
                                    <input type="text" class="form-control" name="genre" value="<?php echo $row['genre']; ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
