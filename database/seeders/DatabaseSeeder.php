<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Funcionario;
use App\Models\Produto;
use App\Models\User;
use App\Models\Avaliacao;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Usuários do Sistema (users)
        User::firstOrCreate(
            ['email' => 'admin@monitorstore.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('123456'),
            ]
        );

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Funcionários (funcionarios)
        $funcionarios = [
            [
                'nome' => 'Carlos Eduardo',
                'cargo' => 'Gerente de Vendas',
                'email' => 'gerente@monitorstore.com',
                'telefone' => '(11) 98888-1111',
                'senha' => '123456',
            ],
            [
                'nome' => 'Ana Clara Santos',
                'cargo' => 'Atendente',
                'email' => 'ana.atendimento@monitorstore.com',
                'telefone' => '(11) 98888-2222',
                'senha' => '123456',
            ],
            [
                'nome' => 'Admin MonitorStore',
                'cargo' => 'Administrador',
                'email' => 'admin@admin.com',
                'telefone' => '(11) 99999-9999',
                'senha' => 'admin123',
            ]
        ];

        foreach ($funcionarios as $f) {
            Funcionario::firstOrCreate(['email' => $f['email']], $f);
        }

        // 3. Clientes (clientes)
        $clientes = [
            [
                'nome' => 'Gabriel de Oliveira Silva',
                'email' => 'go742743@gmail.com',
                'telefone' => '88998655790',
                'cpf' => '056.261.583-08',
                'endereco' => 'Rua Anastacio Ferreira da Cunha, 602 - Centro',
                'senha' => '123456',
            ],
            [
                'nome' => 'Lucas Ferreira Lima',
                'email' => 'lucas.gamer@gmail.com',
                'telefone' => '(11) 97777-3333',
                'cpf' => '123.456.789-00',
                'endereco' => 'Av. Paulista, 1000, Apto 42 - Bela Vista, São Paulo - SP',
                'senha' => '123456',
            ],
            [
                'nome' => 'Mariana Costa Souza',
                'email' => 'mariana.costa@hotmail.com',
                'telefone' => '(21) 96666-4444',
                'cpf' => '987.654.321-11',
                'endereco' => 'Rua das Flores, 350 - Copacabana, Rio de Janeiro - RJ',
                'senha' => '123456',
            ],
            [
                'nome' => 'Rodrigo Mendes',
                'email' => 'rodrigo.tech@outlook.com',
                'telefone' => '(31) 95555-5555',
                'cpf' => '456.789.123-22',
                'endereco' => 'Rua Afonso Pena, 820 - Savassi, Belo Horizonte - MG',
                'senha' => '123456',
            ],
        ];

        $clienteIds = [];
        foreach ($clientes as $c) {
            $cliente = Cliente::firstOrCreate(['email' => $c['email']], $c);
            $clienteIds[] = $cliente->id;
        }

        // 4. Produtos (produtos)
        $produtos = [
            [
                'nome' => 'Monitor Gamer ASUS TUF Gaming 24.5" Full HD 200Hz 0.3ms Fast IPS',
                'categoria' => 'Monitores Gamer',
                'status' => 'ativo',
                'destaque' => 1,
                'oferta' => 1,
                'preco_antigo' => 1499.90,
                'preco' => 1199.90,
                'preco_pix' => 1079.91,
                'preco_parcelado' => 1199.90,
                'parcelas' => 10,
                'estoque' => 25,
                'descricao' => 'O Monitor Gamer ASUS TUF Gaming VG259Q5A oferece taxa de atualização ultra-rápida de 200Hz e tempo de resposta de 0.3ms com painel Fast IPS. Compatível com FreeSync Premium e G-Sync Compatible, HDR10 e alto-falantes embutidos para máxima imersão.',
                'imagem' => '1780072512_1.webp',
                'imagem2' => '1780072512_2.webp',
                'imagem3' => '1780072512_3.webp',
                'imagem4' => '1780072512_4.webp',
                'imagem5' => '1780072512_5.webp',
            ],
            [
                'nome' => 'Monitor Gamer Curvo Odyssey G5 34" UltraWide WQHD 165Hz 1ms',
                'categoria' => 'Monitores Gamer',
                'status' => 'ativo',
                'destaque' => 1,
                'oferta' => 1,
                'preco_antigo' => 3299.00,
                'preco' => 2699.00,
                'preco_pix' => 2429.10,
                'preco_parcelado' => 2699.00,
                'parcelas' => 12,
                'estoque' => 14,
                'descricao' => 'Monitor Samsung Odyssey G5 de 34 polegadas UltraWide com curvatura 1000R pioneira. Resolução WQHD nítida, taxa de 165Hz, HDR10 e tecnologia AMD FreeSync Premium para gameplay cinematográfico.',
                'imagem' => '1780072968_1.webp',
                'imagem2' => '1780072968_2.webp',
                'imagem3' => '1780072968_3.webp',
                'imagem4' => '1780072968_4.webp',
                'imagem5' => '1780072968_5.webp',
            ],
            [
                'nome' => 'Monitor Profissional Dell UltraSharp 27" 4K UHD USB-C IPS Black',
                'categoria' => 'Monitores Profissionais',
                'status' => 'ativo',
                'destaque' => 1,
                'oferta' => 0,
                'preco_antigo' => 4599.00,
                'preco' => 4199.00,
                'preco_pix' => 3899.00,
                'preco_parcelado' => 4199.00,
                'parcelas' => 12,
                'estoque' => 8,
                'descricao' => 'Monitor Dell UltraSharp U2723QE com tecnologia IPS Black pioneira, 98% DCI-P3, resolução 4K UHD, hub USB-C com entrega de energia de até 90W e suporte ergonômico articulado.',
                'imagem' => '1780106173_1.webp',
                'imagem2' => '1780106173_2.webp',
                'imagem3' => '1780106173_3.webp',
                'imagem4' => '1780106173_4.webp',
                'imagem5' => '1780106173_5.webp',
            ],
            [
                'nome' => 'Monitor Home-Office LG 24" Full HD IPS com Bordas Ultrafinas',
                'categoria' => 'Monitores Home-Office',
                'status' => 'ativo',
                'destaque' => 0,
                'oferta' => 1,
                'preco_antigo' => 899.00,
                'preco' => 649.90,
                'preco_pix' => 584.91,
                'preco_parcelado' => 649.90,
                'parcelas' => 6,
                'estoque' => 30,
                'descricao' => 'Excelente para trabalho e produtividade no dia a dia. Painel IPS com cores fiéis em ângulos amplos de 178°, ajuste de inclinação, tecnologia Flicker Safe e Reader Mode para conforto visual prolongado.',
                'imagem' => '1780106254_1.webp',
                'imagem2' => '1780106254_2.webp',
                'imagem3' => '1780106254_3.webp',
                'imagem4' => '1780106254_4.webp',
                'imagem5' => '1780106254_5.webp',
            ],
            [
                'nome' => 'Smart Monitor Samsung M5 27" Full HD com Wi-Fi, Bluetooth e Tizen',
                'categoria' => 'Monitores Smart',
                'status' => 'ativo',
                'destaque' => 1,
                'oferta' => 0,
                'preco_antigo' => 1799.00,
                'preco' => 1499.00,
                'preco_pix' => 1349.10,
                'preco_parcelado' => 1499.00,
                'parcelas' => 10,
                'estoque' => 12,
                'descricao' => 'O Smart Monitor M5 combina a eficiência de um monitor com entretenimento completo. Assista Netflix, YouTube e Prime Video diretamente sem precisar de PC. Suporte a Apple AirPlay e controle remoto incluso.',
                'imagem' => '1780106455_1.webp',
                'imagem2' => '1780106455_2.webp',
                'imagem3' => '1780106455_3.webp',
                'imagem4' => '1780106455_4.webp',
                'imagem5' => '1780106455_5.webp',
            ],
            [
                'nome' => 'Monitor Portátil ASUS ZenScreen 15.6" Full HD USB Type-C',
                'categoria' => 'Monitores Portateis',
                'status' => 'ativo',
                'destaque' => 0,
                'oferta' => 0,
                'preco_antigo' => 1999.00,
                'preco' => 1699.00,
                'preco_pix' => 1529.10,
                'preco_parcelado' => 1699.00,
                'parcelas' => 10,
                'estoque' => 9,
                'descricao' => 'Leveza e mobilidade para quem trabalha em trânsito. Pesa apenas 780g com espessura de 8mm. Conexão híbrida via cabo USB Type-C para transmissão de vídeo e alimentação combinadas.',
                'imagem' => '1780107714_1.webp',
                'imagem2' => '1780107714_2.webp',
                'imagem3' => '1780107714_3.webp',
                'imagem4' => '1780107714_4.webp',
                'imagem5' => '1780107714_5.webp',
            ],
            [
                'nome' => 'Teclado Mecânico Gamer RGB Switch Red ABNT2',
                'categoria' => 'Periféricos',
                'status' => 'ativo',
                'destaque' => 0,
                'oferta' => 1,
                'preco_antigo' => 389.00,
                'preco' => 279.90,
                'preco_pix' => 251.91,
                'preco_parcelado' => 279.90,
                'parcelas' => 4,
                'estoque' => 45,
                'descricao' => 'Teclado mecânico de alta precisão com switches lineares Red silenciosos e rápidos. Iluminação RGB customizável por tecla, padrão ABNT2 com Ç e keycaps double-shot resistentes.',
                'imagem' => '1780107845_1.webp',
                'imagem2' => '1780107845_2.webp',
                'imagem3' => '1780107845_3.webp',
                'imagem4' => '1780107845_4.webp',
                'imagem5' => '1780107845_5.webp',
            ],
            [
                'nome' => 'Mouse Gamer Ergonômico 16000 DPI Sensor Óptico RGB',
                'categoria' => 'Periféricos',
                'status' => 'ativo',
                'destaque' => 0,
                'oferta' => 0,
                'preco_antigo' => 249.00,
                'preco' => 189.90,
                'preco_pix' => 170.91,
                'preco_parcelado' => 189.90,
                'parcelas' => 3,
                'estoque' => 35,
                'descricao' => 'Mouse gamer ultraleve com sensor óptico avançado de até 16.000 DPI ajustáveis. 6 botões programáveis, switches mecânicos com durabilidade de 50 milhões de cliques e cabo paracord flexível.',
                'imagem' => '1780108002_1.webp',
                'imagem2' => '1780108002_2.webp',
                'imagem3' => '1780108002_3.webp',
                'imagem4' => '1780108002_4.webp',
                'imagem5' => '1780108002_5.webp',
            ],
            [
                'nome' => 'Braço Articulado a Gás para Monitor 17" a 35" VESA',
                'categoria' => 'Acessórios',
                'status' => 'ativo',
                'destaque' => 1,
                'oferta' => 1,
                'preco_antigo' => 399.00,
                'preco' => 299.90,
                'preco_pix' => 269.91,
                'preco_parcelado' => 299.90,
                'parcelas' => 5,
                'estoque' => 20,
                'descricao' => 'Suporte articulado de pistão a gás com rotação de 360°, inclinação vertical de +90°/-45° e ajuste suave de altura. Suporta monitores de até 9kg com padrão VESA 75x75 e 100x100mm.',
                'imagem' => '1780111927_1.webp',
                'imagem2' => '1780111927_2.webp',
                'imagem3' => '1780111927_3.webp',
                'imagem4' => '1780111927_4.webp',
                'imagem5' => '1780111927_5.webp',
            ],
            [
                'nome' => 'Cabo DisplayPort 1.4 8K 60Hz / 4K 144Hz 2 Metros',
                'categoria' => 'Acessórios',
                'status' => 'ativo',
                'destaque' => 0,
                'oferta' => 0,
                'preco_antigo' => 99.00,
                'preco' => 69.90,
                'preco_pix' => 62.91,
                'preco_parcelado' => 69.90,
                'parcelas' => 1,
                'estoque' => 50,
                'descricao' => 'Cabo DisplayPort 1.4 de alta velocidade com largura de banda de 32.4 Gbps. Suporte a resoluções até 8K a 60Hz ou 4K a 144Hz/240Hz com HDR dinâmico e conectores banhados a ouro.',
                'imagem' => '1780112333_1.webp',
                'imagem2' => '1780112333_2.webp',
                'imagem3' => '1780112333_3.webp',
                'imagem4' => '1780112333_4.webp',
                'imagem5' => '1780112333_5.webp',
            ],
            [
                'nome' => 'Luminária de Monitor ScreenBar LED com Sensor Touch e Temperatura de Cor',
                'categoria' => 'Acessórios',
                'status' => 'ativo',
                'destaque' => 1,
                'oferta' => 0,
                'preco_antigo' => 299.00,
                'preco' => 219.90,
                'preco_pix' => 197.91,
                'preco_parcelado' => 219.90,
                'parcelas' => 3,
                'estoque' => 18,
                'descricao' => 'Barra de luz LED assimétrica projetada para iluminar a mesa de trabalho sem reflexos na tela do monitor. Ajuste contínuo de brilho e 3 modos de temperatura de cor (quente, neutro e frio).',
                'imagem' => '1780112866_1.webp',
                'imagem2' => '1780112866_2.webp',
                'imagem3' => '1780112866_3.webp',
                'imagem4' => '1780112866_4.webp',
                'imagem5' => '1780112866_5.webp',
            ],
            [
                'nome' => 'Monitor Gamer Alienware 27" Fast IPS QHD 280Hz 0.5ms HDR600',
                'categoria' => 'Monitores Gamer',
                'status' => 'ativo',
                'destaque' => 1,
                'oferta' => 0,
                'preco_antigo' => 4199.00,
                'preco' => 3799.00,
                'preco_pix' => 3419.10,
                'preco_parcelado' => 3799.00,
                'parcelas' => 12,
                'estoque' => 7,
                'descricao' => 'Performance de nível de esports profissional. Painel Fast IPS de 27 polegadas com resolução QHD (2560x1440), taxa de atualização insana de até 280Hz e cobertura de cor DCI-P3 95%.',
                'imagem' => '1780106112_1.webp',
                'imagem2' => '1780106112_2.webp',
                'imagem3' => '1780106112_3.webp',
                'imagem4' => '1780106112_4.webp',
                'imagem5' => '1780106112_5.webp',
            ]
        ];

        foreach ($produtos as $p) {
            $prod = Produto::firstOrCreate(['nome' => $p['nome']], $p);

            // 5. Avaliações de exemplo para os produtos
            if (!empty($clienteIds)) {
                Avaliacao::firstOrCreate(
                    [
                        'produto_id' => $prod->id,
                        'cliente_id' => $clienteIds[0],
                    ],
                    [
                        'nota' => 5,
                        'comentario' => 'Produto espetacular! Qualidade de imagem incrível e entrega super rápida. Recomendo muito!',
                    ]
                );

                if (count($clienteIds) > 1) {
                    Avaliacao::firstOrCreate(
                        [
                            'produto_id' => $prod->id,
                            'cliente_id' => $clienteIds[1],
                        ],
                        [
                            'nota' => 5,
                            'comentario' => 'Excelente custo-benefício. Superou todas as minhas expectativas no setup!',
                        ]
                    );
                }
            }
        }
    }
}
