# Projeto: Indo Ali  
**Turma:** 3D1  

## Integrantes
- **Rian Lucas** – RA: 12400629  
- **Lucas Almeida** – RA: 12402028  
- **Miguel José** – RA: 12401110  
- **Daniel Mafra** – RA: 12401943  
- **João Vitor** – RA: 12301582  
- **Bernardo Martins** – RA: 22402420  

---

## Descrição do Projeto
**Indo Ali** é uma aplicação web voltada para a descoberta e recomendação de locais como bares, restaurantes e estabelecimentos diversos. O sistema possui funcionalidades adaptadas para usuários padrão e administradores.

### Funcionalidades:
- [x] Cadastro e login (com opção via Google e Facebook)
- [x] Recuperação de senha por e-mail
- [ ] Avaliações, comentários, curtidas e favoritos
- [ ] Busca com filtros por nome e localidade
- [ ] Exibição de detalhes dos locais (fotos, disponibilidade, endereço e contato)
- [ ] Sugestões personalizadas baseadas no histórico de navegação e preferências
- [ ] Área administrativa para gerenciamento de locais, visualização de comentários e avaliações, e exportação de relatórios em PDF

---

## Stacks e Tecnologias Utilizadas

- **Laravel**
- **PHP**
- **MySQL**
- **Blade**
- **Alpine.js**
- **JavaScript**
- **Tailwind CSS**
- **HTML5**
- **CSS3**

---

## Organização do Projeto

/app
/resources
/routes
/database
/public


- `routes/web.php`: Rotas do sistema  
- `resources/views`: Templates Blade  
- `app/Models`: Models Eloquent  
- `app/Http/Controllers`: Controladores da aplicação  

---

## Requisitos para rodar o projeto localmente

- PHP 8.2.12  
- Composer  
- Node.js e NPM  
- MySQL  
- Laravel CLI  

### Passos:
```bash
git clone https://github.com/rianlucas-0/software-project-indo-ali.git
cd software-project-indo-ali
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
npm run dev
