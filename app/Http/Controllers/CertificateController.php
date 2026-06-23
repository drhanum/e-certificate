<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Certificate;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CertificateTemplate;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function download(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);
        $format = strtolower($request->query('format', 'pdf'));

        $isAdmin = Auth::user() && Auth::user()->role === 'admin' && Auth::user()->id === $certificate->user_id;
        $isOwner = Auth::user() && Auth::user()->email === $certificate->email;

        if (!$isAdmin && !$isOwner) {
            abort(403);
        }

        $template = $certificate->certificateTemplate;

        if (!$template) {
            return back()->with('error', 'Template sertifikat tidak ditemukan');
        }

        if (in_array($format, ['png', 'jpg', 'jpeg'], true)) {
            $pdfPath = null;
            $imagePath = null;

            try {
                $pdfPath = $this->renderCertificatePdf($certificate, $template);
                $imagePath = $this->convertCertificatePdfToImage($pdfPath, $format);

                @unlink($pdfPath);

                $extension = $format === 'jpeg' ? 'jpg' : $format;
                $contentType = $format === 'png' ? 'image/png' : 'image/jpeg';

                return response()->download(
                    $imagePath,
                    $certificate->certificate_number . '.' . $extension,
                    [
                        'Content-Type' => $contentType,
                    ]
                )->deleteFileAfterSend(true);
            } catch (\Throwable $e) {
                if ($pdfPath && file_exists($pdfPath)) {
                    @unlink($pdfPath);
                }

                if ($imagePath && file_exists($imagePath)) {
                    @unlink($imagePath);
                }

                throw $e;
            }
        }

        $pdf = Pdf::loadView(
            'certificate.pdf',
            compact(
                'certificate',
                'template'
            )
        );

        return $pdf->download(
            $certificate->certificate_number . '.pdf'
        );
    }

    private function renderCertificatePdf(Certificate $certificate, CertificateTemplate $template): string
    {
        $pdfPath = $this->makeTemporaryFilePath('certificate_', '.pdf');

        Pdf::loadView(
            'certificate.pdf',
            compact(
                'certificate',
                'template'
            )
        )->save($pdfPath);

        return $pdfPath;
    }

    private function convertCertificatePdfToImage(string $pdfPath, string $format): string
    {
        $normalizedFormat = $format === 'jpeg' ? 'jpg' : $format;
        $imagePath = $this->makeTemporaryFilePath('certificate_', '.' . $normalizedFormat);
        $scriptPath = base_path('scripts/pdf_to_image.py');

        if (!file_exists($scriptPath)) {
            abort(500, 'Script converter PDF ke gambar tidak ditemukan');
        }

        $descriptorSpec = [
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $process = proc_open(
            [
                $this->pythonBinary(),
                $scriptPath,
                $pdfPath,
                $imagePath,
                $normalizedFormat,
            ],
            $descriptorSpec,
            $pipes,
            base_path()
        );

        if (!is_resource($process)) {
            abort(500, 'Gagal menjalankan converter PDF ke gambar');
        }

        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        $exitCode = proc_close($process);

        if ($exitCode !== 0) {
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }

            $message = trim($stderr ?: $stdout);

            abort(500, $message !== '' ? $message : 'Gagal mengonversi PDF ke gambar');
        }

        if (!file_exists($imagePath)) {
            abort(500, 'Hasil konversi gambar tidak ditemukan');
        }

        return $imagePath;
    }

    private function makeTemporaryFilePath(string $prefix, string $extension): string
    {
        $basePath = tempnam(sys_get_temp_dir(), $prefix);

        if ($basePath === false) {
            abort(500, 'Gagal membuat file sementara');
        }

        $targetPath = $basePath . $extension;

        if (!@rename($basePath, $targetPath)) {
            @unlink($basePath);
            abort(500, 'Gagal menyiapkan file sementara');
        }

        return $targetPath;
    }

    private function pythonBinary(): string
    {
        $windowsPython = 'C:\\Python314\\python.exe';

        if (PHP_OS_FAMILY === 'Windows' && file_exists($windowsPython)) {
            return $windowsPython;
        }

        return PHP_OS_FAMILY === 'Windows' ? 'python' : 'python3';
    }

    // Public JSON endpoint to check certificate by its number
    public function check($number)
    {
        $certificate = Certificate::where('certificate_number', $number)->first();

        if (!$certificate) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'certificate' => [
                'id' => $certificate->id,
                'name' => $certificate->name,
                'email' => $certificate->email,
                'event_name' => $certificate->event_name,
                'organizer_name' => $certificate->organizer_name,
                'event_date' => $certificate->event_date,
                'certificate_issue_date' => $certificate->certificate_issue_date,
                'valid_until' => $certificate->valid_until,
                'category' => $certificate->category,
                'certificate_number' => $certificate->certificate_number,
            ],
        ]);
    }

    public function index()
    {
        $userId = Auth::id();

        $events = Certificate::where('user_id', $userId)
        ->select(
            'event_name',
            'organizer_name',
            'event_date'
        )
        ->selectRaw('COUNT(*) as total_peserta')
        ->groupBy(
            'event_name',
            'organizer_name',
            'event_date'
        )
        ->get();

        return view(
            'admin.sertifikat',
            compact('events')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'organizer_name' => 'required|string|max:255',
            'activity_type' => 'required|string',
            'event_date' => 'required|date',
            'certificate_issue_date' => 'required|date',
            'certificate_prefix' => 'required|string|max:20',
            'certificate_start_number' => 'required|integer|min:1',
            'template' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'excel' => 'required|file|mimes:xlsx,xls|max:5120',
        ], [
            'event_name.required' => 'Nama event wajib diisi.',
            'organizer_name.required' => 'Nama penyelenggara wajib diisi.',
            'activity_type.required' => 'Jenis kegiatan wajib dipilih.',
            'event_date.required' => 'Tanggal event wajib diisi.',
            'certificate_issue_date.required' => 'Tanggal terbit sertifikat wajib diisi.',
            'certificate_prefix.required' => 'Prefix nomor sertifikat wajib diisi.',
            'certificate_prefix.string' => 'Prefix nomor sertifikat harus berupa teks.',
            'certificate_prefix.max' => 'Prefix nomor sertifikat maksimal 20 karakter.',
            'certificate_start_number.required' => 'Inisiasi nomor sertifikat wajib diisi.',
            'certificate_start_number.integer' => 'Inisiasi nomor sertifikat harus berupa angka.',
            'certificate_start_number.min' => 'Inisiasi nomor sertifikat tidak boleh kurang dari 1.',
            'template.required' => 'Template sertifikat wajib diunggah.',
            'template.image' => 'Template harus berupa file gambar.',
            'template.mimes' => 'Template harus berformat png, jpg, atau jpeg.',
            'excel.required' => 'File Excel peserta wajib diunggah.',
            'excel.mimes' => 'File peserta harus berformat xlsx atau xls.',
        ]);

        $templatePath = $request->file('template')
            ->store('templates', 'public');

        $template = CertificateTemplate::create([

            'template_path' => $templatePath,

            'name_x' => $request->name_left,
            'name_y' => $request->name_top,

            'category_x' => $request->category_left,
            'category_y' => $request->category_top,

            'number_x' => $request->number_left,
            'number_y' => $request->number_top,

            'name_color' => $request->name_color,
            'name_size' => $request->name_size,

            'category_color' => $request->category_color,
            'category_size' => $request->category_size,

            'number_color' => $request->number_color,
            'number_size' => $request->number_size,
            'user_id' => Auth::id()
        ]);

        $data = Excel::toArray([], $request->file('excel'));

        $prefix = strtoupper($validated['certificate_prefix']);
        $startNumber = $validated['certificate_start_number'];

        foreach ($data[0] as $index => $row) {

            Certificate::create([

                'name' => $row[0],
                'email' => $row[1],

                'event_name' => $request->event_name,
                'organizer_name' => $request->organizer_name,
                'event_date' => $request->event_date,

                'certificate_number' =>
                    $prefix .
                    '-' .
                    date('Y') .
                    '-' .
                    str_pad($startNumber + $index, 4, '0', STR_PAD_LEFT),

                'certificate_issue_date' =>
                    $request->certificate_issue_date,

                'activity_type' =>
                    $request->activity_type,

                'category' =>
                    ucfirst($row[2]),

                'valid_until' =>
                    $request->valid_until,

                'file_path' => null,
                'user_id' => Auth::id(),
                'certificate_template_id' => $template->id, // Link to the created template
            ]);
        }

        return redirect('/admin/sertifikat')
            ->with('success', 'Sertifikat berhasil dibuat');
    }

    public function show($event)
    {
        $event = str_replace('+', ' ', $event);
        $userId = Auth::id();

        $certificates = Certificate::where('user_id', $userId)
        ->where('event_name', $event)
        ->get();

        return view(
            'admin.detail_sertifikat',
            compact('certificates')
        );
    }

    public function detail($id)
    {
        $certificate = Certificate::findOrFail($id);

        $isAdmin = Auth::user() && Auth::user()->role === 'admin' && Auth::user()->id === $certificate->user_id;
        $isOwner = Auth::user() && Auth::user()->email === $certificate->email;

        if (!$isAdmin && !$isOwner) {
            abort(403);
        }

        return view('user.certificate_detail', compact('certificate'));
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('ids', []);
        $userId = Auth::id();

        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal satu sertifikat untuk dihapus');
        }

        Certificate::whereIn('id', $ids)->where('user_id', $userId)->delete();

        return back()->with('success', count($ids) . ' sertifikat berhasil dihapus');
    }

    public function destroyEvent(Request $request)
    {
        $events = $request->input('events', []);
        $userId = Auth::id();

        if (empty($events)) {
            return back()->with('error', 'Pilih minimal satu event untuk dihapus');
        }

        $count = 0;
        foreach ($events as $eventName) {
            $count += Certificate::where('user_id', $userId)->where('event_name', $eventName)->delete();
        }

        return back()->with('success', $count . ' sertifikat dari ' . count($events) . ' event berhasil dihapus');
    }
}
