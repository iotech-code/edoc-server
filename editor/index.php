<?php
require __DIR__.'/../vendor/autoload.php';

use App\Models\OnlineDocument;

if(isset($_GET['edit'])) {
    $edit = OnlineDocument::where("id", $_GET['edit'])->get();
    print_r($edit);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>เอกสารไม่มีชื่อ - ตัวแก้ไขเอกสาร</title>
    <link rel="icon" type="image/x-icon" href="./theme/icons/document-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@400;500;700&family=Kanit:ital,wght@0,200;0,300;0,400;0,700;1,200;1,300;1,400;1,700&family=Sarabun:ital,wght@0,100;0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="./theme/css/edoc.css" rel="stylesheet">
</head>

<body data-editor="DecoupledDocumentEditor" data-collaboration="false" data-revision-history="false">
    <div class="document-container">
        <div class="toolbar">
            <div class="editor_icon">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#90CAF9" d="M40 45L8 45 8 3 30 3 40 13z"/><path fill="#E1F5FE" d="M38.5 14L29 14 29 4.5z"/><path fill="#1976D2" d="M16 21H33V23H16zM16 25H29V27H16zM16 29H33V31H16zM16 33H29V35H16z"/></svg>
            </div>
            <div class="topnav">
                <input type="text" name="_title" id="_title" class="input_title" placeholder="เอกสารไม่มีชื่อ">
                <span style="display: hidden;" id="save"></span>
                <a id="exitEditor">
                    <svg width="16px" height="16px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.657 18.657a1 1 0 0 1-.707-.293l-5.657-5.657a1 1 0 0 1 0-1.414l5.657-5.657a1 1 0 0 1 1.414 1.414L10.414 12l4.95 4.95a1 1 0 0 1-.707 1.707z" />
                    </svg>
                    ย้อนกลับ
                </a>
                <a id="openDocument">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M147.8 192H480V144C480 117.5 458.5 96 432 96h-160l-64-64h-160C21.49 32 0 53.49 0 80v328.4l90.54-181.1C101.4 205.6 123.4 192 147.8 192zM543.1 224H147.8C135.7 224 124.6 230.8 119.2 241.7L0 480h447.1c12.12 0 23.2-6.852 28.62-17.69l96-192C583.2 249 567.7 224 543.1 224z"/></svg>
                    เปิด
                </a>
                <a id="saveDocument">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path d="M433.941 129.941l-83.882-83.882A48 48 0 0 0 316.118 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V163.882a48 48 0 0 0-14.059-33.941zM224 416c-35.346 0-64-28.654-64-64 0-35.346 28.654-64 64-64s64 28.654 64 64c0 35.346-28.654 64-64 64zm96-304.52V212c0 6.627-5.373 12-12 12H76c-6.627 0-12-5.373-12-12V108c0-6.627 5.373-12 12-12h228.52c3.183 0 6.235 1.264 8.485 3.515l3.48 3.48A11.996 11.996 0 0 1 320 111.48z"/></svg>
                    บันทึก
                </a>

                <span id="documentStatus">เอกสารใหม่</span>
            </div>
        </div>
        <div id="toolbar-container"></div>
        <div class="minimap-wrapper">
            <div class="editor-container">
                <div id="editor"><?php //echo $edit->doc_body;?></div>
            </div>
            <div class="minimap-container"></div>
        </div>

    </div>
    <script src="./translations/th.js"></script>
    <script src="./editor.js"></script>
    <script src="./edocument-editor.js"></script>
</body>

</html>