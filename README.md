# Sistema de Controle

O Sistema de Controle é uma ferramenta fácil de usar, projetada para gerenciar e controlar informações em uma instituição. Com recursos de gerenciamento de usuários,
cadastro de professores, diretores, entre outras além de geração de novas turmas e geração de relatórios, o Sistema de Controle ajuda a otimizar processos e tomar decisões informadas. O sistema foi desenvolvido utilizando uma variedade de tecnologias, incluindo PHP, HTML, CSS, Bootstrap, JavaScript, Composer e SQL

## Principais funcionalidades

Gerenciamento de Usuários: O sistema permite cadastrar usuários, fazer login e redefinir senhas. A autenticação e autorização garantem a segurança das informações, permitindo diferentes níveis de acesso aos recursos do sistema.

Cadastro de Professores: É possível cadastrar e gerenciar informações detalhadas dos professores. Os seguintes dados podem ser registrados para cada professor:

- Nome
- Matrícula
- Tipo (P1 ou P2)
- Componente (área de atuação)
- Status da Matrícula (ativo, licença médica, exoneração, etc.)
- Nome Permutado (caso haja permuta)
- Data de Início e Data de Vencimento (caso necessário)
- Atuação (Sala de Aula, Direção, Sala de Recursos, etc.)
- Nome da Escola
- Turno e Turma
- Outras Contratações (opcional)
- Outra Escola, Outra Turma e Outro Turno (opcional)

Visualização e Edição de Professores: É possível visualizar os detalhes de cada professor cadastrado, incluindo todas as informações registradas. Além disso, o sistema permite editar essas informações, possibilitando a atualização dos dados conforme necessário.

Exclusão de Professores: Existe a opção de excluir um professor do sistema. Ao selecionar essa opção, o professor e todas as informações relacionadas a ele são removidas permanentemente do sistema.

Geração de Relatórios: O sistema oferece a funcionalidade de filtrar os dados escolhidos e gerar relatórios personalizados em formato de planilha. Esses relatórios podem fornecer insights valiosos sobre os dados armazenados no sistema, facilitando a análise e tomada de decisões estratégicas.

### Tecnologias Utilizadas
O Sistema de Controle foi desenvolvido utilizando as seguintes tecnologias:

- `PHP`: Linguagem de programação utilizada para desenvolver a lógica do sistema.
- `HTML`: Linguagem de marcação para estruturar a interface do usuário.
- `CSS`: Linguagem de estilização para melhorar o design e a aparência do sistema.
- `Bootstrap`: Framework CSS utilizado para criar um layout responsivo e facilitar o desenvolvimento do front-end.
- `JavaScript`: Linguagem de programação utilizada para adicionar interatividade e funcionalidades dinâmicas ao sistema.
- `Composer`: Gerenciador de dependências para o PHP, usado para facilitar a inclusão de bibliotecas e pacotes externos.
- `SQL`: Linguagem de consulta estruturada usada para interagir com o banco de dados.

## Instalação e Configuração
- Faça o download do repositório do Sistema de Controle do GitHub.
- Certifique-se de ter instalado e configurado o ambiente de desenvolvimento PHP em seu servidor web.
- Crie um banco de dados MySQL e importe o arquivo de script SQL fornecido para criar as tabelas necessárias.
- Configure as informações de conexão com o banco de dados no arquivo de configuração do sistema.
- Inicie o servidor web e acesse o sistema através do navegador.

## Uso
- Faça o registro e login com suas credenciais de usuário.
- Explore as diferentes funcionalidades do sistema:
- Cadastre e gerencie informações dos professores.
- Gere relatórios personalizados com base nos dados armazenados.
- Atualize ou exclua informações conforme necessário.
- Utilize os filtros disponíveis para segmentar as informações e gerar relatórios mais específicos.
- Exporte os relatórios gerados em formato Excel para análise externa ou compartilhamento.

## Contribuição
Se você encontrar algum bug ou tiver sugestões de melhorias, sinta-se à vontade para abrir uma issue no repositório.
Caso queira contribuir com código, envie um pull request com suas alterações propostas.
