<?php
/**
 * FILE: views/tenure_stats.php
 * FUNGSI: Menampilkan statistik jumlah karyawan berdasarkan masa kerja (tenure)
 */
include 'views/header.php';
?>

<h2>Statistik Masa Kerja Karyawan</h2>

<p style="margin-bottom: 1rem; color: #666;">
    Statistik ini menunjukkan jumlah karyawan berdasarkan lama masa kerja:
    <strong>Junior</strong> (&lt; 1 tahun), 
    <strong>Middle</strong> (1–3 tahun), dan 
    <strong>Senior</strong> (&gt; 3 tahun). 
    Data diambil menggunakan fungsi agregat 
    <code>COUNT()</code> dan ekspresi <code>CASE WHEN</code>.
</p>

<?php if ($stats->rowCount() > 0): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Kategori Masa Kerja</th>
                <th>Jumlah Karyawan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $all_stats = $stats->fetchAll(PDO::FETCH_ASSOC); 
            $max_count = max(array_column($all_stats, 'total_employees'));
            foreach ($all_stats as $row): 
            ?>
            <tr>
                <td><strong><?php echo htmlspecialchars($row['experience_level']); ?></strong></td>
                <td style="text-align: center;">
                    <span style="background: #667eea; color: white; padding: 0.4rem 1rem; border-radius: 20px;">
                        <?php echo $row['total_employees']; ?>
                    </span>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Visualisasi -->
    <div style="margin-top: 2rem;">
        <h3>Visualisasi Jumlah Karyawan per Kategori</h3>
        <?php foreach ($all_stats as $row): ?>
            <div style="margin: 0.5rem 0;">
                <div style="display: flex; justify-content: space-between;">
                    <span><?php echo htmlspecialchars($row['experience_level']); ?></span>
                    <span><?php echo $row['total_employees']; ?> orang</span>
                </div>
                <div style="background: #f0f0f0; border-radius: 4px; height: 18px;">
                    <div style="background: #27ae60; height: 100%; border-radius: 4px; width: <?php echo ($row['total_employees'] / $max_count * 100); ?>%;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <div style="text-align: center; padding: 2rem; background: #f8f9fa; border-radius: 8px;">
        <p style="font-size: 1.1rem; color: #666;">Belum ada data masa kerja karyawan.</p>
        <p style="color: #999;">Pastikan tabel <code>employees</code> sudah berisi data dengan tanggal mulai kerja (hire_date).</p>
    </div>
<?php endif; ?>

<?php include 'views/footer.php'; ?>
