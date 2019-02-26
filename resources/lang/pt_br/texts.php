<?php

    return [
        'passo1' => [
            'passo' => 'Passo 1/3: Escolhendo os Corpora.',
            'texto1' => 'Abaixo estão listados os corpora que compõem o CorTec.',
            'texto2' => 'Selecione os corpora que deseja pesquisar:',
            'lista' => 'Lista de Corpora',
            'lingua' => 'Língua',
            'lingua1' => 'Português',
            'lingua2' => 'Inglês',
        ],
        'passo2' => [
            'passo' => 'Passo 2/3: Escolhendo a Ferramenta.',
            'texto1' => 'Selecione abaixo a ferramenta a ser aplicada:',
            'lista' => 'Lista de Ferramentas'
        ],
        'passo3' => [
            'concord' => [
                'passo' => 'Passo 3/3: Aplicando a Ferramenta sobre o Corpus.',
                'texto1' => 'Configure a ferramenta usando as opções abaixo:',
                'ferramenta' => 'Concordanciador',
                'campo1' => 'Expressão ou Palavra',
                'campo1_1' => 'Igual a',
                'campo1_2' => 'Começando com',
                'campo1_3' => 'Terminando com',
                'campo1_4' => 'Contendo',
                'campo2' => 'Diferenciar maiúsculas e minúsculas',
                'campo3' => 'Tamanho do contexto reduzido (caracteres):',
            ],
        ],
        'lista_palavras' => [
            'tabela' => [
                'head1' => 'Dados estatísticos',
                'types'  => 'Palavras únicas/formas (types)',
                'total1' => 'Total de ocorrências/ palavras corridas (tokens)',
                'total2' => 'Total de palavras distintas (types)',
                'header1' => 'Palavras que aparecem uma única vez',
                'header2' => 'Palavras que aparecem mais de uma vez',
                'head2' => 'Índice Vocabular (token/type ratio)',
                'ratio' => 'Token/Type',
                'header2_1' => 'Posição',
                'header2_2' => 'Palavra',
                'header2_3' => 'Frequência',
                'head3' => 'Tabela de Frequência',
                'download' => 'Download da Tabela',
            ],
        ],
        'concord' => [
            'texto1' => 'Foram encontradas :count ocorrências!!',
            'texto2' => 'Clique na palavra de busca para obter um contexto expandido com 150 caracteres.',
            'download1' => 'com contexto reduzido',
            'download2' => 'com contexto expandido',
            'thead1' => 'Ocorrência',
            'ferramenta' => 'Concordanciador',
        ],
        'ngrams' => [
            'header1'    => 'Passo 3/3: Aplicando a Ferramenta sobre o Corpus.',
            'header2'    => 'Configure a ferramenta usando as opções abaixo:',
            'ferramenta' => 'Gerador de N-Gramas',
            'label1'     => 'Tamanho dos n-gramas:',
            'label2'     => 'Incluir estatísticas de associação: (Disponível para bigramas e trigramas, somente)',
            'option2_1'  => 'Nenhuma',
            'label3'     => 'Deseja utilizar uma Stoplist?',
            'option3_1'  => 'Padrão',
            'option3_2'  => 'Particular',
            'label3_1'   => '(.txt com uma palavra por linha e sem separador)',
            'label4'     => 'Cortar os itens com frequência menor a:',
            'tabela'     => [
                'title'    => 'Tabela de N-gramas',
                'download' => 'Download da tabela',
                'header1'  => 'Posição',
                'header2'  => 'N-grama',
                'header3_1'  => 'Frequência',
                'header3_2'  => [
                    'tmi'         => 'Valor de True Mutual Information',
                    'pmi'         => 'Valor de Pointwise Mutual Information',
                    'dice'        => 'Valor de Dice',
                    'll'          => 'Valor de Log-Likelihood',
                    'x2'          => 'Valor de Chi-Square Test',
                    'leftFisher'  => 'Valor de Left-Fisher Test of Associativity',
                    'rightFisher' => 'Valor de Right-Fisher Test of Associativity',
                    'pmi'         => 'Valor de T-Score',
                    'phi'         => 'Valor de Phi Coefficient',
                    'odds'        => 'Valor de Odds Ratio',
                ]
            ],
        ],
        'categorias' => [
            'texto1' => 'Sobre os Corpora',
            'texto2' => 'Esta categoria de Corpora é constituída de :count corpora comparáveis, ou seja, com textos semelhantes, em inglês e português originais, nas seguintes áreas:',
            'texto3' => 'Cada corpus técnico é composto por aproximadamente 200.000 palavras em cada língua.',
            'texto4' => 'Estão disponíveis três ferramentas que podem ser aplicadas a um ou mais corpora ao mesmo tempo. São elas:',
            'concordanciador' => 'Concordanciador',
            'gerador1' => 'Gerador de Lista de Palavras',
            'gerador2' => 'Gerador de N-Gramas',
            'ocorrencias' => 'Ocorrências/tokens',
            'formas' => 'Formas/types',
            'ratio' => 'T/T ratio',
        ],
        'changes' => [
            'usuario' => 'Usuário',
            'entidade_id' => 'ID da Entidade',
            'entidade_tipo' => 'Tipo de Entidade',
            'entidade_nome' => 'Nome da Entidade',
            'operacao' => 'Operação',
            'data' => 'Data/Hora',
            'categoria' => 'Categoria',
            'corpus' => 'Corpus',
            'text' => 'Texto',
            'criado' => 'Criado',
            'modificado' => 'Modificado',
            'removido' => 'Removido',
        ]
    ];
