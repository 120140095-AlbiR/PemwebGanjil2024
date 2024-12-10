CREATE DATABASE book_management;

USE book_management;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_name VARCHAR(255) NOT NULL,
    number_of_books INT NOT NULL,
    genre VARCHAR(255) NOT NULL
);

INSERT INTO books (book_name, number_of_books, genre) VALUES
('Laskar Pelangi', 10, 'Fiction'),
('Bumi Manusia', 8, 'Historical Fiction'),
('War and Peace', 3, 'Historical Fiction'),
('The Odyssey', 9, 'Epic Poetry'),
('Negeri 5 Menara', 12, 'Fiction'),
('The Hobbit', 12, 'Fantasy'),
('Ayat-Ayat Cinta', 15, 'Romance'),
('Supernova', 7, 'Science Fiction'),
('Perahu Kertas', 9, 'Romance'),
('Moby Dick', 4, 'Adventure'),
('Crime and Punishment', 5, 'Psychological Fiction'),
('Harry Potter and the Philosopher's Stone', 20, 'Fantasy'),
('To Kill a Mockingbird', 18, 'Fiction'),
('The Great Gatsby', 10, 'Fiction'),
('Pride and Prejudice', 14, 'Romance'),
('The Catcher in the Rye', 11, 'Fiction'),
('1984', 13, 'Dystopian'),
('The Lord of the Rings', 9, 'Fantasy'),
('The Hunger Games', 14, 'Dystopian'),
('The Fault in Our Stars', 11, 'Romance'),
('The Book Thief', 9, 'Historical Fiction'),
('Twilight', 13, 'Fantasy'),
('The Chronicles of Narnia', 8, 'Fantasy'),
('The Girl with the Dragon Tattoo', 7, 'Mystery'),
('The Shining', 6, 'Horror');