<?php
// // when offline
// session_start();
// define('ROOT_URL', 'http://localhost/ibelieve/');
// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'hakacdmf_edblog');

// when online
session_start();
define('ROOT_URL', 'http://ibelieve.hakateq.com/');
define('DB_HOST', 'localhost');
define('DB_USER', 'hakabvzf_edson');
define('DB_PASS', 'Eddiespacks2000@');
define('DB_NAME', 'hakabvzf_edblog');


//// ALTERING TABLES SQL
// ALTER TABLE posts ADD CONSTRAINT FK_blog_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL;

// ALTER TABLE posts ADD CONSTRAINT FK_blog_author FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE;