<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembaruan Status Lamaran - PT Imersa Solusi Teknologi</title>
</head>
<body style="margin:0;padding:0;background-color:#F8FAFC;font-family:'Plus Jakarta Sans','Segoe UI',Arial,sans-serif;-webkit-font-smoothing:antialiased;">

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;">
    <tr>
        <td align="center" style="padding:50px 0;">

            <table border="0" cellpadding="0" cellspacing="0" width="620"
                   style="background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #E2E8F0;box-shadow:0 10px 30px rgba(0,75,143,0.05);">

                <!-- Bagian Header (Logo) -->
                <tr>
                    <td align="center" style="background:#004B8F;padding:35px;">
                        <img src="{{ asset('/publicimages/logo-imersa.png') }}"
                             alt="PT Imersa Solusi Teknologi"
                             width="140"
                             style="display:block;border:0;">
                    </td>
                </tr>

                <!-- Konten Utama -->
                <tr>
                    <td style="padding:45px;">

                        <h2 style="margin:0 0 18px;color:#004B8F;font-size:22px;font-weight:700;">
                            Yth. {{ $application->full_name }},
                        </h2>

                        <p style="margin:0 0 24px;color:#475569;font-size:15px;line-height:1.7;">
                            Terima kasih atas ketertarikan dan partisipasi Anda dalam program magang di <strong>PT Imersa Solusi Teknologi</strong>. Kami sangat mengapresiasi waktu dan upaya yang telah Anda luangkan. Melalui surel ini, kami bermaksud menyampaikan pembaruan informasi mengenai status lamaran Anda.
                        </p>

                        <!-- Kotak Informasi Posisi -->
                        <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:12px;padding:20px;margin-bottom:25px;">
                            <div style="font-size:11px;
                                        color:#94A3B8;
                                        font-weight:700;
                                        text-transform:uppercase;
                                        letter-spacing:1px;
                                        margin-bottom:6px;">
                                Posisi yang Dilamar
                            </div>
                            <div style="font-size:18px;
                                        color:#004B8F;
                                        font-weight:700;">
                                {{ $application->vacancy->title }}
                            </div>
                        </div>

                        <!-- Label Status -->
                        <p style="margin:0 0 12px;
                                  color:#64748B;
                                  font-size:12px;
                                  font-weight:700;
                                  text-transform:uppercase;
                                  letter-spacing:1px;">
                            Status Terkini
                        </p>

                        <div style="display:inline-block;
                                    padding:8px 18px;
                                    border-radius:8px;
                                    font-size:12px;
                                    font-weight:700;
                                    text-transform:uppercase;
                                    letter-spacing:0.5px;
                                    margin-bottom:30px;
                            @if($application->status === \App\Models\Application::STATUS_ACCEPTED)
                                background:#DCFCE7;color:#15803D;border:1px solid #BBF7D0;
                            @elseif($application->status === \App\Models\Application::STATUS_REJECTED)
                                background:#FEE2E2;color:#B91C1C;border:1px solid #FCA5A5;
                            @elseif($application->status === \App\Models\Application::STATUS_INTERVIEW)
                                background:#E0F2FE;color:#0369A1;border:1px solid #BAE6FD;
                            @else
                                background:#F1F5F9;color:#475569;border:1px solid #E2E8F0;
                            @endif">
                            {{ $application->status }}
                        </div>

                        <div style="border-top:1px solid #F1F5F9;padding-top:25px;">

                            @if($application->status === \App\Models\Application::STATUS_ACCEPTED)

                                <p style="margin:0 0 15px;
                                          color:#15803D;
                                          font-size:15px;
                                          font-weight:700;
                                          line-height:1.6;">
                                    Selamat! Anda dinyatakan lolos tahapan seleksi untuk program magang pada posisi ini.
                                </p>
                                <p style="margin:0;
                                          color:#475569;
                                          font-size:14.5px;
                                          line-height:1.8;">
                                    Berdasarkan hasil evaluasi secara komprehensif, kualifikasi dan portofolio Anda dinilai selaras dengan kebutuhan proyek perusahaan. Tim Sumber Daya Manusia (HR) kami akan segera menghubungi Anda melalui surel atau kontak WhatsApp resmi guna mengoordinasikan tahapan administrasi lanjutan, penandatanganan dokumen, serta jadwal orientasi (*onboarding*).
                                </p>

                            @elseif($application->status === \App\Models\Application::STATUS_REJECTED)

                                <p style="margin:0 0 15px;
                                          color:#475569;
                                          font-size:14.5px;
                                          line-height:1.8;">
                                    Kami menyampaikan apresiasi yang sebesar-besarnya atas partisipasi Anda dalam proses seleksi ini.
                                </p>
                                <p style="margin:0;
                                          color:#475569;
                                          font-size:14.5px;
                                          line-height:1.8;">
                                    Setelah melalui pertimbangan yang saksama, dengan berat hati kami sampaikan bahwa kami belum dapat memproses lamaran Anda ke tahapan selanjutnya. Keputusan ini didasarkan pada kuota dan spesifikasi kebutuhan perusahaan saat ini, serta tidak mengurangi apresiasi kami terhadap rekam jejak maupun potensi yang Anda miliki. Kami mendoakan kesuksesan untuk perjalanan karier Anda ke depannya.
                                </p>

                            @elseif($application->status === \App\Models\Application::STATUS_INTERVIEW)

                                <p style="margin:0 0 15px;
                                          color:#0369A1;
                                          font-size:15px;
                                          font-weight:700;
                                          line-height:1.6;">
                                    Lamaran Anda telah lolos seleksi berkas dan berhak melaju ke tahapan wawancara.
                                </p>
                                <p style="margin:0;
                                          color:#475569;
                                          font-size:14.5px;
                                          line-height:1.8;">
                                    Pada tahapan ini, kami bermaksud menggali lebih dalam mengenai kompetensi teknis, pengalaman, serta keselarasan profil Anda dengan budaya kerja perusahaan. Informasi lebih perinci mengenai jadwal wawancara, tautan pertemuan (jika dilaksanakan secara daring), serta petunjuk teknis persiapan akan segera kami sampaikan melalui komunikasi terpisah.
                                </p>

                            @else

                                <p style="margin:0;
                                          color:#475569;
                                          font-size:14.5px;
                                          line-height:1.8;">
                                    Saat ini, berkas lamaran Anda sedang dalam tahap peninjauan dan validasi oleh tim rekrutmen kami. Kami melakukan evaluasi secara saksama terhadap setiap kandidat untuk memastikan kesesuaian profil dengan standar operasional perusahaan. Kami akan segera memberikan pembaruan informasi apabila telah ada keputusan lebih lanjut.
                                </p>

                            @endif

                        </div>

                        <!-- Tombol CTA -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                               style="margin-top:40px;margin-bottom:10px;">
                            <tr>
                                <td align="center">
                                    <a href="{{ url('/status-lamaran') }}"
                                       style="background:#00A3E0;
                                              color:#ffffff;
                                              text-decoration:none;
                                              padding:14px 30px;
                                              border-radius:10px;
                                              display:inline-block;
                                              font-size:14px;
                                              font-weight:700;
                                              box-shadow:0 5px 15px rgba(0,163,224,.20);">
                                        Akses Portal Rekrutmen
                                    </a>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                <!-- Bagian Penutup (Footer) -->
                <tr>
                    <td style="padding:0 45px 45px;">

                        <p style="margin:0 0 8px;color:#64748B;font-size:14px;">
                            Hormat kami,
                        </p>
                        <p style="margin:0;color:#1E293B;font-size:15px;font-weight:700;">
                            Departemen Sumber Daya Manusia (HRD)
                        </p>
                        <p style="margin:0;color:#004B8F;font-size:14px;font-weight:600;">
                            PT Imersa Solusi Teknologi
                        </p>

                        <div style="margin-top:35px;
                                    padding-top:20px;
                                    border-top:1px solid #F1F5F9;
                                    text-align:center;">
                            <p style="margin:0;
                                      color:#94A3B8;
                                      font-size:12px;
                                      line-height:1.7;">
                                Surel ini didistribusikan secara otomatis melalui sistem rekrutmen terintegrasi
                                PT Imersa Solusi Teknologi.<br>
                                Mohon untuk tidak membalas pesan ke alamat surel ini. Apabila terdapat pertanyaan, silakan menghubungi administrator melalui kanal komunikasi resmi perusahaan.
                            </p>
                        </div>

                    </td>
                </tr>

            </table>

            <!-- Hak Cipta Perusahaan -->
            <table border="0" cellpadding="0" cellspacing="0" width="620">
                <tr>
                    <td align="center"
                        style="padding-top:30px;
                               color:#94A3B8;
                               font-size:12px;
                               line-height:1.7;">
                        &copy; {{ date('Y') }} PT Imersa Solusi Teknologi. Seluruh hak cipta dilindungi undang-undang.<br>
                        Kantor Pusat: Jl. Puntodewo No. 2 Baron, Kabupaten Nganjuk, Jawa Timur.
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>