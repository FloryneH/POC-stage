import '../css/app.scss';

document.addEventListener('DOMContentLoaded', () => {
    new App();
});

class App {
    constructor() {
        this.handleCommentForm();
    }

    handleCommentForm() {
        const commentForm = document.querySelector('form.comment-form');
        if (null === commentForm) {
            return;
        }
        commentForm.addEventListener('submit', async (e) => {
            e.preventDefault(commentForm);

            const response = await fetch('/ajax/comments', {
                method: 'POST',
                body: new FormData(e.target),
            });

            if (!response.ok) {
                return;
            }
            const json = await response.json();
            if (json.code === 'COMMENT_ADDED_SUCCESSFULLY') {
                const commentList = document.querySelector('.comment-list');
                const commentCount = document.querySelector('.comment-count');
                const commentContent = document.querySelector('#comment_content');
                commentList.insertAdjacentHTML('beforeend', json.message);
                commentList.lastElementChild.scrollIntoView();
                commentCount.innerText = json.numberOfComments;
                commentContent.value = '';
            }
        })        
    }
}
