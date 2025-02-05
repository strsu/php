// board.js
import ApiClient from "./ApiClient.js"; // ApiClient를 board.js에 import

// ApiClient 인스턴스 생성
const apiClient = new ApiClient("http://localhost:8080");

// 게시판 게시글 목록 가져오기
async function getBoardPosts() {
  try {
    const posts = await apiClient.get("/board.php"); // GET 요청 보내기
    console.log(posts); // 게시글 목록을 콘솔에 출력
  } catch (error) {
    console.error("게시글을 가져오는 중 오류 발생:", error);
  }
}

// 게시판에 새 게시글 추가하기
async function createPost(title, content, author) {
  try {
    const newPost = await apiClient.post("/board.php", {
      title: title,
      content: content,
      author: author,
    });
    console.log("새 게시글 추가 완료:", newPost);
  } catch (error) {
    console.error("게시글 추가 중 오류 발생:", error);
  }
}

// 게시판 게시글 수정하기
async function updatePost(id, title, content) {
  try {
    const updatedPost = await apiClient.put(`/board/${id}`, {
      title: title,
      content: content,
    });
    console.log("게시글 수정 완료:", updatedPost);
  } catch (error) {
    console.error("게시글 수정 중 오류 발생:", error);
  }
}

// 게시판 게시글 삭제하기
async function deletePost(id) {
  try {
    const response = await apiClient.delete(`/board/${id}`);
    console.log("게시글 삭제 완료:", response);
  } catch (error) {
    console.error("게시글 삭제 중 오류 발생:", error);
  }
}

export { getBoardPosts, createPost, updatePost, deletePost };
