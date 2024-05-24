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