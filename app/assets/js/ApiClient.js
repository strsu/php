class ApiClient {
  constructor(baseUrl) {
    this.baseUrl = baseUrl;
  }

  async request(endpoint, method = "GET", data = null) {
    const options = {
      method,
      headers: {
        "Content-Type": "application/json",
      },
    };

    if (data) {
      options.body = JSON.stringify(data);
    }

    try {
      const response = await fetch(`${this.baseUrl}${endpoint}`, options);
      return await response.json();
    } catch (error) {
      console.error("API 요청 실패:", error);
      return { status: "error", message: "네트워크 오류 발생" };
    }
  }

  get(endpoint) {
    return this.request(endpoint, "GET");
  }

  post(endpoint, data) {
    return this.request(endpoint, "POST", data);
  }

  put(endpoint, data) {
    return this.request(endpoint, "PUT", data);
  }

  delete(endpoint, data = null) {
    return this.request(endpoint, "DELETE", data);
  }
}

// ApiClient 클래스를 내보내기
export default ApiClient;

// 사용 예시
// const api = new ApiClient("http://localhost/api/");

// // 게시글 목록 가져오기 (GET)
// api.get("board.php").then(console.log);

// // 게시글 추가 (POST)
// api.post("board.php", { title: "새 게시글", content: "내용입니다.", author: "영재" }).then(console.log);

// // 게시글 수정 (PUT)
// api.put("board.php", { id: 1, title: "수정된 제목", content: "수정된 내용" }).then(console.log);

// // 게시글 삭제 (DELETE)
// api.delete("board.php", { id: 1 }).then(console.log);
