<?php
require_once "Database.php";

class QueryExecutor {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // 🔹 SQL 쿼리 실행
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "쿼리 실행 오류: " . $e->getMessage()];
        }
    }

    // 🔹 SELECT 쿼리 실행 후 결과 가져오기
    public function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->execute($sql, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "쿼리 실행 오류: " . $e->getMessage()];
        }
    }

    // 🔹 단일 행 결과 가져오기 (SELECT)
    public function fetchOne($sql, $params = []) {
        try {
            $stmt = $this->execute($sql, $params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "쿼리 실행 오류: " . $e->getMessage()];
        }
    }

    // 🔹 INSERT, UPDATE, DELETE 쿼리 실행 (변경된 행 수 반환)
    public function executeUpdate($sql, $params = []) {
        /*
            $insertResult = $queryExecutor->executeUpdate("INSERT INTO board (title, content, author, created_at) VALUES (:title, :content, :author, NOW())", [
                "title" => "새 게시글",
                "content" => "게시글 내용입니다.",
                "author" => "영재"
            ]);
        */
        try {
            $stmt = $this->execute($sql, $params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return ["status" => "error", "message" => "쿼리 실행 오류: " . $e->getMessage()];
        }
    }

    // 🔹 트랜잭션 시작
    public function beginTransaction() {
        $this->db->beginTransaction();
    }

    // 🔹 트랜잭션 커밋
    public function commit() {
        $this->db->commit();
    }

    // 🔹 트랜잭션 롤백
    public function rollBack() {
        $this->db->rollBack();
    }
}
?>