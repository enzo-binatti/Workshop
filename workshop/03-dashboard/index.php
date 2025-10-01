<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativo</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #0a0a0a;
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #111111;
            border-right: 1px solid #222222;
            padding: 20px 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        .sidebar.mobile-visible { /* Added for mobile visibility */
            transform: translateX(0);
        }

        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid #222222;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff 0%, #888888 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section {
            margin-bottom: 30px;
        }

        .menu-section-title {
            padding: 0 20px;
            font-size: 11px;
            text-transform: uppercase;
            color: #666666;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #999999;
            cursor: pointer;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: #1a1a1a;
            color: #ffffff;
        }

        .menu-item.active {
            background: #1a1a1a;
            color: #ffffff;
            border-left-color: #ffffff;
        }

        .menu-icon {
            font-size: 20px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content.full-width {
            margin-left: 0;
        }

        /* Header */
        .header {
            background: #111111;
            border-bottom: 1px solid #222222;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            color: #ffffff;
            font-size: 24px;
            cursor: pointer;
        }

        .search-bar {
            position: relative;
        }

        .search-bar input {
            background: #1a1a1a;
            border: 1px solid #222222;
            border-radius: 8px;
            padding: 10px 40px 10px 15px;
            color: #ffffff;
            width: 300px;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #444444;
            background: #222222;
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #666666;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-icon {
            position: relative;
            width: 40px;
            height: 40px;
            background: #1a1a1a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .header-icon:hover {
            background: #222222;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4444;
            color: #ffffff;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .user-profile:hover {
            background: #1a1a1a;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffffff 0%, #888888 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
        }

        .user-role {
            font-size: 12px;
            color: #666666;
        }

        /* Content Area */
        .content {
            padding: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #666666;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #111111;
            border: 1px solid #222222;
            border-radius: 12px;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
            border-color: #333333;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .stat-icon.green { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
        .stat-icon.purple { background: rgba(168, 85, 247, 0.1); color: #a855f7; }
        .stat-icon.orange { background: rgba(249, 115, 22, 0.1); color: #f97316; }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .stat-trend.up {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .stat-trend.down {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .stat-label {
            color: #666666;
            font-size: 14px;
        }

        /* Charts Section */
        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: #111111;
            border: 1px solid #222222;
            border-radius: 12px;
            padding: 24px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 600;
        }

        .chart-filter {
            display: flex;
            gap: 8px;
        }

        .filter-btn {
            background: #1a1a1a;
            border: 1px solid #222222;
            color: #666666;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #222222;
            color: #ffffff;
            border-color: #333333;
        }

        .chart-container {
            height: 300px;
            position: relative;
        }

        /* Table */
        .table-card {
            background: #111111;
            border: 1px solid #222222;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-header {
            padding: 24px;
            border-bottom: 1px solid #222222;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-title {
            font-size: 18px;
            font-weight: 600;
        }

        .table-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #ffffff;
            color: #0a0a0a;
        }

        .btn-primary:hover {
            background: #e5e5e5;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #1a1a1a;
            color: #ffffff;
            border: 1px solid #222222;
        }

        .btn-secondary:hover {
            background: #222222;
            border-color: #333333;
        }

        .table-filters {
            padding: 20px 24px;
            border-bottom: 1px solid #222222;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-input {
            background: #1a1a1a;
            border: 1px solid #222222;
            border-radius: 8px;
            padding: 8px 12px;
            color: #ffffff;
            font-size: 14px;
            flex: 1;
            min-width: 200px;
        }

        .filter-input:focus {
            outline: none;
            border-color: #444444;
        }

        .filter-select {
            background: #1a1a1a;
            border: 1px solid #222222;
            border-radius: 8px;
            padding: 8px 12px;
            color: #ffffff;
            font-size: 14px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #0a0a0a;
        }

        th {
            padding: 16px 24px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #666666;
            letter-spacing: 0.5px;
            cursor: pointer;
            user-select: none;
        }

        th:hover {
            color: #ffffff;
        }

        td {
            padding: 16px 24px;
            border-top: 1px solid #222222;
            font-size: 14px;
        }

        tbody tr {
            transition: background 0.2s ease;
        }

        tbody tr:hover {
            background: #1a1a1a;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-active {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-pending {
            background: rgba(249, 115, 22, 0.1);
            color: #f97316;
        }

        .status-inactive {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .table-pagination {
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #222222;
        }

        .pagination-info {
            color: #666666;
            font-size: 14px;
        }

        .pagination-buttons {
            display: flex;
            gap: 8px;
        }

        .pagination-btn {
            background: #1a1a1a;
            border: 1px solid #222222;
            color: #ffffff;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #222222;
            border-color: #333333;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-btn.active {
            background: #ffffff;
            color: #0a0a0a;
            border-color: #ffffff;
        }

        /* Activity Feed */
        .activity-card {
            background: #111111;
            border: 1px solid #222222;
            border-radius: 12px;
            padding: 24px;
        }

        .activity-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #222222;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .activity-description {
            font-size: 13px;
            color: #666666;
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: #444444;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-visible {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .search-bar input {
                width: 200px;
            }

            .user-info {
                display: none;
            }

            .stats-grid,
            .charts-grid {
                grid-template-columns: 1fr;
            }

            .content {
                padding: 20px;
            }

            .table-card {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
            }
        }

        /* Page Specific Styles */
        .page-content {
            display: none;
        }

        .page-content.active {
            display: block;
        }

        /* Settings Page */
        .settings-section {
            background: #111111;
            border: 1px solid #222222;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .settings-section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .settings-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #222222;
        }

        .settings-item:last-child {
            border-bottom: none;
        }

        .settings-label {
            font-size: 14px;
            font-weight: 500;
        }

        .settings-description {
            font-size: 13px;
            color: #666666;
            margin-top: 4px;
        }

        .toggle-switch {
            position: relative;
            width: 48px;
            height: 24px;
            background: #1a1a1a;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .toggle-switch.active {
            background: #22c55e;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            background: #ffffff;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .toggle-switch.active::after {
            transform: translateX(24px);
        }

        /* Loading State */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #222222;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* CHANGE: Adicionando estilos para as novas páginas */
        .notification-item {
            display: flex;
            gap: 16px;
            padding: 16px;
            border-bottom: 1px solid #2a2a2a;
            transition: background 0.2s;
        }

        .notification-item:hover {
            background: #1a1a1a;
        }

        .notification-item.unread {
            background: rgba(102, 126, 234, 0.05);
        }

        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .notification-text {
            font-size: 14px;
            color: #999;
            margin-bottom: 4px;
        }

        .notification-time {
            font-size: 12px;
            color: #666;
        }

        .notification-setting {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #2a2a2a;
        }

        .notification-setting:last-child {
            border-bottom: none;
        }

        .toggle {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 24px;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #2a2a2a;
            transition: 0.3s;
            border-radius: 24px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
        }

        .toggle input:checked + .toggle-slider {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .toggle input:checked + .toggle-slider:before {
            transform: translateX(24px);
        }

        .faq-item {
            border-bottom: 1px solid #2a2a2a;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            cursor: pointer;
            font-weight: 600;
            user-select: none;
        }

        .faq-question:hover {
            color: #667eea;
        }

        .faq-icon {
            transition: transform 0.3s;
            font-size: 12px;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            color: #999;
            line-height: 1.6;
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
            padding-bottom: 20px;
        }

        .help-resource {
            display: flex;
            gap: 16px;
            padding: 20px 0;
            border-bottom: 1px solid #2a2a2a;
        }

        .help-resource:last-child {
            border-bottom: none;
        }

        .help-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .keyboard-shortcut {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px;
            background: #1a1a1a;
            border-radius: 8px;
            font-size: 14px;
        }

        kbd {
            background: #2a2a2a;
            padding: 4px 8px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 12px;
            border: 1px solid #3a3a3a;
        }

        /* Card components used in new pages */
        .card {
            background: #111111;
            border: 1px solid #222222;
            border-radius: 12px;
            margin-bottom: 30px;
            overflow: hidden; /* Ensures border-radius clips content */
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #222222;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
        }

        .card-body {
            padding: 24px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            background: #1a1a1a;
            border: 1px solid #222222;
            border-radius: 8px;
            padding: 10px 15px;
            color: #ffffff;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #444444;
            background: #222222;
        }
        
        .btn-icon {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
            transition: all 0.2s ease;
        }

        .btn-icon:hover {
            transform: scale(1.1);
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-primary { background: rgba(102, 126, 234, 0.1); color: #667eea; }
        .badge-success { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
        .badge-warning { background: rgba(249, 115, 22, 0.1); color: #f97316; }
        .badge-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        .badge-info { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
        .badge-secondary { background: rgba(107, 114, 128, 0.1); color: #6b7280; }

        .data-table thead th {
            font-size: 12px;
            color: #666666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table tbody td {
            font-size: 14px;
            color: #cccccc;
        }

        .data-table tbody tr:hover {
            background: #1a1a1a;
        }

        /* Custom Stat Card for Analytics */
        .stat-card .stat-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align text to the left */
        }

        .stat-card .stat-label {
            color: #666666;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .stat-card .stat-value {
            font-size: 24px; /* Slightly smaller value for these cards */
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-card .stat-change {
            font-size: 13px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
        }

        .stat-card .stat-change.positive {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .stat-card .stat-change.negative {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        /* Styling for the search/filter elements in orders and customers pages */
        .card .filters {
            display: flex;
            gap: 12px;
        }

        .card .filters select, .card .filters input {
            flex: 1;
            min-width: 200px;
            margin-bottom: 0; /* Override default form-group margin */
        }
        
        .card .filters input {
            background: #1a1a1a url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236c757d' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.398 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E") no-repeat 12px center;
            padding-left: 40px;
            background-size: 18px;
        }
        
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">Dashboard Pro</div>
        </div>
        <nav class="sidebar-menu">
            <div class="menu-section">
                <div class="menu-section-title">Principal</div>
                <div class="menu-item active" data-page="overview">
                    <span class="menu-icon">📊</span>
                    <span>Visão Geral</span>
                </div>
                <div class="menu-item" data-page="analytics">
                    <span class="menu-icon">📈</span>
                    <span>Analytics</span>
                </div>
                <div class="menu-item" data-page="reports">
                    <span class="menu-icon">📋</span>
                    <span>Relatórios</span>
                </div>
            </div>
            <div class="menu-section">
                <div class="menu-section-title">Gestão</div>
                <div class="menu-item" data-page="users">
                    <span class="menu-icon">👥</span>
                    <span>Usuários</span>
                </div>
                <div class="menu-item" data-page="products">
                    <span class="menu-icon">📦</span>
                    <span>Produtos</span>
                </div>
                <div class="menu-item" data-page="orders">
                    <span class="menu-icon">🛒</span>
                    <span>Pedidos</span>
                </div>
                <div class="menu-item" data-page="customers">
                    <span class="menu-icon">💼</span>
                    <span>Clientes</span>
                </div>
            </div>
            <div class="menu-section">
                <div class="menu-section-title">Sistema</div>
                <!-- Adicionando novo item de menu para Editor de Dados -->
                <div class="menu-item" data-page="data-editor">
                    <span class="menu-icon">✏️</span>
                    <span>Editor de Dados</span>
                </div>
                <div class="menu-item" data-page="settings">
                    <span class="menu-icon">⚙️</span>
                    <span>Configurações</span>
                </div>
                <div class="menu-item" data-page="notifications">
                    <span class="menu-icon">🔔</span>
                    <span>Notificações</span>
                </div>
                <div class="menu-item" data-page="help">
                    <span class="menu-icon">❓</span>
                    <span>Ajuda</span>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <button class="menu-toggle" id="menuToggle">☰</button>
                <div class="search-bar">
                    <input type="text" placeholder="Buscar...">
                    <span class="search-icon">🔍</span>
                </div>
            </div>
            <div class="header-right">
                <div class="header-icon">
                    <span>🔔</span>
                    <span class="notification-badge">5</span>
                </div>
                <div class="header-icon">
                    <span>✉️</span>
                    <span class="notification-badge">12</span>
                </div>
                <div class="user-profile">
                    <div class="user-avatar">AD</div>
                    <div class="user-info">
                        <div class="user-name">Admin User</div>
                        <div class="user-role">Administrador</div>
                    </div>
                </div>
            </div>
        </header>


        <div class="content">
           <!-- Overview Page -->
            <div class="page-content active" id="page-overview">
                <div class="page-header">
                    <h1 class="page-title">Visão Geral</h1>
                    <p class="page-subtitle">Bem-vindo ao seu dashboard. Aqui está um resumo das suas métricas principais.</p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon blue">💰</div>
                            <div class="stat-trend up">↑ 12.5%</div>
                        </div>
                        <div class="stat-value">R$ 45.231</div>
                        <div class="stat-label">Receita Total</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon green">👥</div>
                            <div class="stat-trend up">↑ 8.2%</div>
                        </div>
                        <div class="stat-value">2.847</div>
                        <div class="stat-label">Usuários Ativos</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon purple">🛒</div>
                            <div class="stat-trend down">↓ 3.1%</div>
                        </div>
                        <div class="stat-value">1.234</div>
                        <div class="stat-label">Pedidos</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon orange">📈</div>
                            <div class="stat-trend up">↑ 15.3%</div>
                        </div>
                        <div class="stat-value">68.5%</div>
                        <div class="stat-label">Taxa de Conversão</div>
                    </div>
                </div>

               <!--  Charts -->
                <div class="charts-grid">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Receita Mensal</h3>
                            <div class="chart-filter">
                                <button class="filter-btn active">7D</button>
                                <button class="filter-btn">30D</button>
                                <button class="filter-btn">90D</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Usuários por Categoria</h3>
                            <div class="chart-filter">
                                <button class="filter-btn active">Hoje</button>
                                <button class="filter-btn">Semana</button>
                                <button class="filter-btn">Mês</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="activity-card">
                    <h3 class="chart-title" style="margin-bottom: 20px;">Atividades Recentes</h3>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">✓</div>
                        <div class="activity-content">
                            <div class="activity-title">Novo pedido recebido</div>
                            <div class="activity-description">Pedido #1234 de João Silva - R$ 459,90</div>
                            <div class="activity-time">Há 5 minutos</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">👤</div>
                        <div class="activity-content">
                            <div class="activity-title">Novo usuário cadastrado</div>
                            <div class="activity-description">Maria Santos criou uma conta</div>
                            <div class="activity-time">Há 15 minutos</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: rgba(249, 115, 22, 0.1); color: #f97316;">⚠️</div>
                        <div class="activity-content">
                            <div class="activity-title">Estoque baixo</div>
                            <div class="activity-description">Produto "Notebook Dell" com apenas 3 unidades</div>
                            <div class="activity-time">Há 1 hora</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: rgba(168, 85, 247, 0.1); color: #a855f7;">💳</div>
                        <div class="activity-content">
                            <div class="activity-title">Pagamento confirmado</div>
                            <div class="activity-description">Pedido #1230 - R$ 1.299,00</div>
                            <div class="activity-time">Há 2 horas</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">📦</div>
                        <div class="activity-content">
                            <div class="activity-title">Produto enviado</div>
                            <div class="activity-description">Pedido #1228 enviado via Correios</div>
                            <div class="activity-time">Há 3 horas</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Page -->
            <div class="page-content" id="page-analytics">
                <div class="page-header">
                    <h1 class="page-title">Analytics</h1>
                    <p class="page-subtitle">Análise detalhada de métricas e performance.</p>
                </div>
                
                <!-- Adicionando conteúdo completo para Analytics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📊</div>
                        <div class="stat-info">
                            <div class="stat-label">Taxa de Conversão</div>
                            <div class="stat-value">3.24%</div>
                            <div class="stat-change positive">+0.8%</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⏱️</div>
                        <div class="stat-info">
                            <div class="stat-label">Tempo Médio</div>
                            <div class="stat-value">4m 32s</div>
                            <div class="stat-change negative">-12s</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🔄</div>
                        <div class="stat-info">
                            <div class="stat-label">Taxa de Retorno</div>
                            <div class="stat-value">68%</div>
                            <div class="stat-change positive">+5%</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">💰</div>
                        <div class="stat-info">
                            <div class="stat-label">Ticket Médio</div>
                            <div class="stat-value">R$ 287</div>
                            <div class="stat-change positive">+R$ 23</div>
                        </div>
                    </div>
                </div>

                <div class="grid-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Visitantes por Hora</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="hourlyChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Dispositivos</h3>
                        </div>
                        <div class="card-body">
                            <div style="margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span>Desktop</span>
                                    <span style="font-weight: 600;">54%</span>
                                </div>
                                <div style="background: #2a2a2a; height: 8px; border-radius: 4px; overflow: hidden;">
                                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 100%; width: 54%;"></div>
                                </div>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span>Mobile</span>
                                    <span style="font-weight: 600;">38%</span>
                                </div>
                                <div style="background: #2a2a2a; height: 8px; border-radius: 4px; overflow: hidden;">
                                    <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); height: 100%; width: 38%;"></div>
                                </div>
                            </div>
                            <div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span>Tablet</span>
                                    <span style="font-weight: 600;">8%</span>
                                </div>
                                <div style="background: #2a2a2a; height: 8px; border-radius: 4px; overflow: hidden;">
                                    <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); height: 100%; width: 8%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Páginas Mais Visitadas</h3>
                    </div>
                    <div class="card-body">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Página</th>
                                    <th>Visualizações</th>
                                    <th>Tempo Médio</th>
                                    <th>Taxa de Saída</th>
                                </tr>
                            </thead>
                            <tbody id="reportsTableBody">
                                <tr>
                                    <td>/home</td>
                                    <td>12,453</td>
                                    <td>3m 24s</td>
                                    <td>32%</td>
                                </tr>
                                <tr>
                                    <td>/produtos</td>
                                    <td>8,721</td>
                                    <td>5m 12s</td>
                                    <td>45%</td>
                                </tr>
                                <tr>
                                    <td>/sobre</td>
                                    <td>5,234</td>
                                    <td>2m 48s</td>
                                    <td>58%</td>
                                </tr>
                                <tr>
                                    <td>/contato</td>
                                    <td>3,892</td>
                                    <td>1m 56s</td>
                                    <td>72%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Reports Page --> 
            <div class="page-content" id="page-reports">
                <div class="page-header">
                    <h1 class="page-title">Relatórios</h1>
                    <p class="page-subtitle">Gere e visualize relatórios personalizados.</p>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h3>Gerar Novo Relatório</h3>
                    </div>
                    <div class="card-body">
                        <div class="grid-3">
                            <div class="form-group">
                                <label>Tipo de Relatório</label>
                                <select id="reportType" class="form-control">
                                    <option value="sales">Vendas</option>
                                    <option value="users">Usuários</option>
                                    <option value="products">Produtos</option>
                                    <option value="financial">Financeiro</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Período</label>
                                <select id="reportPeriod" class="form-control">
                                    <option value="today">Hoje</option>
                                    <option value="week">Última Semana</option>
                                    <option value="month">Último Mês</option>
                                    <option value="year">Último Ano</option>
                                    <option value="custom">Personalizado</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Formato</label>
                                <select id="reportFormat" class="form-control">
                                    <option value="pdf">PDF</option>
                                    <option value="excel">Excel</option>
                                    <option value="csv">CSV</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary" onclick="generateReport()" style="margin-top: 20px;">Gerar Relatório</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Relatórios Recentes</h3>
                    </div>
                    <div class="card-body">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Formato</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="reportsTableBody">
                                <tr>
                                    <td>Relatório de Vendas - Janeiro</td>
                                    <td><span class="badge badge-primary">Vendas</span></td>
                                    <td>15/01/2024</td>
                                    <td>PDF</td>
                                    <td>
                                        <button class="btn-icon" title="Download">📥</button>
                                        <button class="btn-icon" title="Visualizar">👁️</button>
                                        <button class="btn-icon" title="Excluir">🗑️</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Relatório de Usuários - Dezembro</td>
                                    <td><span class="badge badge-success">Usuários</span></td>
                                    <td>28/12/2023</td>
                                    <td>Excel</td>
                                    <td>
                                        <button class="btn-icon" title="Download">📥</button>
                                        <button class="btn-icon" title="Visualizar">👁️</button>
                                        <button class="btn-icon" title="Excluir">🗑️</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Relatório Financeiro - Q4 2023</td>
                                    <td><span class="badge badge-warning">Financeiro</span></td>
                                    <td>20/12/2023</td>
                                    <td>PDF</td>
                                    <td>
                                        <button class="btn-icon" title="Download">📥</button>
                                        <button class="btn-icon" title="Visualizar">👁️</button>
                                        <button class="btn-icon" title="Excluir">🗑️</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Users Page -->
            <div class="page-content" id="page-users">
                <div class="page-header">
                    <h1 class="page-title">Gerenciamento de Usuários</h1>
                    <p class="page-subtitle">Visualize e gerencie todos os usuários do sistema.</p>
                </div>

                <div class="table-card">
                    <div class="table-header">
                        <h3 class="table-title">Lista de Usuários</h3>
                        <div class="table-actions">
                            <button class="btn btn-secondary">Exportar</button>
                            <button class="btn btn-primary">+ Novo Usuário</button>
                        </div>
                    </div>
                    <div class="table-filters">
                        <input type="text" class="filter-input" placeholder="Buscar por nome ou email..." id="userSearch">
                        <select class="filter-select" id="userStatusFilter">
                            <option value="">Todos os Status</option>
                            <option value="active">Ativo</option>
                            <option value="pending">Pendente</option>
                            <option value="inactive">Inativo</option>
                        </select>
                        <select class="filter-select" id="userRoleFilter">
                            <option value="">Todas as Funções</option>
                            <option value="admin">Admin</option>
                            <option value="user">Usuário</option>
                            <option value="manager">Gerente</option>
                        </select>
                    </div>
                    <table id="usersTable">
                        <thead>
                            <tr>
                                <th data-sort="name">Nome ↕</th>
                                <th data-sort="email">Email ↕</th>
                                <th data-sort="role">Função ↕</th>
                                <th data-sort="status">Status ↕</th>
                                <th data-sort="date">Data de Cadastro ↕</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                        </tbody>
                    </table>
                    <div class="table-pagination">
                        <div class="pagination-info">Mostrando <span id="usersPaginationInfo">1-10 de 50</span></div>
                        <div class="pagination-buttons" id="usersPagination">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Page -->
            <div class="page-content" id="page-products">
                <div class="page-header">
                    <h1 class="page-title">Gerenciamento de Produtos</h1>
                    <p class="page-subtitle">Controle seu inventário e catálogo de produtos.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon blue">📦</div>
                            <div class="stat-trend up">↑ 5.2%</div>
                        </div>
                        <div class="stat-value">1.247</div>
                        <div class="stat-label">Total de Produtos</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon green">✓</div>
                            <div class="stat-trend up">↑ 12%</div>
                        </div>
                        <div class="stat-value">1.089</div>
                        <div class="stat-label">Em Estoque</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon orange">⚠️</div>
                            <div class="stat-trend down">↓ 8%</div>
                        </div>
                        <div class="stat-value">47</div>
                        <div class="stat-label">Estoque Baixo</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon purple">🔴</div>
                            <div class="stat-trend up">↑ 3</div>
                        </div>
                        <div class="stat-value">111</div>
                        <div class="stat-label">Sem Estoque</div>
                    </div>
                </div>

                <div class="table-card">
                    <div class="table-header">
                        <h3 class="table-title">Catálogo de Produtos</h3>
                        <div class="table-actions">
                            <button class="btn btn-secondary">Importar</button>
                            <button class="btn btn-primary">+ Novo Produto</button>
                        </div>
                    </div>
                    <div class="table-filters">
                        <input type="text" class="filter-input" placeholder="Buscar produtos..." id="productSearch">
                        <select class="filter-select" id="productCategoryFilter">
                            <option value="">Todas as Categorias</option>
                            <option value="electronics">Eletrônicos</option>
                            <option value="clothing">Roupas</option>
                            <option value="books">Livros</option>
                            <option value="home">Casa</option>
                        </select>
                        <select class="filter-select" id="productStockFilter">
                            <option value="">Todos os Estoques</option>
                            <option value="in-stock">Em Estoque</option>
                            <option value="low-stock">Estoque Baixo</option>
                            <option value="out-of-stock">Sem Estoque</option>
                        </select>
                    </div>
                    <table id="productsTable">
                        <thead>
                            <tr>
                                <th data-sort="name">Produto ↕</th>
                                <th data-sort="category">Categoria ↕</th>
                                <th data-sort="price">Preço ↕</th>
                                <th data-sort="stock">Estoque ↕</th>
                                <th data-sort="sales">Vendas ↕</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody">
                        </tbody>
                    </table>
                    <div class="table-pagination">
                        <div class="pagination-info">Mostrando <span id="productsPaginationInfo">1-10 de 100</span></div>
                        <div class="pagination-buttons" id="productsPagination">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Page -->
            <div class="page-content" id="page-orders">
                <div class="page-header">
                    <h1 class="page-title">Pedidos</h1>
                    <p class="page-subtitle">Gerencie todos os pedidos do sistema.</p>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">📦</div>
                        <div class="stat-info">
                            <div class="stat-label">Total de Pedidos</div>
                            <div class="stat-value">1,247</div>
                            <div class="stat-change positive">+18%</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⏳</div>
                        <div class="stat-info">
                            <div class="stat-label">Pendentes</div>
                            <div class="stat-value">89</div>
                            <div class="stat-change">-</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">✅</div>
                        <div class="stat-info">
                            <div class="stat-label">Concluídos</div>
                            <div class="stat-value">1,098</div>
                            <div class="stat-change positive">+12%</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">❌</div>
                        <div class="stat-info">
                            <div class="stat-label">Cancelados</div>
                            <div class="stat-value">60</div>
                            <div class="stat-change negative">+3</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Lista de Pedidos</h3>
                        <div class="filters">
                            <select id="orderStatusFilter" class="form-control" onchange="filterOrders()">
                                <option value="">Todos os Status</option>
                                <option value="pending">Pendente</option>
                                <option value="processing">Processando</option>
                                <option value="shipped">Enviado</option>
                                <option value="delivered">Entregue</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                            <input type="text" id="orderSearch" class="form-control" placeholder="Buscar pedido..." onkeyup="searchOrders()">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="ordersTableBody">
                                <tr>
                                    <td>#ORD-1001</td>
                                    <td>João Silva</td>
                                    <td>20/01/2024</td>
                                    <td>R$ 459,90</td>
                                    <td><span class="badge badge-success">Entregue</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Detalhes">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-1002</td>
                                    <td>Maria Santos</td>
                                    <td>19/01/2024</td>
                                    <td>R$ 289,50</td>
                                    <td><span class="badge badge-info">Enviado</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Detalhes">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-1003</td>
                                    <td>Pedro Costa</td>
                                    <td>18/01/2024</td>
                                    <td>R$ 1.234,00</td>
                                    <td><span class="badge badge-warning">Processando</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Detalhes">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-1004</td>
                                    <td>Ana Oliveira</td>
                                    <td>17/01/2024</td>
                                    <td>R$ 567,80</td>
                                    <td><span class="badge badge-secondary">Pendente</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Detalhes">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#ORD-1005</td>
                                    <td>Carlos Mendes</td>
                                    <td>16/01/2024</td>
                                    <td>R$ 89,90</td>
                                    <td><span class="badge badge-danger">Cancelado</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Detalhes">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="page-content" id="page-customers">
                <div class="page-header">
                    <h1 class="page-title">Clientes</h1>
                    <p class="page-subtitle">Base de dados de clientes.</p>
                </div>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-info">
                            <div class="stat-label">Total de Clientes</div>
                            <div class="stat-value">3,842</div>
                            <div class="stat-change positive">+234</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⭐</div>
                        <div class="stat-info">
                            <div class="stat-label">Clientes VIP</div>
                            <div class="stat-value">127</div>
                            <div class="stat-change positive">+12</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🆕</div>
                        <div class="stat-info">
                            <div class="stat-label">Novos (30 dias)</div>
                            <div class="stat-value">456</div>
                            <div class="stat-change positive">+89</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">💎</div>
                        <div class="stat-info">
                            <div class="stat-label">Lifetime Value</div>
                            <div class="stat-value">R$ 1.2M</div>
                            <div class="stat-change positive">+15%</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Lista de Clientes</h3>
                        <div class="filters">
                            <select id="customerTypeFilter" class="form-control" onchange="filterCustomers()">
                                <option value="">Todos os Tipos</option>
                                <option value="vip">VIP</option>
                                <option value="regular">Regular</option>
                                <option value="new">Novo</option>
                            </select>
                            <input type="text" id="customerSearch" class="form-control" placeholder="Buscar cliente..." onkeyup="searchCustomers()">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Total Gasto</th>
                                    <th>Tipo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="customersTableBody">
                                <tr>
                                    <td>João Silva</td>
                                    <td>joao.silva@email.com</td>
                                    <td>(11) 98765-4321</td>
                                    <td>R$ 12.450,00</td>
                                    <td><span class="badge badge-warning">VIP</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maria Santos</td>
                                    <td>maria.santos@email.com</td>
                                    <td>(21) 97654-3210</td>
                                    <td>R$ 3.280,00</td>
                                    <td><span class="badge badge-primary">Regular</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pedro Costa</td>
                                    <td>pedro.costa@email.com</td>
                                    <td>(31) 96543-2109</td>
                                    <td>R$ 890,00</td>
                                    <td><span class="badge badge-success">Novo</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ana Oliveira</td>
                                    <td>ana.oliveira@email.com</td>
                                    <td>(41) 95432-1098</td>
                                    <td>R$ 18.920,00</td>
                                    <td><span class="badge badge-warning">VIP</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Carlos Mendes</td>
                                    <td>carlos.mendes@email.com</td>
                                    <td>(51) 94321-0987</td>
                                    <td>R$ 5.670,00</td>
                                    <td><span class="badge badge-primary">Regular</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="page-content" id="page-settings">
                <div class="page-header">
                    <h1 class="page-title">Configurações</h1>
                    <p class="page-subtitle">Gerencie as preferências e configurações do sistema.</p>
                </div>

                <div class="settings-section">
                    <h3 class="settings-section-title">Preferências Gerais</h3>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Notificações por Email</div>
                            <div class="settings-description">Receba atualizações importantes por email</div>
                        </div>
                        <div class="toggle-switch active" data-setting="emailNotifications"></div>
                    </div>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Notificações Push</div>
                            <div class="settings-description">Receba notificações em tempo real</div>
                        </div>
                        <div class="toggle-switch active" data-setting="pushNotifications"></div>
                    </div>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Modo Escuro</div>
                            <div class="settings-description">Interface com tema escuro (sempre ativo)</div>
                        </div>
                        <div class="toggle-switch active" data-setting="darkMode"></div>
                    </div>
                </div>

                <div class="settings-section">
                    <h3 class="settings-section-title">Segurança</h3>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Autenticação de Dois Fatores</div>
                            <div class="settings-description">Adicione uma camada extra de segurança</div>
                        </div>
                        <div class="toggle-switch" data-setting="twoFactor"></div>
                    </div>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Sessões Ativas</div>
                            <div class="settings-description">Gerencie dispositivos conectados</div>
                        </div>
                        <button class="btn btn-secondary">Ver Sessões</button>
                    </div>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Alterar Senha</div>
                            <div class="settings-description">Atualize sua senha regularmente</div>
                        </div>
                        <button class="btn btn-secondary">Alterar</button>
                    </div>
                </div>

                <div class="settings-section">
                    <h3 class="settings-section-title">Sistema</h3>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Backup Automático</div>
                            <div class="settings-description">Backup diário dos dados</div>
                        </div>
                        <div class="toggle-switch active" data-setting="autoBackup"></div>
                    </div>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Logs de Auditoria</div>
                            <div class="settings-description">Registrar todas as ações do sistema</div>
                        </div>
                        <div class="toggle-switch active" data-setting="auditLogs"></div>
                    </div>
                    <div class="settings-item">
                        <div>
                            <div class="settings-label">Manutenção</div>
                            <div class="settings-description">Última manutenção: 15/01/2025</div>
                        </div>
                        <button class="btn btn-secondary">Executar</button>
                    </div>
                </div>
            </div>

            <div class="page-content" id="page-data-editor">
                <div class="page-header">
                    <h1 class="page-title">Editor de Dados</h1>
                    <p class="page-subtitle">Edite todas as informações do dashboard sem mexer no código.</p>
                </div>

                <!-- Estatísticas KPIs -->
                <div class="settings-section">
                    <h3 class="settings-section-title">📊 Estatísticas da Página Inicial (KPIs)</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
                        <div style="background: #1a1a1a; padding: 20px; border-radius: 8px; border: 1px solid #222222;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Receita Total</label>
                            <input type="text" id="kpi-revenue" class="filter-input" placeholder="Ex: R$ 45.231" style="margin-bottom: 8px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tendência (%)</label>
                            <input type="text" id="kpi-revenue-trend" class="filter-input" placeholder="Ex: 12.5">
                        </div>
                        <div style="background: #1a1a1a; padding: 20px; border-radius: 8px; border: 1px solid #222222;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Usuários Ativos</label>
                            <input type="text" id="kpi-users" class="filter-input" placeholder="Ex: 2.847" style="margin-bottom: 8px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tendência (%)</label>
                            <input type="text" id="kpi-users-trend" class="filter-input" placeholder="Ex: 8.2">
                        </div>
                        <div style="background: #1a1a1a; padding: 20px; border-radius: 8px; border: 1px solid #222222;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Pedidos</label>
                            <input type="text" id="kpi-orders" class="filter-input" placeholder="Ex: 1.234" style="margin-bottom: 8px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tendência (%)</label>
                            <input type="text" id="kpi-orders-trend" class="filter-input" placeholder="Ex: -3.1">
                        </div>
                        <div style="background: #1a1a1a; padding: 20px; border-radius: 8px; border: 1px solid #222222;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Taxa de Conversão</label>
                            <input type="text" id="kpi-conversion" class="filter-input" placeholder="Ex: 68.5%" style="margin-bottom: 8px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Tendência (%)</label>
                            <input type="text" id="kpi-conversion-trend" class="filter-input" placeholder="Ex: 15.3">
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="saveKPIs()" style="margin-top: 20px;">💾 Salvar Estatísticas</button>
                </div>

                <div class="settings-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 class="settings-section-title" style="margin: 0;">👥 Gerenciar Usuários</h3>
                        <button class="btn btn-primary" onclick="showAddUserForm()">+ Adicionar Usuário</button>
                    </div>
                    
                    <div id="userForm" style="display: none; background: #1a1a1a; padding: 20px; border-radius: 8px; border: 1px solid #222222; margin-bottom: 20px;">
                        <h4 style="margin-bottom: 16px;" id="userFormTitle">Adicionar Novo Usuário</h4>
                        <input type="hidden" id="editUserId">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nome</label>
                                <input type="text" id="userName" class="filter-input" placeholder="Nome completo">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email</label>
                                <input type="email" id="userEmail" class="filter-input" placeholder="email@exemplo.com">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Função</label>
                                <select id="userRole" class="filter-select">
                                    <option value="user">Usuário</option>
                                    <option value="manager">Gerente</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Status</label>
                                <select id="userStatus" class="filter-select">
                                    <option value="active">Ativo</option>
                                    <option value="pending">Pendente</option>
                                    <option value="inactive">Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px; margin-top: 16px;">
                            <button class="btn btn-primary" onclick="saveUser()">💾 Salvar</button>
                            <button class="btn btn-secondary" onclick="cancelUserForm()">❌ Cancelar</button>
                        </div>
                    </div>

                    <div style="background: #1a1a1a; border-radius: 8px; border: 1px solid #222222; overflow: hidden;">
                        <table style="width: 100%;">
                            <thead style="background: #0a0a0a;">
                                <tr>
                                    <th style="padding: 12px; text-align: left;">Nome</th>
                                    <th style="padding: 12px; text-align: left;">Email</th>
                                    <th style="padding: 12px; text-align: left;">Função</th>
                                    <th style="padding: 12px; text-align: left;">Status</th>
                                    <th style="padding: 12px; text-align: left;">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="editorUsersList">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="settings-section">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h3 class="settings-section-title" style="margin: 0;">📦 Gerenciar Produtos</h3>
                        <button class="btn btn-primary" onclick="showAddProductForm()">+ Adicionar Produto</button>
                    </div>
                    
                    <div id="productForm" style="display: none; background: #1a1a1a; padding: 20px; border-radius: 8px; border: 1px solid #222222; margin-bottom: 20px;">
                        <h4 style="margin-bottom: 16px;" id="productFormTitle">Adicionar Novo Produto</h4>
                        <input type="hidden" id="editProductId">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px;">
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nome do Produto</label>
                                <input type="text" id="productName" class="filter-input" placeholder="Nome do produto">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Categoria</label>
                                <select id="productCategory" class="filter-select">
                                    <option value="electronics">Eletrônicos</option>
                                    <option value="clothing">Roupas</option>
                                    <option value="books">Livros</option>
                                    <option value="home">Casa</option>
                                </select>
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Preço (R$)</label>
                                <input type="number" id="productPrice" class="filter-input" placeholder="0.00" step="0.01">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Estoque</label>
                                <input type="number" id="productStock" class="filter-input" placeholder="0">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Vendas</label>
                                <input type="number" id="productSales" class="filter-input" placeholder="0">
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px; margin-top: 16px;">
                            <button class="btn btn-primary" onclick="saveProduct()">💾 Salvar</button>
                            <button class="btn btn-secondary" onclick="cancelProductForm()">❌ Cancelar</button>
                        </div>
                    </div>

                    <div style="background: #1a1a1a; border-radius: 8px; border: 1px solid #222222; overflow: hidden;">
                        <table style="width: 100%;">
                            <thead style="background: #0a0a0a;">
                                <tr>
                                    <th style="padding: 12px; text-align: left;">Produto</th>
                                    <th style="padding: 12px; text-align: left;">Categoria</th>
                                    <th style="padding: 12px; text-align: left;">Preço</th>
                                    <th style="padding: 12px; text-align: left;">Estoque</th>
                                    <th style="padding: 12px; text-align: left;">Vendas</th>
                                    <th style="padding: 12px; text-align: left;">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="editorProductsList">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="settings-section">
                    <h3 class="settings-section-title">👤 Informações do Perfil</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;">
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nome do Usuário</label>
                            <input type="text" id="profileName" class="filter-input" placeholder="Admin User">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Cargo/Função</label>
                            <input type="text" id="profileRole" class="filter-input" placeholder="Administrador">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Iniciais (Avatar)</label>
                            <input type="text" id="profileInitials" class="filter-input" placeholder="AD" maxlength="2">
                        </div>
                    </div>
                    <button class="btn btn-primary" onclick="saveProfile()" style="margin-top: 20px;">💾 Salvar Perfil</button>
                </div>

                <div class="settings-section" style="border: 1px solid #ef4444;">
                    <h3 class="settings-section-title" style="color: #ef4444;">⚠️ Zona de Perigo</h3>
                    <p style="color: #666666; margin-bottom: 16px;">Restaurar todos os dados para os valores padrão. Esta ação não pode ser desfeita.</p>
                    <button class="btn btn-secondary" onclick="resetAllData()" style="background: #ef4444; border-color: #ef4444;">🔄 Restaurar Dados Padrão</button>
                </div>
            </div>

            <div class="page-content" id="page-customers">
                <div class="page-header">
                    <h1 class="page-title">Clientes</h1>
                    <p class="page-subtitle">Base de dados de clientes.</p>
                </div>
                
                 Adicionando conteúdo completo para Clientes 
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">👥</div>
                        <div class="stat-info">
                            <div class="stat-label">Total de Clientes</div>
                            <div class="stat-value">3,842</div>
                            <div class="stat-change positive">+234</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">⭐</div>
                        <div class="stat-info">
                            <div class="stat-label">Clientes VIP</div>
                            <div class="stat-value">127</div>
                            <div class="stat-change positive">+12</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">🆕</div>
                        <div class="stat-info">
                            <div class="stat-label">Novos (30 dias)</div>
                            <div class="stat-value">456</div>
                            <div class="stat-change positive">+89</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">💎</div>
                        <div class="stat-info">
                            <div class="stat-label">Lifetime Value</div>
                            <div class="stat-value">R$ 1.2M</div>
                            <div class="stat-change positive">+15%</div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Lista de Clientes</h3>
                        <div class="filters">
                            <select id="customerTypeFilter" class="form-control" onchange="filterCustomers()">
                                <option value="">Todos os Tipos</option>
                                <option value="vip">VIP</option>
                                <option value="regular">Regular</option>
                                <option value="new">Novo</option>
                            </select>
                            <input type="text" id="customerSearch" class="form-control" placeholder="Buscar cliente..." onkeyup="searchCustomers()">
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Total Gasto</th>
                                    <th>Tipo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="customersTableBody">
                                <tr>
                                    <td>João Silva</td>
                                    <td>joao.silva@email.com</td>
                                    <td>(11) 98765-4321</td>
                                    <td>R$ 12.450,00</td>
                                    <td><span class="badge badge-warning">VIP</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Maria Santos</td>
                                    <td>maria.santos@email.com</td>
                                    <td>(21) 97654-3210</td>
                                    <td>R$ 3.280,00</td>
                                    <td><span class="badge badge-primary">Regular</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pedro Costa</td>
                                    <td>pedro.costa@email.com</td>
                                    <td>(31) 96543-2109</td>
                                    <td>R$ 890,00</td>
                                    <td><span class="badge badge-success">Novo</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ana Oliveira</td>
                                    <td>ana.oliveira@email.com</td>
                                    <td>(41) 95432-1098</td>
                                    <td>R$ 18.920,00</td>
                                    <td><span class="badge badge-warning">VIP</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Carlos Mendes</td>
                                    <td>carlos.mendes@email.com</td>
                                    <td>(51) 94321-0987</td>
                                    <td>R$ 5.670,00</td>
                                    <td><span class="badge badge-primary">Regular</span></td>
                                    <td>
                                        <button class="btn-icon" title="Ver Perfil">👁️</button>
                                        <button class="btn-icon" title="Editar">✏️</button>
                                        <button class="btn-icon" title="Histórico">📋</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="page-content" id="page-notifications">
                <div class="page-header">
                    <h1 class="page-title">Notificações</h1>
                    <p class="page-subtitle">Central de notificações do sistema.</p>
                </div>
                
                <div class="grid-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Notificações Recentes</h3>
                            <button class="btn btn-sm" onclick="markAllAsRead()">Marcar todas como lidas</button>
                        </div>
                        <div class="card-body" style="padding: 0;">
                            <div class="notification-item unread">
                                <div class="notification-icon" style="background: #667eea;">📦</div>
                                <div class="notification-content">
                                    <div class="notification-title">Novo pedido recebido</div>
                                    <div class="notification-text">Pedido #ORD-1006 foi criado por João Silva</div>
                                    <div class="notification-time">Há 5 minutos</div>
                                </div>
                            </div>
                            <div class="notification-item unread">
                                <div class="notification-icon" style="background: #f093fb;">👤</div>
                                <div class="notification-content">
                                    <div class="notification-title">Novo usuário cadastrado</div>
                                    <div class="notification-text">Maria Santos criou uma conta</div>
                                    <div class="notification-time">Há 15 minutos</div>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-icon" style="background: #4facfe;">💰</div>
                                <div class="notification-content">
                                    <div class="notification-title">Pagamento confirmado</div>
                                    <div class="notification-text">Pedido #ORD-1005 - R$ 459,90</div>
                                    <div class="notification-time">Há 1 hora</div>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-icon" style="background: #f5576c;">⚠️</div>
                                <div class="notification-content">
                                    <div class="notification-title">Estoque baixo</div>
                                    <div class="notification-text">Produto "Notebook Dell" com apenas 3 unidades</div>
                                    <div class="notification-time">Há 2 horas</div>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-icon" style="background: #43e97b;">✅</div>
                                <div class="notification-content">
                                    <div class="notification-title">Pedido entregue</div>
                                    <div class="notification-text">Pedido #ORD-1001 foi entregue com sucesso</div>
                                    <div class="notification-time">Há 3 horas</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>Configurações de Notificações</h3>
                        </div>
                        <div class="card-body">
                            <div class="notification-setting">
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Novos Pedidos</div>
                                    <div style="font-size: 14px; color: #999;">Receber notificação quando um novo pedido for criado</div>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="notification-setting">
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Novos Usuários</div>
                                    <div style="font-size: 14px; color: #999;">Receber notificação quando um novo usuário se cadastrar</div>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="notification-setting">
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Pagamentos</div>
                                    <div style="font-size: 14px; color: #999;">Receber notificação sobre confirmações de pagamento</div>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="notification-setting">
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Estoque Baixo</div>
                                    <div style="font-size: 14px; color: #999;">Alertas quando produtos estiverem com estoque baixo</div>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="notification-setting">
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Relatórios Semanais</div>
                                    <div style="font-size: 14px; color: #999;">Receber resumo semanal por email</div>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="notification-setting">
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Atualizações do Sistema</div>
                                    <div style="font-size: 14px; color: #999;">Notificações sobre atualizações e manutenções</div>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content" id="page-help">
                <div class="page-header">
                    <h1 class="page-title">Ajuda</h1>
                    <p class="page-subtitle">Documentação e suporte.</p>
                </div>
                
                <div class="grid-2">
                    <div class="card">
                        <div class="card-header">
                            <h3>Perguntas Frequentes</h3>
                        </div>
                        <div class="card-body">
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    <span>Como adicionar um novo produto?</span>
                                    <span class="faq-icon">▼</span>
                                </div>
                                <div class="faq-answer">
                                    Vá até a página "Produtos", clique no botão "Adicionar Produto" e preencha o formulário com as informações necessárias. Você também pode usar o "Editor de Dados" para adicionar produtos de forma mais rápida.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    <span>Como gerenciar pedidos?</span>
                                    <span class="faq-icon">▼</span>
                                </div>
                                <div class="faq-answer">
                                    Na página "Pedidos", você pode visualizar todos os pedidos, filtrar por status, buscar pedidos específicos e atualizar o status de cada pedido clicando no botão de editar.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    <span>Como gerar relatórios?</span>
                                    <span class="faq-icon">▼</span>
                                </div>
                                <div class="faq-answer">
                                    Acesse a página "Relatórios", selecione o tipo de relatório desejado, escolha o período e o formato de exportação. Clique em "Gerar Relatório" e o arquivo será criado automaticamente.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    <span>Como alterar dados sem mexer no código?</span>
                                    <span class="faq-icon">▼</span>
                                </div>
                                <div class="faq-answer">
                                    Use a página "Editor de Dados" no menu Sistema. Lá você pode editar estatísticas, adicionar/remover usuários e produtos, e alterar informações do perfil sem precisar editar o código HTML.
                                </div>
                            </div>
                            <div class="faq-item">
                                <div class="faq-question" onclick="toggleFaq(this)">
                                    <span>Como configurar notificações?</span>
                                    <span class="faq-icon">▼</span>
                                </div>
                                <div class="faq-answer">
                                    Vá até a página "Notificações" e use os toggles na seção "Configurações de Notificações" para ativar ou desativar cada tipo de notificação conforme sua preferência.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3>Recursos Rápidos</h3>
                        </div>
                        <div class="card-body">
                            <div class="help-resource">
                                <div class="help-icon">📚</div>
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Documentação Completa</div>
                                    <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Guia completo de todas as funcionalidades</div>
                                    <button class="btn btn-sm">Acessar</button>
                                </div>
                            </div>
                            <div class="help-resource">
                                <div class="help-icon">🎥</div>
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Tutoriais em Vídeo</div>
                                    <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Aprenda com vídeos passo a passo</div>
                                    <button class="btn btn-sm">Assistir</button>
                                </div>
                            </div>
                            <div class="help-resource">
                                <div class="help-icon">💬</div>
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Suporte ao Vivo</div>
                                    <div style="font-size: 14px; color: #999; margin-bottom: 8px;">Fale com nossa equipe de suporte</div>
                                    <button class="btn btn-sm">Iniciar Chat</button>
                                </div>
                            </div>
                            <div class="help-resource">
                                <div class="help-icon">📧</div>
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Email de Suporte</div>
                                    <div style="font-size: 14px; color: #999; margin-bottom: 8px;">suporte@dashboard.com</div>
                                    <button class="btn btn-sm">Enviar Email</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Atalhos do Teclado</h3>
                    </div>
                    <div class="card-body">
                        <div class="grid-2">
                            <div class="keyboard-shortcut">
                                <kbd>Ctrl</kbd> + <kbd>H</kbd>
                                <span>Ir para Home</span>
                            </div>
                            <div class="keyboard-shortcut">
                                <kbd>Ctrl</kbd> + <kbd>U</kbd>
                                <span>Ir para Usuários</span>
                            </div>
                            <div class="keyboard-shortcut">
                                <kbd>Ctrl</kbd> + <kbd>P</kbd>
                                <span>Ir para Produtos</span>
                            </div>
                            <div class="keyboard-shortcut">
                                <kbd>Ctrl</kbd> + <kbd>K</kbd>
                                <span>Busca Rápida</span>
                            </div>
                            <div class="keyboard-shortcut">
                                <kbd>Ctrl</kbd> + <kbd>S</kbd>
                                <span>Salvar Alterações</span>
                            </div>
                            <div class="keyboard-shortcut">
                                <kbd>Esc</kbd>
                                <span> Fechar Modal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        
        // Mock Data (will be loaded from localStorage if available)
        let usersData = [
            { id: 1, name: 'João Silva', email: 'joao@email.com', role: 'admin', status: 'active', date: '2024-01-15' },
            { id: 2, name: 'Maria Santos', email: 'maria@email.com', role: 'user', status: 'active', date: '2024-02-20' },
            { id: 3, name: 'Pedro Oliveira', email: 'pedro@email.com', role: 'manager', status: 'pending', date: '2024-03-10' },
            { id: 4, name: 'Ana Costa', email: 'ana@email.com', role: 'user', status: 'active', date: '2024-01-25' },
            { id: 5, name: 'Carlos Souza', email: 'carlos@email.com', role: 'user', status: 'inactive', date: '2024-02-15' },
            { id: 6, name: 'Juliana Lima', email: 'juliana@email.com', role: 'manager', status: 'active', date: '2024-03-05' },
            { id: 7, name: 'Roberto Alves', email: 'roberto@email.com', role: 'user', status: 'active', date: '2024-01-30' },
            { id: 8, name: 'Fernanda Rocha', email: 'fernanda@email.com', role: 'admin', status: 'active', date: '2024-02-10' },
            { id: 9, name: 'Lucas Martins', email: 'lucas@email.com', role: 'user', status: 'pending', date: '2024-03-15' },
            { id: 10, name: 'Patricia Dias', email: 'patricia@email.com', role: 'user', status: 'active', date: '2024-01-20' },
        ];

        let productsData = [
            { id: 1, name: 'Notebook Dell Inspiron', category: 'electronics', price: 3499.90, stock: 15, sales: 234 },
            { id: 2, name: 'Mouse Logitech MX Master', category: 'electronics', price: 349.90, stock: 45, sales: 567 },
            { id: 3, name: 'Teclado Mecânico RGB', category: 'electronics', price: 599.90, stock: 3, sales: 189 },
            { id: 4, name: 'Monitor LG 27"', category: 'electronics', price: 1299.90, stock: 8, sales: 145 },
            { id: 5, name: 'Webcam Logitech C920', category: 'electronics', price: 449.90, stock: 0, sales: 298 },
            { id: 6, name: 'Headset HyperX Cloud', category: 'electronics', price: 399.90, stock: 22, sales: 412 },
            { id: 7, name: 'SSD Samsung 1TB', category: 'electronics', price: 599.90, stock: 34, sales: 523 },
            { id: 8, name: 'Memória RAM 16GB', category: 'electronics', price: 299.90, stock: 2, sales: 678 },
            { id: 9, name: 'Placa de Vídeo RTX 3060', category: 'electronics', price: 2499.90, stock: 5, sales: 89 },
            { id: 10, name: 'Processador Intel i7', category: 'electronics', price: 1899.90, stock: 12, sales: 156 },
        ];

        // Load data from localStorage or use defaults
        function loadData() {
            const savedUsers = localStorage.getItem('dashboardUsers');
            const savedProducts = localStorage.getItem('dashboardProducts');
            const savedKPIs = localStorage.getItem('dashboardKPIs');
            const savedProfile = localStorage.getItem('dashboardProfile');
            
            if (savedUsers) {
                usersData.length = 0;
                usersData.push(...JSON.parse(savedUsers));
            }
            
            if (savedProducts) {
                productsData.length = 0;
                productsData.push(...JSON.parse(savedProducts));
            }
            
            if (savedKPIs) {
                const kpis = JSON.parse(savedKPIs);
                updateKPIsDisplay(kpis);
            } else {
                // Set default KPIs if none are saved
                updateKPIsDisplay({
                    revenue: 'R$ 45.231', revenueTrend: '12.5',
                    users: '2.847', usersTrend: '8.2',
                    orders: '1.234', ordersTrend: '-3.1',
                    conversion: '68.5%', conversionTrend: '15.3'
                });
            }
            
            if (savedProfile) {
                const profile = JSON.parse(savedProfile);
                updateProfileDisplay(profile);
            } else {
                // Set default profile if none is saved
                updateProfileDisplay({ name: 'Admin User', role: 'Administrador', initials: 'AD' });
            }
        }

        // Save data to localStorage
        function saveData() {
            localStorage.setItem('dashboardUsers', JSON.stringify(usersData));
            localStorage.setItem('dashboardProducts', JSON.stringify(productsData));
        }

        // KPIs Functions
        function saveKPIs() {
            const kpis = {
                revenue: document.getElementById('kpi-revenue').value || 'R$ 45.231',
                revenueTrend: document.getElementById('kpi-revenue-trend').value || '12.5',
                users: document.getElementById('kpi-users').value || '2.847',
                usersTrend: document.getElementById('kpi-users-trend').value || '8.2',
                orders: document.getElementById('kpi-orders').value || '1.234',
                ordersTrend: document.getElementById('kpi-orders-trend').value || '-3.1',
                conversion: document.getElementById('kpi-conversion').value || '68.5%',
                conversionTrend: document.getElementById('kpi-conversion-trend').value || '15.3'
            };
            
            localStorage.setItem('dashboardKPIs', JSON.stringify(kpis));
            updateKPIsDisplay(kpis);
            alert('✅ Estatísticas salvas com sucesso!');
        }

        function updateKPIsDisplay(kpis) {
            const overviewPage = document.getElementById('page-overview');
            const statCards = overviewPage.querySelectorAll('.stat-card');
            
            if (statCards.length >= 4) {
                statCards[0].querySelector('.stat-value').textContent = kpis.revenue;
                const trendRev = parseFloat(kpis.revenueTrend);
                const trendElRev = statCards[0].querySelector('.stat-trend');
                trendElRev.className = `stat-trend ${trendRev >= 0 ? 'up' : 'down'}`;
                trendElRev.textContent = `${trendRev >= 0 ? '↑' : '↓'} ${Math.abs(trendRev)}%`;
            
                statCards[1].querySelector('.stat-value').textContent = kpis.users;
                const trendUsers = parseFloat(kpis.usersTrend);
                const trendElUsers = statCards[1].querySelector('.stat-trend');
                trendElUsers.className = `stat-trend ${trendUsers >= 0 ? 'up' : 'down'}`;
                trendElUsers.textContent = `${trendUsers >= 0 ? '↑' : '↓'} ${Math.abs(trendUsers)}%`;
            
                statCards[2].querySelector('.stat-value').textContent = kpis.orders;
                const trendOrders = parseFloat(kpis.ordersTrend);
                const trendElOrders = statCards[2].querySelector('.stat-trend');
                trendElOrders.className = `stat-trend ${trendOrders >= 0 ? 'up' : 'down'}`;
                trendElOrders.textContent = `${trendOrders >= 0 ? '↑' : '↓'} ${Math.abs(trendOrders)}%`;
            
                statCards[3].querySelector('.stat-value').textContent = kpis.conversion;
                const trendConv = parseFloat(kpis.conversionTrend);
                const trendElConv = statCards[3].querySelector('.stat-trend');
                trendElConv.className = `stat-trend ${trendConv >= 0 ? 'up' : 'down'}`;
                trendElConv.textContent = `${trendConv >= 0 ? '↑' : '↓'} ${Math.abs(trendConv)}%`;
            }
            
            // Load values into editor form
            document.getElementById('kpi-revenue').value = kpis.revenue;
            document.getElementById('kpi-revenue-trend').value = kpis.revenueTrend;
            document.getElementById('kpi-users').value = kpis.users;
            document.getElementById('kpi-users-trend').value = kpis.usersTrend;
            document.getElementById('kpi-orders').value = kpis.orders;
            document.getElementById('kpi-orders-trend').value = kpis.ordersTrend;
            document.getElementById('kpi-conversion').value = kpis.conversion;
            document.getElementById('kpi-conversion-trend').value = kpis.conversionTrend;
        }

        // User Management Functions
        function showAddUserForm() {
            document.getElementById('userForm').style.display = 'block';
            document.getElementById('userFormTitle').textContent = 'Adicionar Novo Usuário';
            document.getElementById('editUserId').value = '';
            document.getElementById('userName').value = '';
            document.getElementById('userEmail').value = '';
            document.getElementById('userRole').value = 'user';
            document.getElementById('userStatus').value = 'active';
        }

        function cancelUserForm() {
            document.getElementById('userForm').style.display = 'none';
        }

        function saveUser() {
            const id = document.getElementById('editUserId').value;
            const name = document.getElementById('userName').value.trim();
            const email = document.getElementById('userEmail').value.trim();
            const role = document.getElementById('userRole').value;
            const status = document.getElementById('userStatus').value;
            
            if (!name || !email) {
                alert('❌ Por favor, preencha todos os campos obrigatórios!');
                return;
            }
            
            if (id) {
                // Edit existing user
                const index = usersData.findIndex(u => u.id === parseInt(id));
                if (index !== -1) {
                    usersData[index] = { ...usersData[index], name, email, role, status };
                }
            } else {
                // Add new user
                const newId = (usersData.length > 0 ? Math.max(...usersData.map(u => u.id)) : 0) + 1;
                usersData.push({
                    id: newId,
                    name,
                    email,
                    role,
                    status,
                    date: new Date().toISOString().split('T')[0]
                });
            }
            
            saveData();
            renderEditorUsersList();
            renderUsersTable();
            cancelUserForm();
            alert('✅ Usuário salvo com sucesso!');
        }

        function editUser(id) {
            const user = usersData.find(u => u.id === id);
            if (!user) return;
            
            document.getElementById('userForm').style.display = 'block';
            document.getElementById('userFormTitle').textContent = 'Editar Usuário';
            document.getElementById('editUserId').value = user.id;
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userRole').value = user.role;
            document.getElementById('userStatus').value = user.status;
        }

        function deleteUser(id) {
            if (!confirm('Tem certeza que deseja excluir este usuário?')) return;
            
            const index = usersData.findIndex(u => u.id === id);
            if (index !== -1) {
                usersData.splice(index, 1);
                saveData();
                renderEditorUsersList();
                renderUsersTable();
                alert('✅ Usuário excluído com sucesso!');
            }
        }

        function renderEditorUsersList() {
            const tbody = document.getElementById('editorUsersList');
            tbody.innerHTML = usersData.map(user => `
                <tr style="border-top: 1px solid #222222;">
                    <td style="padding: 12px;">${user.name}</td>
                    <td style="padding: 12px;">${user.email}</td>
                    <td style="padding: 12px;">${user.role === 'admin' ? 'Administrador' : user.role === 'manager' ? 'Gerente' : 'Usuário'}</td>
                    <td style="padding: 12px;"><span class="status-badge status-${user.status}">${user.status === 'active' ? 'Ativo' : user.status === 'pending' ? 'Pendente' : 'Inativo'}</span></td>
                    <td style="padding: 12px;">
                        <button class="btn btn-secondary" onclick="editUser(${user.id})" style="padding: 6px 12px; font-size: 12px; margin-right: 8px;">✏️ Editar</button>
                        <button class="btn btn-secondary" onclick="deleteUser(${user.id})" style="padding: 6px 12px; font-size: 12px; background: #ef4444; border-color: #ef4444;">🗑️ Excluir</button>
                    </td>
                </tr>
            `).join('');
        }

        // Product Management Functions
        function showAddProductForm() {
            document.getElementById('productForm').style.display = 'block';
            document.getElementById('productFormTitle').textContent = 'Adicionar Novo Produto';
            document.getElementById('editProductId').value = '';
            document.getElementById('productName').value = '';
            document.getElementById('productCategory').value = 'electronics';
            document.getElementById('productPrice').value = '';
            document.getElementById('productStock').value = '';
            document.getElementById('productSales').value = '';
        }

        function cancelProductForm() {
            document.getElementById('productForm').style.display = 'none';
        }

        function saveProduct() {
            const id = document.getElementById('editProductId').value;
            const name = document.getElementById('productName').value.trim();
            const category = document.getElementById('productCategory').value;
            const price = parseFloat(document.getElementById('productPrice').value);
            const stock = parseInt(document.getElementById('productStock').value);
            const sales = parseInt(document.getElementById('productSales').value);
            
            if (!name || isNaN(price) || isNaN(stock) || isNaN(sales)) {
                alert('❌ Por favor, preencha todos os campos corretamente!');
                return;
            }
            
            if (id) {
                // Edit existing product
                const index = productsData.findIndex(p => p.id === parseInt(id));
                if (index !== -1) {
                    productsData[index] = { ...productsData[index], name, category, price, stock, sales };
                }
            } else {
                // Add new product
                const newId = (productsData.length > 0 ? Math.max(...productsData.map(p => p.id)) : 0) + 1;
                productsData.push({ id: newId, name, category, price, stock, sales });
            }
            
            saveData();
            renderEditorProductsList();
            renderProductsTable();
            cancelProductForm();
            alert('✅ Produto salvo com sucesso!');
        }

        function editProduct(id) {
            const product = productsData.find(p => p.id === id);
            if (!product) return;
            
            document.getElementById('productForm').style.display = 'block';
            document.getElementById('productFormTitle').textContent = 'Editar Produto';
            document.getElementById('editProductId').value = product.id;
            document.getElementById('productName').value = product.name;
            document.getElementById('productCategory').value = product.category;
            document.getElementById('productPrice').value = product.price;
            document.getElementById('productStock').value = product.stock;
            document.getElementById('productSales').value = product.sales;
        }

        function deleteProduct(id) {
            if (!confirm('Tem certeza que deseja excluir este produto?')) return;
            
            const index = productsData.findIndex(p => p.id === id);
            if (index !== -1) {
                productsData.splice(index, 1);
                saveData();
                renderEditorProductsList();
                renderProductsTable();
                alert('✅ Produto excluído com sucesso!');
            }
        }

        function renderEditorProductsList() {
            const tbody = document.getElementById('editorProductsList');
            tbody.innerHTML = productsData.map(product => {
                let stockStatus = 'status-active';
                if (product.stock === 0) stockStatus = 'status-inactive';
                else if (product.stock < 5) stockStatus = 'status-pending';
                
                return `
                    <tr style="border-top: 1px solid #222222;">
                        <td style="padding: 12px;">${product.name}</td>
                        <td style="padding: 12px;">${product.category === 'electronics' ? 'Eletrônicos' : product.category === 'clothing' ? 'Roupas' : product.category === 'books' ? 'Livros' : 'Casa'}</td>
                        <td style="padding: 12px;">R$ ${product.price.toFixed(2)}</td>
                        <td style="padding: 12px;"><span class="status-badge ${stockStatus}">${product.stock} un.</span></td>
                        <td style="padding: 12px;">${product.sales}</td>
                        <td style="padding: 12px;">
                            <button class="btn btn-secondary" onclick="editProduct(${product.id})" style="padding: 6px 12px; font-size: 12px; margin-right: 8px;">✏️ Editar</button>
                            <button class="btn btn-secondary" onclick="deleteProduct(${product.id})" style="padding: 6px 12px; font-size: 12px; background: #ef4444; border-color: #ef4444;">🗑️ Excluir</button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        // Profile Functions
        function saveProfile() {
            const profile = {
                name: document.getElementById('profileName').value.trim() || 'Admin User',
                role: document.getElementById('profileRole').value.trim() || 'Administrador',
                initials: document.getElementById('profileInitials').value.trim().toUpperCase().slice(0, 2) || 'AD'
            };
            
            localStorage.setItem('dashboardProfile', JSON.stringify(profile));
            updateProfileDisplay(profile);
            alert('✅ Perfil salvo com sucesso!');
        }

        function updateProfileDisplay(profile) {
            document.querySelector('.user-name').textContent = profile.name;
            document.querySelector('.user-role').textContent = profile.role;
            document.querySelector('.user-avatar').textContent = profile.initials;
            
            document.getElementById('profileName').value = profile.name;
            document.getElementById('profileRole').value = profile.role;
            document.getElementById('profileInitials').value = profile.initials;
        }

        // Reset Function
        function resetAllData() {
            if (!confirm('⚠️ ATENÇÃO: Isso irá restaurar todos os dados para os valores padrão. Esta ação não pode ser desfeita. Deseja continuar?')) {
                return;
            }
            
            localStorage.removeItem('dashboardUsers');
            localStorage.removeItem('dashboardProducts');
            localStorage.removeItem('dashboardKPIs');
            localStorage.removeItem('dashboardProfile');
            
            location.reload();
        }

        // Navigation
        const menuItems = document.querySelectorAll('.menu-item');
        const pageContents = document.querySelectorAll('.page-content');

        function navigateToPage(page) {
            menuItems.forEach(mi => mi.classList.remove('active'));
            pageContents.forEach(pc => pc.classList.remove('active'));
            
            const targetMenuItem = document.querySelector(`.menu-item[data-page="${page}"]`);
            const targetPage = document.getElementById(`page-${page}`);
            
            if (targetMenuItem) targetMenuItem.classList.add('active');
            if (targetPage) targetPage.classList.add('active');

            // Custom logic for specific pages
            if (page === 'analytics') {
                setTimeout(drawHourlyChart, 100);
            }
        }

        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                const page = item.dataset.page;
                navigateToPage(page);
            });
        });

        navigateToPage('overview');

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-visible');
            sidebar.classList.toggle('mobile-hidden');
        });

        // Charts
        function drawLineChart(canvasId, data) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;
            
            const ctx = canvas.getContext('2d');
            const width = canvas.offsetWidth;
            const height = canvas.offsetHeight;
            
            if (width === 0 || height === 0) return;
            
            canvas.width = width; 
            canvas.height = height;
            
            ctx.clearRect(0, 0, width, height);
            
            const padding = 40;
            const chartWidth = width - padding * 2;
            const chartHeight = height - padding * 2;
            
            if (data.length === 0) return;

            const max = Math.max(...data);
            const min = Math.min(...data);
            const range = max - min === 0 ? 1 : max - min;
            
            // Draw grid
            ctx.strokeStyle = '#222222';
            ctx.lineWidth = 1;
            ctx.beginPath();
            for (let i = 0; i <= 5; i++) {
                const y = padding + (chartHeight / 5) * i;
                ctx.moveTo(padding, y);
                ctx.lineTo(width - padding, y);
            }
            ctx.stroke();
            
            // Draw line
            ctx.strokeStyle = '#ffffff';
            ctx.lineWidth = 2;
            ctx.beginPath();
            
            data.forEach((value, index) => {
                const x = padding + (chartWidth / (data.length - 1)) * index;
                const y = padding + chartHeight - ((value - min) / range) * chartHeight;
                
                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            });
            
            ctx.stroke();
            
            // Draw points
            ctx.fillStyle = '#ffffff';
            data.forEach((value, index) => {
                const x = padding + (chartWidth / (data.length - 1)) * index;
                const y = padding + chartHeight - ((value - min) / range) * chartHeight;
                
                ctx.beginPath();
                ctx.arc(x, y, 4, 0, Math.PI * 2);
                ctx.fill();
            });
        }

        function drawBarChart(canvasId, data) {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;
            
            const ctx = canvas.getContext('2d');
            const width = canvas.offsetWidth;
            const height = canvas.offsetHeight;

            if (width === 0 || height === 0) return;

            canvas.width = width;
            canvas.height = height;
            
            ctx.clearRect(0, 0, width, height);
            
            const padding = 40;
            const chartWidth = width - padding * 2;
            const chartHeight = height - padding * 2;
            
            if (data.length === 0) return;

            const max = Math.max(...data);
            const barWidth = chartWidth / data.length - 10;
            
            const colors = ['#3b82f6', '#22c55e', '#a855f7', '#f97316', '#ef4444'];
            
            data.forEach((value, index) => {
                const barHeight = (value / max) * chartHeight;
                const x = padding + (chartWidth / data.length) * index + 5;
                const y = padding + chartHeight - barHeight;
                
                ctx.fillStyle = colors[index % colors.length];
                ctx.fillRect(x, y, barWidth, barHeight);
            });
        }

        setTimeout(() => {
            drawLineChart('revenueChart', [3200, 3800, 3500, 4200, 4500, 4100, 4800]);
            drawBarChart('usersChart', [450, 380, 520, 290, 410]);
        }, 100);

        // Users Table
        let currentUserPage = 1;
        const usersPerPage = 10;
        let filteredUsers = [...usersData];

        function renderUsersTable() {
            const tbody = document.getElementById('usersTableBody');
            const start = (currentUserPage - 1) * usersPerPage;
            const end = start + usersPerPage;
            const pageUsers = filteredUsers.slice(start, end);
            
            tbody.innerHTML = pageUsers.map(user => `
                <tr>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.role === 'admin' ? 'Administrador' : user.role === 'manager' ? 'Gerente' : 'Usuário'}</td>
                    <td><span class="status-badge status-${user.status}">${user.status === 'active' ? 'Ativo' : user.status === 'pending' ? 'Pendente' : 'Inativo'}</span></td>
                    <td>${new Date(user.date).toLocaleDateString('pt-BR')}</td>
                    <td>
                        <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">Editar</button>
                    </td>
                </tr>
            `).join('');
            
            renderUsersPagination();
        }

        function renderUsersPagination() {
            const totalPages = Math.ceil(filteredUsers.length / usersPerPage);
            const pagination = document.getElementById('usersPagination');
            const info = document.getElementById('usersPaginationInfo');
            
            const start = (currentUserPage - 1) * usersPerPage + 1;
            const end = Math.min(start + usersPerPage - 1, filteredUsers.length);
            info.textContent = `${start}-${end} de ${filteredUsers.length}`;
            
            let html = `
                <button class="pagination-btn" ${currentUserPage === 1 ? 'disabled' : ''} onclick="changeUserPage(${currentUserPage - 1})">Anterior</button>
            `;
            
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentUserPage - 1 && i <= currentUserPage + 1)) {
                    html += `<button class="pagination-btn ${i === currentUserPage ? 'active' : ''}" onclick="changeUserPage(${i})">${i}</button>`;
                } else if (i === currentUserPage - 2 || i === currentUserPage + 2) {
                    html += `<span style="padding: 8px;">...</span>`;
                }
            }
            
            html += `
                <button class="pagination-btn" ${currentUserPage === totalPages ? 'disabled' : ''} onclick="changeUserPage(${currentUserPage + 1})">Próximo</button>
            `;
            
            pagination.innerHTML = html;
        }

        function changeUserPage(page) {
            if (page < 1 || page > Math.ceil(filteredUsers.length / usersPerPage)) return;
            currentUserPage = page;
            renderUsersTable();
        }

        // User Filters
        document.getElementById('userSearch').addEventListener('input', (e) => {
            applyUserFilters();
        });

        document.getElementById('userStatusFilter').addEventListener('change', (e) => {
            applyUserFilters();
        });

        document.getElementById('userRoleFilter').addEventListener('change', (e) => {
            applyUserFilters();
        });

        function applyUserFilters() {
            const search = document.getElementById('userSearch').value.toLowerCase();
            const status = document.getElementById('userStatusFilter').value;
            const role = document.getElementById('userRoleFilter').value;

            filteredUsers = usersData.filter(user => 
                user.name.toLowerCase().includes(search) &&
                (status === '' || user.status === status) &&
                (role === '' || user.role === role)
            );
            currentUserPage = 1;
            renderUsersTable();
        }

        // Products Table
        let currentProductPage = 1;
        const productsPerPage = 10;
        let filteredProducts = [...productsData];

        function renderProductsTable() {
            const tbody = document.getElementById('productsTableBody');
            const start = (currentProductPage - 1) * productsPerPage;
            const end = start + productsPerPage;
            const pageProducts = filteredProducts.slice(start, end);
            
            tbody.innerHTML = pageProducts.map(product => {
                let stockStatus = 'status-active';
                let stockText = 'Em Estoque';
                if (product.stock === 0) {
                    stockStatus = 'status-inactive';
                    stockText = 'Sem Estoque';
                } else if (product.stock < 5) {
                    stockStatus = 'status-pending';
                    stockText = 'Estoque Baixo';
                }
                
                return `
                    <tr>
                        <td>${product.name}</td>
                        <td>${product.category === 'electronics' ? 'Eletrônicos' : product.category === 'clothing' ? 'Roupas' : product.category === 'books' ? 'Livros' : 'Casa'}</td>
                        <td>R$ ${product.price.toFixed(2)}</td>
                        <td><span class="status-badge ${stockStatus}">${product.stock} un.</span></td>
                        <td>${product.sales}</td>
                        <td>
                            <button class="btn btn-secondary" style="padding: 6px 12px; font-size: 12px;">Editar</button>
                        </td>
                    </tr>
                `;
            }).join('');
            
            renderProductsPagination();
        }

        function renderProductsPagination() {
            const totalPages = Math.ceil(filteredProducts.length / productsPerPage);
            const pagination = document.getElementById('productsPagination');
            const info = document.getElementById('productsPaginationInfo');
            
            const start = (currentProductPage - 1) * productsPerPage + 1;
            const end = Math.min(start + productsPerPage - 1, filteredProducts.length);
            info.textContent = `${start}-${end} de ${filteredProducts.length}`;
            
            let html = `
                <button class="pagination-btn" ${currentProductPage === 1 ? 'disabled' : ''} onclick="changeProductPage(${currentProductPage - 1})">Anterior</button>
            `;
            
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentProductPage - 1 && i <= currentProductPage + 1)) {
                    html += `<button class="pagination-btn ${i === currentProductPage ? 'active' : ''}" onclick="changeProductPage(${i})">${i}</button>`;
                } else if (i === currentProductPage - 2 || i === currentProductPage + 2) {
                    html += `<span style="padding: 8px;">...</span>`;
                }
            }
            
            html += `
                <button class="pagination-btn" ${currentProductPage === totalPages ? 'disabled' : ''} onclick="changeProductPage(${currentProductPage + 1})">Próximo</button>
            `;
            
            pagination.innerHTML = html;
        }

        function changeProductPage(page) {
            const totalPages = Math.ceil(filteredProducts.length / productsPerPage);
            if (page < 1 || page > totalPages) return;
            currentProductPage = page;
            renderProductsTable();
        }

        // Product Filters
        document.getElementById('productSearch').addEventListener('input', (e) => {
            applyProductFilters();
        });

        document.getElementById('productCategoryFilter').addEventListener('change', (e) => {
            applyProductFilters();
        });

        document.getElementById('productStockFilter').addEventListener('change', (e) => {
            applyProductFilters();
        });
        
        function applyProductFilters() {
            const search = document.getElementById('productSearch').value.toLowerCase();
            const category = document.getElementById('productCategoryFilter').value;
            const stockFilter = document.getElementById('productStockFilter').value;

            filteredProducts = productsData.filter(product => 
                product.name.toLowerCase().includes(search) &&
                (category === '' || product.category === category) &&
                (stockFilter === '' || 
                 (stockFilter === 'in-stock' && product.stock >= 5) ||
                 (stockFilter === 'low-stock' && product.stock > 0 && product.stock < 5) ||
                 (stockFilter === 'out-of-stock' && product.stock === 0))
            );
            currentProductPage = 1;
            renderProductsTable();
        }

        // Settings Toggle Switches
        document.querySelectorAll('.toggle-switch').forEach(toggle => {
            toggle.addEventListener('click', () => {
                toggle.classList.toggle('active');
            });
        });

        // Initialize tables
        loadData(); // Carregar dados salvos ao iniciar
        renderUsersTable();
        renderProductsTable();
        renderEditorUsersList(); // Renderizar lista do editor
        renderEditorProductsList(); // Renderizar lista do editor

        // Responsive handling
        function handleResize() {
            if (window.innerWidth <= 768) {
                sidebar.classList.add('mobile-hidden');
                mainContent.classList.add('full-width');
            } else {
                sidebar.classList.remove('mobile-hidden');
                sidebar.classList.remove('mobile-visible'); /* Ensure visible for larger screens */
                mainContent.classList.remove('full-width');
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();
        

        // Analytics - Gráfico de visitantes por hora
        function drawHourlyChart() {
            const canvas = document.getElementById('hourlyChart');
            if (!canvas) return;
            
            if (canvas.offsetWidth === 0 || canvas.offsetHeight === 0) {
                setTimeout(drawHourlyChart, 100);
                return;
            }
            
            const ctx = canvas.getContext('2d');
            const width = canvas.width = canvas.offsetWidth;
            const height = canvas.height = 300;
            
            const data = [45, 52, 38, 65, 72, 88, 95, 102, 118, 125, 132, 128, 115, 108, 95, 88, 92, 98, 105, 112, 98, 85, 72, 58];
            const max = Math.max(...data);
            const padding = 40;
            const chartWidth = width - padding * 2;
            const chartHeight = height - padding * 2;
            
            ctx.clearRect(0, 0, width, height);
            
            // Grid
            ctx.strokeStyle = '#2a2a2a';
            ctx.lineWidth = 1;
            for (let i = 0; i <= 5; i++) {
                const y = padding + (chartHeight / 5) * i;
                ctx.beginPath();
                ctx.moveTo(padding, y);
                ctx.lineTo(width - padding, y);
                ctx.stroke();
            }
            
            // Line
            ctx.strokeStyle = '#667eea';
            ctx.lineWidth = 3;
            ctx.beginPath();
            
            data.forEach((value, index) => {
                const x = padding + (chartWidth / (data.length - 1)) * index;
                const y = padding + chartHeight - (value / max) * chartHeight;
                
                if (index === 0) {
                    ctx.moveTo(x, y);
                } else {
                    ctx.lineTo(x, y);
                }
            });
            
            ctx.stroke();
            
            // Points
            ctx.fillStyle = '#667eea';
            data.forEach((value, index) => {
                const x = padding + (chartWidth / (data.length - 1)) * index;
                const y = padding + chartHeight - (value / max) * chartHeight;
                
                ctx.beginPath();
                ctx.arc(x, y, 4, 0, Math.PI * 2);
                ctx.fill();
            });
        }

        // Relatórios
        function generateReport() {
            const type = document.getElementById('reportType').value;
            const period = document.getElementById('reportPeriod').value;
            const format = document.getElementById('reportFormat').value;
            
            alert(`Gerando relatório de ${type} para o período ${period} no formato ${format}...`);
        }

        // Pedidos
        function filterOrders() {
            const filter = document.getElementById('orderStatusFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#ordersTableBody tr');
            
            rows.forEach(row => {
                const status = row.querySelector('.badge').textContent.toLowerCase();
                if (filter === '' || status.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function searchOrders() {
            const search = document.getElementById('orderSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#ordersTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(search) ? '' : 'none';
            });
        }

        // Clientes
        function filterCustomers() {
            const filter = document.getElementById('customerTypeFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#customersTableBody tr');
            
            rows.forEach(row => {
                const type = row.querySelector('.badge').textContent.toLowerCase();
                if (filter === '' || type.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function searchCustomers() {
            const search = document.getElementById('customerSearch').value.toLowerCase();
            const rows = document.querySelectorAll('#customersTableBody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(search) ? '' : 'none';
            });
        }

        // Notificações
        function markAllAsRead() {
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
            });
            alert('Todas as notificações foram marcadas como lidas!');
        }

        // Ajuda
        function toggleFaq(element) {
            const faqItem = element.parentElement;
            const isActive = faqItem.classList.contains('active');
            
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
            
            if (!isActive) {
                faqItem.classList.add('active');
            }
        }

    </script>
</body>
</html>
