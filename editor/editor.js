(function() {
    // Exit editor
    document.getElementById('exitEditor').addEventListener("click", () => {
        if(!confirm('คุณแน่ใจหรือไม่?')) { 
            return false; 
        } else { 
            history.back();
        }
    });

    document.getElementById('printDocument').addEventListener('click', () => {
        var id = document.getElementById('_id').value
        if(id == null) {
            alert("โปรดบันทึกไฟล์ก่อน")
            return false;
        } else {
            document.getElementById("saveDocument").click();
            setInterval(() => {
                id = document.getElementById('_id').value
                if(id!==null)
                    window.location.href='/storage/app/online_document/'+id+'.html';
            }, 2000)
        }
    })

    const doc_id = document.getElementById('_id').value
    if(doc_id == '') {
        document.getElementById("deleteDocument").style.display = 'none'
    }

    // Update title
    document.getElementById("openDocument").addEventListener( "click", openDocument.bind(this) )
    document.getElementById("deleteDocument").addEventListener( "click", deleteDocument.bind(this) )
    document.getElementsByClassName("close_button")[0].addEventListener( "click", () => {
        document.getElementById('openDialog').style.display = 'none'
    } )
    document.getElementById("_title").addEventListener( "change", changeTitle.bind(this) )

    function changeTitle (event) {
        if(event.target.value !== null)
            document.title = event.target.value + " - ตัวแก้ไขเอกสาร";
    }

    function deleteDocument () {
        if(!confirm("คุณต้องการลบไฟล์นี้ถาวรหรือไม่?")) {
            return false;
        }

        var id = document.getElementById('_id').value
        fetch('/online-document/'+id, {
            method: 'GET', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer'
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.status == 'success') {
                alert("ลบเรียบร้อยแล้ว");
                window.location.href='/'
            }
        })
    }

    function openDocument() {
        document.getElementById('openDialog').style.display = 'block'
        fetch('/mydocument', {
            method: 'GET', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer'
        })
        .then(res=>res.json())
        .then(data=>{
            var item
            document.getElementById('doclist').innerHTML = '<li></li>'
            
            data.forEach(file => {
                item = document.createElement('li')
                item.innerHTML = '<a href="/editor?edit='+file.id+'" target="_blank"><i class="fa fa-file"></i> '+file.doc_title+'</a>'
                document.getElementById('doclist').appendChild(item)
            })
        })
    }

})();