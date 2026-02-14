<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Klinik Brayan Sehat'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* --- ELITE GLOBAL SETUP --- */
        :root {
            --primary-orange: #ff8a3d;
            --dark-orange: #e6762d;
            --soft-bg: #fdfdfd;
        }

        html { scroll-behavior: smooth; }
        body { 
            /* Padding dinamis: 90px di desktop, 70px di HP */
            padding-top: clamp(70px, 10vh, 90px); 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--soft-bg); 
            color: #333;
            overflow-x: hidden;
        }

        /* --- TYPOGRAPHY MODERN --- */
        h1, h2, h3 { font-weight: 700; color: #222; }
        /* Font size otomatis mengecil di layar kecil tanpa media query */
        h1 { font-size: clamp(1.8rem, 4vw, 2.5rem); } 

        /* --- NAVIGATION --- */
        .nav-link { 
            color: #444 !important; 
            font-weight: 500; 
            margin: 0 12px; 
            transition: 0.3s;
            position: relative;
        }
        .nav-link:after {
            content: '';
            position: absolute;
            width: 0; height: 2px;
            bottom: -2px; left: 0;
            background-color: var(--primary-orange);
            transition: 0.3s;
        }
        .nav-link:hover:after, .nav-link.active:after { width: 100%; }
        .nav-link:hover { color: var(--primary-orange) !important; }

        /* --- BUTTONS --- */
        .btn-orange { 
            background-color: var(--primary-orange); 
            color: white; 
            border-radius: 12px; 
            padding: 10px 28px; 
            border: none; 
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-orange:hover { 
            background-color: var(--dark-orange); 
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 138, 61, 0.3);
            color: white;
        }

        /* --- SMART CHATBOX --- */
        .chatbox-container {
            position: fixed;
            bottom: clamp(15px, 3vw, 30px);
            right: clamp(15px, 3vw, 30px);
            z-index: 2000;
        }

        .chat-trigger {
            width: 60px; height: 60px;
            background: var(--primary-orange);
            color: white; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; cursor: pointer;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: 0.4s; border: none;
        }
        .chat-trigger:hover { transform: rotate(15deg) scale(1.1); }

        .chat-window {
            position: absolute;
            bottom: 75px; right: 0;
            width: 350px; 
            max-width: calc(100vw - 40px); /* Gak bakal off-screen di HP */
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            display: none; flex-direction: column;
            overflow: hidden;
            animation: slideUp 0.4s cubic-bezier(0.18, 0.89, 0.32, 1.28);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px) scale(0.9); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .chat-header { background: var(--primary-orange); color: white; padding: 15px 20px; }
        
        #chatContent {
            height: 350px;
            overflow-y: auto;
            background: #fdfdfd;
            padding: 20px;
            display: flex; flex-direction: column; gap: 12px;
        }

        .msg { 
            max-width: 80%; padding: 10px 14px; 
            border-radius: 15px; font-size: 0.88rem; 
            line-height: 1.5;
        }
        .bot-msg { 
            align-self: flex-start; background: #f1f1f1; color: #444; 
            border-bottom-left-radius: 4px; 
        }
        .user-msg { 
            align-self: flex-end; background: var(--primary-orange); color: white; 
            border-bottom-right-radius: 4px;
        }

        .chat-footer { padding: 15px; background: white; border-top: 1px solid #eee; }
        .chat-input-group {
            display: flex; background: #f5f5f5; border-radius: 25px; padding: 5px 15px;
        }
        .chat-input-group input { border: none; background: transparent; width: 100%; padding: 8px; font-size: 0.9rem; }
        .chat-input-group input:focus { outline: none; }

        /* --- MOBILE TUNING --- */
        @media (max-width: 768px) {
            .nav-link { text-align: center; padding: 10px 0; border-bottom: 1px solid #eee; margin: 0; }
            .nav-link:after { display: none; }
            .chat-window { bottom: 80px; width: 320px; }
        }
    </style>
    <?= $this->renderSection('extra-css'); ?>
</head>
<body>

    <?= $this->include('layout/navbar'); ?>

    <main class="container py-4">
        <?= $this->renderSection('content'); ?>
    </main>

    <div class="chatbox-container">
        <div class="chat-window" id="chatWindow">
            <div class="chat-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px;">
                        <i class="fa-solid fa-robot text-orange" style="color: var(--primary-orange); font-size: 0.8rem;"></i>
                    </div>
                    <div>
                        <span class="fw-bold d-block" style="font-size: 0.85rem; line-height: 1;">KBS Assistant</span>
                        <small style="font-size: 0.65rem; opacity: 0.9;">Online</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" style="font-size: 0.6rem;" onclick="toggleChat()"></button>
            </div>

            <div id="chatContent">
                <div class="msg bot-msg">
                    Halo! Ada yang bisa kami bantu hari ini? 😊
                </div>
            </div>

            <div class="chat-footer">
                <div class="chat-input-group">
                    <input type="text" id="userInput" placeholder="Ketik pesan..." onkeypress="handleKeyPress(event)">
                    <button class="border-0 bg-transparent" onclick="sendMessage()">
                        <i class="fa-solid fa-paper-plane" style="color: var(--primary-orange);"></i>
                    </button>
                </div>
            </div>
        </div>

        <button class="chat-trigger" onclick="toggleChat()">
            <i class="fa-solid fa-headset"></i>
        </button>
    </div>

    <?= $this->include('layout/footer'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleChat() {
            const win = document.getElementById('chatWindow');
            const isVisible = win.style.display === 'flex';
            win.style.display = isVisible ? 'none' : 'flex';
            if(!isVisible) document.getElementById('userInput').focus();
        }

        function handleKeyPress(e) { if (e.key === 'Enter') sendMessage(); }

        function sendMessage() {
            const input = document.getElementById('userInput');
            const content = document.getElementById('chatContent');
            const msg = input.value.trim();
            if (!msg) return;

            content.innerHTML += `<div class="msg user-msg">${msg}</div>`;
            input.value = "";
            content.scrollTo({ top: content.scrollHeight, behavior: 'smooth' });

            setTimeout(() => {
                let res = "Maaf, saya belum mengerti. Coba tanya 'Jadwal' atau 'Lokasi'.";
                const low = msg.toLowerCase();
                if (low.includes("jadwal")) res = "Kami buka <b>Senin-Sabtu jam 08:00 - 21:00</b>.";
                if (low.includes("lokasi")) res = "Klinik kami ada di <b>Jl. Brayan Sehat No. 10</b>.";

                content.innerHTML += `<div class="msg bot-msg">${res}</div>`;
                content.scrollTo({ top: content.scrollHeight, behavior: 'smooth' });
            }, 700);
        }
    </script>
</body>
</html>