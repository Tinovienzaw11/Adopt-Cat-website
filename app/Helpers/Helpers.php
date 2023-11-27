<?php

function alertBS($title, $message, $type)
{
    return '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>' . $title . '</strong> ' . $message . '
                </div>';
}

function sweetAlert($title = '', $text = '', $type = '', $timer = 99999, $showConBtn = true)
{
    return "<script>
        let title = '$title';
        let text = '$text';
        let icon = '$type';
        let timer = '$timer';
        let showConfirmButton = '$showConBtn';
        Swal.fire({title, text, icon, showConfirmButton, timer})
        </script>";
}

function getSchemaCertificate($number): string {
	switch ($number){
		case 1:
			return 'MENJAHIT ALAS KAKI';
		case 2:
			return 'PEMBUATAN POLA SECARA MANUAL';
		case 3:
			return 'PEMOTONGAN (CUTTING) BAHAN ALAS KAKI MENGGUNAKAN MESIN';
		case 4:
			return 'PEMOTONGAN (CUTTING) BAHAN ALAS KAKI SECARA MANUAL';
		case 5:
			return 'PENGEMALAN ALAS KAKI';
		case 6:
			return 'PENGKASARAN SEPATU/ALAS KAKI (ROUGHING)';
		case 7:
			return 'PENGOPENAN ALAS KAKI DENGAN MESIN';
		case 8:
			return 'PENGOPENAN ALAS KAKI SECARA MANUAL';
		case 9:
			return 'PENGOPERASIAN MESIN INJEKSI OUTSOLE';
		case 10:
			return 'PENYELESAIAN PRODUK ALAS KAKI (FINISHER)';
		case 11:
			return 'PERAKITAN ALAS KAKI';
		default: return '-';
	}
}

function getStatusBadge($status)
{
	if($status == 'success'){
		return '<span class="badge badge-success">success</span>';
	} else if($status == 'pending'){
		return '<span class="badge badge-warning">pending</span>';
	} else {
		return '<span class="badge badge-danger">batal</span>';
	}
}

function setGetUniqueId($insert_id, $type, $schema)
{
	return strtoupper($type).'.'.
		str_pad($schema, 2, '0', STR_PAD_LEFT).'.'.
		str_pad($insert_id, 5, '0', STR_PAD_LEFT);
}

function getStatusPhoto($status)
{
    if($status == 'success'){
        return '<span class="badge badge-success">Pekerjaan Selesai</span>';
    } else if($status == 'pending'){
        return '<span class="badge badge-warning">Proses Pengerjaan</span>';
    } else {
        return '<span class="badge badge-danger">Dibatalkan</span>';
    }
}
function getStatusPhotoText($status)
{
    if($status == 'success'){
        return 'Pekerjaan Selesai';
    } else if($status == 'pending'){
        return 'Proses Pengerjaan';
    } else {
        return 'Dibatalkan';
    }
}

function formatRupiah($mentah, $useSymbol = true, $symbol = 'Rp ') {
    if($useSymbol){
        return $symbol.number_format($mentah, 0, ',', '.');
    }
    return number_format($mentah, 0, ',', '.');
}