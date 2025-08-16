# Indo Ali

**Turma:** 3D1  

## Equipe de Desenvolvimento

| Integrante          | RA        |
|---------------------|-----------|
| Rian Lucas          | 12400629  |
| Lucas Almeida       | 12402028  |
| Miguel José         | 12401110  |
| Daniel Mafra        | 12401943  |
| João Vitor          | 12301582  |
| Bernardo Martins    | 22402420  |

## Visão do Projeto
Plataforma para descoberta e recomendação de estabelecimentos locais com sistema de avaliações e recomendações personalizadas.

## Funcionalidades

### Sistema de Autenticação
- [X] Cadastro de usuário via e-mail/senha
- [X] Login social (Google/Facebook)
- [X] Redefinição de senha segura

### Perfil do Usuário
- [ ] Personalização de preferências
- [ ] Configurações de interface
- [ ] Histórico de atividades

### Navegação e Busca
- [X] Mapa interativo de locais
- [ ] Sistema de busca com filtros avançados
- [ ] Favoritos e listas personalizadas

### Engajamento
- [ ] Sistema de avaliações e comentários
- [ ] Compartilhamento em redes sociais
- [ ] Chatbot de suporte integrado

### Acessibilidade
- [ ] Suporte a múltiplos idiomas
- [ ] Modo offline para recomendações

### Administração
- [ ] Dashboard analítico
- [X] Gerenciamento de estabelecimentos
- [ ] Exportação de relatórios em PDF

## 🛠️ Stack Tecnológico
- **Backend:** Laravel 10, PHP 8.3+, MySQL
- **Frontend:** Tailwind CSS, Alpine.js, Blade
- **Ferramentas:** Git, Composer, Node.js/NPM

## Estrutura do Projeto

├── app/
├── database/
├── public/
├── resources/
├── routes/
└── tests/

- `routes/web.php`: Rotas do sistema  
- `resources/views`: Templates Blade  
- `app/Models`: Models Eloquent  
- `app/Http/Controllers`: Controladores da aplicação  

---


## Como Executar
```bash
git clone https://github.com/rianlucas-0/software-project-indo-ali.git
cd software-project-indo-ali
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan serve
npm run dev
