<?php

require_once "./config/database.php";

try {
    $db = Database::getInstance()->getConnection();

    $sql = "
    CREATE TABLE IF NOT EXISTS board (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        author VARCHAR(100) NOT NULL,
        views INT UNSIGNED DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";

    $sql = "
    INSERT INTO board (title, content, author) VALUES 
    ('첫 번째 게시글', '이것은 첫 번째 게시글 내용입니다.', '박영재'),
    ('두 번째 게시글', '이것은 두 번째 게시글 내용입니다.', '관리자');
    ";

    $db->exec($sql);
    echo "✅ 'board' 테이블이 성공적으로 생성되었습니다.";
} catch (PDOException $e) {
    die("❌ 테이블 생성 실패: " . $e->getMessage());
}

?>