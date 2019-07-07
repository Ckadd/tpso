# Software specification
- PHP 7.1 ขึ้นไป
- Laravel 5.7
- mysql Ver 8.0.12

# การติดตั้ง

หลังจากเตรียม environment สำหรับการพัฒนาแล้ว ให้ clone code จาก bitbucket repository หลังจากนั้น run คำสั่ง

```
composer install
```
ภายใต้ root directory จากนั้นสร้างไฟล์ .env ไว้ที่ root directory โดยการคัดลอกจากไฟล์ .env.example ข้อมูลที่สำคัญที่ควรแก้ไขในไฟล์ .env เช่น

```
DB_CONNECTION=mysql 
DB_HOST=localhost # mysql host 
DB_PORT=3306 # mysql port
DB_DATABASE=dot_db # mysql ชื่อฐานข้อมูล 
DB_USERNAME=root # mysql username
DB_PASSWORD=root # mysql password
```

# Migrations

หลังจากการตืดตั้งและทำการตั้งค่าในไฟล์ .env แล้ว จากนั้นให้ run คำสั่งเพื่อสร้าง table ของ database

**ในกรณีที่ทำการติดตั้งเป็นครั้งแรก ให้ run คำสั่ง**
```
php artisan voyager:install --with-dummy
```
**ก่อนเป็นลำดับแรก เพื่อสร้าง table ใน database ที่เกี่ยวข้องกับ package voyager**

จากนั้น run คำสั่งเพื่อ migration และ seed ข้อมูลบางส่วนเข้า database

```
php artisan migrage
php artisan db:seed --class=DotSeeder
```

# Admin Backed

```
backend url: /admin
username: admin@admin.com
password: password
```

# Run fixer เพื่อจัดรูปแบบ Code ให้เหมือนกัน

run คำสั่งด้านล่างภายใต้ root directory

```
composer cs
```

# Flow ของการ dev
- ทุกครั้งที่จะทำ feature ใหม่ ให้สร้าง branch ใหม่ขึ้นมาทุกครั้ง
- อย่า push code เข้า branch master โดยตรงให้สร้าง pull request ทุกครั้ง เพื่อให้เกิดการ review code ทุกครั้ง ก่อนการ merge เข้า branch master
- ลำดับการ merge เข้าสู่ branch master จะขึ้นอยู่ตามความเหมาะสม
- ทุกครั้งที่มีการ merge code ใหม่เข้าสู่ branch master developer ที่กำลังทำงานอยู่ใน branch อื่นจะต้อง pull code จาก branch master มาก่อนทุกครั้ง ก่อนการ push code หรือสร้าง pull request เพื่อป้องการการ conflict ของ code ที่อาจเกิดขึ้นได้ในภายหลัง