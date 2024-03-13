SELECT group_id, COUNT(*) AS user_count
FROM users
GROUP BY group_id
HAVING COUNT(*) > 10000;
