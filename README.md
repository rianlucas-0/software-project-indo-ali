# Indo Ali

**Turma:** 3D1  

## 👨‍💻 Equipe de Desenvolvimento

| Integrante       | RA        |
|------------------|-----------|
| Rian Lucas       | 12400629  |
| Lucas Almeida    | 12402028  |
| Miguel José      | 12401110  |
| Daniel Mafra     | 12401943  |
| João Vitor       | 12301582  |
| Bernardo Martins | 22402420  |

---

## 📌 Visão do Projeto
O **Indo Ali** é uma plataforma para descoberta e recomendação de estabelecimentos locais.  
O sistema oferece funcionalidades de busca, avaliações, comentários e recomendações personalizadas para ajudar usuários a encontrarem locais de acordo com seus gostos e preferências.

---

## ✅ Funcionalidades

- [X] Cadastrar  
- [X] Visualizar histórico  
- [ ] Múltiplos idiomas  
- [X] Sistema de busca  
- [X] Favoritar  
- [X] Comentar  
- [ ] Recomendações personalizadas  
- [X] Compartilhar local com amigos  
- [X] Filtros nas buscas  
- [X] Mapa para visualizar os locais
- [X] Dashboard do administrador
- [X] Exportação de relatorio em PDF   

---

## 🛠️ Stack Tecnológico
- **Backend:** Laravel 10, PHP 8.3+, MySQL  
- **Frontend:** Tailwind CSS, Alpine.js, Blade  
- **Ferramentas:** Git, Composer, Node.js/NPM  

---

## 📂 Estrutura do Projeto

├── app/
├── database/
├── public/
├── resources/
├── routes/
└── tests/

routes/web.php # Rotas do sistema

resources/views # Templates Blade

app/Models # Models Eloquent

app/Http/Controllers # Controladores da aplicação


---

## ▶️ Como Executar o Projeto

```bash
# Clone o repositório
git clone https://github.com/rianlucas-0/software-project-indo-ali.git

# Acesse a pasta
cd software-project-indo-ali

# Instale as dependências do backend
composer install

# Instale as dependências do frontend
npm install

# Copie o arquivo de exemplo de variáveis de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Inicie o servidor backend
php artisan serve

# Inicie o servidor frontend
npm run dev
