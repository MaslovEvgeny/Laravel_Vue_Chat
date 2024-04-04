select users.email , COUNT(messages.id) AS колво_непр_сообщ
from messages,users
where users.id = messages.user_id_from
  and messages.is_viewed != true
group by users.email
having COUNT(messages.id) >= 5
