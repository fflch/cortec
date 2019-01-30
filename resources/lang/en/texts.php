<?php

    return [
        'passo1' => [
            'passo' => 'Step 1/3: Corpus selection.',
            'texto1' => 'Select which one(s) you want to work on.',
            'lista' => 'List of Corpora',
            'lingua' => 'Language',
            'lingua1' => 'Portuguese',
            'lingua2' => 'English',
        ],
        'passo2' => [
            'passo' => 'Step 2/3: Select your tool.',
            'texto1' => '',
            'lista' => 'List of Tools'
        ],
        'lista_palavras' => [
            'tabela' => [
                'head1' => 'Statistical data',
                'types'  => 'Types',
                'total1' => 'Total of tokens',
                'total2' => 'Total of types',
                'header1' => 'Types which occur only once',
                'header2' => 'Types which occur more than once',
                'head2' => 'Type/token ratio',
                'ratio' => 'Type/token',
                'header2_1' => 'Position',
                'header2_2' => 'Word',
                'header2_3' => 'Frequency',
                'head3' => 'Frequency Table',
                'download' => 'Download Table',
            ],
        ],
        'passo3' => [
            'concord' => [
                'passo' => 'Step 3/3: Applying Tool to Corpus.',
                'texto1' => 'Select the tool according to the options below:',
                'ferramenta' => 'Concordancer',
                'campo1' => 'Expression or word',
                'campo1_1' => 'Same as',
                'campo1_2' => 'Starting with',
                'campo1_3' => 'Ending in',
                'campo1_4' => 'Containing',
                'campo2' => 'Case sensitive',
                'campo3' => 'Size of reduced context (in characters):',
            ]
        ],
        'concord' => [
            'texto1' => ':count occurrences has been found!!',
            'texto2' => 'Click on search word to obtain expanded context (150 characters).',
            'download1' => 'with reduced context',
            'download2' => 'with expanded context',
            'thead1' => 'Occurrence',
            'ferramenta' => 'Concordancer',
        ],
        'categorias' => [
            'texto1' => 'Corpora in',
            'texto2' => 'This categoryis made up of :count comparable corpora, that is, collections of similar texts in authentic English and Portuguese in the following areas:',
            'texto3' => 'Each corpus totals about 200,000 words in each language.',
            'texto4' => 'There are three tools which can be applied to one or more corpora at the same time:',
            'concordanciador' => 'Concordancer',
            'gerador1' => 'Frequency Counters',
            'gerador2' => 'N-Gram Generator',
            'ocorrencias' => 'Tokens',
            'formas' => 'Types',
            'ratio' => 'T/T ratio',
        ],
        'changes' => [
            'usuario' => 'User',
            'entidade_id' => 'Entity ID',
            'entidade_tipo' => 'Entity Type',
            'entidade_nome' => 'Entity Name',
            'operacao' => 'operation',
            'data' => 'Date/Time',
            'categoria' => 'Category',
            'corpus' => 'Corpus',
            'text' => 'Text',
            'criado' => 'Created',
            'modificado' => 'Modified',
            'removido' => 'Removed',
        ]
    ];
