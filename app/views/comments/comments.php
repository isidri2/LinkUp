```php
<?php
// Comment view for LinkUp
// Expected variables:
// $comments = array of comments for the current post
// $post = the current post (if available)

if (!isset($comments) || !is_array($comments)) {
    $comments = [];
}
?>

<div class="comments-section">
    <h3>Comments</h3>

    <?php if (empty($comments)): ?>
        <p class="no-comments">No comments yet. Be the first to comment!</p>
    <?php else: ?>

        <?php foreach ($comments as $comment): ?>
            <div class="comment-item">
                <div class="comment-header">
                    <strong>
                        <?= htmlspecialchars(
                            $comment["full_name"] ?? $comment["username"] ?? "User",
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>
                    </strong>

                    <?php if (!empty($comment["created_at"])): ?>
                        <small>
                            <?= htmlspecialchars(
                                $comment["created_at"],
                                ENT_QUOTES,
                                "UTF-8"
                            ) ?>
                        </small>
                    <?php endif; ?>
                </div>

                <p class="comment-content">
                    <?= nl2br(htmlspecialchars(
                        $comment["content"] ?? "",
                        ENT_QUOTES,
                        "UTF-8"
                    )) ?>
                </p>

                <?php if (
                    isset($_SESSION["user_id"], $comment["user_id"]) &&
                    (int) $_SESSION["user_id"] === (int) $comment["user_id"]
                ): ?>
                    <div class="comment-actions">
                        <a href="index.php?action=edit_comment&amp;id=<?= (int) $comment["id"] ?>">
                            Edit
                        </a>

                        <form
                            action="index.php?action=delete_comment"
                            method="POST"
                            onsubmit="return confirm('Delete this comment?');"
                        >
                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int) $comment["id"] ?>"
                            >

                            <button type="submit">Delete</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</div>
```