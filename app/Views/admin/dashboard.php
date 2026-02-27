<?= $this->extend('admin/layout'); ?>

<?= $this->section('admin_content'); ?>

<!-- Page Header -->
<div class="page-header" style="margin-bottom: 2rem;">
    <h1 class="page-title">
        <i class="fas fa-chart-line"></i> Dashboard
    </h1>
    <p style="color: #999; margin: 0.5rem 0 0 0;">Selamat datang di Admin Panel Klinik Brayan Sehat</p>
</div>

<!-- Stats Cards Grid (4 columns) -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Dokter Card -->
    <div class="data-card" style="text-align: center; padding: 1.5rem;">
        <div style="font-size: 32px; color: #ff8a3d; margin-bottom: 0.5rem;">
            <i class="fas fa-user-doctor"></i>
        </div>
        <h3 style="font-size: 20px; font-weight: bold; margin: 0.5rem 0;" id="doctorCount">0</h3>
        <p style="color: #999; margin: 0; font-size: 0.9rem;">Dokter</p>
    </div>

    <!-- Spesialis Card -->
    <div class="data-card" style="text-align: center; padding: 1.5rem;">
        <div style="font-size: 32px; color: #4CAF50; margin-bottom: 0.5rem;">
            <i class="fas fa-star"></i>
        </div>
        <h3 style="font-size: 20px; font-weight: bold; margin: 0.5rem 0;" id="spesialisCount">0</h3>
        <p style="color: #999; margin: 0; font-size: 0.9rem;">Spesialis</p>
    </div>

    <!-- Poli Card -->
    <div class="data-card" style="text-align: center; padding: 1.5rem;">
        <div style="font-size: 32px; color: #2196F3; margin-bottom: 0.5rem;">
            <i class="fas fa-clinic-medical"></i>
        </div>
        <h3 style="font-size: 20px; font-weight: bold; margin: 0.5rem 0;" id="poliCount">0</h3>
        <p style="color: #999; margin: 0; font-size: 0.9rem;">Poli</p>
    </div>

    <!-- Artikel Card -->
    <div class="data-card" style="text-align: center; padding: 1.5rem;">
        <div style="font-size: 32px; color: #9C27B0; margin-bottom: 0.5rem;">
            <i class="fas fa-newspaper"></i>
        </div>
        <h3 style="font-size: 20px; font-weight: bold; margin: 0.5rem 0;" id="artikelCount">0</h3>
        <p style="color: #999; margin: 0; font-size: 0.9rem;">Artikel</p>
    </div>
</div>

<!-- Two Column Section: Greeting + Jadwal -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Left: Greeting Card -->
    <div class="data-card" style="padding: 2rem; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <div style="font-size: 48px; margin-bottom: 1rem;">👋</div>
            <h2 id="greetingText" style="font-size: 1.8rem; font-weight: bold; margin-bottom: 0.5rem;">Halo, Admin</h2>
            <p style="color: #999; margin-bottom: 1.5rem; font-size: 0.95rem;">Semuanya berjalan dengan lancar. Silakan kelola data klinik di menu di bawah.</p>
        </div>
        <div style="padding: 1rem; background: #f8f9fa; border-radius: 12px;">
            <p style="font-size: 0.85rem; color: #666; margin: 0 0 0.5rem 0;">Waktu Login Terakhir</p>
            <p style="font-size: 1.2rem; font-weight: 600; margin: 0;" id="loginTime">-</p>
        </div>
    </div>

    <!-- Right: Jadwal Picker -->
    <div class="data-card">
        <div class="data-card-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h3 class="data-card-title" style="margin: 0;">Jadwal Hari Ini</h3>
            <div style="display: flex; gap: 0.5rem;">
                <button onclick="prevDay()" class="btn-action" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <select id="daySelect" onchange="loadJadwalForDay(this.value)" class="form-select" style="width: auto; padding: 0.5rem 1rem; font-size: 0.9rem;">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
                <button onclick="nextDay()" class="btn-action" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <div id="jadwalList" style="max-height: 300px; overflow-y: auto;">
            <div class="text-center py-5">
                <div class="spinner-border text-warning" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted" style="font-size: 0.9rem;">Memuat jadwal...</p>
            </div>
        </div>
    </div>
</div>

<!-- Bottom: Management Menu -->
<div class="data-card">
    <div class="data-card-header">
        <h3 class="data-card-title">Menu Manajemen</h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem; padding: 1.5rem;">
        <a href="/admin/dokter" style="text-decoration: none; color: inherit;">
            <div class="menu-item" style="padding: 1.5rem; border-radius: 12px; background: linear-gradient(135deg, rgba(255,138,61,0.1), rgba(255,138,61,0.05)); border: 1px solid rgba(255,138,61,0.2); text-align: center; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-user-doctor" style="font-size: 28px; color: #ff8a3d; display: block; margin-bottom: 0.5rem;"></i>
                <p style="margin: 0; font-weight: 500; font-size: 0.9rem;">Dokter</p>
            </div>
        </a>

        <a href="/admin/spesialis" style="text-decoration: none; color: inherit;">
            <div class="menu-item" style="padding: 1.5rem; border-radius: 12px; background: linear-gradient(135deg, rgba(76,175,80,0.1), rgba(76,175,80,0.05)); border: 1px solid rgba(76,175,80,0.2); text-align: center; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-star" style="font-size: 28px; color: #4CAF50; display: block; margin-bottom: 0.5rem;"></i>
                <p style="margin: 0; font-weight: 500; font-size: 0.9rem;">Spesialis</p>
            </div>
        </a>

        <a href="/admin/poli" style="text-decoration: none; color: inherit;">
            <div class="menu-item" style="padding: 1.5rem; border-radius: 12px; background: linear-gradient(135deg, rgba(33,150,243,0.1), rgba(33,150,243,0.05)); border: 1px solid rgba(33,150,243,0.2); text-align: center; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-clinic-medical" style="font-size: 28px; color: #2196F3; display: block; margin-bottom: 0.5rem;"></i>
                <p style="margin: 0; font-weight: 500; font-size: 0.9rem;">Poli</p>
            </div>
        </a>

        <a href="/admin/jadwal" style="text-decoration: none; color: inherit;">
            <div class="menu-item" style="padding: 1.5rem; border-radius: 12px; background: linear-gradient(135deg, rgba(255,152,0,0.1), rgba(255,152,0,0.05)); border: 1px solid rgba(255,152,0,0.2); text-align: center; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-calendar" style="font-size: 28px; color: #FF9800; display: block; margin-bottom: 0.5rem;"></i>
                <p style="margin: 0; font-weight: 500; font-size: 0.9rem;">Jadwal</p>
            </div>
        </a>

        <a href="/admin/artikel" style="text-decoration: none; color: inherit;">
            <div class="menu-item" style="padding: 1.5rem; border-radius: 12px; background: linear-gradient(135deg, rgba(156,39,176,0.1), rgba(156,39,176,0.05)); border: 1px solid rgba(156,39,176,0.2); text-align: center; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-newspaper" style="font-size: 28px; color: #9C27B0; display: block; margin-bottom: 0.5rem;"></i>
                <p style="margin: 0; font-weight: 500; font-size: 0.9rem;">Artikel</p>
            </div>
        </a>

        <a href="/admin/gallery" style="text-decoration: none; color: inherit;">
            <div class="menu-item" style="padding: 1.5rem; border-radius: 12px; background: linear-gradient(135deg, rgba(233, 30, 99, 0.1), rgba(233, 30, 99, 0.05)); border: 1px solid rgba(233, 30, 99, 0.2); text-align: center; cursor: pointer; transition: all 0.3s ease;">
                <i class="fas fa-images" style="font-size: 28px; color: #e91e63; display: block; margin-bottom: 0.5rem;"></i>
                <p style="margin: 0; font-weight: 500; font-size: 0.9rem;">Gallery</p>
            </div>
        </a>
    </div>
</div>

<style>
.menu-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

/* Responsive grid for mobile */
@media (max-width: 991px) {
    div[style*="grid-template-columns: 1fr 1fr"] {
        grid-template-columns: 1fr;
    }

    div[style*="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))"] {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    div[style*="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))"] {
        grid-template-columns: 1fr;
    }

    div[style*="grid-template-columns: repeat(auto-fit, minmax(140px, 1fr))"] {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style><?= $this->endSection(); ?>

<?= $this->section('admin_scripts'); ?>
<script>
// Jadwal slider variables
let currentDayIndex = 0;
const daysOfWeek = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

// Load all dashboard data
async function loadDashboard() {
    // Load admin profile
    try {
        const profileRes = await fetch(`${API_URL}/profile`);
        const profileData = await profileRes.json();
        if (profileData.status) {
            document.getElementById('greetingText').textContent = `Halo, ${profileData.data.username}`;
            document.getElementById('loginTime').textContent = new Date().toLocaleString('id-ID');
        }
    } catch (error) {
        console.error('Error loading profile:', error);
    }

    // Load doctors count
    try {
        const doctorsRes = await fetch(`${API_URL}/doctors?page=1`);
        const doctorsData = await doctorsRes.json();
        if (doctorsData.status) {
            document.getElementById('doctorCount').textContent = doctorsData.data.pagination?.total || 0;
        }
    } catch (error) {
        console.error('Error loading doctors:', error);
    }

    // Load spesialis count
    try {
        const spesialisRes = await fetch(`${API_URL}/spesialis`);
        const spesialisData = await spesialisRes.json();
        if (spesialisData.status) {
            document.getElementById('spesialisCount').textContent = spesialisData.data.spesialis?.length || 0;
        }
    } catch (error) {
        console.error('Error loading spesialis:', error);
    }

    // Load poli count
    try {
        const poliRes = await fetch(`${API_URL}/poli`);
        const poliData = await poliRes.json();
        if (poliData.status) {
            document.getElementById('poliCount').textContent = poliData.data.poli?.length || 0;
        }
    } catch (error) {
        console.error('Error loading poli:', error);
    }

    // Load artikel count
    try {
        const artikelRes = await fetch(`${API_URL}/artikel?page=1`);
        const artikelData = await artikelRes.json();
        if (artikelData.status) {
            document.getElementById('artikelCount').textContent = artikelData.data.pagination?.total || 0;
        }
    } catch (error) {
        console.error('Error loading artikel:', error);
    }

    // Load jadwal for today
    const today = daysOfWeek[new Date().getDay() - 1] || "Senin";
    setDaySelect(today);
    loadJadwalForDay(today);
}

// Jadwal slider functions
function setDaySelect(day) {
    document.getElementById('daySelect').value = day;
    const index = daysOfWeek.indexOf(day);
    currentDayIndex = index >= 0 ? index : 0;
}

function loadJadwalForDay(dayName) {
    const jadwalList = document.getElementById('jadwalList');
    jadwalList.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-warning" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

    fetch(`${API_URL}/jadwal?hari=${dayName}`)
        .then(r => r.json())
        .then(data => {
            if (data.status && data.data && data.data.length > 0) {
                renderJadwalList(data.data);
            } else {
                jadwalList.innerHTML = `
                    <div class="empty-state" style="padding: 2rem; text-align: center;">
                        <i class="fas fa-calendar" style="font-size: 40px; color: #ccc; margin-bottom: 1rem;"></i>
                        <p style="color: #999;">Tidak ada jadwal di hari ${dayName}</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading jadwal:', error);
            jadwalList.innerHTML = `
                <div class="empty-state" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-exclamation-circle" style="font-size: 40px; color: #e74c3c; margin-bottom: 1rem;"></i>
                    <p style="color: #e74c3c;">Gagal memuat jadwal</p>
                </div>
            `;
        });
}

function renderJadwalList(jadwals) {
    const jadwalList = document.getElementById('jadwalList');
    let html = '';

    jadwals.forEach(jadwal => {
        const doctorName = jadwal.doctor_name || jadwal.doctor?.nama_doctor || 'Unknown';
        html += `
            <div style="padding: 1rem; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="font-weight: 600; margin: 0 0 0.25rem 0; font-size: 0.95rem;">${doctorName}</p>
                    <p style="color: #999; margin: 0; font-size: 0.85rem;">
                        <i class="fas fa-clock" style="color: #ff8a3d;"></i> ${jadwal.jam_mulai} - ${jadwal.jam_selesai}
                    </p>
                </div>
                <span style="background: #ff8a3d; color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem;">
                    Aktif
                </span>
            </div>
        `;
    });

    jadwalList.innerHTML = html;
}

function prevDay() {
    currentDayIndex = (currentDayIndex - 1 + 7) % 7;
    document.getElementById('daySelect').value = daysOfWeek[currentDayIndex];
    loadJadwalForDay(daysOfWeek[currentDayIndex]);
}

function nextDay() {
    currentDayIndex = (currentDayIndex + 1) % 7;
    document.getElementById('daySelect').value = daysOfWeek[currentDayIndex];
    loadJadwalForDay(daysOfWeek[currentDayIndex]);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', async function() {
    await loadDashboard();
});
</script>
<?= $this->endSection(); ?>