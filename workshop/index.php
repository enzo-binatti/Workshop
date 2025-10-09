<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Workshop - Projetos</title>
    <style>
        /* Variáveis de Cores Aprimoradas - Dark com Vermelho LED (Não Muito Vibrante, com Melhorias) */
        :root {
            --bg-primary: #0e111a; /* Dark Blue/Black */
            --bg-secondary: #161923;
            --bg-card: #1c212e;
            --text-primary: #f0f4f8;
            --text-secondary: #a3b3c3;
            --text-muted: #6b778d;
            --border: #2a3449;
            --accent: #b71c1c; /* Vermelho LED Escuro, Não Vibrante */
            --accent-hover: #d32f2f;
            --shadow-dark: rgba(0, 0, 0, 0.4);
            --shadow-light: rgba(255, 255, 255, 0.03);
            --shadow-inner: rgba(0, 0, 0, 0.1);
            --neon-glow: rgba(183, 28, 28, 0.6); /* Glow sutil para neon LED */
        }
        
        /* Reset e Base */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            text-rendering: optimizeLegibility;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 64px 24px;
            perspective: 1000px; /* Para efeitos 3D nos cards */
        }
        
        /* Header */
        header {
            margin-bottom: 72px;
            text-align: center;
        }
        
        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            margin-bottom: 12px;
            background: linear-gradient(135deg, var(--accent-hover) 0%, var(--accent) 30%, var(--text-primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 10px var(--neon-glow);
        }
        
        .subtitle {
            color: var(--text-secondary);
            font-size: 1.25rem;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
        }
        
        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        
        /* Card Detail */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 30px;
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 30px var(--shadow-dark);
            transform-style: preserve-3d; /* Para efeitos 3D */
            animation: fadeIn 0.5s ease-in; /* Fade-in on load */
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Linha de brilho (top border) */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .card:hover {
            transform: translateY(-8px) rotateY(5deg) rotateX(3deg) scale(1.02); /* Adicionado 3D tilt e scale */
            border-color: var(--accent);
            box-shadow: 0 25px 50px var(--shadow-dark), 
                        0 0 15px var(--neon-glow), 
                        0 10px 20px rgba(0, 0, 0, 0.1); /* Multi-layer depth e glow */
        }
        
        .card:hover::before {
            opacity: 1;
        }
        
        .card-number {
            display: inline-block;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--accent);
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            padding: 6px 14px;
            border-radius: 9999px; /* Pill shape */
            margin-bottom: 20px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            box-shadow: inset 0 1px 3px var(--shadow-inner);
            transition: transform 0.3s ease; /* Micro-interaction */
        }
        
        .card:hover .card-number {
            transform: scale(1.1); /* Subtle scale on hover */
        }
        
        .card h2 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-primary);
            letter-spacing: -0.01em;
            text-shadow: 0 0 5px var(--neon-glow); /* Neon glow para título */
            transition: text-shadow 0.3s ease;
        }
        
        .card:hover h2 {
            text-shadow: 0 0 10px var(--neon-glow), 0 0 20px var(--neon-glow);
        }
        
        .card-description {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 30px;
            line-height: 1.5;
        }
        
        /* Link/Button Style */
        .card-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            padding: 12px 24px;
            border: 2px solid var(--accent);
            border-radius: 10px;
            transition: all 0.3s ease;
            background: transparent;
            text-shadow: 0 0 5px var(--neon-glow);
            box-shadow: 0 0 15px var(--neon-glow);
        }
        
        .card-link:hover {
            background: var(--accent);
            color: var(--bg-primary);
            border-color: var(--accent-hover);
            transform: translateY(-2px) scale(1.05); /* Adicionado scale */
            box-shadow: 0 5px 20px var(--neon-glow);
            text-shadow: none;
        }
        
        .card-link::after {
            content: '→';
            font-size: 1.25rem;
            transition: transform 0.2s ease;
        }
        
        .card-link:hover::after {
            transform: translateX(4px) rotate(45deg); /* Adicionado rotate para micro-interaction */
        }
        
        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 40px 16px;
            }
            
            h1 {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
            
            .grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .card {
                padding: 24px;
            }
        }
        
        @media (prefers-reduced-motion: reduce) {
            * {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <header>
            <h1>Workshop - Projetos</h1>
            <p class="subtitle">Explore os projetos desenvolvidos durante o workshop e clique para acessar.</p>
        </header>
        
        <div class="grid">
            <article class="card">
                <span class="card-number">01</span>
                <h2>Portfólio Pessoal com IA</h2>
                <p class="card-description">Apresentação profissional moderna e integração de IA simples para sugerir serviços personalizados ao cliente.</p>
                <a href="01-portfolio-ai/" class="card-link">Abrir projeto</a>
            </article>
            
            <article class="card">
                <span class="card-number">02</span>
                <h2>Quiz Interativo</h2>
                <p class="card-description">Quiz dinâmico e responsivo com perguntas aleatórias via JavaScript, gerenciamento de pontuação e feedback imediato.</p>
                <a href="02-quiz/" class="card-link">Abrir projeto</a>
            </article>
            
            <article class="card">
                <span class="card-number">03</span>
                <h2>Dashboard Simples</h2>
                <p class="card-description">Visualização de dados com KPIs (Key Performance Indicators) essenciais e um gráfico dinâmico de performance.</p>
                <a href="03-dashboard/" class="card-link">Abrir projeto</a>
            </article>
            
            <article class="card">
                <span class="card-number">04</span>
                <h2>Agenda de Eventos</h2>
                <p class="card-description">Interface completa de CRUD (Criar, Ler, Atualizar, Deletar) de eventos com JSON, filtros e edição rápida (*inline*).</p>
                <a href="04-events/" class="card-link">Abrir projeto</a>
            </article>
            
            <article class="card">
                <span class="card-number">05</span>
                <h2>Mini Loja Virtual</h2>
                <p class="card-description">Simulação de e-commerce com catálogo de produtos, gerenciamento de carrinho de compras e um fluxo de checkout.</p>
                <a href="05-loja/" class="card-link">Abrir projeto</a>
            </article>
        </div>
    </main>
</body>
</html>