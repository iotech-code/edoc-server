<?php

// Home
Breadcrumbs::for('cabinet.index', function ($trail) {
    $trail->push('ตู้เอกสาร', route('cabinet.index'));
});

Breadcrumbs::for('cabinet.create', function ($trail) {
    $trail->parent('cabinet.index', route('cabinet.index'));
    $trail->push('สร้างตู้เอกสาร', route('cabinet.create'));

});


Breadcrumbs::for('cabinet.edit', function ($trail) {
    $trail->parent('cabinet.index', route('cabinet.index'));
    $trail->push('แก้ไขตู้เอกสาร', route('cabinet.create'));

});
Breadcrumbs::for('folder.create', function ($trail, $cabinet) {
    $trail->push('ตู้เอกสาร', route('cabinet.index'));
    $trail->push('แฟ้มเอกสาร', route('cabinet.folder.index', $cabinet->id));
});

