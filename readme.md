# Edocument Server
Powered by Laravel 

## Install

``` sh
cp env-example .env
```

then **Don't froget to edit your .env file**

``` sh
php artisan key:generate
php passport:client
php artisan migrate [--seed]

```

You can edit mock data seeder at [database/seeds/DatabaseSeeder.php](database/seeds/DatabaseSeeder.php)

## Seed all Mock Data

```sh
php artisan db:seed
```

## Clean Data

```sh
php artisan migrate:refresh [--seed]
```

## Flow

Create doc -> sent_to -> User -> comment back to sender -> get it -> forward to other;

in this flow if receiver is who can approval doc, it can be approved or cancel ;

# Model
- BackOfficeUser.php ─ ยูสเซอร์ที่ใช้ในการสร้างโรงเรียน (ทีมงานของ mode solution)
- Cabinet.php ─ ตู้เอกสาร
- Document.php ─ เอกสาร
- DocumentAttachment.php ─ ไฟล์ที่แนบไปกับเอกสาร
- DocumentComment.php ─ ความคิดเห็นในเอกสารนั้นๆ
- DocumentCommentAttachment.php ─ ไฟล์ที่แนบกับความคิดเห็นในเอกสารนั้นๆ
- DocumentReplyType.php ─ ประเภทการตอบกลับของเอกสาร
- DocumentStatus.php ─ (Entity) สถานะเอกสาร 
- DocumentType.php ─ ประเภทของเอกสารตามระบบงานราชการ
- Folder.php ─ แฟ้มเอกสาร (ผูกกับตู้อีกที)
- Role.php ─ (Entity) ประเภทของผู้ใช้ 
- School.php ─ (Entity) โรงเรียน 
- SharingDocument.php ─ เอกสารที่ถูกแชร์สู่โลกภายนอก
- User.p hp ─ (Entity) ผู้ใช้ (ครู แอดมินรร.) 

# Controller
ส่วนของ Web Controller
- CabinetController.php ─ จัดการตู้เอกสาร
- CabinetFolderController.php ─ จัดการแฟ้มเอกสารจาก ตู้เอกสาร
- DashBoardController.php ─ หน้าแรก แสดงสถิติของแอพ
- DocumentController.php ─ จัดการเอกสาร
- FeedBackController.php ─ จัดการฟีดแบค
- FileController.php ─ จัดกาไฟล์ต่างๆ
- OfficerController.php ─ จัดการบุคคลากรในโรงเรียน
- SharingDocumentController.php ─ จัดการแชร์เอกสาร
- UserController.php ─ จัดการโปรไฟล์ส่วนตัวของผู้ใช้

## Trait
ส่วนของ Trait
- CabinetFolderTrait.php ─ ส่วนประกอบของ  CabinetController.php ใช้จัดการแฟ้ม
- DocumentCommentTrait.php ─ ส่วนประกอบของ  DocumentController.php ใช้จัดการคอมเม้น
- DocumentRespondTrait.php ─ ส่วนประกอบของ  DocumentController.php ใช้จัดการตอบกลับ

## Api Controller
ส่วนของ Api RESTFUL Controller
- BaseApiController.php
- DocumentApiController.php
- UserApiController.php

## BackOffice Controller
ส่วนจัดการของฝ่ายเทคนิค (mode solution)


# Middleware 
- BackOfficerMiddleware ─ ส่วนของทีมงาน mode เข้าไปจัดการโรงเรียน

# Other 
- KeyValidator.php ─ ส่วนเชคคีย์​ใช้ Guzzle ในการส่ง Request เพื่อเช็คคีย์

# Helpers
ฟังชันน์ที่แยกออกมา (มีการใช้งานบ่อย)