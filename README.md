Torneio de Videokê

Das vagas e inscrição

Não há limite de idade para inscrição, mas menores de 18 anos deverão entregar a organização autorização por escrito de um responsável.

Não haverá diferenciação por sexo, nem divisão de categoria ou idade. Todos concorrem em igualdade.

As inscrições deverão ser feitas unicamente através do site divulgado pela organização.

Serão disponibilizadas um número determinado de vagas individuais.

Os candidatos serão aceitos por ordem de inscrição através do site divulgado pela organização.

As inscrições são gratuítas


Das listas de músicas

Cada candidato deverá escolher e indicar previamente 4 músicas de uma das listas fornecidas pela organização. Estas não poderão ser trocadas.

O candidato só poderá repetir uma música na final.

As músicas devem ser escolhidas da lista principal de canções fornecida pela organização


Das fases

Primeira fase - Os candidatos se dividem em 2 grupos com com números iguais de membros, onde cada um canta uma música alternadamente entre os grupos.

Nessa fase serão eliminados metade dos candidatos de cada grupo que tiverem as menores notas.

Segunda fase - Os candidatos serão divididos em duplas e disputarão entre si cantando uma música cada.

Nessa fase será eliminado os candidatos entre os perdedores de cada dupla.

Terceira fase (Final) - Cada candidato cantará uma música, será declarado campeão o candidato com maior pontuação enter os cinco. O segundo colocado será o próximo com maior pontuação, seguido pelo terceiro colocado.

Caso haja empate na pontuação geral em qualquer uma das fases, será critério de desempate a maior nota no quisito VOZ E AFINAÇÃO.

Persistindo o empate, o próximo critério será o quisito RITMO E TEMPO. Persistindo novamente o empate, serão adotados os quesitos seguinte na ordem: INTERPRETAÇÃO, PRESENÇA EM PALCO e NOTA DO APARELHO.


Critérios de avaliação e notas
(atualizaçaõ) estou pensando em uma forma de poder escolher quais critérios irá gerar as notas, sendo possível escolher os critérios abaixo, com jurados ou deixar somente a nota do próprio aparelho como critério.

VOZ E AFINAÇÃO
Tem em conta não só as capacidades vocais do concorrente, mas também o timbre e a forma como coloca a voz a cantar e respectiva afinação.

RITMO E TEMPO
Tem em conta a forma como o concorrente coloca a melodia no tempo do tema, ou seja, a marcação correcta (ou não) das frases musicais.

INTERPRETAÇÃO
Tem em conta a forma como o concorrente sente e transmite vocalmente o tema que está a interpretar, ou seja, a emoção que transmite na sua actuação.

PRESENÇA EM PALCO 
Tem em conta a forma como o concorrente se exibe no palco e a sua interacção com a audiência. São aspectos positivos a forma como se movimenta, o olhar para a audiência, os gestos adequados, sempre de acordo com o tema que canta. São aspectos negativos a permanência estática e as mãos nos bolsos.

NOTA DO APARELHO
O aparelho utiliza um sistema próprio que analiza alguns dos critérios anteriores e pontua de 0 a 100. Utiliza também um sitema de dificuldade para elevar o grau de pontuação, onde Alto dá uma melhor pontuação, Médio dá uma pontuação mediana e Baixa dá uma pontuação baixa, o que exige que o candidato se esforce mais para poder obter notas altas. O sistema usado nesse torneio será o Baixa.




Cada candidato receberá 5 notas, sendo VOZ E AFINAÇÃO, RITMO E TEMPO, INTERPRETAÇÃO e PRESENÇA EM PALCO, cada uma valendo de 5 a 10 pontos, onde 5 é a menor pontuação e 10 a maior pontuação, podendo estes serem fracionado de meio em meio ponto, por exemplo, uma nota de 5.5 ou 7.5.

Também será critério de avaliação a NOTA DO APARELHO que vai de 0 a 100 divido por 10 e arrendado para números inteiros ou fracionados por meio ponto. Exemplo: Se a NOTA DO APARELHO for 89, divido por 10 é igual a 8.9. Arrendondado fica 8.5. Se a NOTA DO APARELHO for 82, divido por 10 fica 8.2. Arrendondado fica 8.5. Se a NOTA DO APARELHO for 80, divido por 10 fica 8. Nesse caso, um número inteiro e não será arredondado. Repare que se a fração passar de meio ponto, ela será arredondada para baixo, e se for menor de meio ponto, será arredondada para cima.

Cada candidato poderá descartar uma nota. 

A pontuação final será a soma das notas de todos os critérios divido pelo total de critério.

Por exemplo: se um candidato descartar a NOTA DO APARELHO, sua pontuação será média da soma dos quatro critérios restantes divido por quatro. Se não descartar nenhuma nota, a média será a soma dos cinco critérios divididos por cinco.


Dos jurados

4 jurados serão escolhidos pela organização seguindo critérios próprios e não ligados a parentesco dos candidatos.

Cada jurado ficará responsável por da nota em um dos critérios de avaliação.



Premiação
Do 1º ao 5º colocado a ser definida

Todos os participantes receberão certificados de participação.



Descrição das tabelas usadas no projeto

tb_candidato
idCandidato
nome
idade
data
situacao

tb_criterios
idCriterios
criterio
descricao

tb_jurados
idJurados
idCriterios
nome

bt_musicas
idMusicas
idCandidato
idListaPrincipal
idListaSecundaria

tb_lista_principal
idListaPrincipal
interprete
codigo
titulo
inicio
idioma

tb_lista_secundaria
idListaSecundaria
interprete
codigo
titulo
inicio
idioma

tb_fases
idFases
nome

tb_grupos
idGrupos
idCandidato

tb_duplas
idDuplas
idFases
idCandidato

tb_final
idFinal
idFases
idCandidato

tb_pontuacao
idPontuacao
idCandidato
idFases
idCriterios
pontos
