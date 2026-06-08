<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih Atas Donasi Anda - Pedulia</title>
    <style>
        /* Base / Reset Styles */
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            height: 100% !important;
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            color: #334155;
        }
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        /* Responsive Breakpoints */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                padding: 10px !important;
            }
            .content-padding {
                padding: 24px 16px !important;
            }
            .logo-text {
                font-size: 20px !important;
            }
            .hero-title {
                font-size: 22px !important;
            }
            .info-table td {
                display: block !important;
                width: 100% !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            .info-table tr {
                margin-bottom: 12px !important;
                display: block !important;
            }
            .info-label {
                padding-bottom: 2px !important;
            }
            .info-value {
                text-align: left !important;
                font-size: 15px !important;
                font-weight: 600 !important;
            }
        }
    </style>
</head>
<body style="background-color: #f8fafc; margin: 0; padding: 0;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f8fafc; table-layout: fixed;">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <!-- Main Email Card -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" class="email-container" style="background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0;">
                    
                    <!-- Header -->
                    <tr>
                        <td align="center" style="background-color: #0f172a; padding: 28px 32px; border-bottom: 4px solid #9FEF00;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <a href="{{ config('app.url') }}" style="text-decoration: none; display: inline-block;">
                                            <table border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <!-- Recreated Logo Badge -->
                                                    <td style="background-color: #020617; border-radius: 12px; padding: 8px 10px; width: 22px; text-align: center; vertical-align: middle;">
                                                        <span style="font-size: 18px; line-height: 1; vertical-align: middle;">💚</span>
                                                    </td>
                                                    <!-- Brand Text -->
                                                    <td style="padding-left: 10px; vertical-align: middle;">
                                                        <span class="logo-text" style="color: #ffffff; font-size: 24px; font-weight: 800; tracking-tight: -0.025em; letter-spacing: -0.5px;">
                                                            Peduli<span style="color: #9FEF00;">a</span>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body / Hero Section -->
                    <tr>
                        <td class="content-padding" style="padding: 48px 40px 32px 40px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <!-- Checkmark Success Graphic -->
                                <tr>
                                    <td align="center" style="padding-bottom: 24px;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="background-color: #ecfdf5; border-radius: 50%; width: 72px; height: 72px; vertical-align: middle;">
                                                    <!-- Outer Green Dot Glow -->
                                                    <span style="font-size: 32px; color: #10b981; line-height: 72px; vertical-align: middle;">✓</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Warm Gratitude Header -->
                                <tr>
                                    <td align="center" style="padding-bottom: 12px;">
                                        <h1 class="hero-title" style="margin: 0; color: #0f172a; font-size: 26px; font-weight: 800; tracking-tight: -0.025em;">
                                            Terima Kasih, {{ $donation->donor_name }}!
                                        </h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 24px;">
                                        <span style="background-color: #ecfdf5; color: #047857; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.075em; padding: 6px 16px; border-radius: 9999px; display: inline-block; border: 1px solid #a7f3d0;">
                                            Donasi Berhasil Dikonfirmasi
                                        </span>
                                    </td>
                                </tr>

                                <!-- Warm Message -->
                                <tr>
                                    <td align="center" style="padding-bottom: 32px;">
                                        <p style="margin: 0; color: #475569; font-size: 15px; line-height: 1.625; max-width: 480px; font-weight: 500;">
                                            Kebaikan Anda sangat berarti bagi sesama. Donasi Anda telah kami terima dengan amanah dan akan segera disalurkan ke program kampanye yang Anda dukung. Semoga kebaikan ini dibalas berlipat ganda.
                                        </p>
                                    </td>
                                </tr>

                                <!-- Donation Details Card -->
                                <tr>
                                    <td style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 24px 28px; margin-bottom: 32px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="info-table">
                                            <!-- Campaign Title -->
                                            <tr>
                                                <td colspan="2" style="padding-bottom: 16px; border-bottom: 1px dashed #e2e8f0;">
                                                    <span style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 4px;">Kampanye Didukung</span>
                                                    <span style="font-size: 15px; font-weight: 700; color: #0f172a; line-height: 1.4; display: block;">
                                                        {{ $donation->campaign->title }}
                                                    </span>
                                                </td>
                                            </tr>

                                            <!-- Spacing -->
                                            <tr><td colspan="2" style="height: 16px;"></td></tr>

                                            <!-- Donor Name -->
                                            <tr>
                                                <td class="info-label" style="font-size: 13px; font-weight: 600; color: #64748b; padding-bottom: 8px;">Nama Donatur</td>
                                                <td class="info-value" align="right" style="font-size: 14px; font-weight: 700; color: #0f172a; padding-bottom: 8px;">{{ $donation->donor_name }}</td>
                                            </tr>

                                            <!-- Donor Email -->
                                            <tr>
                                                <td class="info-label" style="font-size: 13px; font-weight: 600; color: #64748b; padding-bottom: 8px;">Email Donatur</td>
                                                <td class="info-value" align="right" style="font-size: 14px; font-weight: 700; color: #0f172a; padding-bottom: 8px;">{{ $donation->donor_email }}</td>
                                            </tr>

                                            <!-- Nominal Donasi -->
                                            <tr>
                                                <td class="info-label" style="font-size: 13px; font-weight: 600; color: #64748b; padding-bottom: 8px;">Nominal Donasi</td>
                                                <td class="info-value" align="right" style="font-size: 14px; font-weight: 700; color: #0f172a; padding-bottom: 8px;">Rp {{ number_format($donation->nominal, 0, ',', '.') }}</td>
                                            </tr>

                                            <!-- Unique Code -->
                                            @if($donation->unique_code > 0)
                                            <tr>
                                                <td class="info-label" style="font-size: 13px; font-weight: 600; color: #64748b; padding-bottom: 8px;">Kode Unik</td>
                                                <td class="info-value" align="right" style="font-size: 14px; font-weight: 700; color: #64748b; padding-bottom: 8px;">+Rp {{ number_format($donation->unique_code, 0, ',', '.') }}</td>
                                            </tr>
                                            @endif

                                            <!-- Total Amount -->
                                            <tr>
                                                <td class="info-label" style="font-size: 14px; font-weight: 700; color: #0f172a; padding-top: 8px; border-top: 1px dashed #e2e8f0;">Total Ditransfer</td>
                                                <td class="info-value" align="right" style="font-size: 18px; font-weight: 800; color: #10b981; padding-top: 8px; border-top: 1px dashed #e2e8f0;">Rp {{ number_format($donation->total_amount, 0, ',', '.') }}</td>
                                            </tr>

                                            <!-- Spacing -->
                                            <tr><td colspan="2" style="height: 16px;"></td></tr>

                                            <!-- Payment Method -->
                                            <tr>
                                                <td class="info-label" style="font-size: 13px; font-weight: 600; color: #64748b; padding-bottom: 8px; border-top: 1px solid #e2e8f0; padding-top: 16px;">Metode Pembayaran</td>
                                                <td class="info-value" align="right" style="font-size: 13px; font-weight: 700; color: #0f172a; padding-bottom: 8px; border-top: 1px solid #e2e8f0; padding-top: 16px; text-transform: uppercase;">{{ str_replace('_', ' ', $donation->payment_method) }}</td>
                                            </tr>

                                            <!-- Invoice ID -->
                                            <tr>
                                                <td class="info-label" style="font-size: 13px; font-weight: 600; color: #64748b; padding-bottom: 8px;">Nomor Invoice</td>
                                                <td class="info-value" align="right" style="font-size: 13px; font-weight: 700; color: #475569; padding-bottom: 8px; font-family: monospace;">{{ $donation->invoice_number }}</td>
                                            </tr>

                                            <!-- Date -->
                                            <tr>
                                                <td class="info-label" style="font-size: 13px; font-weight: 600; color: #64748b;">Tanggal Konfirmasi</td>
                                                <td class="info-value" align="right" style="font-size: 13px; font-weight: 700; color: #475569;">{{ $donation->updated_at->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- CTA Section -->
                                <tr>
                                    <td align="center" style="padding-top: 8px;">
                                        <a href="{{ route('donations.invoice', $donation->invoice_number) }}" style="background-color: #9FEF00; color: #0f172a; border-radius: 9999px; text-decoration: none; display: inline-block; font-weight: 800; font-size: 14px; padding: 14px 36px; box-shadow: 0 4px 12px rgba(159,239,0,0.25); text-align: center; border: 1px solid #9FEF00;">
                                            Lihat Bukti Donasi
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background-color: #f8fafc; padding: 32px 40px; border-top: 1px solid #e2e8f0;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="color: #64748b; font-size: 12px; line-height: 1.5; font-weight: 500;">
                                        <p style="margin: 0 0 12px 0; font-weight: 700; color: #475569;">Pedulia Indonesia</p>
                                        <p style="margin: 0 0 16px 0;">Platform penggalangan dana dan donasi online resmi, amanah, dan transparan.</p>
                                        <div style="border-top: 1px solid #e2e8f0; width: 100px; margin: 16px auto;"></div>
                                        <p style="margin: 0;">Email ini dikirim secara otomatis oleh sistem kami. Jika Anda mengalami kesulitan atau membutuhkan bantuan, silakan hubungi <a href="mailto:support@pedulia.com" style="color: #10b981; text-decoration: none; font-weight: 700;">support@pedulia.com</a>.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!-- Under Card info -->
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="margin-top: 20px;">
                    <tr>
                        <td align="center" style="color: #94a3b8; font-size: 11px;">
                            &copy; 2026 Pedulia. Hak Cipta Dilindungi.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
