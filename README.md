# SimplePage - Sistema de Gestão de Conteúdo

[🇺🇸 English](README-EN.md)

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat-square&logo=javascript&logoColor=black)](https://developer.mozilla.org/docs/Web/JavaScript)

> Sistema completo de gerenciamento de conteúdo desenvolvido em PHP puro com painel administrativo responsivo e site institucional moderno.

## 📋 Índice

- [Sobre o Projeto](#-sobre-o-projeto)
- [Funcionalidades](#-funcionalidades)
- [Tecnologias Utilizadas](#-tecnologias-utilizadas)
- [Pré-requisitos](#-pré-requisitos)
- [Instalação](#-instalação)
- [Configuração](#-configuração)
- [Uso](#-uso)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Melhorias Implementadas (2025)](#-melhorias-implementadas-2025)
- [Contribuição](#-contribuição)
- [Licença](#-licença)
- [Autor](#-autor)

## 🎯 Sobre o Projeto

O **SimplePage** é um sistema de gestão de conteúdo (CMS) desenvolvido originalmente em 2017 e completamente refatorado em 2025. O projeto oferece uma solução completa para criação e gerenciamento de sites institucionais, com foco na simplicidade de uso e administração eficiente.

### 📸 Screenshots

#### 🌐 Site Público
<div align="center">
  <img src="https://raw.githubusercontent.com/robson-luiz/simplepage/master/screenshots/site_simplepage.png" alt="Homepage SimplePage" width="800">
  <br>
  <em>Página inicial com design moderno e responsivo</em>
</div>

#### 🖥️ Painel Administrativo
<div align="center">
  <img src="https://raw.githubusercontent.com/robson-luiz/simplepage/master/screenshots/admin_simplepage.png" alt="Dashboard SimplePage" width="800">
  <br>
  <em>Dashboard com design moderno</em>
</div>

### Histórico
- **2017**: Desenvolvimento inicial da estrutura básica
- **2025**: Refatoração completa com modernização tecnológica e implementação de novas funcionalidades

## ✨ Funcionalidades

### 🖥️ Painel Administrativo
- **Dashboard** com estatísticas em tempo real
- **Gerenciamento de Usuários** com diferentes níveis de acesso
- **CRUD de Serviços** com sistema de ordenação
- **Gerenciamento de Contatos** com sistema de status
- **Editor de Conteúdo** para páginas Home e Sobre
- **Upload de Imagens** com validação e organização automática
- **Sistema de Autenticação** seguro com sessões
- **Interface Responsiva** para todos os dispositivos

### 🌐 Site Público
- **Layout Responsivo** adaptável a qualquer dispositivo
- **Single Page Application** com navegação suave
- **Seção de Serviços** dinâmica e customizável
- **Formulário de Contato** com validação completa
- **Design Moderno** com animações e efeitos visuais
- **SEO Otimizado** com meta tags e estrutura semântica

### 🔧 Funcionalidades Técnicas
- **Arquitetura PDO** para segurança de banco de dados
- **Validação Dupla** (client-side e server-side)
- **Sistema de Logs** para auditoria
- **Organização Modular** de código
- **Tratamento de Erros** robusto
- **Prevenção de Vulnerabilidades** (SQL Injection, XSS, CSRF)

## 🛠 Tecnologias Utilizadas

### Backend
- **PHP 7.4+** - Linguagem de programação principal
- **PDO (PHP Data Objects)** - Interface de acesso ao banco de dados
- **MySQL 5.7+** - Sistema de gerenciamento de banco de dados

### Frontend
- **HTML5** - Estrutura semântica
- **CSS3** - Estilização avançada com Flexbox e Grid
- **JavaScript ES6+** - Interatividade e validações
- **Bootstrap 5.3** - Framework CSS responsivo
- **Font Awesome 6.4** - Biblioteca de ícones

### Ferramentas e Bibliotecas
- **TinyMCE** - Editor WYSIWYG para conteúdo
- **jQuery** - Manipulação DOM (compatibilidade)

## 📋 Pré-requisitos

Antes de iniciar, certifique-se de ter instalado:

- **Servidor Web** (Apache, Nginx)
- **PHP 7.4** ou superior com extensões:
  - PDO MySQL
  - GD Library (para manipulação de imagens)
  - mbstring
  - fileinfo
- **MySQL 5.7** ou superior / **MariaDB 10.2** ou superior
- **Composer** (opcional, para dependências futuras)

### Ambiente de Desenvolvimento Recomendado
- **XAMPP** / **LARAGON** / **WAMP** para Windows
- **LAMP** / **LEMP** para Linux
- **MAMP** para macOS

## 🚀 Instalação

### 1. Clone o Repositório
```bash
git clone https://github.com/robson-luiz/simplepage.git
cd simplepage
```

### 2. Configuração do Servidor Web
Aponte o servidor web para a pasta do projeto ou mova os arquivos para o diretório web raiz:

```bash
# Para Apache (Ubuntu/Debian)
sudo cp -r simplepage/ /var/www/html/

# Para XAMPP (Windows)
# Copie a pasta para C:\xampp\htdocs\

# Para LARAGON (Windows)
# Copie a pasta para C:\laragon\www\
```

### 3. Configuração do Banco de Dados

#### Criação do Banco
```sql
CREATE DATABASE simplepage CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### Importação das Tabelas
```bash
mysql -u seu_usuario -p simplepage < simplepage.sql
```

Ou através do phpMyAdmin:
1. Acesse o phpMyAdmin
2. Selecione o banco `simplepage`
3. Importe o arquivo `simplepage.sql`

### 4. Configuração da Conexão
Edite o arquivo `adm/conexao/conexao.php`:

```php
<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'simplepage');
define('DB_USER', 'seu_usuario');
define('DB_PASS', 'sua_senha');
define('DB_CHARSET', 'utf8mb4');
?>
```

### 5. Configuração de Permissões
```bash
# Definir permissões corretas (Linux/macOS)
chmod -R 755 simplepage/
chmod -R 777 simplepage/adm/assets/imagens/
```

## ⚙️ Configuração

### Configurações Básicas

#### Usuário Administrador Padrão
- **Email**: `admin@simplepage.com`
- **Senha**: `123456`

> ⚠️ **Importante**: Altere as credenciais padrão imediatamente após a primeira instalação!

#### Estrutura de Pastas de Upload
```
adm/assets/imagens/
├── usuarios/
│   ├── 1/
│   ├── 2/
│   └── ...
└── temp/
```

### Configurações Avançadas

#### Configuração de Upload
No arquivo `includes/funcoes.php`, você pode ajustar:
- Tamanho máximo de arquivo
- Tipos de arquivo permitidos
- Qualidade de compressão

```php
// Configurações de upload (exemplo)
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif']);
```

## 💻 Uso

### Acesso ao Sistema

#### Site Público
```
http://localhost/simplepage/
```

#### Painel Administrativo
```
http://localhost/simplepage/adm/
```

### Primeiros Passos

1. **Acesse o painel administrativo** com as credenciais padrão
2. **Altere a senha** do usuário administrador
3. **Configure o conteúdo** das páginas Home e Sobre
4. **Cadastre os serviços** da empresa/organização
5. **Teste o formulário de contato**
6. **Ajuste o design** conforme necessário

### Gerenciamento de Usuários

#### Níveis de Acesso
- **Admin**: Acesso completo ao sistema
- **Editor**: Acesso limitado para edição de conteúdo
- **Visualizador**: Apenas visualização (funcionalidade futura)

#### Cadastro de Usuários
1. Acesse **Usuários > Cadastrar**
2. Preencha os dados obrigatórios
3. Selecione o nível de acesso
4. Faça upload da foto (opcional)

### Gerenciamento de Conteúdo

#### Edição de Páginas
- **Home**: Configure banner, texto de apresentação e chamadas
- **Sobre**: Defina a história e informações da empresa

#### Gerenciamento de Serviços
- Cadastre serviços com ícones do Font Awesome
- Defina ordem de exibição
- Configure status (ativo/inativo)

#### Sistema de Contatos
- Visualize mensagens recebidas
- Marque como lida/respondida
- Organize com sistema de status

## 📁 Estrutura do Projeto

```
simplepage/
├── 📁 adm/                          # Painel administrativo
│   ├── 📁 administrador/            # Módulos administrativos
│   │   ├── 📁 cadastro/            # Formulários de cadastro
│   │   ├── 📁 editar/              # Formulários de edição
│   │   ├── 📁 listar/              # Listagens e tabelas
│   │   ├── 📁 processa/            # Processamento de formulários
│   │   └── 📁 visualizar/          # Páginas de detalhes
│   ├── 📁 assets/                   # Recursos estáticos admin
│   │   └── 📁 imagens/             # Upload de imagens
│   ├── 📁 conexao/                  # Configuração de banco
│   ├── 📁 css/                      # Estilos administrativos
│   ├── 📁 js/                       # Scripts administrativos
│   └── 📁 lib/                      # Bibliotecas externas
├── 📁 css/                          # Estilos do site público
├── 📁 images/                       # Imagens do site público
├── 📁 includes/                     # Funções e utilitários
├── 📁 js/                           # Scripts do site público
├── 📄 index.php                     # Página principal
├── 📄 menu.php                      # Menu de navegação
├── 📄 footer.php                    # Rodapé
├── 📄 simplepage.sql                # Estrutura do banco
└── 📄 README.md                     # Documentação
```

### Arquivos Principais

#### Backend
- `index.php` - Página principal do site
- `adm/administracao.php` - Dashboard administrativo
- `includes/funcoes.php` - Funções utilitárias
- `adm/conexao/conexao.php` - Configuração do banco

#### Frontend
- `css/style.css` - Estilos principais do site
- `adm/css/style.css` - Estilos administrativos
- `js/admin.js` - Scripts administrativos centralizados

## 🔄 Melhorias Implementadas (2025)

### 🚀 Modernização Técnica

#### Migração para PDO
- **Antes**: MySQLi com queries diretas
- **Depois**: PDO com prepared statements
- **Benefícios**: Maior segurança, melhor tratamento de erros, portabilidade

#### Centralização de Funções
- **Antes**: Código duplicado em múltiplos arquivos
- **Depois**: Funções centralizadas em `includes/funcoes.php`
- **Benefícios**: Manutenibilidade, reutilização, consistência

#### Organização JavaScript
- **Antes**: Scripts inline em cada página
- **Depois**: Arquivo centralizado `admin.js`
- **Benefícios**: Melhor organização, cache de browser, debug facilitado

### 🎨 Melhorias de Interface

#### Design Responsivo
- **Mobile-first** approach
- **Tabelas responsivas** com cards em dispositivos móveis
- **Menu lateral** colapsível no admin
- **Formulários otimizados** para touch devices

#### Sistema de Modais
- **Confirmações elegantes** para exclusões
- **Feedback visual** para ações do usuário
- **Carregamento assíncrono** de conteúdo

#### Validação Dupla
- **Client-side**: Validação imediata com JavaScript
- **Server-side**: Validação robusta com PHP
- **Feedback visual**: Indicadores claros de erro/sucesso

### 🔒 Melhorias de Segurança

#### Prevenção de Vulnerabilidades
- **SQL Injection**: Uso exclusivo de prepared statements
- **XSS**: Sanitização de todas as entradas
- **CSRF**: Tokens de segurança em formulários críticos
- **Upload Seguro**: Validação rigorosa de arquivos

#### Sistema de Autenticação
- **Sessões seguras** com regeneração de ID
- **Senhas hash** com algoritmos modernos
- **Timeout automático** de sessões
- **Logs de acesso** para auditoria

### 📊 Novas Funcionalidades

#### CRUD de Contatos
- **Sistema completo** de gerenciamento de mensagens
- **Filtros avançados** por status e conteúdo
- **Bulk actions** para operações em lote
- **Status tracking** (novo, lido, respondido, arquivado)

#### Dashboard Avançado
- **Estatísticas em tempo real** de usuários, serviços e contatos
- **Gráficos interativos** (preparado para implementação)
- **Quick actions** para tarefas comuns
- **Notificações** de novos contatos

#### Sistema de Upload
- **Organização automática** por ID de usuário
- **Validação rigorosa** de tipos e tamanhos
- **Redimensionamento automático** de imagens
- **Limpeza automática** ao excluir registros

## 🔮 Melhorias Planejadas

### 🎯 Próximas Implementações

#### Melhorias de Interface
- **Responsividade do painel administrativo** - Aprimoramento da experiência mobile no admin

## Contribuição

Contribuições são sempre bem-vindas! Para contribuir:

1. **Fork** o projeto
2. Crie uma **branch** para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. **Commit** suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. **Push** para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um **Pull Request**

### Diretrizes de Contribuição

- Mantenha o código limpo e bem documentado
- Siga os padrões de codificação existentes
- Teste suas alterações antes de submeter
- Atualize a documentação quando necessário

### Reportar Bugs

Use as [Issues do GitHub](https://github.com/robson-luiz/simplepage/issues) para reportar bugs, incluindo:
- Descrição detalhada do problema
- Passos para reproduzir
- Ambiente (SO, versão PHP, navegador)
- Screenshots (se aplicável)

## 📄 Licença

Este projeto está licenciado sob a **MIT License** - veja o arquivo [LICENSE](LICENSE) para detalhes.

### Resumo da Licença
- ✅ Uso comercial permitido
- ✅ Modificação permitida
- ✅ Distribuição permitida
- ✅ Uso privado permitido
- ❌ Garantia não incluída
- ❌ Responsabilidade limitada

## 👨‍💻 Autor

**Robson Luiz**
- GitHub: [@robson-luiz](https://github.com/robson-luiz)
- LinkedIn: [Robson Luiz](https://linkedin.com/in/robson-luiz)
- Email: robsonluiz_6@hotmail.com

---

<div align="center">

**[⬆ Voltar ao topo](#simplepage---sistema-de-gestão-de-conteúdo)**

Desenvolvido por [Robson Luiz](https://github.com/robson-luiz)

</div>