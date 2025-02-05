<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Client Example</title>
</head>

<body>

    <h1>API Client Example</h1>

    <button id="getButton">GET Data</button>
    <button id="postButton">POST Data</button>

    <script type="module">
    // board.js에서 작성한 코드 사용
    import {
        getBoardPosts,
        createPost,
        updatePost,
        deletePost
    } from './assets/js/board.js';

    // GET 요청 버튼 클릭 시 처리
    document.getElementById('getButton').addEventListener('click', async () => {
        await getBoardPosts();
    });

    // POST 요청 버튼 클릭 시 처리
    document.getElementById('postButton').addEventListener('click', async () => {
        const data = {
            title: 'New Post',
            content: 'This is the content of the new post.',
            author: "test"
        };
        await createPost(data)
    });
    </script>

</body>

</html>