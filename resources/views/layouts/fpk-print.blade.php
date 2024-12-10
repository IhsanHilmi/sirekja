<?php
    use Carbon\Carbon;
    use App\Models\Fpk;
    Carbon::setLocale('id');
    $fpk = Fpk::with('details','approvalProcess','jabatan','issuedBy')->find($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print View 
        {{$fpk->kodeFPK}}
    </title>
    <style>
        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }
        }
    
        .page-break {
            page-break-after: always;
        }
        body {
            font-family: serif;
            margin: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 4px;
            vertical-align: middle;
            font-size: 0.8em;
        }
        hr{
            border:1pt solid black;
        }
        .header, .subheader {
            text-align: center;
            font-weight: bold;
        }
        .no-border {
            border: none;
        }
        .checkbox {
            width: 15px;
            height: 15px;
            border: 1px solid black;
            display: inline-block;
            vertical-align: middle;
            margin-right: 5px;
        }
        .form-section {
            margin-bottom: 10px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .label-text {
            flex: 0 0 130px;
            text-align: left;
            padding-right: 10px;
        }
        .value-text {
            flex: 2;
            text-align: left;
            padding-left: 10px;
        }
        .colon {
            flex: 0;
        }
        .signatures td {
            height: 25px;
        }
        .empty-space {
            height: 20px;
        }
        .full-width {
            width: 100%;
        }
        .fixed-width {
            width: 120px;
        }
    </style>
</head>
<body>
    <table style="border: 1px">
        <tr>
            <td rowspan="2" class="header" style="text-align:center;">
                <img src="{{ asset('storage/images/logo-jababeka.png') }}" alt="Logo" width="100">
            </td>
            <td class="header">DOKUMEN PENDUKUNG</td>
            <td rowspan="2" style="font-size: 0.75em; vertical-align:middle;">Nomor: DP-01/PK-09/HRD-GA <hr>Revisi: 2<hr>Tanggal: {{ Carbon::parse(now()->locale('id_ID'))->translatedFormat('d F Y') }}<hr>Nomor FPK: {{$fpk->kodeFPK}}</td>
        </tr>
        <tr>
            <td class="header" style="text-align: center; font-size: 1.3em;">FORMULIR PERMINTAAN KARYAWAN</td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="2" style="width: 50%; border-right:none;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text">Unit Bisnis / Divisi</span><span class="colon">:</span><span class="value-text">{{$fpk->jabatan->departemen->bisnisUnit->nama_bisnis_unit}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Departemen</span><span class="colon">:</span><span class="value-text">{{$fpk->jabatan->departemen->nama_departemen}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Jabatan</span><span class="colon">:</span><span class="value-text">{{$fpk->jabatan->nama_jabatan}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Tanggal Permintaan</span><span class="colon">:</span><span class="value-text">{{ Carbon::parse($fpk->tanggal_efektif)->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </td>
            <td colspan="2" style="width: 50%; border-left:none;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text">Lokasi Kerja</span><span class="colon">:</span><span class="value-text">{{$fpk->details->lokasi_kerja}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Golongan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->golongan}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Status</span><span class="colon">:</span><span class="value-text"></span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="4" style="width: 100%;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text" style="flex: 0 1 140px;"><b>PERMINTAAN UNTUK</b></span><span class="colon">:</span><span class="value-text" style="flex: 1 0 100px;">{{$fpk->jenis_FPK}}</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 50%;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text">Alasan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->alasan}}</span>
                    </div>
                    {{-- <div class="form-group">
                        <span class="label-text">Golongan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->golongan}}</span>
                    </div> --}}
                </div>
            </td>
            <td colspan="2" style="width: 50%;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text">Catatan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->catatan}}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="4" style="width: 100%;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text" style="flex: 0 1 140px;"><b>KUALIFIKASI</b></span><span class="colon">:</span><span class="value-text" style="flex: 1 0 100px;">(DIISI LENGKAP)</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="width: 50%;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text">Jenis Kelamin</span><span class="colon">:</span><span class="value-text">{{$fpk->details->gender}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Pendidikan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->pendidikan}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Jurusan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->jurusan}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Spesifikasi Pekerjaan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->spesifikasi}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Hardskill</span><span class="colon">:</span><span class="value-text">{{$fpk->details->hard_skills}}</span>
                    </div>
                </div>
            </td>
            <td colspan="2" style="width: 50%;">
                <div class="form-container">
                    <div class="form-group">
                        <span class="label-text">Usia</span><span class="colon">:</span><span class="value-text">{{$fpk->details->usia}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Pengalaman</span><span class="colon">:</span><span class="value-text">{{$fpk->details->thn_pengalaman}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Deskripsi Pekerjaan</span><span class="colon">:</span><span class="value-text">{{$fpk->details->deskripsi}}</span>
                    </div>
                    <div class="form-group">
                        <span class="label-text">Softskill</span><span class="colon">:</span><span class="value-text">{{$fpk->details->soft_skills}}</span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

</body>
<script>
    window.print();
</script>
</html>
