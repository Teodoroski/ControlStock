<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../login.php");
    exit();
}

$idUsuario = (int)$_SESSION['idUsuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas e Saídas - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include 'menu.php'; ?>

    <main class="page-container" style="display: block;">
        
        <!-- BARRA DE PESQUISA E FILTRO COM DROPDOWN -->
        <div class="search-filter-container">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="input-pesquisa" placeholder="pesquisar produto...">
            </div>

            <div class="filter-dropdown-container">
                <button class="btn-filter" id="btn-toggle-filter">
                    <i class="fa-solid fa-filter"></i>
                    <span>FILTRAR</span>
                </button>

                <div class="filter-dropdown-menu" id="filter-menu">
                    <div class="filter-dropdown-item active" data-filter="todos">
                        <i class="fa-solid fa-list"></i> Todos
                    </div>
                    <div class="filter-dropdown-item" data-filter="entradas">
                        <i class="fa-solid fa-arrow-up" style="color: #2ec4b6;"></i> Entradas
                    </div>
                    <div class="filter-dropdown-item" data-filter="saidas">
                        <i class="fa-solid fa-arrow-down" style="color: #e71d36;"></i> Saídas
                    </div>
                    <div class="filter-dropdown-divider"></div>
                    <div class="filter-dropdown-item" data-sort="az">
                        <i class="fa-solid fa-arrow-down-a-z"></i> De A a Z
                    </div>
                    <div class="filter-dropdown-item" data-sort="za">
                        <i class="fa-solid fa-arrow-up-z-a"></i> De Z a A
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD DE HISTÓRICO DE MOVIMENTAÇÕES -->
        <div class="movements-card">
            <h2 class="movements-title">ENTRADAS E RETIRADAS DO ESTOQUE</h2>

            <div class="movement-list">
                
                <!-- Item 1: Entrada -->
                <div class="movement-item entry">
                    <div class="movement-info">
                        <div class="movement-icon">
                            <i class="fa-solid fa-arrow-up"></i>
                        </div>
                        <div class="movement-details">
                            <h4>PRODUTO1</h4>
                            <p>Entrada de produtos</p>
                        </div>
                    </div>
                    <div class="movement-value">+100</div>
                </div>

                <!-- Item 2: Saída -->
                <div class="movement-item exit">
                    <div class="movement-info">
                        <div class="movement-icon">
                            <i class="fa-solid fa-arrow-down"></i>
                        </div>
                        <div class="movement-details">
                            <h4>PRODUTO2</h4>
                            <p>Saída de produtos</p>
                        </div>
                    </div>
                    <div class="movement-value">-50</div>
                </div>

                <!-- Item 3: Saída -->
                <div class="movement-item exit">
                    <div class="movement-info">
                        <div class="movement-icon">
                            <i class="fa-solid fa-arrow-down"></i>
                        </div>
                        <div class="movement-details">
                            <h4>PRODUTO3</h4>
                            <p>Saída de produtos</p>
                        </div>
                    </div>
                    <div class="movement-value">-150</div>
                </div>

                <!-- Item 4: Entrada -->
                <div class="movement-item entry">
                    <div class="movement-info">
                        <div class="movement-icon">
                            <i class="fa-solid fa-arrow-up"></i>
                        </div>
                        <div class="movement-details">
                            <h4>PRODUTO4</h4>
                            <p>Entrada de produtos</p>
                        </div>
                    </div>
                    <div class="movement-value">+250</div>
                </div>

                <!-- Item 5: Entrada -->
                <div class="movement-item entry">
                    <div class="movement-info">
                        <div class="movement-icon">
                            <i class="fa-solid fa-arrow-up"></i>
                        </div>
                        <div class="movement-details">
                            <h4>PRODUTO5</h4>
                            <p>Entrada de produtos</p>
                        </div>
                    </div>
                    <div class="movement-value">+10</div>
                </div>

            </div>
        </div>

    </main>

    <footer class="footer">
        <p>© <?php echo date('Y'); ?> controlStoke — Sistema de Controle de Estoque[cite: 2]</p>
        <p><a href="politica.php">Política de Privacidade</a></p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('input-pesquisa');
    const btnFilter = document.getElementById('btn-toggle-filter');
    const filterMenu = document.getElementById('filter-menu');
    const filterItems = document.querySelectorAll('.filter-dropdown-item');
    const movementList = document.querySelector('.movement-list');

    let currentTypeFilter = 'todos'; // todos | entradas | saidas

    // Toggle Dropdown de Filtros
    btnFilter.addEventListener('click', function(e) {
        e.stopPropagation();
        filterMenu.classList.toggle('active');
    });

    // Fechar dropdown ao clicar fora
    document.addEventListener('click', function(e) {
        if (!filterMenu.contains(e.target) && !btnFilter.contains(e.target)) {
            filterMenu.classList.remove('active');
        }
    });

    // Aplicação dos Filtros e Ordenação
    filterItems.forEach(item => {
        item.addEventListener('click', function() {
            const filterType = this.getAttribute('data-filter');
            const sortType = this.getAttribute('data-sort');

            if (filterType) {
                // Atualizar estado do filtro do tipo (Todos, Entradas, Saídas)
                document.querySelectorAll('[data-filter]').forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                currentTypeFilter = filterType;
                applyFilters();
            }

            if (sortType) {
                sortList(sortType);
            }

            filterMenu.classList.remove('active');
        });
    });

    // Filtra por Nome e por Tipo (Entrada/Saída)
    function applyFilters() {
        const query = searchInput.value.toLowerCase().trim();
        const items = document.querySelectorAll('.movement-item');

        items.forEach(item => {
            const productName = item.querySelector('h4').textContent.toLowerCase();
            const isEntry = item.classList.contains('entry');
            const isExit = item.classList.contains('exit');

            let matchesSearch = productName.includes(query);
            let matchesType = true;

            if (currentTypeFilter === 'entradas' && !isEntry) matchesType = false;
            if (currentTypeFilter === 'saidas' && !isExit) matchesType = false;

            if (matchesSearch && matchesType) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Ordenação A-Z / Z-A
    function sortList(direction) {
        const items = Array.from(document.querySelectorAll('.movement-item'));

        items.sort((a, b) => {
            const nameA = a.querySelector('h4').textContent.toLowerCase();
            const nameB = b.querySelector('h4').textContent.toLowerCase();

            if (direction === 'az') return nameA.localeCompare(nameB);
            if (direction === 'za') return nameB.localeCompare(nameA);
            return 0;
        });

        // Reorganiza elementos no DOM
        items.forEach(item => movementList.appendChild(item));
    }

    // Evento na pesquisa por texto
    searchInput.addEventListener('input', applyFilters);
});
    </script>
</body>
</html>