<?= $this->extend('admin/layout'); ?>

<?= $this->section('admin_content'); ?>

<div class="subtitle-admin">Selamat Datang</div>
<h1 class="section-title-admin">
    <i class="fas fa-chart-line" style="color: #ff8a3d;"></i> Dashboard Admin
</h1>

<div id="adminProfile" class="data-card" style="margin-bottom: 30px;">
    <div class="data-card-header">
        <h3 class="data-card-title">Profil Admin</h3>
    </div>
    <div class="modal-body">
        <div style="text-align: center;">
            <i class="fas fa-user-circle" style="font-size: 60px; color: #ff8a3d; margin-bottom: 20px;"></i>
            <p><strong id="adminUsername" style="font-size: 18px;"></strong></p>
            <p style="color: #666;">Administrator Klinik Brayan Sehat</p>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
    <div class="data-card" style="text-align: center;">
        <div style="font-size: 40px; color: #ff8a3d; margin-bottom: 10px;">
            <i class="fas fa-user-doctor"></i>
        </div>
        <h3 style="font-size: 24px; font-weight: bold;" id="doctorCount">0</h3>
        <p style="color: #666;">Total Dokter</p>
    </div>

    <div class="data-card" style="text-align: center;">
        <div style="font-size: 40px; color: #4CAF50; margin-bottom: 10px;">
            <i class="fas fa-star"></i>
        </div>
        <h3 style="font-size: 24px; font-weight: bold;" id="spesialisCount">0</h3>
        <p style="color: #666;">Total Spesialis</p>
    </div>

    <div class="data-card" style="text-align: center;">
        <div style="font-size: 40px; color: #2196F3; margin-bottom: 10px;">
            <i class="fas fa-clinic-medical"></i>
        </div>
        <h3 style="font-size: 24px; font-weight: bold;" id="poliCount">0</h3>
        <p style="color: #666;">Total Poli</p>
    </div>

    <div class="data-card" style="text-align: center;">
        <div style="font-size: 40px; color: #FF9800; margin-bottom: 10px;">
            <i class="fas fa-calendar"></i>
        </div>
        <h3 style="font-size: 24px; font-weight: bold;" id="jadwalCount">0</h3>
        <p style="color: #666;">Total Jadwal</p>
    </div>

    <div class="data-card" style="text-align: center;">
        <div style="font-size: 40px; color: #9C27B0; margin-bottom: 10px;">
            <i class="fas fa-newspaper"></i>
        </div>
        <h3 style="font-size: 24px; font-weight: bold;" id="artikelCount">0</h3>
        <p style="color: #666;">Total Artikel</p>
    </div>
</div>

<div class="data-card">
    <div class="data-card-header">
        <h3 class="data-card-title">Menu Manajemen</h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; padding: 20px;">
        <a href="/admin/dokter" class="menu-link" style="text-decoration: none; color: inherit;">
            <div style="padding: 20px; border-radius: 20px; background: linear-gradient(135deg, rgba(255,138,61,0.1), rgba(255,138,61,0.05)); border: 1px solid rgba(255,138,61,0.2); text-align: center; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-user-doctor" style="font-size: 32px; color: #ff8a3d;"></i>
                <p style="margin-top: 10px; font-weight: 500;">Manajemen Dokter</p>
            </div>
        </a>

        <a href="/admin/spesialis" class="menu-link" style="text-decoration: none; color: inherit;">
            <div style="padding: 20px; border-radius: 20px; background: linear-gradient(135deg, rgba(76,175,80,0.1), rgba(76,175,80,0.05)); border: 1px solid rgba(76,175,80,0.2); text-align: center; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-star" style="font-size: 32px; color: #4CAF50;"></i>
                <p style="margin-top: 10px; font-weight: 500;">Manajemen Spesialis</p>
            </div>
        </a>

        <a href="/admin/poli" class="menu-link" style="text-decoration: none; color: inherit;">
            <div style="padding: 20px; border-radius: 20px; background: linear-gradient(135deg, rgba(33,150,243,0.1), rgba(33,150,243,0.05)); border: 1px solid rgba(33,150,243,0.2); text-align: center; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-clinic-medical" style="font-size: 32px; color: #2196F3;"></i>
                <p style="margin-top: 10px; font-weight: 500;">Manajemen Poli</p>
            </div>
        </a>

        <a href="/admin/jadwal" class="menu-link" style="text-decoration: none; color: inherit;">
            <div style="padding: 20px; border-radius: 20px; background: linear-gradient(135deg, rgba(255,152,0,0.1), rgba(255,152,0,0.05)); border: 1px solid rgba(255,152,0,0.2); text-align: center; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-calendar" style="font-size: 32px; color: #FF9800;"></i>
                <p style="margin-top: 10px; font-weight: 500;">Manajemen Jadwal</p>
            </div>
        </a>

        <a href="/admin/artikel" class="menu-link" style="text-decoration: none; color: inherit;">
            <div style="padding: 20px; border-radius: 20px; background: linear-gradient(135deg, rgba(156,39,176,0.1), rgba(156,39,176,0.05)); border: 1px solid rgba(156,39,176,0.2); text-align: center; cursor: pointer; transition: all 0.3s;">
                <i class="fas fa-newspaper" style="font-size: 32px; color: #9C27B0;"></i>
                <p style="margin-top: 10px; font-weight: 500;">Manajemen Artikel</p>
            </div>
        </a>
    </div>
</div>

<style>
.menu-link:hover div {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}
</style>

<?= $this->endSection(); ?>

<?= $this->section('admin_scripts'); ?>
<script>
// Load dashboard stats
function loadDashboard() {
    // Load admin profile
    fetch(`${API_URL}/profile`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                document.getElementById('adminUsername').textContent = data.data.username;
            }
        });

    // Load doctors count
    fetch(`${API_URL}/doctors?page=1`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                let total = 0;
                data.data.doctors.forEach(doctor => {
                    total++;
                });
                document.getElementById('doctorCount').textContent = data.data.pagination.total || total;
            }
        });

    // Load spesialis count
    fetch(`${API_URL}/spesialis`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                document.getElementById('spesialisCount').textContent = data.data.spesialis.length;
            }
        });

    // Load poli count
    fetch(`${API_URL}/poli`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                document.getElementById('poliCount').textContent = data.data.poli.length;
            }
        });

    // Load jadwal count
    fetch(`${API_URL}/doctors`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                let totalJadwal = 0;
                data.data.forEach(doctor => {
                    totalJadwal += doctor.jadwal.length;
                });
                document.getElementById('jadwalCount').textContent = totalJadwal;
            }
        });

    // Load artikel count
    fetch(`${API_URL}/artikel?page=1`)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                document.getElementById('artikelCount').textContent = data.data.pagination.total || data.data.artikel.length;
            }
        });
}

document.addEventListener('DOMContentLoaded', loadDashboard);
</script>
<?= $this->endSection(); ?>