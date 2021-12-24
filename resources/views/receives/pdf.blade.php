
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
          <style>
           @font-face {
                font-family: "THSarabunNew";
                font-style: normal;
                font-weight: normal;
                src: url("{{ public_path("fonts/THSarabunNew.ttf") }}") format("truetype");
            }
            @font-face {
                font-family: "THSarabunNew";
                font-style: normal;
                font-weight: bold;
                src: url("{{ public_path("fonts/THSarabunNew Bold.ttf") }}") format("truetype");
            }
            @font-face {
                font-family: "THSarabunNew";
                font-style: italic;
                font-weight: normal;
                src: url("{{ public_path("fonts/THSarabunNew Italic.ttf") }}") format("truetype");
            }
            @font-face {
                font-family: "THSarabunNew";
                font-style: italic;
                font-weight: bold;
                src: url("{{ public_path("fonts/THSarabunNew BoldItalic.ttf") }}") format("truetype");
            }
     
            body {
                font-family: "THSarabunNew";
                font-size:16;
               

            }
        </style>
</head>
<body> 
    <h3 align="center" style="font-size:28;">ทะเบียนรับหนังสือ</h3>
    <table width="100%" style="border-collapse: collapse; border: 0px;">
    <tr>
    <th style="border: 1px solid; padding:5px; font-size:18;" >เลขทะเบียนรับ</th>
    <th style="border: 1px solid; padding:5px; font-size:18;" >วันที่ลงรับ</th>
    <th style="border: 1px solid; padding:5px; font-size:18;" >จาก</th>
    <th style="border: 1px solid; padding:5px; font-size:18;" >เรื่อง</th>
    <th style="border: 1px solid; padding:5px; font-size:18;" >วันที่เอกสาร</th>
    </tr>
        @foreach ($documents as $document )
            <tr>
                <td style="border: 1px solid; padding:5px; text-align:center; width: 2%">{{ $document->receive_code }}</td>
                <td style="border: 1px solid; padding:5px; text-align:center; width: 3%">{{ $document->thai_date2 }}</td>
                <td style="border: 1px solid; padding:5px; text-align:center; width: 3%">{{ $document->creator->full_name }}</td>
                <td style="border: 1px solid; padding:5px; text-align:center; width: 10%">{{ $document->title }}</td>
                <td style="border: 1px solid; padding:5px; text-align:center; width: 3%">{{ $document->thai_date }}</td>
            </tr>
        @endforeach
    </table> 
</body>
</html>

