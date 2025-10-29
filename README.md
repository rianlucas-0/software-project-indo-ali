# Indo Ali

**Turma:** 3D1

## 👨‍💻 Equipe de Desenvolvimento

| Integrante       | RA       |
| ---------------- | -------- |
| Rian Lucas       | 12400629 |
| Lucas Almeida    | 12402028 |
| Miguel José      | 12401110 |
| Daniel Mafra     | 12401943 |
| João Vitor       | 12301582 |
| Bernardo Martins | 22402420 |

---

## 📌 Visão do Projeto

O **Indo Ali** é uma plataforma para descoberta e recomendação de estabelecimentos locais.
O sistema oferece funcionalidades de busca, avaliações, comentários e recomendações personalizadas para ajudar usuários a encontrarem locais de acordo com seus gostos e preferências.

---

## ✅ Funcionalidades

* [x] Cadastrar
* [x] Visualizar histórico
* [x] Sistema de busca
* [x] Favoritar
* [x] Comentar
* [x] Recomendações personalizadas
* [x] Compartilhar local com amigos
* [x] Filtros nas buscas
* [x] Mapa para visualizar os locais
* [x] Dashboard do administrador
* [x] Exportação de relatório em PDF
* [x] Tornar-se parceiro
* [x] Recomendação com base no histórico
* [x] Personalização de preferências para as recomendações
* [x] ChatBot de suporte

---

## 🛠️ Stack Tecnológico

* **Backend:** Laravel 10, PHP 8.3+, MySQL
* **Frontend:** Tailwind CSS, Alpine.js, Blade
* **Ferramentas:** Git, Composer, Node.js/NPM

---

## 📂 Estrutura do Projeto

```
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
```

---

# Área de Design Patterns (GoF)

## Singleton

O **Singleton** é usado para garantir que apenas uma instância de certos serviços seja criada, evitando múltiplas instâncias desnecessárias e permitindo um ponto central de acesso a esses serviços. No nosso projeto, ele é usado em serviços como RecommendationService e LocalService, que atuam como gerenciadores de lógica central.

> **Benefício:** evita duplicidade de instâncias de serviços e mantém consistência de dados e operações durante a execução da aplicação.

> **Localização:**

* `app/Services/RecommendationService.php`
* `app/Services/LocalService.php`
* `app/Services/UserService.php`
* `app/Services/FavoriteService.php`

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
```

---
