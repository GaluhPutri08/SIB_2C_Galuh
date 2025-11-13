<?php
/**
 * FILE: views/employee_overview.php
 * FUNGSI: Menampilkan ringkasan umum karyawan (total, total gaji, rata-rata masa kerja)
 */
include 'views/header.php';
?>

<h2>Ringkasan Data Karyawan</h2>

<p style="margin-bottom: 1rem; color: #666;">
    Halaman ini menampilkan ringkasan agregat dari seluruh data karyawan menggunakan fungsi 
    <code>COUNT()</code>, <code>SUM()</code>, dan <code>AVG()</code>.
</p>

<?php if (!empty($overview)): ?>
    <div class="dashboard-cards">
        <div class="card">
            <h3>Total Karyawan</h3>
            <div class="number"><?php echo $overview['total_employees']; ?></div>
        </div>

        <div class="card">
            <h3>Total Gaji Seluruh Karyawan</h3>
            <div class="number">Rp <?php echo number_format($overview['total_salary'], 0, ',', '.'); ?></div>
        </div>

        <div class="card">
            <h3>Rata-rata Masa Kerja</h3>
            <div class="number"><?php echo $overview['avg_years_service']; ?> tahun</div>
        </div>
    </div>

    <div style="margin-top: 2rem; background: #f8f9fa; padding: 1rem; border-radius: 8px;">
        <h4>Interpretasi:</h4>
        <ul style="margin-top: 0.5rem; line-height: 1.6;">
            <li><strong>Total Karyawan</strong> menunjukkan jumlah seluruh pegawai aktif di perusahaan.</li>
            <li><strong>Total Gaji</strong> adalah akumulasi gaji per bulan dari seluruh karyawan.</li>
            <li><strong>Rata-rata Masa Kerja</strong> menunjukkan rata-rata lamanya karyawan bekerja di perusahaan (dalam tahun).</li>
        </ul>
    </div>
<?php else: ?>
    <div style="text-align: center; padding: 2rem; background: #f8f9fa; border-radius: 8px;">
        <p style="font-size: 1.1rem; color: #666;">Data ringkasan karyawan tidak ditemukan.</p>
        <p style="color: #999;">Pastikan tabel <code>employees</code> berisi data yang valid.</p>
    </div>
<?php endif; ?>

<?php include 'views/footer.php'; ?>
