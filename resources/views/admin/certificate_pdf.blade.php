<!DOCTYPE html>
<html>
<body>

<img
src="{{ public_path('storage/'.$templatePath) }}"
style="
position:absolute;
width:100%;
height:100%;
">

<div style="text-align:center">

    <h1>SERTIFIKAT</h1>

    <p>
        No. {{ $certificate_number }}
    </p>

    <h2>
        {{ $name }}
    </h2>

    <h3>
        {{ $category }}
    </h3>

</div>

</body>
</html>