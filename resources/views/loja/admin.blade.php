@extends('layout_funcionario')

@section('conteudo')
<link rel="stylesheet" href="{{ asset('/css/loja/admin.css') }}">

<div class="admin-page-header">
    <div class="page-title">
        <h1>Gerenciar Produtos</h1>
        <p>Adicione, edite ou remova produtos do catálogo da loja.</p>
    </div>
    
    <div class="page-actions">
        <a href="{{ route('funcionario.cadastro') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Novo Produto
        </a>
    </div>
</div>

<section class="admin-card">
    <div class="admin-card-header">
        <div class="filter-group">
            <select class="form-select">
                <option value="">Todas as Categorias</option>
                <option value="monitores">Monitores Gamer</option>
                <option value="suportes">Suportes</option>
            </select>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome do Produto</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1045</td>
                    <td><img src="{{ asset('imagens/Monitor - 1.png') }}" alt="Monitor Gamer" class="table-img" width="50"></td>
                    <td><strong>Monitor Gamer 24" 144Hz</strong></td>
                    <td>Monitores Gamer</td>
                    <td><span class="badge-stock success">45 un.</span></td>
                    <td>R$ 1.299,00</td>
                    <td class="action-buttons">
                        <button class="btn-icon edit" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn-icon delete" title="Excluir"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#1046</td>
                    <td><img src="{{ asset('imagens/Monitor - 1 (1).png') }}" alt="Monitor Ultrawide" class="table-img" width="50"></td>
                    <td><strong>Monitor Ultrawide 29"</strong></td>
                    <td>Profissionais</td>
                    <td><span class="badge-stock warning">2 un.</span></td>
                    <td>R$ 1.549,90</td>
                    <td class="action-buttons">
                        <button class="btn-icon edit" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn-icon delete" title="Excluir"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="pagination">
        <button class="page-btn disabled"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="page-btn active">1</button>
        <button class="page-btn">2</button>
        <button class="page-btn">3</button>
        <button class="page-btn"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</section>

@endsection