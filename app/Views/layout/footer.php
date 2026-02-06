<style>
    .main-footer {
        background-color: #8B0000; /* Warna merah gelap sesuai branding */
        color: #ffffff;
        padding: 60px 0 30px;
        font-family: 'Poppins', sans-serif;
    }
    .footer-title {
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }
    .footer-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #ff8b3d; 
    }
    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }
    .footer-contact-item:hover { transform: translateX(10px); }
    .footer-icon {
        font-size: 1.5rem;
        margin-right: 15px;
        width: 30px;
        text-align: center;
        color: #ff8a3d;
    }
    .contact-text h6 {
        font-size: 0.85rem;
        text-transform: uppercase;
        margin-bottom: 2px;
        opacity: 0.8;
    }
    .contact-text p { margin-bottom: 0; font-weight: 500; }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 40px;
        padding-top: 25px;
        text-align: center;
        font-size: 0.85rem;
        opacity: 0.7;
    }
</style>

<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="footer-title">Klinik Brayan Sehat</h5>
                <p class="small" style="line-height: 1.8; opacity: 0.9;">
                    Memberikan pelayanan kesehatan terbaik dengan tenaga medis profesional dan fasilitas modern.
                </p>
            </div>

            <div class="col-lg-4 mb-4">
                <h5 class="footer-title">Hubungi Kami</h5>
                <div class="footer-contact-item">
                    <div class="footer-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="contact-text">
                        <h6>Telepon</h6>
                        <p>(0281) 777-2941</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-icon"><i class="fab fa-whatsapp"></i></div>
                    <div class="contact-text">
                        <h6>Whatsapp</h6>
                        <p>0855-4044-1147</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div class="footer-icon"><i class="far fa-envelope"></i></div>
                    <div class="contact-text">
                        <h6>Email</h6>
                        <p>klinikbrayansehat@gmail.com</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <h5 class="footer-title">Lokasi Utama</h5>
                <div class="footer-contact-item">
                    <div class="footer-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-text">
                        <h6>Alamat</h6>
                        <p>Jl. S Parman No 74 A Purwokerto Kulon, Purwokerto Selatan, Banyumas, Jawa Tengah 53141</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?= date('Y'); ?> Klinik Brayan Sehat. All Rights Reserved.</p>
        </div>
    </div>
</footer>