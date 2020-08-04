<body>
    นี่คือ E-mail ของระบบ <b>Smart e-Dcoument System</b>
    <br/>
    <h3> จาก <b>{{$document->school->name}} </h3>
    <br/>
    คุณสามารถดูรายละเอียดเอกสารเพิ่มเติมได้ <a href="{{ route("document.sharing", $document->link()->first()->token) }}">ที่นี่</a>
    <br/>

    <footer>
        <img class="mr-1" src="https://edoc.mode-education.com/image/icon-logo.png" alt="" srcset="">
    </footer>
</body>