<?php
/**
 * FILE: views/salary_stats.php
 * FUNGSI: Menampilkan statistik gaji (rata-rata, tertinggi, terendah) per departemen
 */
include 'views/header.php';
?>

<h2>Statistik Gaji Per Departemen</h2>

<p style="margin-bottom: 1rem; color: #666;">
    Data ini menampilkan rata-rata, gaji tertinggi, dan gaji terendah per departemen 
    menggunakan fungsi agregat <code>AVG()</code>, <code>MAX()</code>, dan <code>MIN()</code>.
</p>

<?php if ($stats->rowCount() > 0): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>Departemen</th>
                <th>Gaji Rata-rata</th>
                <th>Gaji Tertinggi</th>
                <th>Gaji Terendah</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stats->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><strong><?php echo htmlspecialchars($row['department']); ?></strong></td>
                <td>Rp <?php echo number_format($row['avg_salary'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($row['max_salary'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($row['min_salary'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Visualisasi sederhana -->
    <div style="margin-top: 2rem;">
        <h3>Visualisasi Gaji Rata-rata per Departemen</h3>
        <?php 
        $stats->execute();
        $all_stats = $stats->fetchAll(PDO::FETCH_ASSOC);
        $max_avg = max(array_column($all_stats, 'avg_salary'));
        ?>
        <?php foreach ($all_stats as $row): ?>
            <div style="margin: 0.5rem 0;">
                <div style="display: flex; justify-content: space-between;">
                    <span><?php echo htmlspecialchars($row['department']); ?></span>
                    <span>Rp <?php echo number_format($row['avg_salary'], 0, ',', '.'); ?></span>
                </div>
                <div style="background: #f0f0f0; border-radius: 4px; height: 18px;">
                    <div style="background: #667eea; height: 100%; border-radius: 4px; width: <?php echo ($row['avg_salary'] / $max_avg * 100); ?>%;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <div style="text-align: center; padding: 2rem; background: #f8f9fa; border-radius: 8px;">
        <p style="font-size: 1.1rem; color: #666;">Tidak ada data statistik gaji.</p>
        <p style="color: #999;">Pastikan tabel <code>employees</code> sudah berisi data.</p>
    </div>
<?php endif; ?>

<?php include 'views/footer.php'; ?>
