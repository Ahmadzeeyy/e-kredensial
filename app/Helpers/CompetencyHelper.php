<?php

namespace App\Helpers;

class CompetencyHelper
{
    public static function getList()
    {
        return [
            'MEMBERIKAN ASUHAN KEPERAWATAN SEDERHANA' => [
                '1_a' => 'A Pengkajian keperawatan dasar individu',
                '1_b' => 'B Merumuskan diagnosis keperawatan individu',
                '1_c' => 'C Menyusun rencana tindakan',
                '1_d' => 'D Melakukan Evaluasi tindakan keperawatan pada individu',
                '1_e' => 'E Melakukan Pendokumentasian Tindakan keperawatan',
            ],
            'MELAKSANAKAN IMPLEMENTASI' => [
                'SUB_A' => [
                    'label' => 'A KESELAMATAN PASIEN',
                    'items' => [
                        '2_a_1' => '1) Mengidentifikasi pasien dengan benar',
                        '2_a_2' => '2) Melakukan Komunikasi terapeutik',
                        '2_a_3' => '3) Meningkatkan keamanan obat-obatan yang harus diwaspadai',
                        '2_a_4' => '4) Memastikan lokasi pembedahan yang benar, prosedur yang benar, pembedahan pada pasien yang benar',
                        '2_a_5' => '5) Memfasilitasi penggunaan alat pengaman fisik (pemasangan bed side rel, tanda resiko jatuh, matras anti dekubitus)',
                        '2_a_6' => '6) Memastikan lokasi pembedahan yang benar, prosedur yang benar, pembedahan pada pasien yang benar',
                        '2_a_7' => '7) Memfasilitasi sarana lingkungan yang tenang dan aman',
                    ]
                ],
                'SUB_B' => [
                    'label' => 'B ETIKA KEPERAWATAN',
                    'items' => [
                        '2_b_1' => '1) Menerapkan prinsip etika dalam profesi keperawatan (salam dan senyum dalam pelayanan)',
                        '2_b_2' => '2) Memberikan asuhan keperawatan dengan prinsip otonomi (menghormati hak pasien)',
                        '2_b_3' => '3) Memberikan asuhan keperawatan dengan prinsip beneficience (melakukan yang terbaik bagi pasien)',
                        '2_b_4' => '4) Memberikan asuhan keperawatan dengan prinsip justice (bersikap adil pada semua pasien)',
                        '2_b_5' => '5) Memberikan asuhan keperawatan dengan prinsip nonmaleficience (tidak merugikan pasien)',
                        '2_b_6' => '6) Memberikan asuhan keperawatan dengan prinsip veracity (jujur pada pasien dan keluarga)',
                        '2_b_7' => '7) Memberikan asuhan keperawatan dengan prinsip fidelity (menepati janji pada pasien dan keluarga)',
                        '2_b_8' => '8) Memberikan asuhan keperawatan dengan prinsip confidentialty (menjaga kerahasiaan pasien)',
                        '2_b_9' => '9) Memberikan asuhan keperawatan dengan prinsip accountability (kepastian sesuai standar profesi)',
                    ]
                ],
                'SUB_C' => [
                    'label' => 'C PENCEGAHAN PENGENDALIAN INFEKSI',
                    'items' => [
                        '2_c_1' => '1) Melakukan Hand hygiene dg 6 langkah 6 momen',
                        '2_c_2' => '2) Mampu menggunakan APD dengan benar dan sesuai indikasi',
                        '2_c_3' => '3) Membuang limbah dengan benar',
                        '2_c_4' => '4) Mengelola Linen dengan benar',
                        '2_c_5' => '5) Mengelola Kebersihan (Lingkungan dan alat medis)',
                        '2_c_6' => '6) Melaksanakan manajemen Surveilens Bundle (ISK,VAP,IAD,IDO,Plebitis) sebagai upaya pengawasan resiko infeksi dalam upaya preventif pada pelayanan keperawatan',
                    ]
                ],
                'SUB_D' => [
                    'label' => 'D MANAJEMEN AIRWAY BREATHING',
                    'items' => [
                        '2_d_1' => '1) Membebaskan Jalan Nafas dengan Head Tilt, Chin Lift',
                        '2_d_2' => '2) Membebaskan Jalan Nafas dengan Jaw Trust',
                        '2_d_3' => '3) Membebaskan Jalan Nafas buatan dengan OPA',
                        '2_d_4' => '4) Membebaskan Jalan Nafas buatan dengan NPA',
                        '2_d_5' => '5) Memberikan oksigen sederhana(Nasal Kanul, Simple Mask)',
                        '2_d_6' => '6) Memberikan oksigen komplek (Masker Rebreathing/Non Rebreathing)',
                        '2_d_7' => '7) Melatih nafas dalam dan Latihan Batuk Efektif',
                        '2_d_8' => '8) Mengatur mobilisasi (posisi fowler/ semi fowler)',
                    ]
                ],
                'SUB_E' => [
                    'label' => 'E MONITORING TTV',
                    'items' => [
                        '2_e_1' => '1) Mengukur Respirasi',
                        '2_e_2' => '2) Mengukur Suhu',
                        '2_e_3' => '3) Mengukur Nadi',
                        '2_e_4' => '4) Mengukur Tekanan Darah',
                        '2_e_5' => '5) Mengukur Saturasi Oksigen',
                    ]
                ],
                'SUB_F' => [
                    'label' => 'F MERAWAT LUKA',
                    'items' => [
                        '2_f_1' => '1) Merawat Luka sederhana (eviserasi ringan operasi bersih dan luka trauma superfisial tanpa infeksi),',
                        '2_f_2' => '2) Merawat Luka bakar grade 1 dan 2 < 10% non area saluran pernapasan',
                        '2_f_3' => '3) Merawat Luka Kaki Diabetes sederhana',
                    ]
                ],
                'SUB_G' => [
                    'label' => 'G MEMBERIKAN OBAT SESUAI 6 BENAR',
                    'items' => [
                        '2_g_1' => '1) Memberikan Obat Inhalasi',
                        '2_g_2' => '2) Memberikan Obat Nasal',
                        '2_g_3' => '3) Memberikan Obat IM',
                        '2_g_4' => '4) Memberikan Obat Intravena',
                        '2_g_5' => '5) Memberikan Obat Intravena Melalui Selang Infus',
                        '2_g_6' => '6) Memberikan Obat Melalui Selang Nasogastrik',
                        '2_g_7' => '7) Memberikan Obat Subkutan',
                        '2_g_8' => '8) Memberikan Obat Suppositoria Anal',
                        '2_g_9' => '9) Memberikan Obat Salep Mata',
                        '2_g_10' => '10) Memberikan Obat Tetes Mata',
                        '2_g_11' => '11) Memberikan Obat Vagina',
                        '2_g_12' => '12) Menggunakan syringe pump/infus pump',
                    ]
                ],
                'SUB_H' => [
                    'label' => 'H MEMFASILITASI KEBUTUHAN CAIRAN DAN ELEKTROLIT',
                    'items' => [
                        '2_h_1' => '1) Memantau capilari refill time ( CRT)',
                        '2_h_2' => '2) Memasang pasien monitor',
                        '2_h_3' => '3) Memberikan cairan intravena',
                        '2_h_4' => '4) Menghitung keseimbangan cairan input dan output',
                        '2_h_5' => '5) Melakukan restriksi cairan',
                        '2_h_6' => '6) Merekam ECG',
                        '2_h_7' => '7) Memasang akses intra vena',
                        '2_h_8' => '8) Melepas akses intra vena',
                    ]
                ],
                'SUB_I' => [
                    'label' => 'I Memberikan darah dan produk darah secara aman',
                    'items' => [
                        '2_i_1' => '1) Memberikan darah dan produk darah secara aman',
                    ]
                ],
                'SUB_J' => [
                    'label' => 'J Pemenuhan kebutuhan Eliminasi',
                    'items' => [
                        '2_j_1' => '1) Membantu pasien berkemih',
                        '2_j_2' => '2) Memasang Kateter urin Laki-laki atau perempuan',
                        '2_j_3' => '3) Memasang Kondom kateter',
                        '2_j_4' => '4) Merawat kateter urin',
                        '2_j_5' => '5) Melepas kateter urin',
                        '2_j_6' => '6) Melakukan Irigasi Kandung Kemih',
                        '2_j_7' => '7) Melakukan Evakuasi feses secara manual',
                        '2_j_8' => '8) Melepas tampon anus',
                        '2_j_9' => '9) Memantau bising usus',
                    ]
                ],
                'SUB_K' => [
                    'label' => 'K NUTRISI',
                    'items' => [
                        '2_k_1' => '1) Mendeteksi status gizi',
                        '2_k_2' => '2) Memasang selang nasogastrik/Orogastrik',
                        '2_k_3' => '3) Memberikan makan enteral',
                        '2_k_4' => '4) Memberikan nutrisi parenteral',
                        '2_k_5' => '5) Mengukur lingkar abdomen',
                        '2_k_6' => '6) Mengukur lingkar kepala',
                        '2_k_7' => '7) Mengukur lingkar lengan atas',
                        '2_k_8' => '8) Mengukur panjang badan',
                        '2_k_9' => '9) Mengukur tinggi badan',
                        '2_k_10' => '10) Menimbang berat badan',
                    ]
                ],
                'SUB_L' => [
                    'label' => 'L PENGAMBILAN SAMPLE',
                    'items' => [
                        '2_l_1' => '1) Mengambil sample pemeriksaan: Darah Vena',
                        '2_l_2' => '2) Mengambil sample pemeriksaan: Urin',
                        '2_l_3' => '3) Mengambil sample pemeriksaan: Feses',
                        '2_l_4' => '4) Mengambil sample pemeriksaan: Sputum',
                    ]
                ],
                'SUB_M' => [
                    'label' => 'M MOBILISASI PASIEN',
                    'items' => [
                        '2_m_1' => '1) Melakukan Dukungan Mobilisasi fisik',
                        '2_m_2' => '2) Melakukan ROM pada pasien',
                    ]
                ],
                'SUB_N' => [
                    'label' => 'N MELAKUKAN PEMENUHAN HIEGENE PERSONAL',
                    'items' => [
                        '2_n_1' => '1) Melakukan pemenuhan hiegene personal',
                    ]
                ],
                'SUB_O' => [
                    'label' => 'O MELAKUKAN PEMENUHAN ISTIRAHAT TIDUR',
                    'items' => [
                        '2_o_1' => '1) Melakukan pemenuhan istirahat tidur',
                    ]
                ],
                'SUB_P' => [
                    'label' => 'P Melakukan Tindakan Keperawatan pada kondisi Gawat',
                    'items' => [
                        '2_p_1' => '1) Melakukan monitoring EWS',
                        '2_p_2' => '2) Manajemen Code Blue',
                        '2_p_3' => '3) Resusitasi Jantung Paru Pada Pasien Dewasa',
                        '2_p_4' => '4) Melakukan Defibrilasi/Kardioversi',
                        '2_p_5' => '5) Memantau tanda dan gejala perdarahan',
                        '2_p_6' => '6) Melakukan Penanganan Syok',
                    ]
                ],
                'SUB_Q' => [
                    'label' => 'Q PEMENUHAN KEBUTUHAN PSIKOLOGIS',
                    'items' => [
                        '2_q_1' => '1) Melakukan tindakan rasa nyaman dan pengaturan suhu tubuh',
                        '2_q_2' => '2) Melakukan Terapi relaksasi nafas dalam',
                        '2_q_3' => '3) Memberikan tindakan untuk mengurangi kecemasan pasien',
                        '2_q_4' => '4) Memfasilitasi adaptasi dalam hospitalisasi pada individu',
                        '2_q_5' => '5) Memberikan perawatan paliatif',
                        '2_q_6' => '6) Memberikan dukungan spiritual pada kondisi kehilangan, berduka, atau menjelang ajal (terminal) dalam pelayanan keperawatan',
                    ]
                ],
            ],
            'MELAKUKAN DISKUSI REFLEKSI KASUS UNTUK MENINGKATKAN KUALITAS' => [
                '3_0' => 'Melakukan diskusi refleksi kasus untuk meningkatkan kualitas',
            ],
            'MENGELOLA PASIEN YANG MEMBUTUHKAN KEWASPADAAN TRANSMISI' => [
                '4_0' => 'Mengelola pasien yang membutuhkan kewaspadaan transmisi',
            ],
            'KOMPETENSI TAMBAHAN' => [
                'T2_1' => '1 Melakukan perawatan pre dan post operasi',
                'T2_2' => '2 Mempersiapkan pemeriksaan diagnostik (radiologi)',
                'T2_3' => '3 Melakukan tindakan POCT Gula darah',
            ]
        ];
    }
}
