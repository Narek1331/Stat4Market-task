SELECT u.*
FROM users u
JOIN users i ON u.invited_by_user_id = i.id
WHERE u.group_id != i.group_id;
