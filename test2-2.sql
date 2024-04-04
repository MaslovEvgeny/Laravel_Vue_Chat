select users.name , COUNT(phone_numbers.phone) AS колво_номеров
from phone_numbers,users
where users.id = phone_numbers.user_id
  and users.gender = 2
  and extract ( 'Year' from age(TO_TIMESTAMP(users.birth_date))) >= 18
  and extract ( 'Year' from age(TO_TIMESTAMP(users.birth_date))) <= 22
group by users.id