# Roteiro de Refatoração - Projeto SimplePage


## Objetivo
Refatorar o projeto mantendo a estrutura simples, modernizar o visual (admin e site), adicionar upload de imagem e exibir na Home. Utilizar a base de dados já existente.

---

## Passos da Refatoração

1. **Refatorar conexão com banco**
   - Trocar MySQLi por PDO para maior segurança e flexibilidade.
2. **Centralizar funções utilitárias**
   - Criar arquivo para funções comuns (ex: conexão, CRUD).
3. **Adicionar upload de imagem**
   - Permitir upload de imagem no administrativo (ex: Home ou usuários).
   - Salvar caminho da imagem no banco.
4. **Exibir imagem na Home**
   - Mostrar imagem cadastrada na página principal do site.
5. **Melhorar visual com Bootstrap**
   - Atualizar layout do admin e da Home, mantendo SinglePage.
6. **Testar todas as funcionalidades**
   - Garantir simplicidade e funcionamento.
7. **Documentar o projeto**
   - Após refatoração, criar documentação bilingue (PT/EN) para o GitHub.

---

## Orientações para documentação futura

- Após a refatoração, crie um arquivo `README.md` bilingue (Português/Inglês) para o GitHub.
- Inclua instruções de instalação, uso, estrutura do projeto e exemplos de uso.
- Siga o padrão do CRUD desenvolvido anteriormente.

---

---------------------------------------------------------------------------------------------
Resumo das Refatorações e Melhorias
Backend (PHP)
Migração para PDO: Todo o acesso ao banco de dados foi refatorado para utilizar PDO.
Centralização de Funções: Funções utilitárias de banco e validação foram centralizadas em funcoes.php.
CRUD de Usuários Modernizado: Os módulos de cadastro, edição, listagem e visualização de usuários foram atualizados para usar apenas os campos reais do banco (nome, email, senha, status, nivel, imagem).
Remoção de Legados: Eliminação de referências a tabelas e campos antigos como situacoes, niveis_acessos, etc.
Upload de Imagem: Implementação do upload de imagem para usuários, com validação de extensão.
Organização das Imagens: As imagens dos usuários são salvas em pastas individuais por ID: adm/assets/imagens/usuarios/{ID}/foto.ext.
Atualização de Imagem: Ao editar o usuário, é possível substituir a imagem, removendo a anterior automaticamente do diretório do usuário.
Exibição Correta: Ajuste dos caminhos para exibir as imagens corretamente nas páginas de listagem, edição e visualização.

Banco de Dados
Alinhamento de Estrutura: O sistema foi ajustado para funcionar apenas com os campos e tabelas realmente existentes.
Campo de Imagem: Adição do campo imagem na tabela usuarios para armazenar o nome do arquivo da foto.
Outros
Código Limpo e Organizado: Remoção de duplicidades, comentários desnecessários e padronização de nomenclaturas.
Documentação: Este resumo foi gerado para facilitar o entendimento das principais mudanças e servir como base para futuras manutenções.

Exclusão Completa:
Ao apagar um usuário, o sistema também remove automaticamente a pasta do usuário (com o ID) e todas as imagens associadas do servidor. Isso garante que não fiquem arquivos órfãos após a exclusão do registro.
---------------------------------------------------------------------------------------------
Próximos Passos da Refatoração
Refatoração do Site Público:
Modernizar o frontend do site principal, aplicando boas práticas de HTML, CSS (Bootstrap) e JavaScript.
Garantir responsividade e melhor experiência para o usuário final.

Padronização de Layout:
Unificar o visual entre o admin e o site público, mantendo identidade visual e usabilidade.

Otimização de Performance:
Revisar carregamento de páginas, imagens e recursos para garantir rapidez e eficiência.

Segurança:
Implementar validações extras, proteção contra SQL Injection, XSS e CSRF no site público.

Documentação Completa:
Finalizar documentação técnica e de uso para facilitar manutenção e onboarding de novos colaboradores.

Testes:
Realizar testes funcionais e de usabilidade em todas as áreas do sistema.

## Contato
Dúvidas ou sugestões: robson-luiz (GitHub)
