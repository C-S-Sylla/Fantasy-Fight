<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Fight - L'Éveil des Héros</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700;900&family=MedievalSharp&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gold: #d4af37;
            --magic-blue: #00d4ff;
            --deep-black: #0a0a0c;
        }

        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: var(--deep-black);
            font-family: 'MedievalSharp', cursive;
        }

        /* Fond avec effet de brume/vortex */
        .background-container {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, #1a1a2e 0%, #0a0a0c 100%);
            z-index: -2;
        }

        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/dark-matter.png');
            opacity: 0.5;
            z-index: -1;
        }

        /* Particules magiques (Animation simple) */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        /* Titre Principal */
        .main-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            color: white;
        }

        h1 {
            font-family: 'Cinzel Decorative', serif;
            font-size: 5rem;
            margin: 0;
            color: var(--gold);
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.5), 4px 4px 0px black;
            letter-spacing: 10px;
            animation: titleGlow 3s infinite alternate;
        }

        .subtitle {
            font-size: 1.5rem;
            letter-spacing: 5px;
            color: var(--magic-blue);
            text-transform: uppercase;
            margin-top: -10px;
            opacity: 0.8;
        }

        /* Bouton d'entrée */
        .enter-btn {
            margin-top: 50px;
            padding: 20px 60px;
            font-size: 1.8rem;
            font-family: 'Cinzel Decorative', serif;
            background: transparent;
            color: var(--gold);
            border: 2px solid var(--gold);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: 0.5s;
            box-shadow: 0 0 15px rgba(212, 175, 55, 0.2);
            text-decoration: none;
        }

        .enter-btn:hover {
            color: white;
            background: var(--gold);
            box-shadow: 0 0 50px var(--gold);
            transform: scale(1.1);
        }

        /* Décorations de coins */
        .corner {
            position: absolute;
            width: 150px;
            height: 150px;
            border: 2px solid var(--gold);
            opacity: 0.3;
        }

        .top-left { top: 20px; left: 20px; border-right: none; border-bottom: none; }
        .top-right { top: 20px; right: 20px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: 20px; left: 20px; border-right: none; border-top: none; }
        .bottom-right { bottom: 20px; right: 20px; border-left: none; border-top: none; }

        @keyframes titleGlow {
            from { text-shadow: 0 0 20px rgba(212, 175, 55, 0.5); }
            to { text-shadow: 0 0 40px rgba(0, 212, 255, 0.8); }
        }

        /* Version mobile */
        @media (max-width: 768px) {
            h1 { font-size: 3rem; }
            .enter-btn { padding: 15px 30px; font-size: 1.2rem; }
        }
    </style>
</head>
<body>

    <div class="background-container"></div>
    <div class="overlay"></div>

    <!-- Coins décoratifs -->
    <div class="corner top-left"></div>
    <div class="corner top-right"></div>
    <div class="corner bottom-left"></div>
    <div class="corner bottom-right"></div>

    <div class="main-content">
        <div class="subtitle">L'Odyssée des Arcanes</div>
        <h1>FANTASY FIGHT</h1>
        
        <a href="{{ url('/menu') }}" class="enter-btn">ENTRER DANS L'ARÈNE</a>


        <div style="margin-top: 100px; font-size: 0.8rem; color: rgba(255,255,255,0.4);">
            &copy; 2026 Studio Fantasy - Tous droits réservés
        </div>
    </div>

    <!-- Script pour petites particules magiques -->
    <script>
        function createParticle() {
            const particle = document.createElement('div');
            const size = Math.random() * 3;
            particle.style.position = 'absolute';
            particle.style.width = size + 'px';
            particle.style.height = size + 'px';
            particle.style.background = Math.random() > 0.5 ? '#d4af37' : '#00d4ff';
            particle.style.borderRadius = '50%';
            particle.style.top = Math.random() * 100 + 'vh';
            particle.style.left = Math.random() * 100 + 'vw';
            particle.style.opacity = Math.random();
            particle.style.boxShadow = '0 0 10px white';
            
            document.body.appendChild(particle);

            // Animation simple
            const duration = Math.random() * 3000 + 2000;
            particle.animate([
                { transform: 'translateY(0)', opacity: particle.style.opacity },
                { transform: `translateY(-${Math.random() * 100 + 50}px)`, opacity: 0 }
            ], { duration: duration });

            setTimeout(() => {
                particle.remove();
            }, duration);
        }

        setInterval(createParticle, 100);
    </script>
</body>
</html>