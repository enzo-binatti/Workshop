<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Portfólio - Enzo Binatti Baleroni</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background: #000000;
      color: #ffffff;
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
      border-bottom: 1px solid #222;
    }

    h1 {
      font-size: 3rem;
      font-weight: 700;
      background: linear-gradient(135deg, #ffffff 0%, #888888 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 1rem;
      letter-spacing: -0.02em;
    }

    header p {
      font-size: 1.125rem;
      color: #999;
      margin-bottom: 2rem;
    }

    header p strong {
      color: #ffffff;
      font-weight: 600;
    }

    nav {
      display: flex;
      gap: 2rem;
      justify-content: center;
      flex-wrap: wrap;
    }

    nav a {
      color: #999;
      text-decoration: none;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      position: relative;
    }

    nav a:hover {
      color: #ffffff;
      background: #111;
    }

    nav a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%) scaleX(0);
      width: 80%;
      height: 2px;
      background: #ffffff;
      transition: transform 0.3s ease;
    }

    nav a:hover::after {
      transform: translateX(-50%) scaleX(1);
    }

    main {
      padding: 3rem 2rem;
    }

    .card {
      background: #0a0a0a;
      border: 1px solid #222;
      border-radius: 16px;
      padding: 2.5rem;
      margin-bottom: 2rem;
      transition: all 0.3s ease;
    }

    .card:hover {
      border-color: #333;
      box-shadow: 0 8px 32px rgba(255, 255, 255, 0.05);
      transform: translateY(-2px);
    }

    h2 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #ffffff;
      letter-spacing: -0.01em;
    }

    .card p {
      font-size: 1.125rem;
      color: #aaa;
      line-height: 1.8;
    }

    .ai-box {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    label {
      font-size: 1rem;
      color: #ccc;
      font-weight: 500;
    }

    textarea,
    input[type="text"],
    input[type="email"],
    input {
      width: 100%;
      padding: 1rem;
      background: #000;
      border: 1px solid #333;
      border-radius: 12px;
      color: #ffffff;
      font-size: 1rem;
      font-family: inherit;
      transition: all 0.3s ease;
      resize: vertical;
    }

    textarea {
      min-height: 120px;
    }

    textarea:focus,
    input:focus {
      outline: none;
      border-color: #666;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.05);
    }

    textarea::placeholder,
    input::placeholder {
      color: #555;
    }

    .btn {
      padding: 1rem 2rem;
      background: #ffffff;
      color: #000000;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: inherit;
    }

    .btn:hover {
      background: #e0e0e0;
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(255, 255, 255, 0.15);
    }

    .btn:active {
      transform: translateY(0);
    }

    .muted {
      color: #777;
      font-size: 0.95rem;
      margin-top: 1rem;
      padding: 1rem;
      background: #050505;
      border-radius: 8px;
      border: 1px solid #1a1a1a;
      min-height: 50px;
    }

    .tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      margin-top: 1rem;
    }

    .tag {
      padding: 0.5rem 1rem;
      background: #111;
      border: 1px solid #333;
      border-radius: 8px;
      color: #fff;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .tag:hover {
      background: #1a1a1a;
      border-color: #444;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    footer {
      text-align: center;
      padding: 3rem 2rem;
      border-top: 1px solid #222;
      margin-top: 3rem;
    }

    footer small {
      color: #666;
      font-size: 0.95rem;
    }

    .success {
      color: #4ade80;
      background: rgba(74, 222, 128, 0.1);
      border-color: rgba(74, 222, 128, 0.2);
    }

    .error {
      color: #f87171;
      background: rgba(248, 113, 113, 0.1);
      border-color: rgba(248, 113, 113, 0.2);
    }

    @media (max-width: 768px) {
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

      header {
        padding: 3rem 1rem 2rem;
      }
    }

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

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .service-card {
      background: #050505;
      border: 1px solid #222;
      border-radius: 12px;
      padding: 2rem;
      transition: all 0.3s ease;
    }

    .service-card:hover {
      border-color: #444;
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(255, 255, 255, 0.08);
    }

    .service-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      display: block;
    }

    .service-card h3 {
      font-size: 1.25rem;
      color: #ffffff;
      margin-bottom: 0.75rem;
      font-weight: 600;
    }

    .service-card p {
      font-size: 0.95rem;
      color: #888;
      line-height: 1.6;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    .stat-item {
      text-align: center;
      padding: 2rem;
      background: #050505;
      border: 1px solid #222;
      border-radius: 12px;
      transition: all 0.3s ease;
    }

    .stat-item:hover {
      border-color: #333;
      transform: scale(1.05);
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 700;
      background: linear-gradient(135deg, #ffffff 0%, #888888 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      display: block;
      margin-bottom: 0.5rem;
    }

    .stat-label {
      color: #999;
      font-size: 0.95rem;
    }

    .testimonial {
      background: #050505;
      border: 1px solid #222;
      border-radius: 12px;
      padding: 2rem;
      margin-bottom: 1.5rem;
      transition: all 0.3s ease;
    }

    .testimonial:hover {
      border-color: #333;
    }

    .testimonial-text {
      font-size: 1.05rem;
      color: #ccc;
      line-height: 1.8;
      margin-bottom: 1rem;
      font-style: italic;
    }

    .testimonial-author {
      color: #fff;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .testimonial-role {
      color: #777;
      font-size: 0.85rem;
    }

    .faq-item {
      background: #050505;
      border: 1px solid #222;
      border-radius: 12px;
      padding: 1.5rem;
      margin-bottom: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .faq-item:hover {
      border-color: #333;
    }

    .faq-question {
      font-size: 1.1rem;
      color: #ffffff;
      font-weight: 600;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .faq-answer {
      color: #999;
      margin-top: 1rem;
      line-height: 1.7;
      display: none;
    }

    .faq-item.active .faq-answer {
      display: block;
    }

    .faq-toggle {
      color: #666;
      font-size: 1.5rem;
      transition: transform 0.3s ease;
    }

    .faq-item.active .faq-toggle {
      transform: rotate(45deg);
    }

    .process-steps {
      display: grid;
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .process-step {
      display: flex;
      gap: 1.5rem;
      background: #050505;
      border: 1px solid #222;
      border-radius: 12px;
      padding: 2rem;
      transition: all 0.3s ease;
    }

    .process-step:hover {
      border-color: #333;
    }

    .step-number {
      flex-shrink: 0;
      width: 50px;
      height: 50px;
      background: #ffffff;
      color: #000;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      font-weight: 700;
    }

    .step-content h3 {
      font-size: 1.2rem;
      color: #ffffff;
      margin-bottom: 0.5rem;
    }

    .step-content p {
      color: #888;
      font-size: 0.95rem;
      line-height: 1.6;
    }

    .contact-info {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .contact-item {
      background: #050505;
      border: 1px solid #222;
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
      transition: all 0.3s ease;
    }

    .contact-item:hover {
      border-color: #333;
      transform: translateY(-2px);
    }

    .contact-icon {
      font-size: 2rem;
      margin-bottom: 0.75rem;
      display: block;
    }

    .contact-item h3 {
      font-size: 1rem;
      color: #ffffff;
      margin-bottom: 0.5rem;
    }

    .contact-item a {
      color: #999;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .contact-item a:hover {
      color: #ffffff;
    }

    .differentials-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .differential-item {
      background: #050505;
      border: 1px solid #222;
      border-radius: 12px;
      padding: 2rem;
      text-align: center;
      transition: all 0.3s ease;
    }

    .differential-item:hover {
      border-color: #333;
      transform: translateY(-2px);
    }

    .differential-icon {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      display: block;
    }

    .differential-item h3 {
      font-size: 1.1rem;
      color: #ffffff;
      margin-bottom: 0.75rem;
    }

    .differential-item p {
      font-size: 0.9rem;
      color: #888;
      line-height: 1.6;
    }
  </style>
</head>
<body>
  <header class="container">
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
      <p style="color: #aaa; margin-bottom: 1rem;">Oferecemos uma gama completa de serviços contábeis e fiscais para atender todas as necessidades da sua empresa.</p>
      
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
      <p style="color: #aaa; margin-bottom: 1rem;">Não sabe qual serviço precisa? Descreva sua necessidade e nossa IA sugerirá os serviços mais adequados.</p>
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
          <p style="color: #999; font-size: 0.9rem;">Umuarama - PR</p>
        </div>
        
        <div class="contact-item">
          <span class="contact-icon">🕐</span>
          <h3>Horário</h3>
          <p style="color: #999; font-size: 0.9rem;">Seg-Sex: 8h às 18h</p>
        </div>
      </div>
      
      <h3 style="margin-top: 2rem; margin-bottom: 1rem; font-size: 1.5rem;">Envie uma Mensagem</h3>
      <form id="formContato" method="POST" action="contact.php">
        <input required name="nome" placeholder="Seu nome completo" />
        <input required type="email" name="email" placeholder="Seu melhor email" />
        <input name="telefone" placeholder="Seu telefone (opcional)" />
        <textarea required name="mensagem" placeholder="Conte-nos como podemos ajudar..."></textarea>
        <button type="submit" class="btn">Enviar Mensagem</button>
      </form>
      <div id="respContato" class="muted"></div>
    </section>
  </main>

  <footer class="container">
    <small>© <span id="currentYear"></span> Enzo Binatti Baleroni | Aliança Contábil | CRC/PR 123456 | Todos os direitos reservados</small>
  </footer>

  <script>
    // Set current year
    document.getElementById('currentYear').textContent = new Date().getFullYear();

    // AI Service Suggestion
    document.getElementById('btnSugerir').addEventListener('click', function() {
      const texto = document.getElementById('servicosTxt').value.trim();
      const container = document.getElementById('tagsSugeridas');
      
      if (!texto) {
        container.innerHTML = '<span class="error">Por favor, descreva o que você precisa.</span>';
        return;
      }

      // Simulate AI processing
      container.innerHTML = '<span style="color: #999;">Analisando sua solicitação...</span>';
      
      setTimeout(() => {
        const servicos = analisarServicos(texto);
        
        if (servicos.length > 0) {
          container.innerHTML = '<div class="tags">' + 
            servicos.map(s => `<span class="tag">${s}</span>`).join('') + 
            '</div>';
        } else {
          container.innerHTML = '<span>Não foi possível identificar serviços específicos. Entre em contato para mais informações.</span>';
        }
      }, 1000);
    });

    function analisarServicos(texto) {
      const lower = texto.toLowerCase();
      const servicos = [];
      
      if (lower.includes('imposto') || lower.includes('declaração') || lower.includes('ir')) {
        servicos.push('Declaração de Imposto de Renda');
      }
      if (lower.includes('empresa') || lower.includes('cnpj') || lower.includes('abrir')) {
        servicos.push('Abertura de Empresa');
      }
      if (lower.includes('contabil') || lower.includes('contabilidade')) {
        servicos.push('Contabilidade Completa');
      }
      if (lower.includes('folha') || lower.includes('pagamento') || lower.includes('funcionário')) {
        servicos.push('Folha de Pagamento');
      }
      if (lower.includes('fiscal') || lower.includes('nota')) {
        servicos.push('Gestão Fiscal');
      }
      if (lower.includes('consultor') || lower.includes('planejamento')) {
        servicos.push('Consultoria Tributária');
      }
      if (lower.includes('balanço') || lower.includes('demonstra')) {
        servicos.push('Balanço Patrimonial');
      }
      
      return servicos;
    }

    // Contact Form
    document.getElementById('formContato').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const respDiv = document.getElementById('respContato');
      const formData = new FormData(this);
      
      respDiv.innerHTML = '<span style="color: #999;">Enviando mensagem...</span>';
      
      fetch('contact.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          respDiv.innerHTML = '<span class="success">✓ Mensagem enviada com sucesso! Entraremos em contato em breve.</span>';
          document.getElementById('formContato').reset();
        } else {
          respDiv.innerHTML = '<span class="error">✗ Erro ao enviar mensagem. Tente novamente.</span>';
        }
      })
      .catch(error => {
        respDiv.innerHTML = '<span class="error">✗ Erro ao enviar mensagem. Tente novamente mais tarde.</span>';
      });
    });

    // Smooth scroll for navigation
    document.querySelectorAll('nav a').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });

    // FAQ toggle functionality
    document.querySelectorAll('.faq-item').forEach(item => {
      item.addEventListener('click', function() {
        const wasActive = this.classList.contains('active');
        
        // Close all FAQ items
        document.querySelectorAll('.faq-item').forEach(faq => {
          faq.classList.remove('active');
        });
        
        // Open clicked item if it wasn't active
        if (!wasActive) {
          this.classList.add('active');
        }
      });
    });
  </script>
</body>
</html>
