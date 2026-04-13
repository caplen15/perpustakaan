<?php

// 1. Hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}

// 2. Hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $a) {
        if ($a['status'] == "Aktif") {
            $total++;
        }
    }
    return $total;
}

// 3. Rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    $total = 0;
    foreach ($anggota_list as $a) {
        $total += $a['total_pinjaman'];
    }
    return $total / count($anggota_list);
}

// 4. Cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $a) {
        if ($a['id'] == $id) {
            return $a;
        }
    }
    return null;
}

// 5. Cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    $teraktif = $anggota_list[0];
    foreach ($anggota_list as $a) {
        if ($a['total_pinjaman'] > $teraktif['total_pinjaman']) {
            $teraktif = $a;
        }
    }
    return $teraktif;
}

// 6. Filter berdasarkan status
function filter_by_status($anggota_list, $status) {
    $hasil = [];
    foreach ($anggota_list as $a) {
        if ($a['status'] == $status) {
            $hasil[] = $a;
        }
    }
    return $hasil;
}

// 7. Validasi email sederhana
function validasi_email($email) {
    if (empty($email)) return false;
    if (strpos($email, "@") === false) return false;
    if (strpos($email, ".") === false) return false;
    return true;
}

// 8. Format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    $bulan = [
        "01" => "Januari", "02" => "Februari", "03" => "Maret",
        "04" => "April", "05" => "Mei", "06" => "Juni",
        "07" => "Juli", "08" => "Agustus", "09" => "September",
        "10" => "Oktober", "11" => "November", "12" => "Desember"
    ];

    $pecah = explode("-", $tanggal);
    return $pecah[2] . " " . $bulan[$pecah[1]] . " " . $pecah[0];
}

// ================= BONUS =================

// 9. Sort nama A-Z
function sort_by_nama($anggota_list) {
    usort($anggota_list, function($a, $b) {
        return strcmp($a['nama'], $b['nama']);
    });
    return $anggota_list;
}

// 10. Search nama (partial match)
function search_by_nama($anggota_list, $keyword) {
    $hasil = [];
    foreach ($anggota_list as $a) {
        if (stripos($a['nama'], $keyword) !== false) {
            $hasil[] = $a;
        }
    }
    return $hasil;
}
?>