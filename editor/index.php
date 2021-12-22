<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ตัวแก้ไขเอกสาร</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@400;500;700&family=Kanit:ital,wght@0,200;0,300;0,400;0,700;1,200;1,300;1,400;1,700&family=Sarabun:ital,wght@0,100;0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link href="./theme/css/edoc.css" rel="stylesheet">
</head>
<body data-editor="DecoupledDocumentEditor" data-collaboration="false" data-revision-history="false">
<div class="document-container">
    <div class="topnav">
        <a href="#" onclick="if(!confirm('คุณแน่ใจหรือไม่?')) { return false; } else { history.back() }">          
            ย้อนกลับ
        </a>
        <a href="" id="save">
            บันทึก
        </a>
        <input type="text" name="_title" id="_title"  class="input_title" placeholder="ไฟล์ไม่มีชื่อ">
    </div>
    <div id="toolbar-container"></div>
    <div class="minimap-wrapper">
        <div class="editor-container">
            <div id="editor"></div>
        </div>
        <div class="minimap-container"></div>
    </div>

</div>
<script src="./translations/th.js"></script>
<script src="./edocument-editor.js"></script>
</body>
</html>
