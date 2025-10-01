<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Workshop - Projetos</title>
  <style>
    :root {
      --bg-primary: #0a0a0a;
      --bg-secondary: #111111;
      --bg-card: #1a1a1a;
      --text-primary: #ffffff;
      --text-secondary: #a3a3a3;
      --text-muted: #737373;
      --border: #262626;
      --accent: #ffffff;
      --accent-hover: #e5e5e5;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background: var(--bg-primary);
      color: var(--text-primary);
      line-height: 1.6;
      min-height: 100vh;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 48px 24px;
    }
    
    header {
      margin-bottom: 64px;
      text-align: center;
    }
    
    h1 {
      font-size: 3rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      margin-bottom: 12px;
      background: linear-gradient(135deg, var(--text-primary) 0%, var(--text-secondary) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .subtitle {
      color: var(--text-muted);
      font-size: 1.125rem;
      font-weight: 400;
    }
    
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 24px;
    }
    
    .card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }
    
    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: linear-gradient(90deg, transparent, var(--accent), transparent);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-4px);
      border-color: var(--accent);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }
    
    .card:hover::before {
      opacity: 1;
    }
    
    .card-number {
      display: inline-block;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--text-muted);
      background: var(--bg-secondary);
      padding: 4px 12px;
      border-radius: 6px;
      margin-bottom: 16px;
      letter-spacing: 0.05em;
    }
    
    .card h2 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 12px;
      color: var(--text-primary);
      letter-spacing: -0.01em;
    }
    
    .card-description {
      color: var(--text-secondary);
      font-size: 0.9375rem;
      margin-bottom: 24px;
      line-height: 1.6;
    }
    
    .card-link {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--text-primary);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9375rem;
      padding: 10px 20px;
      border: 1px solid var(--border);
      border-radius: 8px;
      transition: all 0.2s ease;
      background: var(--bg-secondary);
    }
    
    .card-link:hover {
      background: var(--accent);
      color: var(--bg-primary);
      border-color: var(--accent);
      transform: translateX(4px);
    }
    
    .card-link::after {
      content: '→';
      font-size: 1.125rem;
      transition: transform 0.2s ease;
    }
    
    .card-link:hover::after {
      transform: translateX(4px);
    }
    
    @media (max-width: 768px) {
      .container {
        padding: 32px 16px;
      }
      
      h1 {
        font-size: 2rem;
      }
      
      .subtitle {
        font-size: 1rem;
      }
      
      .grid {
        grid-template-columns: 1fr;
        gap: 16px;
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
      <p class="subtitle">Explore os projetos desenvolvidos durante o workshop</p>
    </header>
    
    <div class="grid">
      <article class="card">
        <span class="card-number">01</span>
        <h2>Portfólio Pessoal com IA</h2>
        <p class="card-description">Apresentação profissional e IA simples para sugerir serviços personalizados.</p>
        <a href="01-portfolio-ai/" class="card-link">Abrir projeto</a>
      </article>
      
      <article class="card">
        <span class="card-number">02</span>
        <h2>Quiz Interativo</h2>
        <p class="card-description">Perguntas dinâmicas via JSON e correção automática em PHP.</p>
        <a href="02-quiz/" class="card-link">Abrir projeto</a>
      </article>
      
      <article class="card">
        <span class="card-number">03</span>
        <h2>Dashboard Simples</h2>
        <p class="card-description">KPIs e gráfico dinâmico com visualização de dados fictícios.</p>
        <a href="03-dashboard/" class="card-link">Abrir projeto</a>
      </article>
      
      <article class="card">
        <span class="card-number">04</span>
        <h2>Agenda de Eventos</h2>
        <p class="card-description">CRUD completo com JSON, filtros avançados e edição inline.</p>
        <a href="04-events/" class="card-link">Abrir projeto</a>
      </article>
      
      <article class="card">
        <span class="card-number">05</span>
        <h2>Mini Loja Virtual</h2>
        <p class="card-description">Catálogo de produtos, carrinho de compras e checkout simulado.</p>
        <a href="05-store/" class="card-link">Abrir projeto</a>
      </article>
    </div>
  </main>
</body>
</html>
