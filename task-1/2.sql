SELECT u.*
FROM users u
JOIN (
    SELECT group_id, MAX(posts_qty) AS max_posts
    FROM users
    GROUP BY group_id
) AS max_posts_per_group ON u.group_id = max_posts_per_group.group_id AND u.posts_qty = max_posts_per_group.max_posts;
