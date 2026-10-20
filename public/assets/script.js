console.log("LinkUp loaded successfully.");
console.log("AJAX comment script is ready.");

document.addEventListener("DOMContentLoaded", function () {

    const commentForms = document.querySelectorAll(".ajax-comment-form");

    console.log("Comment forms found:", commentForms.length);

    commentForms.forEach(function (form) {

        form.addEventListener("submit", function (event) {

            event.preventDefault();

            const postId = form.getAttribute("data-post-id");
            const input = form.querySelector('input[name="content"]');
            const message = form.querySelector(".ajax-comment-message");

            const content = input.value.trim();

            if (content === "") {
                message.textContent = "Comment cannot be empty.";
                return;
            }

            const formData = new FormData();

            formData.append("post_id", postId);
            formData.append("content", content);
            formData.append("ajax", "1");

            fetch("index.php?action=ajax_create_comment", {
                method: "POST",
                body: formData
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {

                if (data.success) {

                    // Find the comments list
                    const commentsSection =
                    form.closest(".comments");

                    let commentsList =
                    commentsSection.querySelector(".comments-list");

                    if (!commentsList) {

                    commentsList = document.createElement("div");

                    commentsList.className = "comments-list";

                    commentsSection.insertBefore(
                    commentsList,
                    form
                    );

                    const noComments =
                    commentsSection.querySelector(".no-comments");

                    if (noComments) {
                    noComments.remove();
                }
            }

                    // Create the new comment
                    const commentBox =
                        document.createElement("div");

                    commentBox.className = "comment-item";

                    const safeContent =
                        content
                            .replace(/&/g, "&amp;")
                            .replace(/</g, "&lt;")
                            .replace(/>/g, "&gt;")
                            .replace(/"/g, "&quot;")
                            .replace(/'/g, "&#039;");

                    commentBox.innerHTML = `
                        <div class="comment-header">
                            <strong>You</strong>
                            <small>Just now</small>
                        </div>

                        <p class="comment-content">
                            ${safeContent}
                        </p>
                    `;

                    // Add the new comment
                    commentsList.appendChild(commentBox);

                    // Clear input
                    input.value = "";

                    // Show success message
                    message.textContent = data.message;

                } else {

                    message.textContent = data.message;

                }

            })
            .catch(function (error) {

                console.error("AJAX error:", error);

                message.textContent =
                    "Something went wrong. Please try again.";

            });

        });

    });

});