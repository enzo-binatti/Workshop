<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo - Teste seus Conhecimentos</title>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo - Teste seus Conhecimentos</title>
    <style>
        /* Cores LED/NEON:
           - Neon Principal: #FFFFFF (Branco Puro / Glacial)
           - Neon Secundário: #7DF9FF (Azul Glacial)
           - Fundo: #000000 (Preto Absoluto)
           - Borda/Divisor: #1a1a1a (Cinza escuro)
        */
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            /* Fundo Preto para realçar o LED Branco/Gelo */
            font-family: 'Segoe UI', 'Roboto', 'Arial', monospace, sans-serif;
            background: linear-gradient(135deg, #000000 0%, #0a0a0a 50%, #000000 100%);
            color: #FFFFFF; /* Texto branco puro para contraste LED */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 800px;
            width: 100%;
        }

        .quiz-card {
            background: rgba(0, 0, 0, 0.85); /* Fundo mais escuro */
            border: 2px solid #FFFFFF; /* Borda branca LED */
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(10px);
            /* Efeito LED Branco mais intenso */
            box-shadow: 
                0 0 30px rgba(255, 255, 255, 0.3),
                0 0 60px rgba(255, 255, 255, 0.1),
                inset 0 0 20px rgba(255, 255, 255, 0.05);
            animation: fadeIn 0.8s ease-out, ledGlow 3s ease-in-out infinite alternate;
        }

        @keyframes ledGlow {
            0% {
                box-shadow: 
                    0 0 30px rgba(255, 255, 255, 0.3),
                    0 0 60px rgba(255, 255, 255, 0.1),
                    inset 0 0 20px rgba(255, 255, 255, 0.05);
            }
            100% {
                box-shadow: 
                    0 0 40px rgba(255, 255, 255, 0.4),
                    0 0 80px rgba(255, 255, 255, 0.15),
                    inset 0 0 30px rgba(255, 255, 255, 0.08);
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

        h1 {
            font-size: 2.8rem;
            font-weight: 700;
            /* Efeito LED Branco mais intenso */
            color: #FFFFFF; 
            text-shadow: 
                0 0 10px #FFFFFF,
                0 0 20px #FFFFFF,
                0 0 30px rgba(255, 255, 255, 0.8),
                0 0 40px rgba(255, 255, 255, 0.5);
            margin-bottom: 15px;
            text-align: center;
            animation: titlePulse 2s ease-in-out infinite alternate;
        }

        @keyframes titlePulse {
            0% {
                text-shadow: 
                    0 0 10px #FFFFFF,
                    0 0 20px #FFFFFF,
                    0 0 30px rgba(255, 255, 255, 0.8);
            }
            100% {
                text-shadow: 
                    0 0 15px #FFFFFF,
                    0 0 30px #FFFFFF,
                    0 0 45px rgba(255, 255, 255, 0.9);
            }
        }

        .subtitle {
            text-align: center;
            color: #FFFFFF; /* Branco para manter consistência LED */
            margin-bottom: 30px;
            font-size: 1.2rem;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.7);
            font-weight: 300;
        }

        .progress-bar {
            width: 100%;
            height: 10px; 
            background: #0d0d0d;
            border: 1px solid #1a1a1a;
            border-radius: 10px;
            margin-bottom: 30px;
            overflow: hidden;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .progress-fill {
            height: 100%;
            /* LED de Progresso (Verde Neon) */
            background: linear-gradient(90deg, #39FF14, #00FF7F);
            box-shadow: 0 0 10px #39FF14, 0 0 20px #00FF7F;
            border-radius: 10px;
            transition: width 0.3s ease;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 15px;
        }

        .stat-item {
            flex: 1;
            background: #0d0d0d;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid #1a1a1a;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.1);
        }

        .stat-label {
            font-size: 0.85rem;
            color: #7DF9FF;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #FFFFFF; /* Branco */
            text-shadow: 0 0 5px #FFFFFF;
        }

        .category-badge {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid #FFFFFF;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .question-container {
            margin-bottom: 30px;
        }

        .question-text {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #FFFFFF;
            line-height: 1.5;
            text-shadow: 0 0 2px #F0F0F0;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option {
            background: #0a0a0a;
            border: 2px solid #333333;
            padding: 20px 26px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.4s ease;
            font-size: 1.1rem;
            position: relative;
            overflow: hidden;
            color: #FFFFFF;
            text-shadow: 0 0 3px rgba(255, 255, 255, 0.3);
        }

        .option:hover {
            background: #1a1a1a;
            border-color: #FFFFFF;
            box-shadow: 
                0 0 15px rgba(255, 255, 255, 0.4),
                0 0 30px rgba(255, 255, 255, 0.2);
            transform: translateX(8px) scale(1.02);
            color: #FFFFFF;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.8);
        }

        .option.selected {
            background: rgba(255, 255, 255, 0.1);
            border-color: #FFFFFF;
            box-shadow: 0 0 15px #FFFFFF;
        }

        .option.correct {
            /* LED de Acerto (Verde Limão) */
            background: rgba(57, 255, 20, 0.2);
            border-color: #39FF14;
            box-shadow: 0 0 15px #39FF14, 0 0 5px #00FF7F;
            animation: correctPulse 0.5s ease;
        }

        .option.incorrect {
            /* LED de Erro (Vermelho Frio) */
            background: rgba(255, 0, 70, 0.2);
            border-color: #FF0046;
            box-shadow: 0 0 15px #FF0046, 0 0 5px #FF6969;
            animation: incorrectShake 0.5s ease;
        }

        .option.disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        @keyframes correctPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.01); }
        }

        @keyframes incorrectShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .option-letter {
            display: inline-block;
            width: 30px;
            height: 30px;
            background: #1a1a1a;
            border: 1px solid #7DF9FF;
            border-radius: 5px;
            text-align: center;
            line-height: 28px;
            margin-right: 12px;
            font-weight: 700;
            color:rgb(255, 255, 255);
            text-shadow: 0 0 5px #7DF9FF;
        }

        .btn {
            width: 100%;
            padding: 18px 36px;
            /* Botão LED Branco */
            background: #FFFFFF;
            color: #000000;
            border: 2px solid #FFFFFF;
            border-radius: 12px;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.4s ease;
            margin-top: 25px;
            box-shadow: 
                0 0 20px #FFFFFF, 
                0 0 40px rgba(255, 255, 255, 0.6),
                inset 0 0 10px rgba(255, 255, 255, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.02);
            background: #F0F0F0;
            box-shadow: 
                0 0 30px #FFFFFF, 
                0 15px 40px rgba(255, 255, 255, 0.5),
                inset 0 0 15px rgba(255, 255, 255, 0.3);
            border-color: #FFFFFF;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
            background: #333333;
            color: #666666;
            border-color: #333333;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
            animation: none;
        }

        .start-screen, .results-screen {
            text-align: center;
        }

        .start-screen h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .start-screen p {
            font-size: 1.2rem;
            color:rgb(255, 255, 255);
            margin-bottom: 40px;
        }

        .theme-selection {
            margin-bottom: 40px;
        }

        .theme-selection h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: #FFFFFF;
            text-shadow: 0 0 5px #FFFFFF;
        }

        .theme-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .theme-card {
            background: #0d0d0d;
            border: 2px solid #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.1);
        }

        .theme-card:hover {
            background: #1a1a1a;
            border-color: #FFFFFF;
            box-shadow: 0 0 10px #FFFFFF;
            transform: translateY(-5px);
        }

        .theme-card.selected {
            background: rgba(255, 255, 255, 0.15);
            border-color: #FFFFFF;
            box-shadow: 0 0 20px #FFFFFF, inset 0 0 10px #FFFFFF;
        }

        .theme-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color:rgb(255, 255, 255); /* Azul Glacial */
            text-shadow: 0 0 10px #7DF9FF;
        }

        .theme-name {
            font-weight: 600;
            margin-bottom: 5px;
            color: #F0F0F0;
        }

        .theme-count {
            font-size: 0.85rem;
            color:rgb(255, 255, 255);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .feature {
            background: #0d0d0d;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #1a1a1a;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.1);
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #FFFFFF;
            text-shadow: 0 0 5px #FFFFFF;
        }

        .feature-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #FFFFFF;
        }

        .feature-desc {
            font-size: 0.9rem;
            color:rgb(255, 255, 255);
        }

        .results-screen h2 {
            font-size: 2.5rem;
            color: #FFFFFF;
            text-shadow: 0 0 5px #FFFFFF;
            margin-bottom: 20px;
        }

        .score-display {
            font-size: 4rem;
            font-weight: 700;
            /* LED de Pontuação - Verde Limão */
            color: #39FF14;
            text-shadow: 0 0 10px #39FF14, 0 0 20px rgba(57, 255, 20, 0.8);
            margin-bottom: 20px;
        }

        .score-message {
            font-size: 1.3rem;
            color:rgb(250, 250, 250);
            text-shadow: 0 0 3pxrgb(255, 255, 255);
            margin-bottom: 30px;
        }

        .results-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .result-item {
            background: #0d0d0d;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #1a1a1a;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.1);
        }

        .result-label {
            font-size: 0.9rem;
            color:rgb(255, 255, 255);
            margin-bottom: 8px;
        }

        .result-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .correct-value {
            color: #39FF14; /* Verde Limão LED */
            text-shadow: 0 0 5px #39FF14;
        }

        .incorrect-value {
            color: #FF0046; /* Vermelho Frio LED */
            text-shadow: 0 0 5px #FF0046;
        }

        .hidden {
            display: none;
        }

        .feedback {
            margin-top: 15px;
            padding: 15px;
            border-radius: 10px;
            font-size: 0.95rem;
            animation: fadeIn 0.3s ease;
            font-weight: 600;
        }

        .feedback.correct {
            background: rgba(57, 255, 20, 0.1);
            border: 1px solid #39FF14;
            color: #39FF14;
            box-shadow: 0 0 10px rgba(57, 255, 20, 0.5);
        }

        .feedback.incorrect {
            background: rgba(255, 0, 70, 0.1);
            border: 1px solid #FF0046;
            color: #FF0046;
            box-shadow: 0 0 10px rgba(255, 0, 70, 0.5);
        }

        /* Animação para as opções aparecerem */
        @keyframes optionFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Efeito de pulsação nos botões principais */
        .btn {
            animation: buttonPulse 2s ease-in-out infinite;
        }

        @keyframes buttonPulse {
            0%, 100% {
                box-shadow: 0 0 15px #FFFFFF, 0 0 30px rgba(255, 255, 255, 0.5);
            }
            50% {
                box-shadow: 0 0 20px #FFFFFF, 0 0 40px rgba(255, 255, 255, 0.7);
            }
        }

        .btn:hover {
            animation: none; /* Para o pulso no hover */
        }

        @media (max-width: 768px) {
            .quiz-card {
                padding: 25px;
            }

            h1 {
                font-size: 2rem;
            }

            .start-screen h1 {
                font-size: 2.2rem;
            }

            .theme-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .question-text {
                font-size: 1.2rem;
            }

            .stats {
                flex-direction: column;
            }

            .results-details {
                grid-template-columns: 1fr;
            }

            .score-display {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body onload="updateThemeCounts()">
    <div class="container">
        <div class="quiz-card">
            <div id="startScreen" class="start-screen">
                <h1>Quiz Interativo</h1>
                <p class="subtitle">Teste seus conhecimentos em diversas áreas</p>
                
                <div class="theme-selection">
                    <h3>Escolha um Tema:</h3>
                    <div class="theme-grid" id="themeGrid">
                        <div class="theme-card" onclick="selectTheme('all', this)">
                            <div class="theme-icon">🎯</div>
                            <div class="theme-name">Todos os Temas</div>
                            <div class="theme-count" id="count-all"></div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('História', this)">
                            <div class="theme-icon">📜</div>
                            <div class="theme-name">História</div>
                            <div class="theme-count" id="count-História"></div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Ciências', this)">
                            <div class="theme-icon">🔬</div>
                            <div class="theme-name">Ciências</div>
                            <div class="theme-count" id="count-Ciências"></div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Geografia', this)">
                            <div class="theme-icon">🌍</div>
                            <div class="theme-name">Geografia</div>
                            <div class="theme-count" id="count-Geografia"></div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Cultura Geral', this)">
                            <div class="theme-icon">🎭</div>
                            <div class="theme-name">Cultura Geral</div>
                            <div class="theme-count" id="count-Cultura Geral"></div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Tecnologia', this)">
                            <div class="theme-icon">💻</div>
                            <div class="theme-name">Tecnologia</div>
                            <div class="theme-count" id="count-Tecnologia"></div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Matemática', this)">
                            <div class="theme-icon">🔢</div>
                            <div class="theme-name">Matemática</div>
                            <div class="theme-count" id="count-Matemática"></div>
                        </div>
                    </div>
                </div>

                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">📚</div>
                        <div class="feature-title" id="feature-question-count">10 Perguntas</div>
                        <div class="feature-desc">Desafios variados</div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">🎯</div>
                        <div class="feature-title">Múltiplas Categorias</div>
                        <div class="feature-desc">História, Ciências, Geografia e mais</div>
                    </div>
                    <div class="feature">
                        <div class="feature-icon">⚡</div>
                        <div class="feature-title">Perguntas Aleatórias</div>
                        <div class="feature-desc">Cada jogo é único</div>
                    </div>
                </div>

                <button class="btn" id="startBtn" onclick="startQuiz()" disabled>Começar Quiz</button>
            </div>

            <div id="quizScreen" class="hidden">
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-label">Pergunta</div>
                        <div class="stat-value"><span id="currentQuestion">1</span>/<span id="totalQuestionsDisplay">10</span></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Pontuação</div>
                        <div class="stat-value" id="score">0</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Acertos</div>
                        <div class="stat-value" id="correct">0</div>
                    </div>
                </div>

                <div class="progress-bar">
                    <div class="progress-fill" id="progressFill"></div>
                </div>

                <div class="question-container">
                    <span class="category-badge" id="category"></span>
                    <h2 class="question-text" id="questionText"></h2>
                    <div class="options" id="optionsContainer"></div>
                    <div id="feedback" class="feedback hidden"></div>
                </div>

                <button class="btn" id="nextBtn" onclick="nextQuestion()" disabled>Próxima Pergunta</button>
            </div>

            <div id="resultsScreen" class="results-screen hidden">
                <h2>Quiz Finalizado!</h2>
                <div class="score-display" id="finalScore"></div>
                <p class="score-message" id="scoreMessage"></p>

                <div class="results-details">
                    <div class="result-item">
                        <div class="result-label">Total de Perguntas</div>
                        <div class="result-value" id="resultsTotalQuestions"></div>
                    </div>
                    <div class="result-item">
                        <div class="result-label">Acertos</div>
                        <div class="result-value correct-value" id="finalCorrect"></div>
                    </div>
                    <div class="result-item">
                        <div class="result-label">Erros</div>
                        <div class="result-value incorrect-value" id="finalIncorrect"></div>
                    </div>
                </div>

                <button class="btn" onclick="restartQuiz()">Jogar Novamente</button>
            </div>
        </div>
    </div>

    <script>
        // Banco de perguntas (Mantido o original, ele está bem estruturado)
        const questionBank = [
            // História
            {
                category: "História",
                question: "Em que ano ocorreu a Proclamação da República no Brasil?",
                options: ["1822", "1889", "1891", "1900"],
                correct: 1
            },
            {
                category: "História",
                question: "Quem foi o primeiro presidente dos Estados Unidos?",
                options: ["Thomas Jefferson", "Abraham Lincoln", "George Washington", "John Adams"],
                correct: 2
            },
            {
                category: "História",
                question: "Qual civilização construiu Machu Picchu?",
                options: ["Astecas", "Maias", "Incas", "Olmecas"],
                correct: 2
            },
            {
                category: "História",
                question: "Em que ano começou a Segunda Guerra Mundial?",
                options: ["1939", "1941", "1937", "1945"],
                correct: 0
            },
            {
                category: "História",
                question: "Quem pintou a Mona Lisa?",
                options: ["Michelangelo", "Rafael", "Leonardo da Vinci", "Donatello"],
                correct: 2
            },

            // Ciências
            {
                category: "Ciências",
                question: "Qual é o planeta mais próximo do Sol?",
                options: ["Vênus", "Marte", "Mercúrio", "Terra"],
                correct: 2
            },
            {
                category: "Ciências",
                question: "Qual é a fórmula química da água?",
                options: ["H2O", "CO2", "O2", "H2O2"],
                correct: 0
            },
            {
                category: "Ciências",
                question: "Quantos ossos tem o corpo humano adulto?",
                options: ["186", "206", "226", "246"],
                correct: 1
            },
            {
                category: "Ciências",
                question: "Qual é a velocidade da luz no vácuo?",
                options: ["300.000 km/s", "150.000 km/s", "450.000 km/s", "200.000 km/s"],
                correct: 0
            },
            {
                category: "Ciências",
                question: "Qual é o maior órgão do corpo humano?",
                options: ["Fígado", "Coração", "Pele", "Cérebro"],
                correct: 2
            },

            // Geografia
            {
                category: "Geografia",
                question: "Qual é o maior país do mundo em área territorial?",
                options: ["Canadá", "China", "Estados Unidos", "Rússia"],
                correct: 3
            },
            {
                category: "Geografia",
                question: "Qual é o rio mais extenso do mundo?",
                options: ["Nilo", "Amazonas", "Yangtzé", "Mississippi"],
                correct: 1
            },
            {
                category: "Geografia",
                question: "Qual é a capital da Austrália?",
                options: ["Sydney", "Melbourne", "Canberra", "Brisbane"],
                correct: 2
            },
            {
                category: "Geografia",
                question: "Quantos continentes existem no mundo?",
                options: ["5", "6", "7", "8"],
                correct: 2
            },
            {
                category: "Geografia",
                question: "Qual é o oceano mais profundo?",
                options: ["Atlântico", "Índico", "Ártico", "Pacífico"],
                correct: 3
            },

            // Cultura Geral
            {
                category: "Cultura Geral",
                question: "Qual é o idioma mais falado no mundo?",
                options: ["Inglês", "Mandarim", "Espanhol", "Hindi"],
                correct: 1
            },
            {
                category: "Cultura Geral",
                question: "Quantas teclas tem um piano padrão?",
                options: ["76", "88", "92", "100"],
                correct: 1
            },
            {
                category: "Cultura Geral",
                question: "Qual é a moeda oficial do Japão?",
                options: ["Yuan", "Won", "Yen", "Ringgit"],
                correct: 2
            },
            {
                category: "Cultura Geral",
                question: "Quem escreveu 'Dom Casmurro'?",
                options: ["José de Alencar", "Machado de Assis", "Clarice Lispector", "Jorge Amado"],
                correct: 1
            },
            {
                category: "Cultura Geral",
                question: "Qual é o esporte mais popular do mundo?",
                options: ["Basquete", "Futebol", "Críquete", "Tênis"],
                correct: 1
            },

            // Tecnologia
            {
                category: "Tecnologia",
                question: "Quem fundou a Microsoft?",
                options: ["Steve Jobs", "Bill Gates", "Mark Zuckerberg", "Elon Musk"],
                correct: 1
            },
            {
                category: "Tecnologia",
                question: "O que significa HTML?",
                options: ["HyperText Markup Language", "High Tech Modern Language", "Home Tool Markup Language", "Hyperlinks and Text Markup Language"],
                correct: 0
            },
            {
                category: "Tecnologia",
                question: "Em que ano foi lançado o primeiro iPhone?",
                options: ["2005", "2007", "2009", "2010"],
                correct: 1
            },
            {
                category: "Tecnologia",
                question: "Qual é a linguagem de programação mais usada para desenvolvimento web?",
                options: ["Python", "Java", "JavaScript", "C++"],
                correct: 2
            },
            {
                category: "Tecnologia",
                question: "O que é IA?",
                options: ["Internet Avançada", "Inteligência Artificial", "Interface Automática", "Informação Analítica"],
                correct: 1
            },

            // Matemática
            {
                category: "Matemática",
                question: "Quanto é 15% de 200?",
                options: ["25", "30", "35", "40"],
                correct: 1
            },
            {
                category: "Matemática",
                question: "Qual é o valor de π (pi) aproximadamente?",
                options: ["3.14", "2.71", "1.41", "4.20"],
                correct: 0
            },
            {
                category: "Matemática",
                question: "Quanto é 7 × 8?",
                options: ["54", "56", "58", "60"],
                correct: 1
            },
            {
                category: "Matemática",
                question: "Qual é a raiz quadrada de 144?",
                options: ["10", "11", "12", "13"],
                correct: 2
            },
            {
                category: "Matemática",
                question: "Quantos graus tem um triângulo?",
                options: ["90°", "180°", "270°", "360°"],
                correct: 1
            },

            // Mais perguntas de História
            {
                category: "História",
                question: "Qual foi a primeira capital do Brasil?",
                options: ["Salvador", "Rio de Janeiro", "São Paulo", "Brasília"],
                correct: 0
            },
            {
                category: "História",
                question: "Em que data é comemorado o Dia da Independência do Brasil?",
                options: ["15 de Novembro", "7 de Setembro", "21 de Abril", "12 de Outubro"],
                correct: 1
            },
            {
                category: "História",
                question: "Quem foi Getúlio Vargas?",
                options: ["Escritor brasileiro", "Presidente do Brasil", "Militar revolucionário", "Imperador do Brasil"],
                correct: 1
            },

            // Mais perguntas de Ciências
            {
                category: "Ciências",
                question: "Qual é o gás mais abundante na atmosfera terrestre?",
                options: ["Oxigênio", "Nitrogênio", "Dióxido de Carbono", "Hidrogênio"],
                correct: 1
            },
            {
                category: "Ciências",
                question: "Quantos cromossomos tem uma célula humana normal?",
                options: ["23", "42", "46", "48"],
                correct: 2
            },
            {
                category: "Ciências",
                question: "Qual é a unidade básica da vida?",
                options: ["Átomo", "Molécula", "Célula", "Tecido"],
                correct: 2
            },

            // Mais perguntas de Geografia
            {
                category: "Geografia",
                question: "Qual é o maior estado do Brasil em área territorial?",
                options: ["Minas Gerais", "Bahia", "Amazonas", "Pará"],
                correct: 2
            },
            {
                category: "Geografia",
                question: "Em qual região do Brasil fica o Pantanal?",
                options: ["Norte", "Nordeste", "Centro-Oeste", "Sul"],
                correct: 2
            },
            {
                category: "Geografia",
                question: "Qual é a montanha mais alta do mundo?",
                options: ["Monte Everest", "Monte Kilimanjaro", "Monte McKinley", "Monte Fuji"],
                correct: 0
            },

            // Mais perguntas de Cultura Geral
            {
                category: "Cultura Geral",
                question: "Qual é o animal símbolo da WWF?",
                options: ["Tigre", "Panda", "Elefante", "Baleia"],
                correct: 1
            },
            {
                category: "Cultura Geral",
                question: "Quantas cores tem o arco-íris?",
                options: ["5", "6", "7", "8"],
                correct: 2
            },
            {
                category: "Cultura Geral",
                question: "Qual é a festa junina mais famosa do Brasil?",
                options: ["Festa de São João em Campina Grande", "Festa Junina de Caruaru", "Festival de Inverno de Garanhuns", "Todas as anteriores"],
                correct: 3
            },

            // Mais perguntas de Tecnologia
            {
                category: "Tecnologia",
                question: "O que significa 'www' na internet?",
                options: ["World Wide Web", "World Web Wide", "Wide World Web", "Web World Wide"],
                correct: 0
            },
            {
                category: "Tecnologia",
                question: "Qual empresa criou o sistema operacional Android?",
                options: ["Apple", "Microsoft", "Google", "Samsung"],
                correct: 2
            },
            {
                category: "Tecnologia",
                question: "Em que ano foi criado o Facebook?",
                options: ["2003", "2004", "2005", "2006"],
                correct: 1
            },

            // Mais perguntas de Matemática
            {
                category: "Matemática",
                question: "Quanto é 2 elevado à 4ª potência?",
                options: ["8", "12", "16", "24"],
                correct: 2
            },
            {
                category: "Matemática",
                question: "Qual é o resultado de 25% de 80?",
                options: ["15", "20", "25", "30"],
                correct: 1
            },
            {
                category: "Matemática",
                question: "Quantos lados tem um hexágono?",
                options: ["5", "6", "7", "8"],
                correct: 1
            },

            // Perguntas sobre o Brasil
            {
                category: "Geografia",
                question: "Qual é o rio que banha a cidade de São Paulo?",
                options: ["Rio Tietê", "Rio Pinheiros", "Rio Tamanduateí", "Todos os anteriores"],
                correct: 3
            },
            {
                category: "Cultura Geral",
                question: "Quem compôs o Hino Nacional Brasileiro?",
                options: ["Francisco Manuel da Silva", "Carlos Gomes", "Villa-Lobos", "Tom Jobim"],
                correct: 0
            },
            {
                category: "História",
                question: "Qual foi o último imperador do Brasil?",
                options: ["Dom Pedro I", "Dom Pedro II", "Dom João VI", "Não houve imperadores no Brasil"],
                correct: 1
            }
        ];
        
        // --- Variáveis de Estado ---
        let currentQuestions = [];
        let currentQuestionIndex = 0;
        let score = 0;
        let correctAnswers = 0;
        let selectedAnswer = null;
        let selectedTheme = null;
        const totalQuestions = 10; // O quiz terá sempre 10 perguntas
        let usedQuestions = new Set(); // Para evitar repetir perguntas no mesmo quiz

        // --- Funções Auxiliares ---

        function shuffleArray(array) {
            const newArray = [...array];
            for (let i = newArray.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
            }
            return newArray;
        }

        // Função para selecionar perguntas únicas e aleatórias com variedade
        function getRandomUniqueQuestions(questionPool, count) {
            if (selectedTheme === 'all') {
                // Para "Todos os Temas", garantir variedade entre categorias
                return getBalancedQuestions(questionPool, count);
            } else {
                // Para temas específicos, seleção aleatória simples
                const shuffled = shuffleArray(questionPool);
                return shuffled.slice(0, count);
            }
        }

        // Função para garantir variedade de categorias quando "Todos os Temas" está selecionado
        function getBalancedQuestions(questionPool, count) {
            const categories = ['História', 'Ciências', 'Geografia', 'Cultura Geral', 'Tecnologia', 'Matemática'];
            const questionsPerCategory = Math.floor(count / categories.length);
            const remainder = count % categories.length;
            const selected = [];
            
            // Seleciona perguntas de cada categoria
            categories.forEach((category, index) => {
                const categoryQuestions = questionPool.filter(q => q.category === category);
                const shuffledCategory = shuffleArray(categoryQuestions);
                const questionsToTake = questionsPerCategory + (index < remainder ? 1 : 0);
                
                selected.push(...shuffledCategory.slice(0, questionsToTake));
            });
            
            // Embaralha a seleção final para não ter ordem previsível
            return shuffleArray(selected);
        }

        function updateThemeCounts() {
            const themes = ["História", "Ciências", "Geografia", "Cultura Geral", "Tecnologia", "Matemática"];
            let totalCount = 0;

            themes.forEach(theme => {
                const count = questionBank.filter(q => q.category === theme).length;
                totalCount += count;
                const countElement = document.getElementById(`count-${theme.replace(/ /g, '')}`);
                if (countElement) {
                    countElement.textContent = `${count} perguntas`;
                }
            });

            // Atualiza o contador para "Todos os Temas"
            const allCountElement = document.getElementById('count-all');
            if (allCountElement) {
                allCountElement.textContent = `${totalCount} perguntas (${totalQuestions} serão sorteadas)`;
            }

            // Atualiza o contador de perguntas no Feature
            document.getElementById('feature-question-count').textContent = `${totalQuestions} Perguntas`;
            document.getElementById('totalQuestionsDisplay').textContent = totalQuestions;
            document.getElementById('resultsTotalQuestions').textContent = totalQuestions;
        }

        // --- Lógica Principal do Quiz ---

        function selectTheme(theme, element) {
            selectedTheme = theme;
            
            // Atualiza a UI para mostrar o tema selecionado
            const themeCards = document.querySelectorAll('.theme-card');
            themeCards.forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');
            
            // Habilita o botão de iniciar
            document.getElementById('startBtn').disabled = false;
        }

        function startQuiz() {
            let availableQuestions;
            let questionsToSelect = totalQuestions;

            if (selectedTheme === 'all') {
                // Para "Todos os Temas", usamos o banco inteiro para sorteio
                availableQuestions = questionBank;
            } else {
                // Para um tema específico, filtramos por categoria
                availableQuestions = questionBank.filter(q => q.category === selectedTheme);
                // Ajusta o número de questões baseado no tema selecionado
                questionsToSelect = Math.min(availableQuestions.length, totalQuestions);
                // Atualiza o display do total de perguntas para o tema específico
                document.getElementById('totalQuestionsDisplay').textContent = questionsToSelect;
                document.getElementById('resultsTotalQuestions').textContent = questionsToSelect;
            }
            
            // Embaralha e seleciona perguntas únicas aleatórias
            currentQuestions = getRandomUniqueQuestions(availableQuestions, questionsToSelect);
            
            // Reset do estado do quiz
            currentQuestionIndex = 0;
            score = 0;
            correctAnswers = 0;
            selectedAnswer = null;
            usedQuestions.clear();

            // Transição entre telas
            document.getElementById('startScreen').classList.add('hidden');
            document.getElementById('quizScreen').classList.remove('hidden');
            document.getElementById('resultsScreen').classList.add('hidden');

            loadQuestion();
        }

        function loadQuestion() {
            const question = currentQuestions[currentQuestionIndex];
            selectedAnswer = null;

            // Atualiza contadores com animação
            document.getElementById('currentQuestion').textContent = currentQuestionIndex + 1;
            document.getElementById('category').textContent = question.category;
            document.getElementById('questionText').textContent = question.question;
            document.getElementById('feedback').classList.add('hidden');
            document.getElementById('nextBtn').disabled = true;

            // Limpa o container de opções
            const optionsContainer = document.getElementById('optionsContainer');
            optionsContainer.innerHTML = '';

            // Letras das opções
            const letters = ['A', 'B', 'C', 'D'];
            
            // SEMPRE embaralha as opções para máxima aleatoriedade
            const shuffledOptions = shuffleOptions(question.options, question.correct);

            // Cria as opções embaralhadas com efeito de animação
            shuffledOptions.shuffled.forEach((option, index) => {
                const optionDiv = document.createElement('div');
                optionDiv.className = 'option';
                optionDiv.style.animationDelay = `${index * 0.1}s`;
                optionDiv.style.opacity = '0';
                optionDiv.style.animation = 'optionFadeIn 0.5s ease forwards';
                
                optionDiv.innerHTML = `<span class="option-letter">${letters[index]}</span>${option}`;
                
                // Evento de clique com os índices corretos
                optionDiv.onclick = () => selectOption(shuffledOptions.originalIndices[index], optionDiv, shuffledOptions.shuffled, shuffledOptions.originalCorrectIndex);
                
                optionsContainer.appendChild(optionDiv);
            });

            updateProgress();
        }

        /**
         * Embaralha as opções e rastreia o novo índice da resposta correta.
         * @param {Array<string>} options - As opções da pergunta.
         * @param {number} correctIndex - O índice original da resposta correta.
         */
        function shuffleOptions(options, correctIndex) {
            let originalIndices = options.map((_, i) => i);
            let shuffledOptions = [...options];

            // Algoritmo de Fisher-Yates para embaralhar e rastrear os índices
            for (let i = shuffledOptions.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffledOptions[i], shuffledOptions[j]] = [shuffledOptions[j], shuffledOptions[i]];
                [originalIndices[i], originalIndices[j]] = [originalIndices[j], originalIndices[i]];
            }

            // Encontra o novo índice da resposta correta
            const newCorrectIndex = originalIndices.findIndex(index => index === correctIndex);

            return {
                shuffled: shuffledOptions,
                originalIndices: originalIndices,
                originalCorrectIndex: newCorrectIndex
            };
        }


        function selectOption(originalIndex, element, optionsArray, correctDisplayIndex) {
            // originalIndex é o índice da opção na lista *original* da questão (0 a 3)
            // correctDisplayIndex é o índice da opção correta *na tela* (após o embaralhamento)

            if (selectedAnswer !== null) return;

            selectedAnswer = originalIndex;
            const question = currentQuestions[currentQuestionIndex];
            const options = document.querySelectorAll('.option');
            
            options.forEach(opt => opt.classList.add('disabled'));

            if (originalIndex === question.correct) {
                element.classList.add('correct');
                score += 10;
                correctAnswers++;
                showFeedback(true, question.options[question.correct]);
            } else {
                element.classList.add('incorrect');
                // Adiciona a classe 'correct' ao elemento que contém a resposta correta na tela
                options[correctDisplayIndex].classList.add('correct'); 
                showFeedback(false, question.options[question.correct]);
            }

            document.getElementById('score').textContent = score;
            document.getElementById('correct').textContent = correctAnswers;
            document.getElementById('nextBtn').disabled = false;
        }

        function showFeedback(isCorrect, correctAnswer) {
            const feedback = document.getElementById('feedback');
            feedback.classList.remove('hidden', 'correct', 'incorrect');
            
            if (isCorrect) {
                feedback.classList.add('correct');
                feedback.textContent = '✓ Correto! Muito bem!';
            } else {
                feedback.classList.add('incorrect');
                feedback.textContent = `✗ Incorreto. A resposta correta era: ${correctAnswer}`;
            }
        }

        function nextQuestion() {
            currentQuestionIndex++;

            if (currentQuestionIndex < currentQuestions.length) {
                loadQuestion();
            } else {
                showResults();
            }
        }

        function updateProgress() {
            const total = currentQuestions.length;
            const progress = ((currentQuestionIndex + 1) / total) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
        }

        function showResults() {
            document.getElementById('quizScreen').classList.add('hidden');
            document.getElementById('resultsScreen').classList.remove('hidden');

            const total = currentQuestions.length;
            const percentage = (correctAnswers / total) * 100;
            document.getElementById('finalScore').textContent = `${percentage.toFixed(0)}%`;
            document.getElementById('finalCorrect').textContent = correctAnswers;
            document.getElementById('finalIncorrect').textContent = total - correctAnswers;
            document.getElementById('resultsTotalQuestions').textContent = total;

            let message = '';
            if (percentage === 100) {
                message = '🏆 Perfeito! Você é um gênio!';
            } else if (percentage >= 80) {
                message = '🌟 Excelente! Você mandou muito bem!';
            } else if (percentage >= 60) {
                message = '👍 Bom trabalho! Continue praticando!';
            } else if (percentage >= 40) {
                message = '📚 Não foi mal! Estude mais um pouco!';
            } else {
                message = '💪 Continue tentando! A prática leva à perfeição!';
            }

            document.getElementById('scoreMessage').textContent = message;
        }

        function restartQuiz() {
            selectedTheme = null;
            document.getElementById('startBtn').disabled = true;
            
            // Remove a seleção visual dos cards
            const themeCards = document.querySelectorAll('.theme-card');
            themeCards.forEach(card => card.classList.remove('selected'));
            
            // Reseta a contagem de perguntas no display
            document.getElementById('totalQuestionsDisplay').textContent = totalQuestions;

            document.getElementById('resultsScreen').classList.add('hidden');
            document.getElementById('startScreen').classList.remove('hidden');
        }

        // Garante que as contagens sejam atualizadas ao carregar a página
        document.addEventListener('DOMContentLoaded', updateThemeCounts);
    </script>
</body>
</html>