<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portfólio - Enzo Binatti Baleroni</title>
  <style>
    /* ---------------------------------- */
    /* Variáveis para o estilo LED Amarelo */
    /* ---------------------------------- */
    :root {
      --bg-primary: #000000;
      --bg-secondary: #0a0a0a; /* Fundo de cartões mais escuro */
      --bg-card: #050505; /* Fundo de seções (mais escuro que o secondary) */
      --text-primary: #f0f0f0;
      --text-secondary: #aaaaaa;
      --text-muted: #666666;
      --border: #1a1a1a;
      --accent: #ffc700; /* Amarelo/Âmbar LED */
      --accent-glow: #ffe066; /* Amarelo mais claro para brilho */
      --led-glow: 0 0 8px rgba(255, 199, 0, 0.7), 0 0 12px rgba(255, 199, 0, 0.5);
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
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
      padding: 2rem;
    }

    header {
      text-align: center;
      padding: 4rem 2rem 3rem;
      border-bottom: 1px solid var(--border);
      position: relative; /* Para posicionar o logo */
    }

    /* ---------------------------------- */
    /* Novo Estilo Logo */
    /* ---------------------------------- */
    .logo-box {
      position: absolute;
      left: 2rem;
      top: 50%;
      transform: translateY(-50%);
      text-align: left;
      line-height: 1.2;
    }

    .logo-text {
      font-size: 2.2rem;
      font-weight: 900;
      color: var(--accent);
      text-shadow: var(--led-glow);
      display: block;
    }

    .logo-subtext {
        display: block;
        font-size: 0.7rem;
        color: var(--text-primary);
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    /* ---------------------------------- */
    /* Título H1 com Efeito LED */
    /* ---------------------------------- */
    h1 {
      font-size: 3rem;
      font-weight: 700;
      /* Gradiente do Amarelo LED */
      background: linear-gradient(135deg, var(--accent-glow) 0%, var(--accent) 50%, var(--text-primary) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
      text-shadow: 0 0 5px rgba(255, 199, 0, 0.4); /* Sombra sutil de brilho */
    }

    header p {
      font-size: 1.125rem;
      color: var(--text-secondary);
      margin-bottom: 2rem;
    }

    header p strong {
      color: var(--text-primary);
      font-weight: 600;
    }

    /* ---------------------------------- */
    /* Navegação com Efeito LED */
    /* ---------------------------------- */
    nav {
      display: flex;
      gap: 2rem;
      justify-content: center;
      flex-wrap: wrap;
    }

    nav a {
      color: var(--text-secondary);
      text-decoration: none;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      position: relative;
    }

    nav a:hover {
      color: var(--accent-glow);
      background: var(--bg-secondary);
      text-shadow: 0 0 3px rgba(255, 199, 0, 0.5);
    }

    nav a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%) scaleX(0);
      width: 80%;
      height: 2px;
      background: var(--accent);
      box-shadow: 0 0 5px rgba(255, 199, 0, 0.8);
      transition: transform 0.3s ease;
    }

    nav a:hover::after {
      transform: translateX(-50%) scaleX(1);
    }

    main {
      padding: 3rem 2rem;
    }

    /* ---------------------------------- */
    /* Cartões e Hover com LED */
    /* ---------------------------------- */
    .card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      transition: all 0.3s ease;
    }

    .card:hover {
      border-color: var(--accent);
      box-shadow: 0 0 15px rgba(255, 199, 0, 0.2);
      transform: translateY(-2px);
    }

    h2 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: var(--text-primary);
      letter-spacing: -0.01em;
    }

    .card p {
      font-size: 1.125rem;
      color: var(--text-secondary);
      line-height: 1.8;
    }

    /* ---------------------------------- */
    /* Grids Responsivos */
    /* ---------------------------------- */
    .stats-grid, .services-grid, .differentials-grid, .contact-info {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    .stat-item, .service-card, .differential-item, .contact-item {
      background: var(--bg-secondary);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      transition: all 0.3s ease;
    }

    .stat-item:hover, .service-card:hover, .differential-item:hover, .contact-item:hover {
      border-color: var(--accent);
      box-shadow: 0 0 10px rgba(255, 199, 0, 0.2);
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      display: block;
      margin-bottom: 0.5rem;
      /* Gradiente LED */
      background: linear-gradient(135deg, var(--accent-glow) 0%, var(--accent) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-shadow: var(--led-glow);
    }

    .stat-label {
      color: var(--text-secondary);
      font-size: 0.9rem;
    }

    .service-icon, .differential-icon, .contact-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      display: block;
      filter: drop-shadow(0 0 3px var(--accent));
    }

    .service-card h3, .differential-item h3, .contact-item h3 {
      font-size: 1.25rem;
      margin-bottom: 0.75rem;
      color: var(--text-primary);
    }

    .service-card p, .differential-item p {
      color: var(--text-secondary);
      font-size: 0.95rem;
    }

    /* ---------------------------------- */
    /* Processo de Trabalho */
    /* ---------------------------------- */
    .process-steps {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      margin-top: 1.5rem;
    }

    .process-step {
      display: flex;
      align-items: flex-start;
      gap: 1.5rem;
      background: var(--bg-secondary);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1.5rem;
      transition: all 0.3s ease;
    }

    .process-step:hover {
      border-color: var(--accent);
      box-shadow: 0 0 10px rgba(255, 199, 0, 0.2);
    }

    .step-number {
      background: var(--accent);
      color: var(--bg-primary);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      flex-shrink: 0;
      text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    }

    .step-content h3 {
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
      color: var(--text-primary);
    }

    .step-content p {
      color: var(--text-secondary);
    }

    /* ---------------------------------- */
    /* Depoimentos */
    /* ---------------------------------- */
    .testimonial {
      background: var(--bg-secondary);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }

    .testimonial:hover {
      border-color: var(--accent);
      box-shadow: 0 0 10px rgba(255, 199, 0, 0.2);
    }

    .testimonial-text {
      font-style: italic;
      margin-bottom: 1rem;
      color: var(--text-secondary);
    }

    .testimonial-author {
      font-weight: 600;
      color: var(--text-primary);
    }

    .testimonial-role {
      font-size: 0.9rem;
      color: var(--text-muted);
    }

    /* ---------------------------------- */
    /* FAQ */
    /* ---------------------------------- */
    .faq-item {
      background: var(--bg-secondary);
      border: 1px solid var(--border);
      border-radius: 12px;
      margin-bottom: 1rem;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .faq-item.active {
      border-color: var(--accent);
    }

    .faq-question {
      padding: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      font-weight: 600;
    }

    .faq-toggle {
      color: var(--accent);
      font-size: 1.5rem;
      transition: transform 0.3s ease;
    }

    .faq-item.active .faq-toggle {
      transform: rotate(45deg);
    }

    .faq-answer {
      padding: 0 1.5rem;
      max-height: 0;
      overflow: hidden;
      transition: all 0.3s ease;
      color: var(--text-secondary);
    }

    .faq-item.active .faq-answer {
      padding: 0 1.5rem 1.5rem;
      max-height: 500px;
    }

    /* ---------------------------------- */
    /* Estilo de Formulário e Botão LED */
    /* ---------------------------------- */
    .ai-box, form {
      margin-top: 1.5rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      color: var(--text-secondary);
    }

    textarea,
    input[type="text"],
    input[type="email"],
    input {
      width: 100%;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      background: var(--bg-primary);
      border: 1px solid var(--border);
      color: var(--text-primary);
      font-family: inherit;
      font-size: 1rem;
      margin-bottom: 1rem;
      transition: all 0.3s ease;
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    textarea:focus,
    input:focus {
      outline: none;
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(255, 199, 0, 0.2);
    }

    .btn {
      background: var(--accent);
      color: var(--bg-primary);
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.3s ease;
      text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    }

    .btn:hover {
      background: var(--accent-glow);
      transform: translateY(-2px);
      box-shadow: var(--led-glow);
    }

    .muted {
      padding: 1rem;
      border-radius: 8px;
      margin-top: 1rem;
      color: var(--text-secondary);
      background: var(--bg-secondary);
      border: 1px solid var(--border);
    }

    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .tag {
        background: var(--bg-secondary);
        border: 1px solid var(--accent);
        color: var(--accent-glow);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        text-shadow: 0 0 2px rgba(255, 199, 0, 0.5);
    }

    .success {
      color: #7efc7e; /* Green for success */
      background: rgba(0, 255, 0, 0.1);
      border-color: rgba(0, 255, 0, 0.2);
    }

    .error {
      color: #ff8888; /* Red for error */
      background: rgba(255, 0, 0, 0.1);
      border-color: rgba(255, 0, 0, 0.2);
    }

    /* ---------------------------------- */
    /* Footer */
    /* ---------------------------------- */
    footer {
        border-top: 1px solid var(--border);
        padding-top: 2rem;
        text-align: center;
        color: var(--text-secondary);
    }
    
    /* ---------------------------------- */
    /* Animações */
    /* ---------------------------------- */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      animation: fadeIn 0.6s ease forwards;
    }

    .card:nth-child(1) {
      animation-delay: 0.1s;
    }

    .card:nth-child(2) {
      animation-delay: 0.2s;
    }

    .card:nth-child(3) {
      animation-delay: 0.3s;
    }

    /* ---------------------------------- */
    /* Responsividade */
    /* ---------------------------------- */
    @media (max-width: 768px) {
      /* Ajuste o logo para o centro em telas pequenas */
      .logo-box {
          position: static;
          transform: none;
          text-align: center;
          margin-bottom: 2rem;
      }
      
      header {
          padding: 3rem 1rem 2rem;
      }
      
      h1 {
        font-size: 2rem;
      }

      h2 {
        font-size: 1.5rem;
      }

      .card {
        padding: 1.5rem;
      }

      nav {
        gap: 1rem;
      }

      .stats-grid, .services-grid, .differentials-grid, .contact-info {
        grid-template-columns: 1fr;
      }

      .process-step {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <header class="container">
    <div class="logo-box">
        <span class="logo-text">A C</span>
        <span class="logo-subtext">Aliança Contábil</span>
    </div>
    
    <h1>Enzo Binatti Baleroni</h1>
    <p>30 anos | Formado na UNIPAR | Dono da <strong>Aliança Contábil</strong></p>
    <nav>
      <a href="#sobre">Sobre</a>
      <a href="#servicos">Serviços</a>
      <a href="#diferenciais">Diferenciais</a>
      <a href="#processo">Processo</a>
      <a href="#depoimentos">Depoimentos</a>
      <a href="#faq">FAQ</a>
      <a href="#contato">Contato</a>
    </nav>
  </header>

  <main class="container">
    <section id="sobre" class="card">
      <h2>Sobre</h2>
      <p style="margin-bottom: 1.5rem;">Sou contador formado pela UNIPAR e fundador da <strong>Aliança Contábil</strong>, empresa especializada em soluções contábeis e fiscais para pequenas e médias empresas. Com mais de 8 anos de experiência no mercado, minha missão é simplificar a gestão financeira e tributária dos meus clientes, permitindo que foquem no crescimento de seus negócios.</p>
      
      <p style="margin-bottom: 1.5rem;">A <strong>Aliança Contábil</strong> nasceu da visão de oferecer um serviço contábil diferenciado, combinando expertise técnica com atendimento personalizado e uso de tecnologia. Acreditamos que cada empresa é única e merece soluções sob medida para suas necessidades específicas.</p>
      
      <p>Nossa equipe é composta por profissionais qualificados e em constante atualização, garantindo que nossos clientes estejam sempre em conformidade com as legislações vigentes e aproveitem todas as oportunidades de otimização tributária disponíveis.</p>
    </section>

    <section class="card">
      <h2>Números que Falam por Si</h2>
      <div class="stats-grid">
        <div class="stat-item">
          <span class="stat-number">150+</span>
          <span class="stat-label">Clientes Ativos</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">8</span>
          <span class="stat-label">Anos de Experiência</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">98%</span>
          <span class="stat-label">Satisfação dos Clientes</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">5000+</span>
          <span class="stat-label">Declarações Processadas</span>
        </div>
      </div>
    </section>

    <section id="servicos" class="card">
      <h2>Nossos Serviços</h2>
      <p style="color: var(--text-secondary); margin-bottom: 1rem;">Oferecemos uma gama completa de serviços contábeis e fiscais para atender todas as necessidades da sua empresa.</p>
      
      <div class="services-grid">
        <div class="service-card">
          <span class="service-icon">📊</span>
          <h3>Contabilidade Completa</h3>
          <p>Gestão contábil completa incluindo escrituração, balanços, demonstrativos financeiros e relatórios gerenciais personalizados.</p>
        </div>
        
        <div class="service-card">
          <span class="service-icon">🏢</span>
          <h3>Abertura de Empresas</h3>
          <p>Assessoria completa para abertura de CNPJ, escolha do regime tributário ideal e registro em todos os órgãos necessários.</p>
        </div>
        
        <div class="service-card">
          <span class="service-icon">📝</span>
          <h3>Declaração de IR</h3>
          <p>Elaboração e envio da declaração de imposto de renda para pessoas físicas e jurídicas, com análise de deduções e restituições.</p>
        </div>
        
        <div class="service-card">
          <span class="service-icon">💼</span>
          <h3>Folha de Pagamento</h3>
          <p>Processamento completo de folha, cálculo de encargos, férias, rescisões e envio de obrigações acessórias (eSocial, FGTS).</p>
        </div>
        
        <div class="service-card">
          <span class="service-icon">⚖️</span>
          <h3>Consultoria Tributária</h3>
          <p>Planejamento tributário estratégico para redução legal de impostos e análise do melhor regime fiscal para seu negócio.</p>
        </div>
        
        <div class="service-card">
          <span class="service-icon">📈</span>
          <h3>Gestão Fiscal</h3>
          <p>Apuração de impostos, emissão de guias, escrituração fiscal e cumprimento de todas as obrigações acessórias.</p>
        </div>
        
        <div class="service-card">
          <span class="service-icon">💰</span>
          <h3>Balanço Patrimonial</h3>
          <p>Elaboração de balanços e demonstrações contábeis conforme normas brasileiras e internacionais de contabilidade.</p>
        </div>
        
        <div class="service-card">
          <span class="service-icon">🔍</span>
          <h3>Auditoria Contábil</h3>
          <p>Revisão e auditoria de documentos contábeis, identificação de inconsistências e regularização de pendências.</p>
        </div>
      </div>
    </section>

    <section class="card">
      <h2>IA: Sugestão de Serviços</h2>
      <p style="color: var(--text-secondary); margin-bottom: 1rem;">Não sabe qual serviço precisa? Descreva sua necessidade e nossa IA sugerirá os serviços mais adequados.</p>
      <div class="ai-box">
        <label for="servicosTxt">Descreva o que você precisa:</label>
        <textarea id="servicosTxt" placeholder="Ex: Preciso abrir uma empresa de tecnologia e não sei por onde começar..."></textarea>
        <button id="btnSugerir" class="btn">Sugerir Serviços</button>
        <div id="tagsSugeridas" class="muted"></div>
      </div>
    </section>

    <section id="diferenciais" class="card">
      <h2>Por Que Escolher a Aliança Contábil?</h2>
      <div class="differentials-grid">
        <div class="differential-item">
          <span class="differential-icon">🎯</span>
          <h3>Atendimento Personalizado</h3>
          <p>Cada cliente recebe atenção individual e soluções customizadas para suas necessidades específicas.</p>
        </div>
        
        <div class="differential-item">
          <span class="differential-icon">💻</span>
          <h3>Tecnologia de Ponta</h3>
          <p>Utilizamos os melhores sistemas e ferramentas para garantir eficiência e segurança na gestão contábil.</p>
        </div>
        
        <div class="differential-item">
          <span class="differential-icon">⚡</span>
          <h3>Agilidade nas Entregas</h3>
          <p>Processos otimizados que garantem rapidez no atendimento e cumprimento de prazos.</p>
        </div>
        
        <div class="differential-item">
          <span class="differential-icon">🛡️</span>
          <h3>Segurança e Conformidade</h3>
          <p>Total conformidade com legislação vigente e proteção de dados dos nossos clientes.</p>
        </div>
        
        <div class="differential-item">
          <span class="differential-icon">📚</span>
          <h3>Equipe Qualificada</h3>
          <p>Profissionais certificados e em constante atualização sobre mudanças tributárias e contábeis.</p>
        </div>
        
        <div class="differential-item">
          <span class="differential-icon">💡</span>
          <h3>Consultoria Estratégica</h3>
          <p>Não apenas executamos, mas orientamos decisões estratégicas para o crescimento do seu negócio.</p>
        </div>
      </div>
    </section>

    <section id="processo" class="card">
      <h2>Como Funciona Nosso Processo</h2>
      <div class="process-steps">
        <div class="process-step">
          <div class="step-number">1</div>
          <div class="step-content">
            <h3>Primeiro Contato</h3>
            <p>Entre em contato conosco através do formulário, telefone ou WhatsApp. Agende uma reunião inicial sem compromisso.</p>
          </div>
        </div>
        
        <div class="process-step">
          <div class="step-number">2</div>
          <div class="step-content">
            <h3>Diagnóstico</h3>
            <p>Analisamos sua situação atual, entendemos suas necessidades e identificamos oportunidades de melhoria.</p>
          </div>
        </div>
        
        <div class="process-step">
          <div class="step-number">3</div>
          <div class="step-content">
            <h3>Proposta Personalizada</h3>
            <p>Elaboramos uma proposta sob medida com os serviços necessários, prazos e investimento transparente.</p>
          </div>
        </div>
        
        <div class="process-step">
          <div class="step-number">4</div>
          <div class="step-content">
            <h3>Implementação</h3>
            <p>Iniciamos os trabalhos com coleta de documentos, configuração de sistemas e alinhamento de processos.</p>
          </div>
        </div>
        
        <div class="process-step">
          <div class="step-number">5</div>
          <div class="step-content">
            <h3>Acompanhamento Contínuo</h3>
            <p>Mantemos comunicação constante, enviamos relatórios periódicos e estamos sempre disponíveis para dúvidas.</p>
          </div>
        </div>
      </div>
    </section>

    <section id="depoimentos" class="card">
      <h2>O Que Nossos Clientes Dizem</h2>
      
      <div class="testimonial">
        <p class="testimonial-text">"A Aliança Contábil transformou a gestão financeira da minha empresa. O atendimento é excepcional e sempre recebo orientações valiosas para o crescimento do negócio. Recomendo de olhos fechados!"</p>
        <div class="testimonial-author">Maria Silva</div>
        <div class="testimonial-role">Proprietária - Silva Comércio de Alimentos</div>
      </div>
      
      <div class="testimonial">
        <p class="testimonial-text">"Profissionalismo e competência definem o trabalho do Enzo e sua equipe. Desde que contratei os serviços, não me preocupo mais com questões fiscais e posso focar no que realmente importa: fazer minha empresa crescer."</p>
        <div class="testimonial-author">João Santos</div>
        <div class="testimonial-role">CEO - TechStart Soluções</div>
      </div>
      
      <div class="testimonial">
        <p class="testimonial-text">"Excelente custo-benefício! A Aliança Contábil oferece serviços de alta qualidade com preços justos. A comunicação é clara e sempre recebo respostas rápidas para minhas dúvidas. Estou muito satisfeita!"</p>
        <div class="testimonial-author">Ana Paula Oliveira</div>
        <div class="testimonial-role">Diretora - Oliveira Consultoria</div>
      </div>
      
      <div class="testimonial">
        <p class="testimonial-text">"O planejamento tributário feito pela equipe resultou em uma economia significativa de impostos para minha empresa. Além disso, o suporte na abertura da filial foi impecável. Parceria de confiança!"</p>
        <div class="testimonial-author">Carlos Mendes</div>
        <div class="testimonial-role">Sócio - Mendes & Associados</div>
      </div>
    </section>

    <section id="faq" class="card">
      <h2>Perguntas Frequentes</h2>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>Quanto tempo leva para abrir uma empresa?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          O processo de abertura de empresa geralmente leva de 5 a 15 dias úteis, dependendo da complexidade do negócio e da agilidade dos órgãos públicos. Cuidamos de toda a burocracia para você.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>Qual o melhor regime tributário para minha empresa?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          Depende do faturamento, atividade e estrutura da sua empresa. Fazemos uma análise detalhada comparando Simples Nacional, Lucro Presumido e Lucro Real para identificar a opção mais vantajosa para o seu caso específico.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>Preciso ir até o escritório para contratar os serviços?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          Não é necessário. Todo o processo pode ser feito online através de videochamadas e envio digital de documentos. Oferecemos total comodidade e segurança no atendimento remoto.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>Como funciona a cobrança dos serviços?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          Trabalhamos com mensalidades fixas de acordo com o porte e necessidades da empresa. Não há cobranças surpresa. Tudo é acordado previamente na proposta comercial com total transparência.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>Vocês atendem empresas de todos os portes?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          Sim! Atendemos desde MEIs e microempresas até empresas de médio porte. Cada cliente recebe um atendimento personalizado adequado ao seu tamanho e complexidade.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>O que está incluído na contabilidade completa?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          Inclui escrituração contábil, apuração de impostos, emissão de guias, envio de obrigações acessórias, balanços, demonstrativos financeiros, certificado digital e suporte contábil ilimitado.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>Posso migrar minha contabilidade de outro escritório?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          Com certeza! Cuidamos de todo o processo de transição, solicitando documentos ao escritório anterior e garantindo que não haja interrupção nos seus serviços contábeis.
        </div>
      </div>
      
      <div class="faq-item">
        <div class="faq-question">
          <span>Oferecem suporte fora do horário comercial?</span>
          <span class="faq-toggle">+</span>
        </div>
        <div class="faq-answer">
          Para questões urgentes, oferecemos suporte via WhatsApp com tempo de resposta estendido. Para demandas rotineiras, nosso horário de atendimento é de segunda a sexta, das 8h às 18h.
        </div>
      </div>
    </section>

    <section id="contato" class="card">
      <h2>Entre em Contato</h2>
      <div class="contact-info">
        <div class="contact-item">
          <span class="contact-icon">📱</span>
          <h3>WhatsApp</h3>
          <a href="https://wa.me/5544999999999" target="_blank">(44) 99999-9999</a>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">📧</span>
          <h3>Email</h3>
          <a href="mailto:contato@aliancacontabil.com.br">contato@aliancacontabil.com.br</a>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">📍</span>
          <h3>Endereço</h3>
          <p style="color: var(--text-secondary); font-size: 0.9rem;">Umuarama - PR</p>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">🕒</span>
          <h3>Horário de Atendimento</h3>
          <p style="color: var(--text-secondary); font-size: 0.9rem;">Segunda a Sexta: 8h às 18h</p>
        </div>
      </div>
      
      <form id="contactForm">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" required>
          </div>
          <div>
            <label for="email">Email:</label>
            <input type="email" id="email" required>
          </div>
        </div>
        
        <label for="assunto">Assunto:</label>
        <input type="text" id="assunto" required>
        
        <label for="mensagem">Mensagem:</label>
        <textarea id="mensagem" required></textarea>
        
        <button type="submit" class="btn">Enviar Mensagem</button>
      </form>
    </section>
  </main>

  <footer class="container">
    <p>© 2023 Aliança Contábil - Todos os direitos reservados</p>
  </footer>

  <script>
    // FAQ Accordion
    document.querySelectorAll('.faq-question').forEach(question => {
      question.addEventListener('click', () => {
        const item = question.parentNode;
        item.classList.toggle('active');
      });
    });

    // Sugestão de Serviços por IA
    document.getElementById('btnSugerir').addEventListener('click', () => {
      const input = document.getElementById('servicosTxt').value.toLowerCase();
      const tagsDiv = document.getElementById('tagsSugeridas');
      
      // Limpar sugestões anteriores
      tagsDiv.innerHTML = '';
      
      if (!input.trim()) {
        tagsDiv.textContent = 'Por favor, descreva sua necessidade para receber sugestões.';
        return;
      }
      
      // Simulação de IA - Mapeamento de palavras-chave para serviços
      const keywords = {
        'abrir': 'Abertura de Empresas',
        'empresa': 'Abertura de Empresas',
        'cnpj': 'Abertura de Empresas',
        'imposto': 'Consultoria Tributária',
        'tributo': 'Consultoria Tributária',
        'irpf': 'Declaração de IR',
        'imposto de renda': 'Declaração de IR',
        'folha': 'Folha de Pagamento',
        'salário': 'Folha de Pagamento',
        'funcionário': 'Folha de Pagamento',
        'contabilidade': 'Contabilidade Completa',
        'balanço': 'Balanço Patrimonial',
        'fiscal': 'Gestão Fiscal',
        'auditoria': 'Auditoria Contábil',
        'planejamento': 'Consultoria Tributária'
      };
      
      // Identificar serviços relevantes
      const suggestedServices = new Set();
      
      for (const [keyword, service] of Object.entries(keywords)) {
        if (input.includes(keyword)) {
          suggestedServices.add(service);
        }
      }
      
      // Se não encontrou correspondências específicas
      if (suggestedServices.size === 0) {
        // Sugerir serviços gerais
        suggestedServices.add('Contabilidade Completa');
        suggestedServices.add('Consultoria Tributária');
      }
      
      // Exibir sugestões
      if (suggestedServices.size > 0) {
        tagsDiv.innerHTML = '<p>Com base na sua descrição, sugerimos:</p><div class="tags"></div>';
        const tagsContainer = tagsDiv.querySelector('.tags');
        
        suggestedServices.forEach(service => {
          const tag = document.createElement('span');
          tag.className = 'tag';
          tag.textContent = service;
          tagsContainer.appendChild(tag);
        });
      }
    });

    // Formulário de Contato
    document.getElementById('contactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Simulação de envio
      const nome = document.getElementById('nome').value;
      const email = document.getElementById('email').value;
      const assunto = document.getElementById('assunto').value;
      const mensagem = document.getElementById('mensagem').value;
      
      // Validação simples
      if (!nome || !email || !assunto || !mensagem) {
        alert('Por favor, preencha todos os campos obrigatórios.');
        return;
      }
      
      // Simulação de envio bem-sucedido
      alert(`Obrigado, ${nome}! Sua mensagem foi enviada com sucesso. Entraremos em contato em breve.`);
      
      // Limpar formulário
      this.reset();
    });

    // Scroll suave para âncoras
    document.querySelectorAll('nav a').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 100,
            behavior: 'smooth'
          });
        }
      });
    });
  </script>
</body>
</html>