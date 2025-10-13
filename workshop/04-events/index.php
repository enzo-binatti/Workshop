<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Eventos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #ffffff;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #333;
        }

        h1 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #cccccc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff;
        }

        .header-subtitle {
            color: #888;
            font-size: 1rem;
            text-shadow: 0 0 2px #ffffff;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .view-controls {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            background: #222;
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            box-shadow: 0 0 5px #ffffff;
        }

        .btn:hover {
            background: #333;
            border-color: #666;
            transform: translateY(-2px);
            box-shadow: 0 0 10px #ffffff, 0 0 15px #ffffff;
        }

        .btn.active {
            background: #fff;
            color: #000;
            border-color: #fff;
            box-shadow: 0 0 10px #ffffff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ffffff 0%, #cccccc 100%);
            color: #000;
            border: none;
            font-weight: 600;
            box-shadow: 0 0 5px #ffffff;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #cccccc 0%, #aaaaaa 100%);
            box-shadow: 0 0 10px #ffffff, 0 0 15px #ffffff;
        }

        .search-filter {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 600px;
        }

        .search-input {
            flex: 1;
            padding: 10px 15px;
            background: #222;
            border: 1px solid #444;
            border-radius: 8px;
            color: #fff;
            font-size: 0.9rem;
            box-shadow: inset 0 0 5px #ffffff;
        }

        .search-input:focus {
            outline: none;
            border-color: #666;
            box-shadow: 0 0 10px #ffffff;
        }

        .filter-select {
            padding: 10px 15px;
            background: #222;
            border: 1px solid #444;
            border-radius: 8px;
            color: #fff;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: inset 0 0 5px #ffffff;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 20px;
            background: #1a1a1a;
            border-radius: 12px;
            border: 1px solid #333;
            box-shadow: 0 0 5px #ffffff;
        }

        .calendar-nav {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .calendar-title {
            font-size: 1.5rem;
            font-weight: 600;
            text-shadow: 0 0 3px #ffffff;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-bottom: 30px;
        }

        .calendar-day-header {
            text-align: center;
            padding: 15px;
            background: #1a1a1a;
            border-radius: 8px;
            font-weight: 600;
            color: #888;
            font-size: 0.9rem;
            box-shadow: 0 0 5px #ffffff;
        }

        .calendar-day {
            min-height: 120px;
            padding: 10px;
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            box-shadow: 0 0 5px #ffffff;
        }

        .calendar-day:hover {
            background: #222;
            border-color: #555;
            transform: translateY(-2px);
            box-shadow: 0 0 10px #ffffff, 0 0 15px #ffffff;
        }

        .calendar-day.other-month {
            opacity: 0.3;
        }

        .calendar-day.today {
            border: 2px solid #fff;
            background: #252525;
            box-shadow: 0 0 10px #ffffff;
        }

        .day-number {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
            text-shadow: 0 0 3px #ffffff;
        }

        .day-events {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .event-dot {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 0 5px #ffffff;
        }

        .event-dot:hover {
            transform: scale(1.05);
            opacity: 0.9;
            box-shadow: 0 0 10px #ffffff;
        }

        .event-list {
            display: grid;
            gap: 15px;
        }

        .event-card {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 0 5px #ffffff;
        }

        .event-card:hover {
            background: #222;
            border-color: #555;
            transform: translateY(-2px);
            box-shadow: 0 0 10px #ffffff, 0 0 15px #ffffff;
        }

        .event-card-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .event-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
            text-shadow: 0 0 3px #ffffff;
        }

        .event-time {
            color: #888;
            font-size: 0.9rem;
            text-shadow: 0 0 2px #ffffff;
        }

        .event-category {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 0 5px #ffffff;
            text-transform: capitalize;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .category-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
            vertical-align: middle;
        }

        .event-description {
            color: #aaa;
            margin-bottom: 10px;
            line-height: 1.5;
            text-shadow: 0 0 2px #ffffff;
        }

        .event-details {
            display: flex;
            gap: 20px;
            color: #888;
            font-size: 0.9rem;
            text-shadow: 0 0 2px #ffffff;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 16px;
            padding: 30px;
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 0 10px #ffffff;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            text-shadow: 0 0 3px #ffffff;
        }

        .close-btn {
            background: none;
            border: none;
            color: #888;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: #333;
            color: #fff;
            box-shadow: 0 0 10px #ffffff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #aaa;
            font-size: 0.9rem;
            font-weight: 500;
            text-shadow: 0 0 2px #ffffff;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px 15px;
            background: #222;
            border: 1px solid #444;
            border-radius: 8px;
            color: #fff;
            font-size: 0.95rem;
            font-family: inherit;
            box-shadow: inset 0 0 5px #ffffff;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #666;
            box-shadow: 0 0 10px #ffffff;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .color-options {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
        }

        .color-option {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 8px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            box-shadow: 0 0 5px #ffffff;
        }

        .color-option:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px #ffffff, 0 0 15px #ffffff;
        }

        .color-option.selected {
            border-color: #fff;
            box-shadow: 0 0 0 3px #ffffff, 0 0 10px #ffffff;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .btn-delete {
            background: #ff4444;
            color: #fff;
            border: none;
            margin-right: auto;
            box-shadow: 0 0 5px #ffffff;
        }

        .btn-delete:hover {
            background: #cc0000;
            box-shadow: 0 0 10px #ffffff, 0 0 15px #ffffff;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 0 5px #ffffff;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 0 0 3px #ffffff;
        }

        .stat-label {
            color: #888;
            font-size: 0.9rem;
            text-shadow: 0 0 2px #ffffff;
        }

        .week-view,
        .day-view {
            display: none;
        }

        .week-view.active,
        .day-view.active {
            display: block;
        }

        .time-grid {
            display: grid;
            gap: 10px;
        }

        .time-slot {
            display: grid;
            grid-template-columns: 80px 1fr;
            gap: 15px;
            min-height: 60px;
        }

        .time-label {
            color: #888;
            font-size: 0.9rem;
            padding-top: 5px;
            text-shadow: 0 0 2px #ffffff;
        }

        .time-events {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .calendar-grid {
                gap: 5px;
            }

            .calendar-day {
                min-height: 80px;
                padding: 5px;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-filter {
                max-width: 100%;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Agenda de Eventos</h1>
            <p class="header-subtitle">Organize e gerencie seus eventos de forma eficiente</p>
        </header>

        <div class="toolbar">
            <div class="view-controls">
                <button class="btn active" data-view="month">Mês</button>
                <button class="btn" data-view="week">Semana</button>
                <button class="btn" data-view="day">Dia</button>
                <button class="btn" data-view="list">Lista</button>
            </div>

            <div class="search-filter">
                <input type="text" class="search-input" id="searchInput" placeholder="🔍 Digite o nome do evento que você criou...">
                <select class="filter-select" id="categoryFilter">
                    <option value="all">Todas Categorias</option>
                    <option value="trabalho">Trabalho</option>
                    <option value="pessoal">Pessoal</option>
                    <option value="reuniao">Reunião</option>
                    <option value="evento">Evento</option>
                    <option value="aniversario">Aniversário</option>
                    <option value="outro">Outro</option>
                </select>
                <button class="btn" id="clearFiltersBtn" title="Limpar Filtros">🔄</button>
                <button class="btn" id="clearAllEventsBtn" title="Limpar Todos os Eventos" style="background: #ef4444; display: none;">🗑️</button>
            </div>

            <button class="btn btn-primary" id="addEventBtn">+ Novo Evento</button>
        </div>

        <div class="stats-grid" id="statsGrid">
            <div class="stat-card">
                <div class="stat-number" id="totalEvents">0</div>
                <div class="stat-label">Total de Eventos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="todayEvents">0</div>
                <div class="stat-label">Eventos Hoje</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="weekEvents">0</div>
                <div class="stat-label">Esta Semana</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="monthEvents">0</div>
                <div class="stat-label">Este Mês</div>
            </div>
        </div>

        <div id="monthView" class="month-view active">
            <div class="calendar-header">
                <button class="btn" id="prevMonth">← Anterior</button>
                <div class="calendar-title" id="currentMonth"></div>
                <button class="btn" id="nextMonth">Próximo →</button>
            </div>

            <div class="calendar-grid">
                <div class="calendar-day-header">Dom</div>
                <div class="calendar-day-header">Seg</div>
                <div class="calendar-day-header">Ter</div>
                <div class="calendar-day-header">Qua</div>
                <div class="calendar-day-header">Qui</div>
                <div class="calendar-day-header">Sex</div>
                <div class="calendar-day-header">Sáb</div>
            </div>

            <div class="calendar-grid" id="calendarDays"></div>
        </div>

        <div id="weekView" class="week-view">
            <div class="calendar-header">
                <button class="btn" id="prevWeek">← Anterior</button>
                <div class="calendar-title" id="currentWeek"></div>
                <button class="btn" id="nextWeek">Próxima →</button>
            </div>
            <div id="weekGrid"></div>
        </div>

        <div id="dayView" class="day-view">
            <div class="calendar-header">
                <button class="btn" id="prevDay">← Anterior</button>
                <div class="calendar-title" id="currentDay"></div>
                <button class="btn" id="nextDay">Próximo →</button>
            </div>
            <div class="time-grid" id="dayGrid"></div>
        </div>

        <div id="listView" class="event-list" style="display: none;"></div>
    </div>

    <div class="modal" id="eventModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">Novo Evento</h2>
                <button class="close-btn" id="closeModal">×</button>
            </div>

            <form id="eventForm">
                <div class="form-group">
                    <label class="form-label">Título do Evento *</label>
                    <input type="text" class="form-input" id="eventTitle" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-textarea" id="eventDescription"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Data *</label>
                        <input type="date" class="form-input" id="eventDate" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hora *</label>
                        <input type="time" class="form-input" id="eventTime" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Duração (minutos)</label>
                        <input type="number" class="form-input" id="eventDuration" value="60" min="15" step="15">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Categoria *</label>
                        <select class="form-select" id="eventCategory" required>
                            <option value="trabalho">Trabalho</option>
                            <option value="pessoal">Pessoal</option>
                            <option value="reuniao">Reunião</option>
                            <option value="evento">Evento</option>
                            <option value="aniversario">Aniversário</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Local</label>
                    <input type="text" class="form-input" id="eventLocation">
                </div>

                <div class="form-group">
                    <label class="form-label">Participantes</label>
                    <input type="text" class="form-input" id="eventParticipants" placeholder="Separados por vírgula">
                </div>

                <div class="form-group">
                    <label class="form-label">Cor do Evento</label>
                    <div class="color-options" id="colorOptions">
                        <div class="color-option selected" data-color="#3b82f6" style="background: #3b82f6;"></div>
                        <div class="color-option" data-color="#10b981" style="background: #10b981;"></div>
                        <div class="color-option" data-color="#f59e0b" style="background: #f59e0b;"></div>
                        <div class="color-option" data-color="#ef4444" style="background: #ef4444;"></div>
                        <div class="color-option" data-color="#8b5cf6" style="background: #8b5cf6;"></div>
                        <div class="color-option" data-color="#ec4899" style="background: #ec4899;"></div>
                        <div class="color-option" data-color="#ffffff" style="background: #ffffff;"></div>
                        <div class="color-option" data-color="#cccccc" style="background: #cccccc;"></div>
                        <div class="color-option" data-color="#aaaaaa" style="background: #aaaaaa;"></div>
                        <div class="color-option" data-color="#888888" style="background: #888888;"></div>
                        <div class="color-option" data-color="#666666" style="background: #666666;"></div>
                        <div class="color-option" data-color="#444444" style="background: #444444;"></div>
                        <div class="color-option" data-color="#22c55e" style="background: #22c55e;"></div>
                        <div class="color-option" data-color="#eab308" style="background: #eab308;"></div>
                        <div class="color-option" data-color="#f97316" style="background: #f97316;"></div>
                        <div class="color-option" data-color="#a855f7" style="background: #a855f7;"></div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-delete" id="deleteEventBtn" style="display: none;">Excluir</button>
                    <button type="button" class="btn" id="cancelBtn">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Evento</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Estado da aplicação
        let currentDate = new Date();
        let currentView = 'month';
        let events = JSON.parse(localStorage.getItem('agendaEvents')) || [];
        let filteredEvents = []; // Array para eventos filtrados
        let editingEventId = null;
        let selectedColor = '#3b82f6';
        let searchTimeout = null; // Para debounce da pesquisa

        // Categorias com cores padrão
        const categoryColors = {
            trabalho: '#3b82f6',
            pessoal: '#10b981',
            reuniao: '#f59e0b',
            evento: '#ef4444',
            aniversario: '#8b5cf6',
            outro: '#ec4899'
        };

        
        function updateClearAllButton() {
            const clearAllEventsBtn = document.getElementById('clearAllEventsBtn');
            if (clearAllEventsBtn) {
                if (events.length > 0) {
                    clearAllEventsBtn.style.display = 'block';
                } else {
                    clearAllEventsBtn.style.display = 'none';
                }
            }
        }
        
        // Inicialização
        document.addEventListener('DOMContentLoaded', () => {
            initializeEventListeners();
            renderCalendar();
            updateStats();
            updateClearAllButton();
        });

        function initializeEventListeners() {
            // View controls
            document.querySelectorAll('[data-view]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    currentView = e.target.dataset.view;
                    document.querySelectorAll('[data-view]').forEach(b => b.classList.remove('active'));
                    e.target.classList.add('active');
                    switchView();
                });
            });

            // Navigation
            document.getElementById('prevMonth').addEventListener('click', () => changeMonth(-1));
            document.getElementById('nextMonth').addEventListener('click', () => changeMonth(1));
            document.getElementById('prevWeek').addEventListener('click', () => changeWeek(-1));
            document.getElementById('nextWeek').addEventListener('click', () => changeWeek(1));
            document.getElementById('prevDay').addEventListener('click', () => changeDay(-1));
            document.getElementById('nextDay').addEventListener('click', () => changeDay(1));

            // Modal - Adicionar evento
            const addEventBtn = document.getElementById('addEventBtn');
            if (addEventBtn) {
                addEventBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Botão Adicionar Evento clicado!');
                    openNewEventModal();
                });
            } else {
                console.error('Botão addEventBtn não encontrado!');
            }
            
            // Outros eventos do modal
            const closeModalBtn = document.getElementById('closeModal');
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }
            
            const cancelBtn = document.getElementById('cancelBtn');
            if (cancelBtn) {
                cancelBtn.addEventListener('click', closeModal);
            }
            
            const eventForm = document.getElementById('eventForm');
            if (eventForm) {
                eventForm.addEventListener('submit', saveEvent);
            }
            
            const deleteEventBtn = document.getElementById('deleteEventBtn');
            if (deleteEventBtn) {
                deleteEventBtn.addEventListener('click', deleteEvent);
            }

            // Color selection
            document.querySelectorAll('.color-option').forEach(option => {
                option.addEventListener('click', (e) => {
                    document.querySelectorAll('.color-option').forEach(o => o.classList.remove('selected'));
                    e.target.classList.add('selected');
                    selectedColor = e.target.dataset.color;
                });
            });

            // Search and filter - pesquisa em tempo real
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            
            if (searchInput) {
                searchInput.addEventListener('input', filterEvents);
                searchInput.addEventListener('keyup', filterEvents);
                searchInput.addEventListener('paste', () => {
                    // Pequeno delay para paste
                    setTimeout(filterEvents, 50);
                });
            }
            
            if (categoryFilter) {
                categoryFilter.addEventListener('change', filterEvents);
            }
            
            // Clear filters
            const clearFiltersBtn = document.getElementById('clearFiltersBtn');
            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener('click', function() {
                    document.getElementById('searchInput').value = '';
                    document.getElementById('categoryFilter').value = 'all';
                    filteredEvents = [];
                    console.log('Filtros limpos');
                    renderCurrentView(); // Atualizar visualização
                    updateStats(); // Restaurar estatísticas originais
                    updateFilterIndicators(); // Atualizar indicadores visuais
                });
            }
            
            // Clear all events button (only show if there are events)
            const clearAllEventsBtn = document.getElementById('clearAllEventsBtn');
            if (clearAllEventsBtn) {
                clearAllEventsBtn.addEventListener('click', function() {
                    if (confirm('Tem certeza que deseja excluir TODOS os eventos? Esta ação não pode ser desfeita.')) {
                        events = [];
                        filteredEvents = [];
                        localStorage.setItem('agendaEvents', JSON.stringify(events));
                        console.log('🗑️ Todos os eventos foram removidos');
                        renderCurrentView();
                        updateStats();
                        updateClearAllButton();
                    }
                });
            }
            
            // Category color auto-selection
            const eventCategorySelect = document.getElementById('eventCategory');
            if (eventCategorySelect) {
                eventCategorySelect.addEventListener('change', function() {
                    const selectedCategory = this.value;
                    const categoryColor = categoryColors[selectedCategory];
                    if (categoryColor) {
                        selectCategoryColor(categoryColor);
                    }
                });
            }
        }

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            // Update header
            const monthNames = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                              'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
            document.getElementById('currentMonth').textContent = `${monthNames[month]} ${year}`;

            // Get first day of month and number of days
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const daysInPrevMonth = new Date(year, month, 0).getDate();

            const calendarDays = document.getElementById('calendarDays');
            calendarDays.innerHTML = '';

            // Previous month days
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = daysInPrevMonth - i;
                const dayElement = createDayElement(day, true, new Date(year, month - 1, day));
                calendarDays.appendChild(dayElement);
            }

            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const date = new Date(year, month, day);
                const dayElement = createDayElement(day, false, date);
                calendarDays.appendChild(dayElement);
            }

            // Next month days
            const remainingDays = 42 - (firstDay + daysInMonth);
            for (let day = 1; day <= remainingDays; day++) {
                const dayElement = createDayElement(day, true, new Date(year, month + 1, day));
                calendarDays.appendChild(dayElement);
            }
        }

        function createDayElement(day, otherMonth, date) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            if (otherMonth) dayElement.classList.add('other-month');
            
            const today = new Date();
            if (date.toDateString() === today.toDateString()) {
                dayElement.classList.add('today');
            }

            const dayNumber = document.createElement('div');
            dayNumber.className = 'day-number';
            dayNumber.textContent = day;
            dayElement.appendChild(dayNumber);

            const dayEvents = document.createElement('div');
            dayEvents.className = 'day-events';
            
            const dateStr = date.toISOString().split('T')[0];
            const dayEventsList = events.filter(e => e.date === dateStr);
            
            dayEventsList.slice(0, 3).forEach(event => {
                const eventDot = document.createElement('div');
                eventDot.className = 'event-dot';
                eventDot.textContent = event.title;
                eventDot.style.background = event.color;
                eventDot.style.color = '#000';
                eventDot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    openEditEventModal(event);
                });
                dayEvents.appendChild(eventDot);
            });

            if (dayEventsList.length > 3) {
                const more = document.createElement('div');
                more.className = 'event-dot';
                more.textContent = `+${dayEventsList.length - 3} mais`;
                more.style.background = '#444';
                more.style.color = '#fff';
                dayEvents.appendChild(more);
            }

            dayElement.appendChild(dayEvents);

            dayElement.addEventListener('click', () => {
                openNewEventModal(date);
            });

            return dayElement;
        }

        function renderWeekView() {
            const weekGrid = document.getElementById('weekGrid');
            weekGrid.innerHTML = '';
            
            const startOfWeek = new Date(currentDate);
            startOfWeek.setDate(currentDate.getDate() - currentDate.getDay());
            
            const endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6);
            
            document.getElementById('currentWeek').textContent = 
                `${startOfWeek.toLocaleDateString('pt-BR')} - ${endOfWeek.toLocaleDateString('pt-BR')}`;

            for (let i = 0; i < 7; i++) {
                const date = new Date(startOfWeek);
                date.setDate(startOfWeek.getDate() + i);
                
                const dayCard = document.createElement('div');
                dayCard.className = 'event-card';
                dayCard.innerHTML = `
                    <div class="event-card-header">
                        <div>
                            <div class="event-title">${['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'][i]}</div>
                            <div class="event-time">${date.toLocaleDateString('pt-BR')}</div>
                        </div>
                    </div>
                    <div class="day-events" id="week-day-${i}"></div>
                `;
                weekGrid.appendChild(dayCard);
                
                const dateStr = date.toISOString().split('T')[0];
                const dayEvents = events.filter(e => e.date === dateStr);
                const eventsContainer = document.getElementById(`week-day-${i}`);
                
                dayEvents.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.className = 'event-dot';
                    eventEl.textContent = `${event.time} - ${event.title}`;
                    eventEl.style.background = event.color;
                    eventEl.style.color = '#000';
                    eventEl.style.marginTop = '8px';
                    eventEl.style.padding = '8px';
                    eventEl.addEventListener('click', () => openEditEventModal(event));
                    eventsContainer.appendChild(eventEl);
                });
            }
        }

        function renderDayView() {
            const dayGrid = document.getElementById('dayGrid');
            dayGrid.innerHTML = '';
            
            document.getElementById('currentDay').textContent = currentDate.toLocaleDateString('pt-BR', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const dateStr = currentDate.toISOString().split('T')[0];
            const dayEvents = events.filter(e => e.date === dateStr).sort((a, b) => a.time.localeCompare(b.time));

            for (let hour = 0; hour < 24; hour++) {
                const timeSlot = document.createElement('div');
                timeSlot.className = 'time-slot';
                
                const timeLabel = document.createElement('div');
                timeLabel.className = 'time-label';
                timeLabel.textContent = `${hour.toString().padStart(2, '0')}:00`;
                
                const timeEvents = document.createElement('div');
                timeEvents.className = 'time-events';
                
                const hourStr = hour.toString().padStart(2, '0');
                const hourEvents = dayEvents.filter(e => e.time.startsWith(hourStr));
                
                hourEvents.forEach(event => {
                    const eventCard = document.createElement('div');
                    eventCard.className = 'event-card';
                    eventCard.innerHTML = `
                        <div class="event-card-header">
                            <div>
                                <div class="event-title">${event.title}</div>
                                <div class="event-time">${event.time} - ${event.duration} min</div>
                            </div>
                            <div class="event-category" style="background: ${event.color}; color: #000;">
                                ${event.category}
                            </div>
                        </div>
                        ${event.description ? `<div class="event-description">${event.description}</div>` : ''}
                        <div class="event-details">
                            ${event.location ? `<span>📍 ${event.location}</span>` : ''}
                            ${event.participants ? `<span>👥 ${event.participants}</span>` : ''}
                        </div>
                    `;
                    eventCard.addEventListener('click', () => openEditEventModal(event));
                    timeEvents.appendChild(eventCard);
                });
                
                timeSlot.appendChild(timeLabel);
                timeSlot.appendChild(timeEvents);
                dayGrid.appendChild(timeSlot);
            }
        }

        function renderListView() {
            const listView = document.getElementById('listView');
            listView.innerHTML = '';

            const sortedEvents = [...events].sort((a, b) => {
                const dateA = new Date(`${a.date}T${a.time}`);
                const dateB = new Date(`${b.date}T${b.time}`);
                return dateA - dateB;
            });

            sortedEvents.forEach(event => {
                const eventCard = document.createElement('div');
                eventCard.className = 'event-card';
                eventCard.innerHTML = `
                    <div class="event-card-header">
                        <div>
                            <div class="event-title">${event.title}</div>
                            <div class="event-time">${new Date(event.date).toLocaleDateString('pt-BR')} às ${event.time}</div>
                        </div>
                        <div class="event-category" style="background: ${event.color}; color: #000;">
                            ${event.category}
                        </div>
                    </div>
                    ${event.description ? `<div class="event-description">${event.description}</div>` : ''}
                    <div class="event-details">
                        <span>⏱️ ${event.duration} minutos</span>
                        ${event.location ? `<span>📍 ${event.location}</span>` : ''}
                        ${event.participants ? `<span>👥 ${event.participants}</span>` : ''}
                    </div>
                `;
                eventCard.addEventListener('click', () => openEditEventModal(event));
                listView.appendChild(eventCard);
            });

            if (sortedEvents.length === 0) {
                const searchTerm = document.getElementById('searchInput').value.trim();
                const category = document.getElementById('categoryFilter').value;
                let message = 'Nenhum evento encontrado';
                let suggestion = 'Adicione novos eventos usando o botão "+ Novo Evento"';
                
                if (searchTerm) {
                    message = `🔍 Nenhum evento chamado "${searchTerm}" foi encontrado`;
                    suggestion = 'Tente buscar por outro nome ou verifique a grafia';
                } else if (category !== 'all') {
                    message = `📁 Nenhum evento encontrado na categoria "${category}"`;
                    suggestion = 'Tente selecionar "Todas Categorias" ou criar eventos nesta categoria';
                }
                
                listView.innerHTML = `
                    <div style="text-align: center; color: #888; padding: 40px;">
                        <div style="font-size: 1.2rem; margin-bottom: 10px;">${message}</div>
                        <div style="font-size: 0.9rem; margin-bottom: 15px;">${suggestion}</div>
                        ${searchTerm ? `<div style="font-size: 0.8rem; color: #666;">Dica: A busca procura no título do evento primeiro, depois em outros campos</div>` : ''}
                    </div>
                `;
            }
        }

        function switchView() {
            document.getElementById('monthView').style.display = 'none';
            document.getElementById('weekView').style.display = 'none';
            document.getElementById('dayView').style.display = 'none';
            document.getElementById('listView').style.display = 'none';

            switch(currentView) {
                case 'month':
                    document.getElementById('monthView').style.display = 'block';
                    break;
                case 'week':
                    document.getElementById('weekView').style.display = 'block';
                    break;
                case 'day':
                    document.getElementById('dayView').style.display = 'block';
                    break;
                case 'list':
                    document.getElementById('listView').style.display = 'block';
                    break;
            }
            
            // Renderizar a visualização atual (com ou sem filtros)
            renderCurrentView();
        }

        function changeMonth(delta) {
            currentDate.setMonth(currentDate.getMonth() + delta);
            renderCalendar();
        }

        function changeWeek(delta) {
            currentDate.setDate(currentDate.getDate() + (delta * 7));
            renderWeekView();
        }

        function changeDay(delta) {
            currentDate.setDate(currentDate.getDate() + delta);
            renderDayView();
        }

        function openNewEventModal(date = null) {
            console.log('Abrindo modal de novo evento...');
            
            try {
                editingEventId = null;
                
                // Resetar o formulário
                const eventForm = document.getElementById('eventForm');
                if (eventForm) {
                    eventForm.reset();
                }
                
                // Definir título do modal
                const modalTitle = document.getElementById('modalTitle');
                if (modalTitle) {
                    modalTitle.textContent = 'Novo Evento';
                }
                
                // Esconder botão de deletar
                const deleteEventBtn = document.getElementById('deleteEventBtn');
                if (deleteEventBtn) {
                    deleteEventBtn.style.display = 'none';
                }
                
                // Definir data padrão
                const eventDate = document.getElementById('eventDate');
                if (eventDate) {
                    if (date) {
                        eventDate.value = date.toISOString().split('T')[0];
                    } else {
                        eventDate.value = new Date().toISOString().split('T')[0];
                    }
                }
                
                // Definir horário padrão
                const eventTime = document.getElementById('eventTime');
                if (eventTime) {
                    eventTime.value = '09:00';
                }
                
                // Definir categoria e cor padrão
                const eventCategory = document.getElementById('eventCategory');
                if (eventCategory) {
                    eventCategory.value = 'trabalho'; // categoria padrão
                    const defaultColor = categoryColors['trabalho'] || '#3b82f6';
                    selectCategoryColor(defaultColor);
                }
                
                // Abrir o modal
                const eventModal = document.getElementById('eventModal');
                if (eventModal) {
                    eventModal.classList.add('active');
                    console.log('Modal aberto com sucesso!');
                } else {
                    console.error('Modal não encontrado!');
                }
                
            } catch (error) {
                console.error('Erro ao abrir modal:', error);
            }
        }

        function openEditEventModal(event) {
            editingEventId = event.id;
            document.getElementById('modalTitle').textContent = 'Editar Evento';
            document.getElementById('eventTitle').value = event.title;
            document.getElementById('eventDescription').value = event.description || '';
            document.getElementById('eventDate').value = event.date;
            document.getElementById('eventTime').value = event.time;
            document.getElementById('eventDuration').value = event.duration;
            document.getElementById('eventCategory').value = event.category;
            document.getElementById('eventLocation').value = event.location || '';
            document.getElementById('eventParticipants').value = event.participants || '';
            
            selectedColor = event.color;
            document.querySelectorAll('.color-option').forEach(o => {
                o.classList.remove('selected');
                if (o.dataset.color === event.color) {
                    o.classList.add('selected');
                }
            });
            
            document.getElementById('deleteEventBtn').style.display = 'block';
            document.getElementById('eventModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('eventModal').classList.remove('active');
            editingEventId = null;
        }

        function saveEvent(e) {
            e.preventDefault();
            
            const category = document.getElementById('eventCategory').value;
            const eventColor = selectedColor || categoryColors[category] || '#3b82f6';
            
            const eventData = {
                id: editingEventId || Date.now().toString(),
                title: document.getElementById('eventTitle').value,
                description: document.getElementById('eventDescription').value,
                date: document.getElementById('eventDate').value,
                time: document.getElementById('eventTime').value,
                duration: parseInt(document.getElementById('eventDuration').value),
                category: category,
                location: document.getElementById('eventLocation').value,
                participants: document.getElementById('eventParticipants').value,
                color: eventColor
            };
            
            console.log('Salvando evento:', eventData);

            if (editingEventId) {
                const index = events.findIndex(e => e.id === editingEventId);
                events[index] = eventData;
            } else {
                events.push(eventData);
            }

            localStorage.setItem('agendaEvents', JSON.stringify(events));
            closeModal();
            switchView();
            updateStats();
            updateClearAllButton();
        }

        function deleteEvent() {
            if (confirm('Tem certeza que deseja excluir este evento?')) {
                events = events.filter(e => e.id !== editingEventId);
                localStorage.setItem('agendaEvents', JSON.stringify(events));
                closeModal();
                switchView();
                updateStats();
                updateClearAllButton();
            }
        }

        function filterEvents() {
            // Limpar timeout anterior se existir
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }
            
            // Adicionar debounce para pesquisa mais suave
            searchTimeout = setTimeout(() => {
                performFilter();
            }, 300); // 300ms de delay
        }
        
        function performFilter() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase().trim();
            const category = document.getElementById('categoryFilter').value;
            
            console.log('Buscando eventos por nome:', searchTerm, 'Categoria:', category);
            
            // Aplicar filtros com prioridade no título
            filteredEvents = events.filter(event => {
                let matchesSearch = true;
                let matchesCategory = true;
                
                // Filtro de busca - PRIORIDADE NO TÍTULO
                if (searchTerm) {
                    const eventTitle = event.title.toLowerCase();
                    
                    // Primeira prioridade: busca exata no título
                    if (eventTitle === searchTerm) {
                        matchesSearch = true;
                    }
                    // Segunda prioridade: título começa com o termo
                    else if (eventTitle.startsWith(searchTerm)) {
                        matchesSearch = true;
                    }
                    // Terceira prioridade: título contém o termo
                    else if (eventTitle.includes(searchTerm)) {
                        matchesSearch = true;
                    }
                    // Quarta prioridade: busca em outros campos (opcional)
                    else {
                        matchesSearch = 
                            (event.description && event.description.toLowerCase().includes(searchTerm)) ||
                            (event.location && event.location.toLowerCase().includes(searchTerm)) ||
                            (event.participants && event.participants.toLowerCase().includes(searchTerm));
                    }
                }
                
                // Filtro de categoria
                if (category !== 'all') {
                    matchesCategory = event.category === category;
                }
                
                return matchesSearch && matchesCategory;
            });
            
            // Ordenar resultados por relevância (títulos primeiro)
            if (searchTerm) {
                filteredEvents.sort((a, b) => {
                    const aTitleLower = a.title.toLowerCase();
                    const bTitleLower = b.title.toLowerCase();
                    
                    // Correspondência exata no título vem primeiro
                    if (aTitleLower === searchTerm && bTitleLower !== searchTerm) return -1;
                    if (bTitleLower === searchTerm && aTitleLower !== searchTerm) return 1;
                    
                    // Título que começa com o termo vem antes
                    if (aTitleLower.startsWith(searchTerm) && !bTitleLower.startsWith(searchTerm)) return -1;
                    if (bTitleLower.startsWith(searchTerm) && !aTitleLower.startsWith(searchTerm)) return 1;
                    
                    // Título que contém o termo vem antes
                    if (aTitleLower.includes(searchTerm) && !bTitleLower.includes(searchTerm)) return -1;
                    if (bTitleLower.includes(searchTerm) && !aTitleLower.includes(searchTerm)) return 1;
                    
                    // Ordenar alfabeticamente se mesma relevância
                    return a.title.localeCompare(b.title, 'pt-BR');
                });
            }
            
            console.log(`✨ Encontrados: ${filteredEvents.length} eventos com "${searchTerm}"`);
            if (filteredEvents.length > 0) {
                console.log('Eventos encontrados:', filteredEvents.map(e => e.title));
            }
            
            // Atualizar visualização
            renderCurrentView();
            
            // Atualizar estatísticas
            updateFilteredStats(filteredEvents);
            
            // Atualizar indicadores visuais
            updateFilterIndicators();
        }

        function updateStats() {
            const today = new Date().toISOString().split('T')[0];
            const todayEvents = events.filter(e => e.date === today).length;

            const startOfWeek = new Date();
            startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay());
            const endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6);
            
            const weekEvents = events.filter(e => {
                const eventDate = new Date(e.date);
                return eventDate >= startOfWeek && eventDate <= endOfWeek;
            }).length;

            const monthEvents = events.filter(e => {
                const eventDate = new Date(e.date);
                return eventDate.getMonth() === currentDate.getMonth() &&
                       eventDate.getFullYear() === currentDate.getFullYear();
            }).length;

            document.getElementById('totalEvents').textContent = events.length;
            document.getElementById('todayEvents').textContent = todayEvents;
            document.getElementById('weekEvents').textContent = weekEvents;
            document.getElementById('monthEvents').textContent = monthEvents;
        }
        
        function updateFilteredStats(filteredEvents) {
            const today = new Date().toISOString().split('T')[0];
            const todayEvents = filteredEvents.filter(e => e.date === today).length;

            const startOfWeek = new Date();
            startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay());
            const endOfWeek = new Date(startOfWeek);
            endOfWeek.setDate(startOfWeek.getDate() + 6);
            
            const weekEvents = filteredEvents.filter(e => {
                const eventDate = new Date(e.date);
                return eventDate >= startOfWeek && eventDate <= endOfWeek;
            }).length;

            const monthEvents = filteredEvents.filter(e => {
                const eventDate = new Date(e.date);
                return eventDate.getMonth() === currentDate.getMonth() &&
                       eventDate.getFullYear() === currentDate.getFullYear();
            }).length;

            document.getElementById('totalEvents').textContent = filteredEvents.length;
            document.getElementById('todayEvents').textContent = todayEvents;
            document.getElementById('weekEvents').textContent = weekEvents;
            document.getElementById('monthEvents').textContent = monthEvents;
        }
        
        function renderCurrentView() {
            // Usar eventos filtrados se houver filtros ativos, senão usar todos os eventos
            const eventsToRender = (isFilterActive()) ? filteredEvents : events;
            const originalEvents = events;
            
            // Temporariamente substituir events pelos filtrados para renderização
            events = eventsToRender;
            
            switch(currentView) {
                case 'month':
                    renderCalendar();
                    break;
                case 'week':
                    renderWeekView();
                    break;
                case 'day':
                    renderDayView();
                    break;
                case 'list':
                    renderListView();
                    break;
            }
            
            // Restaurar events original
            events = originalEvents;
        }
        
        function isFilterActive() {
            const searchTerm = document.getElementById('searchInput').value.trim();
            const category = document.getElementById('categoryFilter').value;
            return searchTerm !== '' || category !== 'all';
        }
        
        function updateFilterIndicators() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const clearFiltersBtn = document.getElementById('clearFiltersBtn');
            
            if (isFilterActive()) {
                // Adicionar classe visual para indicar filtros ativos
                searchInput.style.borderColor = '#10b981';
                searchInput.style.boxShadow = '0 0 5px #10b981';
                categoryFilter.style.borderColor = '#10b981';
                categoryFilter.style.boxShadow = '0 0 5px #10b981';
                
                if (clearFiltersBtn) {
                    clearFiltersBtn.style.background = '#ef4444';
                    clearFiltersBtn.style.color = '#fff';
                }
            } else {
                // Remover indicadores visuais
                searchInput.style.borderColor = '#444';
                searchInput.style.boxShadow = 'inset 0 0 5px #ffffff';
                categoryFilter.style.borderColor = '#444';
                categoryFilter.style.boxShadow = 'inset 0 0 5px #ffffff';
                
                if (clearFiltersBtn) {
                    clearFiltersBtn.style.background = '#222';
                    clearFiltersBtn.style.color = '#fff';
                }
            }
        }
        
        function selectCategoryColor(color) {
            selectedColor = color;
            document.querySelectorAll('.color-option').forEach(option => {
                option.classList.remove('selected');
                if (option.dataset.color === color) {
                    option.classList.add('selected');
                }
            });
            console.log('Cor selecionada automaticamente:', color);
        }
    </script>
</body>
</html>