![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/fflch/cortec.svg)
![GitHub closed pull requests](https://img.shields.io/github/issues-pr-closed-raw/fflch/cortec.svg)

![GitHub issues](https://img.shields.io/github/issues/fflch/cortec.svg)
![GitHub closed issues](https://img.shields.io/github/issues-closed/fflch/cortec.svg)

## CorTec

O CorTec - Corpus Técnico-Científico - é um corpus comparável de textos técnicos e/ou científicos, originalmente escritos em português brasileiro e em inglês. Esse corpus é constituído por corpora compilados por alunos do extinto Curso de Especialização em Tradução e por pós-graduandos do programa de Estudos Linguísticos e Literários em Inglês, que os construíram para suas pesquisas. Sempre que possível, novos corpora são acrescentados.

A primeira versão do CorTec, lançada em setembro de 2005, teve o apoio financeiro do CNPq, processo no. 403120-03-9 e foi construída e implementada junto ao projeto CoMET em parceria com o NILC (Núcleo Interinstitucional de Lingüística Computacional), localizado no ICMC da USP de São Carlos, e o Projeto Lácio-Web.

A interface original e todas as ferramentas de pesquisa foram desenvolvidas e adaptadas para o Cortec por Marcos Felipe Tonelli de Carvalho, sob a coordenação da Profa. Dra. Sandra Maria Aluísio.

O CorTec conta atualmente com mais de 20 corpora, dos mais variados domínios. O tamanho de cada corpus varia segundo sua especificidade. Assim, o corpus de Magnéticos de Vazão tem xxx palavras em português e xxxx em inglês, enquanto o de Culinária conta com mais de um milhão de palavras em cada língua.

Clicando-se sobre o nome do corpus abre-se uma janela com detalhes sobre sua autoria, composição, número de palavras distintas (types) e ocorrências (tokens).

### Funcionalidades

**Funcionalidades abertas:**
-   Listagem de categorias de corporas e corporas.
-   Descrição de categorias de corporas e corporas.
-   Tabela com resumo analítico de cada corpora, com:    
	-   quantidade de ocorrências/tokens;        
	-   quantidade de formas/types;        
	-   token/type ratio.        
-   Análise de texto:
	-   Seleção de corporas e/ou categorias.        
	-   Seleção de idioma.        
	-   Seleção de ferramenta de análise de texto (Concordanciador, Gerador de Lista de Palavras, Gerador de N-Gramas).    

-   **Concordanciador**:    
	-   Busca de termo nos corporas selecionados com os parâmetros:        
		-   igual a, começando com, terminando com ou contendo;
		-   tamanho do contexto reduzido a ser exibido na listagem: 20, 30, 40, 50 ou 60 caracteres.        
  -   Compilação das ocorrências do termo encontradas com o respectivo contexto ajustado para o tamanho escolhido.
	  - Opção para download
  -   Compilação das ocorrências do termo encontradas com o respectivo contexto ampliado (150 caracteres).
	  - Opção para download

-   **Gerador de Lista de Palavras**:
	-   Tabela com todos os types dos corporas selecionados e os respectivos números de ocorrência (frequência).       
		-   Opção de ordenar a tabela por type (alfabética) e por frequência (nº de ocorrências);            
		-   Busca na tabela por type;            
		-   Opção de download da tabela.            
	-   Tabela de Tokens com: o total de ocorrências, quantidade de tokens que aparecem uma vez e que aparecem mais de uma vez.        
	-   Tabela de Types com: o total de palavras, quantidade de types que aparecem uma vez e que aparecem mais de uma vez.        
	-   Índice Vocabular (token/type ratio).

-   **Gerador de N-Gramas**    
	- Compilação do n-gramas de acordo com os parâmetros:
		- tamanho dos n-gramas, Stoplist (padrão ou inserir uma), limite mínimo.

**Funcionalidades administrativas:**
-   CRUD de Categorias.   
-   CRUD de Corpora.    
-   CRUD de Corpus.    
	-   Opção de digitar ou subir arquivo .txt.
