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
          'tokens' => 'Ocorrências (tokens)',
          'types'  => 'Palavras únicas/formas (types)',
          'total1' => 'Total de Ocorrências',
          'total2' => 'Total de Palavras',
          'header1' => 'que aparecem uma vez',
          'header2' => 'que aparecem mais de uma vez',
          'header3' => 'Índice Vocabular (token/type ratio)',
          'ratio' => 'Token/Type',
          'header2_1' => 'Posição',
          'header2_2' => 'Palavra',
          'header2_3' => 'Frequência',
          'header3' => 'Tabela de Frequência',
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
      ]
  ];
