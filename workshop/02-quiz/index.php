<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo - Teste seus Conhecimentos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            width: 100%;
        }

        .quiz-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.5s ease-out;
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
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff 0%, #a0a0a0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            color: #888;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50, #8BC34A);
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
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stat-label {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
        }

        .category-badge {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(76, 175, 80, 0.2);
            color: #4CAF50;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .question-container {
            margin-bottom: 30px;
        }

        .question-text {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #fff;
            line-height: 1.5;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .option {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 18px 24px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.05rem;
            position: relative;
            overflow: hidden;
        }

        .option:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
        }

        .option.selected {
            background: rgba(76, 175, 80, 0.2);
            border-color: #4CAF50;
        }

        .option.correct {
            background: rgba(76, 175, 80, 0.3);
            border-color: #4CAF50;
            animation: correctPulse 0.5s ease;
        }

        .option.incorrect {
            background: rgba(244, 67, 54, 0.3);
            border-color: #f44336;
            animation: incorrectShake 0.5s ease;
        }

        .option.disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        @keyframes correctPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        @keyframes incorrectShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .option-letter {
            display: inline-block;
            width: 30px;
            height: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            margin-right: 12px;
            font-weight: 600;
        }

        .btn {
            width: 100%;
            padding: 16px 32px;
            background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
            color: #000;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
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
            color: #888;
            margin-bottom: 40px;
        }

        .theme-selection {
            margin-bottom: 40px;
        }

        .theme-selection h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .theme-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .theme-card {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .theme-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-5px);
        }

        .theme-card.selected {
            background: rgba(76, 175, 80, 0.2);
            border-color: #4CAF50;
        }

        .theme-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .theme-name {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .theme-count {
            font-size: 0.85rem;
            color: #888;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .feature {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .feature-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .feature-desc {
            font-size: 0.9rem;
            color: #888;
        }

        .results-screen h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .score-display {
            font-size: 4rem;
            font-weight: 700;
            background: linear-gradient(135deg, #4CAF50 0%, #8BC34A 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
        }

        .score-message {
            font-size: 1.3rem;
            color: #888;
            margin-bottom: 30px;
        }

        .results-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .result-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .result-label {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 8px;
        }

        .result-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .correct-value {
            color: #4CAF50;
        }

        .incorrect-value {
            color: #f44336;
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
        }

        .feedback.correct {
            background: rgba(76, 175, 80, 0.2);
            border: 1px solid rgba(76, 175, 80, 0.3);
            color: #4CAF50;
        }

        .feedback.incorrect {
            background: rgba(244, 67, 54, 0.2);
            border: 1px solid rgba(244, 67, 54, 0.3);
            color: #f44336;
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
<body>
    <div class="container">
        <div class="quiz-card">
            <!-- Start Screen -->
            <div id="startScreen" class="start-screen">
                <h1>Quiz Interativo</h1>
                <p class="subtitle">Teste seus conhecimentos em diversas áreas</p>
                
                <!-- Theme Selection Section -->
                <div class="theme-selection">
                    <h3>Escolha um Tema:</h3>
                    <div class="theme-grid" id="themeGrid">
                        <div class="theme-card" onclick="selectTheme('all')">
                            <div class="theme-icon">🎯</div>
                            <div class="theme-name">Todos os Temas</div>
                            <div class="theme-count">30 perguntas</div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('História')">
                            <div class="theme-icon">📜</div>
                            <div class="theme-name">História</div>
                            <div class="theme-count">5 perguntas</div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Ciências')">
                            <div class="theme-icon">🔬</div>
                            <div class="theme-name">Ciências</div>
                            <div class="theme-count">5 perguntas</div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Geografia')">
                            <div class="theme-icon">🌍</div>
                            <div class="theme-name">Geografia</div>
                            <div class="theme-count">5 perguntas</div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Cultura Geral')">
                            <div class="theme-icon">🎭</div>
                            <div class="theme-name">Cultura Geral</div>
                            <div class="theme-count">5 perguntas</div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Tecnologia')">
                            <div class="theme-icon">💻</div>
                            <div class="theme-name">Tecnologia</div>
                            <div class="theme-count">5 perguntas</div>
                        </div>
                        <div class="theme-card" onclick="selectTheme('Matemática')">
                            <div class="theme-icon">🔢</div>
                            <div class="theme-name">Matemática</div>
                            <div class="theme-count">5 perguntas</div>
                        </div>
                    </div>
                </div>

                <div class="features">
                    <div class="feature">
                        <div class="feature-icon">📚</div>
                        <div class="feature-title">10 Perguntas</div>
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

            <!-- Quiz Screen -->
            <div id="quizScreen" class="hidden">
                <div class="stats">
                    <div class="stat-item">
                        <div class="stat-label">Pergunta</div>
                        <div class="stat-value"><span id="currentQuestion">1</span>/10</div>
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

            <!-- Results Screen -->
            <div id="resultsScreen" class="results-screen hidden">
                <h2>Quiz Finalizado!</h2>
                <div class="score-display" id="finalScore"></div>
                <p class="score-message" id="scoreMessage"></p>

                <div class="results-details">
                    <div class="result-item">
                        <div class="result-label">Total de Perguntas</div>
                        <div class="result-value">10</div>
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
        // Banco de perguntas
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
            }
        ];

        let currentQuestions = [];
        let currentQuestionIndex = 0;
        let score = 0;
        let correctAnswers = 0;
        let selectedAnswer = null;
        let selectedTheme = null;

        function shuffleArray(array) {
            const newArray = [...array];
            for (let i = newArray.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [newArray[i], newArray[j]] = [newArray[j], newArray[i]];
            }
            return newArray;
        }

        function selectTheme(theme) {
            selectedTheme = theme;
            
            // Update UI to show selected theme
            const themeCards = document.querySelectorAll('.theme-card');
            themeCards.forEach(card => card.classList.remove('selected'));
            event.target.closest('.theme-card').classList.add('selected');
            
            // Enable start button
            document.getElementById('startBtn').disabled = false;
        }

        function startQuiz() {
            let availableQuestions;
            if (selectedTheme === 'all') {
                availableQuestions = questionBank;
            } else {
                availableQuestions = questionBank.filter(q => q.category === selectedTheme);
            }
            
            // Seleciona 10 perguntas aleatórias do tema escolhido
            currentQuestions = shuffleArray(availableQuestions).slice(0, 10);
            currentQuestionIndex = 0;
            score = 0;
            correctAnswers = 0;
            selectedAnswer = null;

            document.getElementById('startScreen').classList.add('hidden');
            document.getElementById('quizScreen').classList.remove('hidden');
            document.getElementById('resultsScreen').classList.add('hidden');

            loadQuestion();
        }

        function loadQuestion() {
            const question = currentQuestions[currentQuestionIndex];
            selectedAnswer = null;

            document.getElementById('currentQuestion').textContent = currentQuestionIndex + 1;
            document.getElementById('category').textContent = question.category;
            document.getElementById('questionText').textContent = question.question;
            document.getElementById('feedback').classList.add('hidden');
            document.getElementById('nextBtn').disabled = true;

            const optionsContainer = document.getElementById('optionsContainer');
            optionsContainer.innerHTML = '';

            const letters = ['A', 'B', 'C', 'D'];
            question.options.forEach((option, index) => {
                const optionDiv = document.createElement('div');
                optionDiv.className = 'option';
                optionDiv.innerHTML = `<span class="option-letter">${letters[index]}</span>${option}`;
                optionDiv.onclick = () => selectOption(index, optionDiv);
                optionsContainer.appendChild(optionDiv);
            });

            updateProgress();
        }

        function selectOption(index, element) {
            if (selectedAnswer !== null) return;

            selectedAnswer = index;
            const question = currentQuestions[currentQuestionIndex];
            const options = document.querySelectorAll('.option');
            
            options.forEach(opt => opt.classList.add('disabled'));

            if (index === question.correct) {
                element.classList.add('correct');
                score += 10;
                correctAnswers++;
                showFeedback(true, question.options[question.correct]);
            } else {
                element.classList.add('incorrect');
                options[question.correct].classList.add('correct');
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
                feedback.textContent = `✗ Incorreto. A resposta correta é: ${correctAnswer}`;
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
            const progress = ((currentQuestionIndex + 1) / currentQuestions.length) * 100;
            document.getElementById('progressFill').style.width = progress + '%';
        }

        function showResults() {
            document.getElementById('quizScreen').classList.add('hidden');
            document.getElementById('resultsScreen').classList.remove('hidden');

            const percentage = (correctAnswers / currentQuestions.length) * 100;
            document.getElementById('finalScore').textContent = `${percentage.toFixed(0)}%`;
            document.getElementById('finalCorrect').textContent = correctAnswers;
            document.getElementById('finalIncorrect').textContent = currentQuestions.length - correctAnswers;

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
            const themeCards = document.querySelectorAll('.theme-card');
            themeCards.forEach(card => card.classList.remove('selected'));
            
            document.getElementById('resultsScreen').classList.add('hidden');
            document.getElementById('startScreen').classList.remove('hidden');
        }
    </script>
</body>
</html>
