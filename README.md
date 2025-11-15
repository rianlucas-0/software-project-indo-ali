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

* [x] Cadastro de usuários
* [X] Login com autenticação
* [X] Login com Google ou Facebook 
* [X] Redefinição de senha
* [x] Visualizar histórico
* [x] Sistema de busca
* [x] Favoritar locais
* [x] Comentar em locais
* [X] Avaliar locais
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
* [x] Versão para dispositivos mobile

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

# 🎯 Área de Design Patterns (GoF)

Nesta seção estão os padrões do catálogo GoF aplicados no Indo Ali, com explicação clara do papel de cada um no projeto.

---

## 🧩 Singleton

O **Singleton** garante que apenas **uma instância** de certos serviços exista na aplicação.  
Isso é útil para serviços utilizados em múltiplas partes do sistema e que precisam manter consistência em suas operações.

**Benefícios:**
- Evita múltiplas instâncias desnecessárias dos serviços
- Centraliza a lógica principal
- Mantém dados mais consistentes durante o uso do sistema

📌 **Onde é usado:**
- `app/Services/RecommendationService.php`
- `app/Services/LocalService.php`
- `app/Services/UserService.php`
- `app/Services/FavoriteService.php`

---

## 🧠 Strategy

O **Strategy** permite alternar a lógica de recomendação sem alterar o restante do código.  
Isso possibilita que novas estratégias sejam criadas e aplicadas facilmente no futuro.

**Por que usar:**
- Possibilita múltiplas formas de recomendação (por histórico, por categoria, por IA…)
- Facilita manutenção e expansão
- Segue o princípio OCP (Aberto para extensão / Fechado para modificação)

📌 **Onde está implementado:**
- `app/Services/RecommendationService.php`
- `app/Services/RecommendationStrategies/RecommendationStrategyInterface.php`
- `app/Services/RecommendationStrategies/DefaultRecommendationStrategy.php`

---

## 🏭 Factory Method

O **Factory Method** permite que o sistema escolha automaticamente **qual serviço de upload** utilizar ao armazenar imagens.  
Hoje o upload usa armazenamento local, mas já está preparado para usar, por exemplo, AWS S3 ou Google Cloud Storage futuramente.

**Benefícios:**
- Facilita troca de provedores de armazenamento
- Evita duplicação de código de upload
- Traz escalabilidade e flexibilidade

📌 **Onde está implementado:**
- `app/Contracts/UploaderInterface.php`
- `app/Services/Upload/UploadFactory.php`
- `app/Services/Upload/LocalUploader.php`

---

## 👁️ Observer

O **Observer** é usado para reagir automaticamente a eventos gerados pelos usuários, como visualizações e comentários.  
Assim, o sistema pode atualizar recomendações e histórico sem precisar chamar tudo diretamente do controller.

**Benefícios:**
- Reduz processamento em tempo de requisição
- Atualiza recomendações automaticamente
- Diminui acoplamento entre controllers e lógica de recomendação

📌 **Onde está implementado:**
- `app/Observers/LocalObserver.php`
- `app/Observers/CommentObserver.php`
- `app/Providers/AppServiceProvider.php`


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
