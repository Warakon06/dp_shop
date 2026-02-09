FROM php:8.0-apache
# ... (คำสั่งอื่นๆ ของคุณ) ...

# --- เพิ่มส่วนนี้เข้าไปครับ ---
RUN docker-php-ext-install pdo pdo_mysql mysqli
# -------------------------

COPY . /var/www/html/
EXPOSE 80