<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .control-topbar, .control-sidebar, .control-overlay, .logout-modal-overlay {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .control-topbar {
            background-color: #0d3b66;
            color: #ffffff;
            height: 65px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .control-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .control-logo-img {
            height: 45px;
            width: auto;
            object-fit: contain;
            display: block;
        }

        .hamburger-btn {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 26px;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.2s ease, transform 0.1s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hamburger-btn:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        .hamburger-btn:active {
            transform: scale(0.95);
        }

        .control-sidebar {
            width: 320px;
            background-color: #92c9e8;
            position: fixed;
            top: 0;
            right: -320px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 1002;
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: -4px 0 15px rgba(0,0,0,0.2);
        }

        .control-sidebar.active {
            right: 0;
        }

        .sidebar-header {
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 20px;
            background-color: rgba(0, 0, 0, 0.05);
        }

        .close-btn {
            background: none;
            border: none;
            color: #0b2545;
            font-size: 26px;
            cursor: pointer;
            padding: 5px;
            transition: color 0.2s ease;
        }

        .close-btn:hover {
            color: #d90429;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding-top: 15px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
        }

        .sidebar-menu li a {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 25px;
            color: #0b2545;
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .sidebar-menu li a:hover {
            background-color: #7ab8de;
            color: #000000;
        }

        .sidebar-menu li a i {
            font-size: 20px;
            width: 24px;
            text-align: center;
        }

        .sidebar-bottom {
            border-top: 1px solid rgba(11, 37, 69, 0.15);
            padding-bottom: 20px;
            padding-top: 10px;
        }

        .control-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .control-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .logout-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }

        .logout-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .logout-modal-card {
            background-color: #ffffff;
            border: 1.5px solid #e71d36;
            border-radius: 16px;
            padding: 25px 30px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            text-align: center;
        }

        .logout-modal-card .logout-close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            font-size: 20px;
            color: #555;
            cursor: pointer;
        }

        .logout-modal-card h3 {
            color: #e71d36;
            font-size: 20px;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 12px;
            margin-top: 5px;
        }

        .logout-modal-card p {
            color: #333;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 22px;
        }

        .logout-modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-cancel-logout {
            background-color: #e2e8f0;
            color: #333333;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 13px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-cancel-logout:hover {
            background-color: #cbd5e1;
        }

        .btn-confirm-logout {
            background-color: #e71d36;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .btn-confirm-logout:hover {
            background-color: #c9182e;
        }
    </style>
</head>
<body>

    <header class="control-topbar">
        <a href="home.php" class="control-logo">
            <img src="../imagem/logo.png" alt="controlStoke" class="control-logo-img">
        </a>

        <button class="hamburger-btn" id="btn-hamburger" title="Abrir Menu">
            <i class="fa-solid fa-bars"></i>
        </button>
    </header>

    <div class="control-overlay" id="menu-overlay"></div>

    <aside class="control-sidebar" id="sidebar-drawer">
        <div class="sidebar-header">
            <button class="close-btn" id="btn-close-sidebar" title="Fechar Menu">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <nav class="sidebar-nav">
            <ul class="sidebar-menu">
                <li>
                    <a href="home.php"><i class="fa-solid fa-house"></i> HOME</a>
                </li>
                <li>
                    <a href="cadastrarProduto.php"><i class="fa-regular fa-file-lines"></i> CADASTRAR PRODUTO</a>
                </li>
                <li>
                    <a href="exibirEstoque.php"><i class="fa-regular fa-calendar-check"></i> ESTOQUE</a>
                </li>
                <li>
                    <a href="cadastrarCategoria.php"><i class="fa-solid fa-tag"></i> CADASTRAR CATEGORIA</a>
                </li>
                <li>
                    <a href="entradaSaida.php"><i class="fa-solid fa-right-left"></i> ENTRADA E SAÍDA ESTO.</a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-bottom">
            <ul class="sidebar-menu">
                <li>
                    <a href="configuracao.php"><i class="fa-solid fa-gear"></i> CONFIGURAÇÕES</a>
                </li>
                <li>
                    <!-- Clique dispara a abertura do modal de confirmação -->
                    <a href="javascript:void(0);" id="btn-open-logout-modal"><i class="fa-solid fa-right-from-bracket"></i> SAIR</a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- MODAL DE CONFIRMAÇÃO DE SAÍDA GLOBAL -->
    <div class="logout-modal-overlay" id="modal-logout">
        <div class="logout-modal-card">
            <button class="logout-close-btn" id="btn-close-logout-modal"><i class="fa-solid fa-xmark"></i></button>
            <h3>SAIR DO SISTEMA</h3>
            <p>TEM CERTEZA QUE DESEJA SAIR DO CONTROLSTOKE?</p>
            
            <div class="logout-modal-actions">
                <button class="btn-cancel-logout" id="btn-cancel-logout">CANCELAR</button>
                <a href="logout.php" class="btn-confirm-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>SAIR</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menu Lateral
            const btnHamburger = document.getElementById('btn-hamburger');
            const btnClose = document.getElementById('btn-close-sidebar');
            const sidebar = document.getElementById('sidebar-drawer');
            const overlay = document.getElementById('menu-overlay');

            // Modal Sair
            const btnOpenLogoutModal = document.getElementById('btn-open-logout-modal');
            const modalLogout = document.getElementById('modal-logout');
            const btnCloseLogoutModal = document.getElementById('btn-close-logout-modal');
            const btnCancelLogout = document.getElementById('btn-cancel-logout');

            function openMenu() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            }

            function closeMenu() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }

            function openLogoutModal() {
                closeMenu(); // Fecha a sidebar ao abrir o modal
                modalLogout.classList.add('active');
            }

            function closeLogoutModal() {
                modalLogout.classList.remove('active');
            }

            // Listeners da Sidebar
            btnHamburger.addEventListener('click', openMenu);
            btnClose.addEventListener('click', closeMenu);
            overlay.addEventListener('click', closeMenu);

            // Listeners do Modal
            btnOpenLogoutModal.addEventListener('click', openLogoutModal);
            btnCloseLogoutModal.addEventListener('click', closeLogoutModal);
            btnCancelLogout.addEventListener('click', closeLogoutModal);

            modalLogout.addEventListener('click', function(event) {
                if (event.target === modalLogout) {
                    closeLogoutModal();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeMenu();
                    closeLogoutModal();
                }
            });
        });
    </script>
</body>
</html>