<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>

@page {
    margin: 0;
    size: 1123px 794px;
}

html,
body {
    margin: 0;
    padding: 0;
    width: 1123px;
    height: 794px;
}

body {
    position: relative;
}

.template {
    position: relative;
    width: 1123px;
    height: 794px;
    page-break-inside: avoid;
}

.name,
.category,
.number {
    position: absolute;
    z-index: 999;
    white-space: nowrap;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
}

.name {
    font-weight: bold;
}

</style>

</head>
<body>

<div class="template">

    <img
        src="{{ public_path('storage/'.$template->template_path) }}"
        style="
            width:1123px;
            height:794px;
            position:absolute;
            top:0;
            left:0;
        "
    >

    <div class="name"
        style="
        top:{{$template->name_y}}px;
        color:{{$template->name_color}};
        font-size:{{$template->name_size}}px;
        font-weight:bold;
        ">
        {{ $certificate->name }}
    </div>

    <div class="number"
        style="
        top:{{$template->number_y}}px;
        color:{{$template->number_color}};
        font-size:{{$template->number_size}}px;
        ">
        {{ $certificate->certificate_number }}
    </div>

    <div class="category"
        style="
        top:{{$template->category_y}}px;
        color:{{$template->category_color}};
        font-size:{{$template->category_size}}px;
        ">
        {{ $certificate->category }}
    </div>

</div>

</body>
</html>