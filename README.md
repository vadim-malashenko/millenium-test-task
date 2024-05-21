# Installation

## Clone repo
```
git clone git@github.com:vadim-malashenko/millenium-test-task.git
cd millenium-test-task
composer install
```
## Create database
```
sudo apt install -y mariadb-server
mysql -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('31415'); DROP USER IF EXISTS ''@'localhost'; DROP DATABASE IF EXISTS test; FLUSH PRIVILEGES;"
for f in schema/*.sql; do mysql -uroot -p31415 < $f; done
```
## Serve
```
php -S 127.0.0.1:8080 -t .
```
# Task
![Task](https://raw.githubusercontent.com/vadim-malashenko/millenium-test-task/main/task.png)

1.
  1.
  2.
  3.
  ```
  CREATE TABLE orders
  (
      id                                             INT AUTO_INCREMENT PRIMARY KEY
      product_id                                     INT NOT NULL,
      created_at timestamp default CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP
  );
  CREATE TABLE user_orders
  (
      user_id                                        INT NOT NULL,
      order_id                                       INT NOT NULL
  );
  ALTER TABLE user_orders ADD UNIQUE (user_id, order_id);
 ```
2. Не уверен, но думаю что от меня хотят услышать что-то из этого: "Наследование", "Полиморфизм", "Шаблонный метод".
3. Первое - язык программирования, второе - РСУБД.
5. [Можно](https://github.com/vadim-malashenko/millenium-test-task/blob/main/src/App.php#L11)
