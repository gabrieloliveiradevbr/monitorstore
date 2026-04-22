@extends('layout_funcionario')

@section('conteudo')
<link rel="stylesheet" href="{{ asset('/css/loja/pedidos.css') }}">


<div class="page-header">
    <h2>Gerenciamento de Pedidos</h2>
    <p>Visualize e acompanhe os pedidos realizados na loja.</p>
</div>

<section class="admin-card filter-section">
    <div class="filter-container">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Buscar por cliente ou ID do pedido...">
        </div>
        
        <div class="filter-box">
            <select class="form-select">
                <option value="todos">Todos os Status</option>
                <option value="pago">Pago</option>
                <option value="pendente">Pendente</option>
                <option value="enviado">Enviado</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>
        
        <button class="btn btn-primary">
            <i class="fa-solid fa-filter"></i> Buscar
        </button>
    </div>
</section>

<section class="admin-card">
    <div class="table-responsive">
        <table class="admin-table striped-table">
            <thead>
                <tr>
                    <th>ID do Pedido</th>
                    <th>Cliente</th>
                    <th>Data</th>
                    <th>Produtos</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>#4092</strong></td>
                    <td>Carlos Silva</td>
                    <td>27/03/2026</td>
                    <td>1x Monitor Ultrawide 29"</td>
                    <td>R$ 1.549,90</td>
                    <td><span class="badge-status pago">Pago</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action update" title="Atualizar status"><i class="fa-solid fa-rotate"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><strong>#4091</strong></td>
                    <td>Ana Souza</td>
                    <td>26/03/2026</td>
                    <td>2x Suporte Articulado F80N</td>
                    <td>R$ 518,00</td>
                    <td><span class="badge-status pendente">Pendente</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action update" title="Atualizar status"><i class="fa-solid fa-rotate"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><strong>#4088</strong></td>
                    <td>Fernando Gomes</td>
                    <td>25/03/2026</td>
                    <td>1x Monitor 27" 4K IPS <br><small class="text-muted">+ 1 outro item</small></td>
                    <td>R$ 2.399,00</td>
                    <td><span class="badge-status enviado">Enviado</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action update" title="Atualizar status"><i class="fa-solid fa-rotate"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><strong>#4085</strong></td>
                    <td>Roberto Santos</td>
                    <td>23/03/2026</td>
                    <td>1x Monitor Gamer 144Hz 24"</td>
                    <td>R$ 1.299,00</td>
                    <td><span class="badge-status cancelado">Cancelado</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action update" title="Atualizar status"><i class="fa-solid fa-rotate"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <div class="pagination">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span class="page-dots">...</span>
            <button class="page-btn next-btn">Próximo <i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>
</section>

@endsection