@extends('layout_funcionario')

@section('conteudo')
<link rel="stylesheet" href="{{ asset('/css/loja/clientes.css') }}">

<div class="page-header">
    <h2>Gerenciamento de Clientes</h2>
    <p>Visualize e gerencie os clientes cadastrados na loja.</p>
</div>

<section class="summary-cards">
    <div class="summary-card">
        <div class="card-icon">
            <i class="fa-solid fa-users"></i>
        </div>
        <div class="card-info">
            <h3>Total de Clientes</h3>
            <span class="card-number">3.240</span>
        </div>
    </div>
    
    <div class="summary-card">
        <div class="card-icon">
            <i class="fa-solid fa-user-check"></i>
        </div>
        <div class="card-info">
            <h3>Clientes Ativos</h3>
            <span class="card-number">3.102</span>
        </div>
    </div>
    
    <div class="summary-card">
        <div class="card-icon">
            <i class="fa-solid fa-user-plus"></i>
        </div>
        <div class="card-info">
            <h3>Novos no Mês</h3>
            <span class="card-number">+128</span>
        </div>
    </div>
</section>

<section class="admin-card action-bar-section">
    <div class="action-bar-container">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Buscar cliente por nome ou e-mail...">
        </div>
        
        <button class="btn btn-primary">
            <i class="fa-solid fa-magnifying-glass"></i> Buscar
        </button>
    </div>
</section>

<section class="admin-card">
    <div class="table-responsive">
        <table class="admin-table striped-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th>Data de Cadastro</th>
                    <th>Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>#10452</strong></td>
                    <td>Carlos Silva</td>
                    <td>carlos.silva@email.com</td>
                    <td>(11) 98765-4321</td>
                    <td>São Paulo - SP</td>
                    <td>15/01/2026</td>
                    <td><span class="badge-status ativo">Ativo</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action edit" title="Editar cliente"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><strong>#10451</strong></td>
                    <td>Ana Souza</td>
                    <td>ana.souza88@email.com</td>
                    <td>(21) 97654-3210</td>
                    <td>Rio de Janeiro - RJ</td>
                    <td>10/02/2026</td>
                    <td><span class="badge-status ativo">Ativo</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action edit" title="Editar cliente"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>

                <tr>
                    <td><strong>#10450</strong></td>
                    <td>Roberto Santos</td>
                    <td>roberto.santos.dev@email.com</td>
                    <td>(31) 99887-7665</td>
                    <td>Belo Horizonte - MG</td>
                    <td>05/03/2026</td>
                    <td><span class="badge-status inativo">Inativo</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action edit" title="Editar cliente"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>
                
                <tr>
                    <td><strong>#10449</strong></td>
                    <td>Mariana Costa</td>
                    <td>mari.costa@email.com</td>
                    <td>(41) 91234-5678</td>
                    <td>Curitiba - PR</td>
                    <td>22/03/2026</td>
                    <td><span class="badge-status ativo">Ativo</span></td>
                    <td class="action-buttons text-center">
                        <button class="btn-action view" title="Ver detalhes"><i class="fa-regular fa-eye"></i></button>
                        <button class="btn-action edit" title="Editar cliente"><i class="fa-solid fa-pen"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>


@endsection