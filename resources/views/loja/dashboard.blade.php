<link rel="stylesheet" href="{{ asset('/css/loja/dashboard.css') }}">


@extends('layout_funcionario')

@section('conteudo')

<div class="dashboard-header">
    <h2>Visão Geral da Loja</h2>
    <p>Acompanhe o desempenho da Monitor Store hoje.</p>
</div>

<section class="summary-cards">
    <div class="summary-card">
        <div class="card-icon"><i class="fa-solid fa-box-open"></i></div>
        <div class="card-info">
            <h3>Total de Produtos</h3>
            <span class="card-number">124</span>
            <p class="card-desc">Ativos no catálogo</p>
        </div>
    </div>
    
    <div class="summary-card">
        <div class="card-icon"><i class="fa-solid fa-cart-arrow-down"></i></div>
        <div class="card-info">
            <h3>Total de Pedidos</h3>
            <span class="card-number">856</span>
            <p class="card-desc">Neste mês</p>
        </div>
    </div>
    
    <div class="summary-card">
        <div class="card-icon"><i class="fa-solid fa-users"></i></div>
        <div class="card-info">
            <h3>Total de Clientes</h3>
            <span class="card-number">3.240</span>
            <p class="card-desc">Cadastrados na base</p>
        </div>
    </div>
    
    <div class="summary-card">
        <div class="card-icon"><i class="fa-solid fa-money-bill-trend-up"></i></div>
        <div class="card-info">
            <h3>Faturamento do Mês</h3>
            <span class="card-number">R$ 45.890</span>
            <p class="card-desc">↑ 12% vs. mês passado</p>
        </div>
    </div>
</section>

<div class="dashboard-grid">
    
    <section class="dashboard-panel recent-orders">
        <div class="panel-header">
            <h3>Pedidos Recentes</h3>
            <a href="{{ route('funcionario.pedidos') }}" class="btn-link">Ver todos</a>
        </div>
        
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Produto</th>
                        <th>Valor</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#4092</td>
                        <td>Carlos Silva</td>
                        <td>Monitor Ultrawide 29"</td>
                        <td>R$ 1.549,90</td>
                        <td><span class="status-badge success">Pago</span></td>
                    </tr>
                    <tr>
                        <td>#4091</td>
                        <td>Ana Souza</td>
                        <td>Suporte Articulado F80N</td>
                        <td>R$ 259,00</td>
                        <td><span class="status-badge warning">Pendente</span></td>
                    </tr>
                    <tr>
                        <td>#4090</td>
                        <td>Roberto Santos</td>
                        <td>Monitor Gamer 144Hz 24"</td>
                        <td>R$ 1.299,00</td>
                        <td><span class="status-badge danger">Cancelado</span></td>
                    </tr>
                    <tr>
                        <td>#4089</td>
                        <td>Mariana Costa</td>
                        <td>Cabo DisplayPort 2m</td>
                        <td>R$ 89,90</td>
                        <td><span class="status-badge success">Pago</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="dashboard-panel top-products">
        <div class="panel-header">
            <h3>Mais Vendidos</h3>
        </div>
        
        <div class="product-list">
            <div class="product-item">
                <img src="https://via.placeholder.com/50" alt="Monitor 24">
                <div class="product-info">
                    <h4>Monitor Gamer 24" 144Hz</h4>
                    <span>120 unidades vendidas</span>
                </div>
            </div>
            
            <div class="product-item">
                <img src="https://via.placeholder.com/50" alt="Monitor 29">
                <div class="product-info">
                    <h4>Monitor Ultrawide 29"</h4>
                    <span>85 unidades vendidas</span>
                </div>
            </div>
            
            <div class="product-item">
                <img src="https://via.placeholder.com/50" alt="Suporte">
                <div class="product-info">
                    <h4>Suporte Articulado F80N</h4>
                    <span>74 unidades vendidas</span>
                </div>
            </div>
            
            <div class="product-item">
                <img src="https://via.placeholder.com/50" alt="Monitor 27">
                <div class="product-info">
                    <h4>Monitor 27" 4K IPS</h4>
                    <span>42 unidades vendidas</span>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection