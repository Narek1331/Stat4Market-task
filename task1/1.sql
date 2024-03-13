SELECT u.*
FROM users u
JOIN users i ON u.invited_by_user_id = i.id
WHERE u.posts_qty > i.posts_qty;
