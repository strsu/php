<?php
require_once './config/QueryExecutor.php';

// API 요청 메서드 확인
$method = $_SERVER['REQUEST_METHOD'];

// API 응답 헤더 설정
header('Content-Type: application/json');

// 데이터베이스 연결
$queryExecutor = new QueryExecutor();

// 요청을 처리하는 함수들
switch ($method) {
    case 'GET':
        handleGetRequest($queryExecutor);
        break;
    case 'POST':
        handlePostRequest($queryExecutor);
        break;
    case 'PUT':
        handlePutRequest($queryExecutor);
        break;
    case 'DELETE':
        handleDeleteRequest($queryExecutor);
        break;
    default:
        echo json_encode(["status" => "error", "message" => "지원되지 않는 요청입니다."]);
        break;
}

// GET 요청 처리
function handleGetRequest($queryExecutor) {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if ($id) {
        // 단일 게시글 가져오기
        $post = $queryExecutor->fetchOne("SELECT * FROM board WHERE id = :id", ['id' => $id]);
        echo json_encode($post);
    } else {
        // 모든 게시글 가져오기
        $posts = $queryExecutor->fetchAll("SELECT * FROM board ORDER BY created_at DESC");
        echo json_encode($posts);
    }
}

// POST 요청 처리 (새 게시글 추가)
function handlePostRequest($queryExecutor) {
    $data = json_decode(file_get_contents('php://input'), true); // JSON 입력 받기

    if (isset($data['title']) && isset($data['content']) && isset($data['author'])) {
        $title = $data['title'];
        $content = $data['content'];
        $author = $data['author'];

        $queryExecutor->executeUpdate("INSERT INTO board (title, content, author, created_at) VALUES (:title, :content, :author, NOW())", [
            'title' => $title,
            'content' => $content,
            'author' => $author,
        ]);

        echo json_encode(["status" => "success", "message" => "게시글이 성공적으로 추가되었습니다."]);
    } else {
        echo json_encode(["status" => "error", "message" => "필수 파라미터가 부족합니다."]);
    }
}

// PUT 요청 처리 (게시글 수정)
function handlePutRequest($queryExecutor) {
    $data = json_decode(file_get_contents('php://input'), true); // JSON 입력 받기

    if (isset($data['id']) && isset($data['title']) && isset($data['content'])) {
        $id = $data['id'];
        $title = $data['title'];
        $content = $data['content'];

        $queryExecutor->executeUpdate("UPDATE board SET title = :title, content = :content WHERE id = :id", [
            'id' => $id,
            'title' => $title,
            'content' => $content,
        ]);

        echo json_encode(["status" => "success", "message" => "게시글이 성공적으로 수정되었습니다."]);
    } else {
        echo json_encode(["status" => "error", "message" => "필수 파라미터가 부족합니다."]);
    }
}

// DELETE 요청 처리 (게시글 삭제)
function handleDeleteRequest($queryExecutor) {
    $data = json_decode(file_get_contents('php://input'), true); // JSON 입력 받기

    if (isset($data['id'])) {
        $id = $data['id'];

        $queryExecutor->executeUpdate("DELETE FROM board WHERE id = :id", ['id' => $id]);

        echo json_encode(["status" => "success", "message" => "게시글이 성공적으로 삭제되었습니다."]);
    } else {
        echo json_encode(["status" => "error", "message" => "게시글 ID가 필요합니다."]);
    }
}
?>