<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sertifikat</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto px-6 py-10">

        <div class="bg-white rounded-xl shadow p-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold">Detail Sertifikat</h1>
                    <p class="text-gray-500">Informasi lengkap sertifikat Anda.</p>
                </div>
                <button onclick="history.back()" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    Kembali
                </button>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold mb-4">Data Event</h2>
                    <div class="space-y-3 text-sm text-gray-700">
                        <div>
                            <span class="font-medium">Nama Event:</span>
                            {{ $certificate->event_name }}
                        </div>
                        <div>
                            <span class="font-medium">Nama Penyelenggara:</span>
                            {{ $certificate->organizer_name }}
                        </div>
                        <div>
                            <span class="font-medium">Jenis Kegiatan:</span>
                            {{ $certificate->activity_type }}
                        </div>
                        <div>
                            <span class="font-medium">Tanggal Event:</span>
                            {{ \Carbon\Carbon::parse($certificate->event_date)->format('d M Y') }}
                        </div>
                        <div>
                            <span class="font-medium">Tanggal Terbit Sertifikat:</span>
                            {{ \Carbon\Carbon::parse($certificate->certificate_issue_date)->format('d M Y') }}
                        </div>
                        <div>
                            <span class="font-medium">Masa Aktif:</span>
                            {{ $certificate->valid_until ? \Carbon\Carbon::parse($certificate->valid_until)->format('d M Y') : '-' }}
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold mb-4">Data Peserta</h2>
                    <div class="space-y-3 text-sm text-gray-700">
                        <div>
                            <span class="font-medium">Nama:</span>
                            {{ $certificate->name }}
                        </div>
                        <div>
                            <span class="font-medium">Email:</span>
                            {{ $certificate->email }}
                        </div>
                        <div>
                            <span class="font-medium">Kategori:</span>
                            {{ $certificate->category }}
                        </div>
                        <div>
                            <span class="font-medium">Nomor Sertifikat:</span>
                            {{ $certificate->certificate_number }}
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8 bg-white rounded-xl shadow-inner p-6 border border-gray-200">
                <h2 class="text-xl font-semibold mb-4">Tindakan</h2>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('certificate.download', ['id' => $certificate->id, 'format' => 'pdf']) }}"
                       class="inline-flex items-center gap-2 bg-green-100 text-green-700 px-4 py-2 rounded-lg hover:bg-green-200 transition">
                        <i class="fa-solid fa-download"></i>
                        PDF
                    </a>

                    <a href="{{ route('certificate.download', ['id' => $certificate->id, 'format' => 'png']) }}"
                       class="inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-200 transition">
                        <i class="fa-solid fa-image"></i>
                        Image
                    </a>
                </div>
            </div>

            <div class="mt-8 rounded-xl border border-yellow-200 bg-yellow-50 p-6">
                <h2 class="text-xl font-semibold mb-2">
                    Ajukan Perubahan Data
                </h2>

                <p class="text-sm text-gray-700 mb-4">
                    Jika ada kesalahan pada nama, email, kategori, atau data event, silakan hubungi admin yang membuat sertifikat ini agar bisa dilakukan pengecekan dan perbaikan.
                </p>

                @php
                    $adminEmail = optional($certificate->user)->email;
                    $emailSubject = 'Permohonan Perubahan Data Sertifikat ' . $certificate->certificate_number;
                    $emailBody = "Halo Admin,\n\nSaya ingin mengajukan perubahan data pada sertifikat berikut:\n- Nama: {$certificate->name}\n- Email: {$certificate->email}\n- Nomor Sertifikat: {$certificate->certificate_number}\n\nBagian data yang perlu diperbaiki:\n\nTerima kasih.";
                    $gmailComposeUrl = $adminEmail
                        ? 'https://mail.google.com/mail/?view=cm&fs=1'
                            . '&to=' . rawurlencode($adminEmail)
                            . '&su=' . rawurlencode($emailSubject)
                            . '&body=' . rawurlencode($emailBody)
                        : null;
                @endphp

                @if ($adminEmail)
                    <button
                       type="button"
                       id="contactAdminBtn"
                       data-compose-url="{{ $gmailComposeUrl }}"
                       class="inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-3 font-medium text-gray-700 border border-gray-300 hover:bg-gray-100 transition">
                        <i class="fa-solid fa-envelope"></i>
                        Hubungi Admin via Email
                    </button>
                @else
                    <div class="rounded-lg border border-yellow-300 bg-yellow-100 px-4 py-3 text-sm text-yellow-800">
                        Email admin belum tersedia untuk sertifikat ini.
                    </div>
                @endif
            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('contactAdminBtn');

            if (!btn) return;

            btn.addEventListener('click', function () {
                const url = btn.getAttribute('data-compose-url');

                if (!url) return;

                window.open(url, '_blank', 'noopener,noreferrer');
            });
        });
    </script>

</body>
</html>
