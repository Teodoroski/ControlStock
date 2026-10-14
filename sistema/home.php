<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Principal - controlStoke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <?php include 'menu.php'; ?>

    <main class="dashboard-container">
        
        <div class="dashboard-header">
            <h1>Seja bem-vindo(a) ao controlStoke!</h1>
            <p>Confira um resumo do estoque atual</p>
        </div>

        <div class="dashboard-main-grid">
            
            <div class="dashboard-sidebar-column">
                
                <div class="alert-card-danger">
                    <h3>ATENÇÃO</h3>
                    <p>ALGUNS PRODUTOS ESTÃO COM O ESTOQUE ZERADO!!</p>
                </div>

                <div class="recent-movements-card">
                    <h4>Movimentações Recentes</h4>
                    <ul class="movement-list">
                        <li class="movement-item">
                            <div class="movement-info">
                                <div class="movement-icon in">
                                    <i class="fa-solid fa-arrow-up"></i>
                                </div>
                                <div class="movement-details">
                                    <strong>PRODUTO1</strong>
                                    <span>Entrada de produtos</span>
                                </div>
                            </div>
                            <span class="movement-value positive">+100</span>
                        </li>

                        <li class="movement-item">
                            <div class="movement-info">
                                <div class="movement-icon out">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </div>
                                <div class="movement-details">
                                    <strong>PRODUTO2</strong>
                                    <span>Saída de produtos</span>
                                </div>
                            </div>
                            <span class="movement-value negative">-50</span>
                        </li>

                        <li class="movement-item">
                            <div class="movement-info">
                                <div class="movement-icon out">
                                    <i class="fa-solid fa-arrow-down"></i>
                                </div>
                                <div class="movement-details">
                                    <strong>PRODUTO3</strong>
                                    <span>Saída de produtos</span>
                                </div>
                            </div>
                            <span class="movement-value negative">-150</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="metrics-grid">
                
                <div class="metric-card blue">
                    <div class="icon-box">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <div class="number">120</div>
                    <div class="label">Total de Produtos</div>
                </div>

                <div class="metric-card green">
                    <div class="icon-box">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div class="number">520</div>
                    <div class="label">Produtos em Estoque</div>
                </div>

                <div class="metric-card yellow">
                    <div class="icon-box">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div class="number">8</div>
                    <div class="label">Estoque Baixo</div>
                </div>

                <div class="metric-card red">
                    <div class="icon-box">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div class="number">109</div>
                    <div class="label">Estoque Zerado</div>
                </div>

            </div>
        </div>

        <div class="section-subtitle-bar">
            <h3>Ações Rápidas</h3>
            <div class="line"></div>
        </div>

        <div class="quick-actions-grid">
            <a href="cadastrarProduto.php" class="action-btn-card">
                <i class="fa-regular fa-square-plus"></i>
                <span>Novo Produto</span>
            </a>
            <a href="entradaSaida.php" class="action-btn-card">
                <i class="fa-solid fa-right-left"></i>
                <span>Registrar Entrada/Saída</span>
            </a>
            <a href="exibirEstoque.php" class="action-btn-card">
                <i class="fa-regular fa-calendar-check"></i>
                <span>Consultar Estoque</span>
            </a>
            <a href="cadastrarCategoria.php" class="action-btn-card">
                <i class="fa-solid fa-tag"></i>
                <span>Nova Categoria</span>
            </a>
        </div>

        <div class="section-subtitle-bar">
            <h3>Itens Críticos para Reposição</h3>
            <div class="line"></div>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Qtd. Atual</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#PRD-0012</td>
                        <td><strong>PRODUTO3</strong></td>
                        <td>Eletrônicos</td>
                        <td>0 Unid.</td>
                        <td><span class="status-badge red">Zerado</span></td>
                    </tr>
                    <tr>
                        <td>#PRD-0045</td>
                        <td><strong>PRODUTO8</strong></td>
                        <td>Acessórios</td>
                        <td>2 Unid.</td>
                        <td><span class="status-badge yellow">Estoque Baixo</span></td>
                    </tr>
                    <tr>
                        <td>#PRD-0089</td>
                        <td><strong>PRODUTO15</strong></td>
                        <td>Informática</td>
                        <td>0 Unid.</td>
                        <td><span class="status-badge red">Zerado</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>

    <footer class="footer">
        <p>© <?php echo date('Y'); ?> controlStoke — Sistema de Controle de Estoque[cite: 2]</p>
        <p><a href="politica.php">Política de Privacidade</a></p>
    </footer>

</body>
</html>