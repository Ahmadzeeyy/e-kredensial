<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Kredensial - {{ $data['nama_asesi'] }}</title>
    @php
        $logoPath = public_path('assests/img/logo rs.png');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/png;base64,' . $logoData;
        }

        $customBg = \App\Models\Setting::get('certificate_background');
        $bgBase64 = '';
        if ($customBg && file_exists(public_path($customBg))) {
            $bgData = base64_encode(file_get_contents(public_path($customBg)));
            $bgBase64 = 'data:image/png;base64,' . $bgData;
        }
    @endphp
    <style>
        @page { size: A4 landscape; margin: 0; }
        html, body { 
            margin: 0; padding: 0; 
            width: 297mm; height: 210mm; 
            overflow: hidden; background: #fff;
        }

        .certificate-container {
            width: 297mm;
            height: 210mm;
            position: relative;
            background: #fff;
            box-sizing: border-box;
            overflow: hidden;
            @if($bgBase64)
                background-image: url("{{ $bgBase64 }}");
                background-size: 100% 100%;
            @else
                border: 15px solid #0F172A; /* Bingkai Navy Utama */
            @endif
        }

        @if(!$bgBase64)
        .inner-frame {
            position: absolute;
            top: 10px; left: 10px; right: 10px; bottom: 10px;
            border: 2px solid #D4AF37; /* Garis Emas Penyeimbang */
            z-index: 1;
        }
        @endif

        .content {
            position: relative;
            z-index: 10;
            padding: 50px 110px; /* Ditambah agar logo tidak mepet ke bingkai */
            text-align: center;
        }

        .header-table { width: 100%; margin-bottom: 25px; }
        .logo-img { height: 80px; }
        .rs-name { font-size: 18pt; font-weight: bold; color: #0F172A; text-transform: uppercase; }
        .gov-name { font-size: 11pt; font-weight: bold; color: #64748b; letter-spacing: 1px; }

        .cert-title { font-size: 52pt; font-weight: bold; color: #0F172A; margin: 5px 0; letter-spacing: 3px; }
        .cert-subtitle { font-size: 18pt; color: #D4AF37; font-weight: bold; letter-spacing: 6px; margin-bottom: 30px; }

        .label-text { font-size: 14pt; color: #64748b; margin-bottom: 10px; }
        .name { font-size: 40pt; font-weight: bold; color: #0F172A; margin: 10px 0; border-bottom: 2px solid #D4AF37; display: inline-block; padding: 0 40px; }
        .jabatan { font-size: 18pt; font-weight: bold; color: #334155; margin-top: 5px; }

        .description { font-size: 13pt; color: #334155; line-height: 1.6; margin: 25px auto; width: 85%; }
        .highlight { font-weight: bold; color: #0F172A; }

        .footer-area {
            position: absolute;
            bottom: 45px;
            left: 100px;
            right: 100px;
        }
        .footer-table { width: 100%; }
        .sig-box { width: 50%; text-align: center; vertical-align: bottom; }
        .sig-name { font-weight: bold; font-size: 15pt; color: #0F172A; border-bottom: 1px solid #0F172A; display: inline-block; padding: 0 20px; }
        .sig-title { font-size: 11pt; color: #64748b; margin-top: 4px; }

        .cert-info { position: absolute; bottom: 15px; width: 100%; text-align: center; font-size: 8pt; color: #cbd5e1; }
    </style>
</head>
<body>
    <div class="certificate-container">
        @if(!$bgBase64)
            <div class="inner-frame"></div>
        @endif
        
        <div class="content">
            <table class="header-table">
                <tr>
                    <td style="width: 120px; text-align: center;">
                        @if($logoBase64)
                            <img src="{{ $logoBase64 }}" class="logo-img">
                        @else
                            <div style="height: 95px; width: 95px; background: #eee;"></div>
                        @endif
                    </td>
                    <td style="text-align: left; padding-left: 20px;">
                        <div class="gov-name">PEMERINTAH KOTA SURABAYA</div>
                        <div class="rs-name">RSUD dr. MOHAMAD SOEWANDHIE</div>
                    </td>
                </tr>
            </table>

            <h1 class="cert-title">SERTIFIKAT</h1>
            <div class="cert-subtitle">KREDENSIAL TENAGA KESEHATAN</div>

            <p class="label-text">Diberikan Kepada :</p>
            <div class="name">{{ $data['nama_asesi'] }}</div>
            <div class="jabatan">{{ $data['jabatan'] }}</div>

            <p class="description">
                Telah dinyatakan <span class="highlight">LULUS</span> dan memenuhi standar kompetensi dalam rangkaian proses 
                Kredensial / Rekredensial pada unit kerja <span class="highlight">{{ $data['unit_kerja'] }}</span> di lingkungan 
                <strong>RSUD dr. Mohamad Soewandhie Surabaya</strong>.
            </p>

            <div class="footer-area">
                <table class="footer-table">
                    <tr>
                        <td class="sig-box">
                            <p style="font-size: 11pt; color: #64748b; margin-bottom: 55px;">Surabaya, {{ $data['tanggal_selesai'] }}</p>
                            <div class="sig-name">{{ $data['nama_asesi'] }}</div>
                            <div class="sig-title">Tenaga Kesehatan</div>
                        </td>
                        <td class="sig-box">
                            <p style="font-size: 11pt; color: #64748b; margin-bottom: 10px;">Asesor Penguji,</p>
                            <div style="height: 60px;">
                                @if(!empty($kredensial->data_asesor['ttd_asesor']))
                                    <img src="{{ $kredensial->data_asesor['ttd_asesor'] }}" style="max-height: 60px;">
                                @endif
                            </div>
                            <div class="sig-name">{{ $data['nama_asesor'] }}</div>
                            <div class="sig-title">Asesor Kompetensi</div>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="cert-info">
                No. Sertifikat: {{ $data['nomor_sertifikat'] }} | Dokumen Elektronik Sah RSUD dr. Mohamad Soewandhie
            </div>
        </div>
    </div>
</body>
</html>
