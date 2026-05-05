<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 03A - Cheklist Observasi</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        :root {
            --primary: #1a5fa8;
            --secondary: #3b9de8;
            --bg-color: #f0f6ff;
            --card-bg: #FFFFFF;
            --border-color: #cbd5e1;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: linear-gradient(135deg, #e8f0fc 0%, #f0f9ff 50%, #e8f4f0 100%); color: var(--text-main); padding: 2rem 2rem 6rem; min-height: 100vh; }
        .container { max-width: 1400px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; background: white; padding: 1.5rem 2rem; border-radius: 16px; box-shadow: 0 4px 24px rgba(13,43,85,0.05); }
        h1 { font-size: 1.4rem; font-weight: 700; color: var(--primary); letter-spacing: -0.02em; }
        
        .card { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(13,43,85,0.05); border: 1px solid rgba(255,255,255,0.5); margin-bottom: 1.5rem; }
        
        .info-grid { display: grid; grid-template-columns: auto 1fr auto 1fr; gap: 12px 24px; margin-bottom: 30px; font-size: 13.5px; background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #f1f5f9; }
        .info-label { font-weight: 600; color: var(--text-muted); }
        
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; border: 2px solid #34d399; margin-bottom: 2rem; font-size: 12.5px; }
        th { background: #86efac; padding: 12px; text-align: center; font-weight: 800; color: #14532d; border: 1px solid #34d399; text-transform: uppercase; letter-spacing: 0.02em; }
        td { padding: 8px 10px; border: 1px solid #cbd5e1; background: white; vertical-align: top; line-height: 1.4; color: #334155; }
        
        .col-no { text-align: center; font-weight: 800; font-size: 14px; }
        
        .radio-group { display: flex; justify-content: center; align-items: center; width: 100%; height: 100%; }
        .radio-group input { cursor: pointer; width: 16px; height: 16px; }
        .radio-ya, .radio-k { accent-color: #10B981 !important; }
        .radio-tdk, .radio-bk { accent-color: #EF4444 !important; }

        .keputusan-cell { vertical-align: bottom; padding-bottom: 15px; }
        .keputusan-wrapper { display: flex; flex-direction: column; align-items: center; gap: 5px; font-weight: 700; color: #64748b; font-size: 11px; }

        .btn { padding: 0.7rem 1.4rem; border-radius: 10px; font-weight: 600; cursor: pointer; border: none; font-size: 13.5px; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; box-shadow: 0 4px 12px rgba(26,95,168,0.25); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,95,168,0.35); }
        .btn-secondary { background: white; border: 1.5px solid #cbd5e1; color: #475569; }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 1rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 1rem; z-index: 100; box-shadow: 0 -4px 20px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>FORM-03A (Cheklist Observasi)</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Penilaian observasi lapangan sesuai kriteria unit.</p>
            </div>
            <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <form action="{{ route('admin.form3a.store', $kredensial->id) }}" method="POST" style="padding-bottom: 80px;">
            @csrf
            <div class="card">
                <div class="info-grid">
                    <div class="info-label">Nama</div>
                    <div>: {{ $kredensial->nama_asesi }}</div>
                    <div class="info-label">Tanggal/waktu</div>
                    <div>: {{ \Carbon\Carbon::now()->format('d F Y H:i') }}</div>
                    
                    <div class="info-label">Nama Asessor</div>
                    <div>: {{ auth()->user()->name }}</div>
                    <div class="info-label">Tempat</div>
                    <div>: RSUD dr. M. Soewandhie Surabaya</div>
                </div>

                @php
                    $saved = $kredensial->data_form3a ?? [];
                    // Fallback to array if old data format is weird
                    if(!is_array($saved)) $saved = [];

                    $data = [
                        [
                            'no' => '1',
                            'unit' => "Pengkajian\n- Pelajari data\n- Kumpulan data focus pasien (biopsikososio spiritual) yang",
                            'kep_id' => 'kep_1',
                            'items' => [
                                ['id' => '1_1', 'kriteria' => '1.1. Alat yang', 'point' => 'Alat-alat'],
                                ['id' => '1_2', 'kriteria' => '1.2. Kondisi', 'point' => 'Alat-alat'],
                                ['id' => '1_3', 'kriteria' => '1.3. Tujuan', 'point' => 'Menyampaika'],
                                ['id' => '1_4', 'kriteria' => '1.4. Data', 'point' => 'Melakukan'],
                                ['id' => '1_5', 'kriteria' => '1.5. Data', 'point' => 'Melakukan'],
                                ['id' => '1_6', 'kriteria' => '1.6. Data', 'point' => 'Memeriksa'],
                            ]
                        ],
                        [
                            'no' => '2',
                            'unit' => "Diagnosa\nKeperawatan",
                            'kep_id' => 'kep_2',
                            'items' => [
                                ['id' => '2_1', 'kriteria' => '2.1. Data dari', 'point' => 'Data focus'],
                                ['id' => '2_2', 'kriteria' => '2.2. masalah', 'point' => 'Merumuskan'],
                            ]
                        ],
                        [
                            'no' => '3',
                            'unit' => "Perencanaan",
                            'kep_id' => 'kep_3',
                            'items' => [
                                ['id' => '3_1', 'kriteria' => '3.1. Masalah', 'point' => 'Ketepatan'],
                                ['id' => '3_2', 'kriteria' => '3.2. Tujuan', 'point' => 'Ketepatan'],
                                ['id' => '3_3', 'kriteria' => '3.3. Tindakan', 'point' => 'Ketepatan'],
                            ]
                        ],
                        [
                            'no' => '4',
                            'unit' => "IMPLEMENTASI",
                            'sub_units' => [
                                [
                                    'unit' => '4.1. menerapkan prinsip infeksi Nosokomial',
                                    'kep_id' => 'kep_4_1',
                                    'items' => [
                                        ['id' => '4_1_4', 'kriteria' => '4.1.4. Cuci', 'point' => 'Melakukan'],
                                        ['id' => '4_1_5', 'kriteria' => '4.1.5. Prinsip', 'point' => 'Ketepatan'],
                                        ['id' => '4_1_6', 'kriteria' => '4.1.6. Proteksi', 'point' => 'Menggunakan'],
                                        ['id' => '4_1_7', 'kriteria' => '4.1.7.', 'point' => 'Membuang'],
                                    ]
                                ],
                                [
                                    'unit' => '4.2.Mempasilitasi pemenuhan kebutuhan oksigen',
                                    'kep_id' => 'kep_4_2',
                                    'items' => [
                                        ['id' => '4_2_1', 'kriteria' => '4.2.1. Tujuan', 'point' => 'Menjelaskan'],
                                        ['id' => '4_2_2', 'kriteria' => '4.2.2. Kondisi', 'point' => 'Memeriksa'],
                                        ['id' => '4_2_3', 'kriteria' => '4.2.3. posisi', 'point' => 'Memberikan'],
                                        ['id' => '4_2_4', 'kriteria' => '4.2.4.', 'point' => 'Melakukan'],
                                        ['id' => '4_2_5', 'kriteria' => '4.2.5. Tehnik', 'point' => 'Ketepatan'],
                                        ['id' => '4_2_6', 'kriteria' => '4.2.6. Respon', 'point' => 'Ketepatan'],
                                    ]
                                ],
                                [
                                    'unit' => '4.3.Memfasilitasi pemenuhan cairan dan elektrolit',
                                    'kep_id' => 'kep_4_3',
                                    'items' => [
                                        ['id' => '4_3_1', 'kriteria' => '4.3.1. Macam', 'point' => 'Menyiapkan'],
                                        ['id' => '4_3_2', 'kriteria' => '4.3.2.', 'point' => 'Alat-alat'],
                                        ['id' => '4_3_3', 'kriteria' => '4.3.3. Tehnik', 'point' => 'Melakukan'],
                                        ['id' => '4_3_4', 'kriteria' => '4.3.4. Tetesan', 'point' => '- Melakukan'],
                                        ['id' => '4_3_5', 'kriteria' => '4.3.5. Kondisi', 'point' => 'Melakukan'],
                                    ]
                                ],
                                [
                                    'unit' => '4.4.Melakukan perawatan luka',
                                    'kep_id' => 'kep_4_4',
                                    'items' => [
                                        ['id' => '4_4_1', 'kriteria' => '4.4.1. Kondisi', 'point' => 'Mengidentifik'],
                                        ['id' => '4_4_2', 'kriteria' => '4.4.2. tujuan dan prosedur dijelaskan', 'point' => 'Menjelaskan tujuan dan prosedur tindakan Keperawatan ada pasien dan keluarga'],
                                        ['id' => '4_4_3', 'kriteria' => '4.4.3.Daftar alat kebutuhan peralatan diidentifikasi sesuai standar', 'point' => 'Menyiapkan alat penggantian balutan sesuai standar (persiapan alat steril dan non steril)'],
                                        ['id' => '4_4_4', 'kriteria' => '4.4.4.Jenis bahan dan obat atau order antiseptic sesuai order ditentukan', 'point' => 'Kesesuaian jenis bahan dan obat dengan order dan tahap penyembuhan luka'],
                                        ['id' => '4_4_5', 'kriteria' => '4.4.5. Penggunaan balutan luka secara steril dilakukan sesuai dengan SPO', 'point' => 'Melakukan perawatan luka sesuai SPO'],
                                        ['id' => '4_4_6', 'kriteria' => '4.4.6. Cara-cara untuk menurunkan rasa nyeri disaat penggantian balutan diidentifikasi', 'point' => "1. melakukan komunikasi therapeutic\n2. melakukan tehnik relaksasi sesuai kondisi pasien\n3. mengatur posisi yang tepat"],
                                    ]
                                ],
                                [
                                    'unit' => '4.5.Mengukur tanda-tanda vital',
                                    'kep_id' => 'kep_4_5',
                                    'items' => [
                                        ['id' => '4_5_1', 'kriteria' => '4.5.1. Set alat pengukuran TTV dipersiapkan', 'point' => 'Alat-alat pengukuran TTV dipersiapkan sesuai denga SPO'],
                                        ['id' => '4_5_2', 'kriteria' => '4.5.2. Pengukuran tekanan darah dilakukan', 'point' => "Menentukan nadi Brachialis, pengembanga n cuff sesuai kondisi klien, menempatkan stetoskop dengan tepat, membaca hasil dengan tepat."],
                                        ['id' => '4_5_3', 'kriteria' => '4.5.3. Pengukuran suhu tubuh dilakukan', 'point' => 'Melakukan pengukuran suhu tubuh sesuai standar alat yang digunakan'],
                                        ['id' => '4_5_4', 'kriteria' => '4.5.4. Pengukuran nadi klien dilakukan', 'point' => 'Pengukuran nadi klien dilakukan dalam 1 menit (sesuai kondisi klien)'],
                                        ['id' => '4_5_5', 'kriteria' => '4.5.5. Pengukuran pernafasan dilakukan', 'point' => 'Pengukuran nadi klien dilakukan dalam 1 menit'],
                                        ['id' => '4_5_6', 'kriteria' => '4.5.6. Set alat pengukuran TTV dibersihkan dan diletakkan kembali ketempatnya', 'point' => 'Membersihka n dan meletakkan alat set TTV ketempatnya semula'],
                                    ]
                                ],
                                [
                                    'unit' => '4.6. Memberikan obat secara aman dan tepat',
                                    'kep_id' => 'kep_4_6',
                                    'items' => [
                                        ['id' => '4_6_2', 'kriteria' => '4.6.2 Obat-obatan yang diperoleh klien dipersiapkan', 'point' => 'Mempersiapka n obat dan mengecek dengan 7 benar'],
                                        ['id' => '4_6_3', 'kriteria' => '4.6.3. Alat dan obat-obatan disiapkan sesuai tehnik pemberian', 'point' => 'Menyiapkan alat dan obat sesuai dengan tehnik pemberian'],
                                        ['id' => '4_6_4', 'kriteria' => '4.6.4. Pemberian obat-obatan dilaksanakan', 'point' => 'Melakukan pemberian obat dengan tehnik yang tepat sesuai denga SPO'],
                                        ['id' => '4_6_5', 'kriteria' => '4.6.5. Berbagai kategori efek dan reaksi obat yang utama dideteksi', 'point' => 'Menanyakan dan mengobservas i pasien efek ndan reaksi obat yang diberikan (terutama obat injeksi)'],
                                    ]
                                ],
                                [
                                    'unit' => '4.7.Mengelola Pemberian darah dan produk darak secara aman',
                                    'kep_id' => 'kep_4_7',
                                    'items' => [
                                        ['id' => '4_7_1', 'kriteria' => '4.7.1. Kebutuhan dan tujuan akan produk darah disampaikan', 'point' => 'Menyampaika n kepada pasien dan atau keluarga kebutuhan dan tujuan pemberian produk darah'],
                                        ['id' => '4_7_2', 'kriteria' => '4.7.2. Kebutuhan alat diidentifikasi sesuai SPO', 'point' => 'Menyiapkan alat-alat sesuai standar'],
                                        ['id' => '4_7_3', 'kriteria' => '4.7.3. Produk darah yang akan diberi diperiksa kembali', 'point' => 'Melakukan pengecekan silang terhadap produk darah menyesuaikan suhu produk darah'],
                                        ['id' => '4_7_4', 'kriteria' => '4.7.4. Jumlah pemberian order dipastikan', 'point' => 'Melakukan pengecekan pemberian jumlah produk darah'],
                                        ['id' => '4_7_5', 'kriteria' => '4.7.5. Pemberian darah dilakukan dengan benar', 'point' => 'Melakukan pemberian transfuse sesuai dengan SPO'],
                                        ['id' => '4_7_6', 'kriteria' => '4.7.6. Respon setelah pemberian transfuse diidentifikasi', 'point' => 'Melakukan identifikasi respon dengan menanyakan Keperawatan ada klien terkait reaksi yang terjadi dan melakukan pengukuran TTV pada 5 mni pertama'],
                                    ]
                                ],
                            ]
                        ],
                        [
                            'no' => '5',
                            'unit' => 'Evaluasi/Mengevaluasi efektifitas tindakan',
                            'kep_id' => 'kep_5',
                            'items' => [
                                ['id' => '5_1', 'kriteria' => '5.1 Hasil evaluasi dicatat pada CPPT', 'point' => 'Mencatat hasil evaluasi secara langsung pada CPPT'],
                                ['id' => '5_3', 'kriteria' => '5.3. Keputusan diambil berdasarkan hasil telaah, mencakup tujuan tercapai, tidak tercapai atau tercapai sebagian', 'point' => 'Mengambil Keputusan ketercapaian tujuan setelah membandingk an dengan criteria hasil Keputusan ditulis pada catatan perkembangan'],
                                ['id' => '5_4', 'kriteria' => '5.4. Untuk tujuan yang belum tercapai dilakukan kaji ulang terhadap tahap-tahap pencegahan dan perencanaan dimodifikasi', 'point' => 'Melakukan kaji ulang untuk tujuan yang belum tercapai dan melakukan modifikasi perencanaan'],
                            ]
                        ],
                        [
                            'no' => '6',
                            'unit' => 'Menerapkan prinsip etika dalam Keperawatan',
                            'kep_id' => 'kep_6',
                            'items' => [
                                ['id' => '6_1', 'kriteria' => '6.1. Prinsip-prinsip moral (Universal) diterapkan selama berhubungan dengan klien', 'point' => 'Menerapkan prinsip-prinsip moral selama berhubungan dengan klien (respek, Privacy, beneficiens, otonomi, justice dan lain-lain'],
                                ['id' => '6_2', 'kriteria' => '6.2. Sikap Empati diperlihatkan', 'point' => 'Memperlihatk an sikap empati ketika berhadapan dan mendengarkan klien'],
                                ['id' => '6_3', 'kriteria' => '6.3. Issue Etik diidentifikasi', 'point' => 'Memperlihatk an respon terhadap issue etik selama memberikan asuhan Keperawatan'],
                            ]
                        ],
                        [
                            'no' => '7',
                            'unit' => 'Melakukan komunikasi interpersonal dalam melaksanakan tindakan Keperawatan',
                            'kep_id' => 'kep_7',
                            'items' => [
                                ['id' => '7_1', 'kriteria' => '7.1. Melakukan pra Interaksi', 'point' => 'Memperkenal kan diri dan mengkalrifikas i identitas pasien, melakukan kontrak setiap berhubungan dengan pasien'],
                                ['id' => '7_2', 'kriteria' => '7.2. Tujuan interaksi disampaiak', 'point' => 'Menyampaika n tujuan interaksi pada setiap awal melakukan tindakan Keperawatan'],
                                ['id' => '7_3', 'kriteria' => '7.3. Tehnik komunikasi dilakukan', 'point' => 'Melakukan tehnik komunikasi therapeutic sesuai SPO'],
                                ['id' => '7_4', 'kriteria' => '7.4. Klien atau keluarga diberi kesempatan untuk bertanya klarifikasi', 'point' => 'Memberi kesempatan ada klien atau keluarga untuk bertanya/klarif ikasi selama tindakan Keperawatan'],
                                ['id' => '7_5', 'kriteria' => '7.5. Komunikasi melalui telpon dilaksanakan', 'point' => 'Melaporkan kondisi pasien menggunakan SBAR'],
                                ['id' => '7_6', 'kriteria' => '7.6. Terminasi dilakukan', 'point' => 'Melakukan terminasi pada setiap akhir tindakan dan akhir dari pertemuan dengan pasien dan keluarganya'],
                            ]
                        ],
                        [
                            'no' => '8',
                            'unit' => 'Menciptakan dan memelihara lingkungan perawatan secara aman melalui jaminan mutu dan manajemen resiko',
                            'kep_id' => 'kep_8',
                            'items' => [
                                ['id' => '8_1', 'kriteria' => '8.1. Kondisi resiko bahaya/trauma bagi pasien diidentifikasi', 'point' => 'Mengidentifik asi lingkungan yang beresiko bahay/trauma pada pasien'],
                                ['id' => '8_2', 'kriteria' => '8.2. Lingkungan yang aman bagi klien difasilitasi untuk dipenuhi', 'point' => 'Melakukan pengamanan pasien (Patient Safety_ memasang side rell, lingkungan tidak licin, linen kering dan tidak kusut dan tehnik isolasi'],
                            ]
                        ]
                    ];

                    $flatRows = [];
                    foreach ($data as $unitBlock) {
                        if (isset($unitBlock['items'])) {
                            $itemCount = count($unitBlock['items']);
                            foreach ($unitBlock['items'] as $i => $item) {
                                $row = [
                                    'id' => $item['id'],
                                    'kriteria' => $item['kriteria'],
                                    'point' => $item['point'],
                                ];
                                if ($i == 0) {
                                    $row['no'] = $unitBlock['no'];
                                    $row['no_span'] = $itemCount;
                                    $row['unit'] = $unitBlock['unit'];
                                    $row['unit_span'] = $itemCount;
                                    $row['kep_id'] = $unitBlock['kep_id'];
                                    $row['kep_span'] = $itemCount;
                                }
                                $flatRows[] = $row;
                            }
                        } elseif (isset($unitBlock['sub_units'])) {
                            $totalItems = 1; 
                            foreach ($unitBlock['sub_units'] as $sub) {
                                $totalItems += count($sub['items']);
                            }
                            
                            $flatRows[] = [
                                'is_header' => true,
                                'no' => $unitBlock['no'],
                                'no_span' => $totalItems,
                                'unit' => $unitBlock['unit'],
                                'unit_span' => 1,
                            ];
                            
                            foreach ($unitBlock['sub_units'] as $sub) {
                                $subCount = count($sub['items']);
                                foreach ($sub['items'] as $i => $item) {
                                    $row = [
                                        'id' => $item['id'],
                                        'kriteria' => $item['kriteria'],
                                        'point' => $item['point'],
                                    ];
                                    if ($i == 0) {
                                        $row['unit'] = $sub['unit'];
                                        $row['unit_span'] = $subCount;
                                        $row['kep_id'] = $sub['kep_id'];
                                        $row['kep_span'] = $subCount;
                                    }
                                    $flatRows[] = $row;
                                }
                            }
                        }
                    }
                @endphp

                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 4%;">NO</th>
                            <th rowspan="2" style="width: 16%;">UNIT</th>
                            <th rowspan="2" style="width: 25%;">KRITERIA UNIT</th>
                            <th rowspan="2" style="width: 25%;">POINT YANG</th>
                            <th colspan="2" style="width: 15%;">PENCAPAIAN</th>
                            <th colspan="2" style="width: 15%;">KEPUTUSAN</th>
                        </tr>
                        <tr>
                            <th style="width: 7.5%;">YA</th>
                            <th style="width: 7.5%;">TDK</th>
                            <th style="width: 7.5%;">K</th>
                            <th style="width: 7.5%;">BK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($flatRows as $row)
                            @if(isset($row['is_header']) && $row['is_header'])
                                <tr>
                                    <td class="col-no" rowspan="{{ $row['no_span'] }}">{{ $row['no'] }}</td>
                                    <td colspan="7" style="font-weight: 700; text-transform: uppercase;">{!! nl2br(e($row['unit'])) !!}</td>
                                </tr>
                            @else
                                <tr>
                                    @if(isset($row['no']))
                                        <td class="col-no" rowspan="{{ $row['no_span'] }}">{{ $row['no'] }}</td>
                                    @endif
                                    
                                    @if(isset($row['unit']))
                                        <td rowspan="{{ $row['unit_span'] }}">{!! nl2br(e($row['unit'])) !!}</td>
                                    @endif
                                    
                                    <td>{{ $row['kriteria'] }}</td>
                                    <td>{!! nl2br(e($row['point'])) !!}</td>
                                    
                                    @php
                                        $pencapaian = $saved[$row['id']]['pencapaian'] ?? '';
                                    @endphp
                                    <td>
                                        <div class="radio-group">
                                            <input type="radio" class="radio-ya" name="form3a[{{ $row['id'] }}][pencapaian]" value="YA" {{ $pencapaian == 'YA' ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio-group">
                                            <input type="radio" class="radio-tdk" name="form3a[{{ $row['id'] }}][pencapaian]" value="TDK" {{ $pencapaian == 'TDK' ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    
                                    @if(isset($row['kep_id']))
                                        @php
                                            $kep = $saved[$row['kep_id']]['keputusan'] ?? '';
                                        @endphp
                                        <td rowspan="{{ $row['kep_span'] }}" class="keputusan-cell">
                                            <div class="keputusan-wrapper">
                                                <input type="radio" class="radio-k" name="form3a[{{ $row['kep_id'] }}][keputusan]" value="K" {{ $kep == 'K' ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td rowspan="{{ $row['kep_span'] }}" class="keputusan-cell">
                                            <div class="keputusan-wrapper">
                                                <input type="radio" class="radio-bk" name="form3a[{{ $row['kep_id'] }}][keputusan]" value="BK" {{ $kep == 'BK' ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <div style="display: flex; justify-content: center; margin-top: 4rem; text-align: center;">
                    <div style="display: flex; flex-direction: column; align-items: center; gap: 4rem; font-weight: 700; color: #334155;">
                        <div style="text-transform: uppercase;">ASESSOR</div>
                        <div style="font-weight: 500;">{{ auth()->user()->name }}</div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Form 3A</button>
            </div>
        </form>
    </div>
</body>
</html>
