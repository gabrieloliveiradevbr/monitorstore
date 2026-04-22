@extends('layout_funcionario')

@section('conteudo')
<link rel="stylesheet" href="{{ asset('/css/loja/cadastro_produto.css') }}">


<main class="admin-conteudo">
    <div class="page-header">
        <h2>Cadastrar Produto</h2>
        <p>Preencha as informações abaixo para adicionar um novo produto ao catálogo da loja.</p>
    </div>

    <section class="admin-card">
        <form action="#" method="POST" enctype="multipart/form-data" class="admin-form">
            
            <div class="form-grid">
                
                <div class="form-group span-2">
                    <label for="nome">Nome do Produto *</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Ex: Monitor Gamer 27' IPS 144Hz" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria *</label>
                    <select id="categoria" name="categoria" class="form-control" required>
                        <option value="" disabled selected>Selecione uma categoria...</option>
                        <option value="monitores_gamer">Monitores Gamer</option>
                        <option value="monitores_profissionais">Monitores Profissionais</option>
                        <option value="acessorios">Acessórios</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status do Produto *</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="ativo" selected>Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="preco">Preço (R$) *</label>
                    <input type="number" id="preco" name="preco" class="form-control" step="0.01" min="0" placeholder="0.00" required>
                </div>

                <div class="form-group">
                    <label for="estoque">Quantidade em Estoque *</label>
                    <input type="number" id="estoque" name="estoque" class="form-control" min="0" placeholder="0" required>
                </div>

                <div class="form-group span-2">
                    <label for="imagem">Imagem do Produto *</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="imagem" name="imagem" class="form-control file-input" accept="image/*" required>
                        <small class="text-muted">Formatos recomendados: JPG, PNG ou WEBP. Tamanho máximo: 2MB.</small>
                    </div>
                </div>

                <div class="form-group span-2">
                    <label for="descricao">Descrição Completa</label>
                    <textarea id="descricao" name="descricao" class="form-control textarea-large" placeholder="Descreva os detalhes técnicos, diferenciais e informações importantes do produto..."></textarea>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('funcionario.admin') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Cadastrar Produto
                </button>
            </div>
            
        </form>
    </section>
</main>