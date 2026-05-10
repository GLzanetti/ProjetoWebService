# ⚽ Sistema de Gestão - ONG Gol Solidário

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![jQuery](https://img.shields.io/badge/jquery-%230769AD.svg?style=for-the-badge&logo=jquery&logoColor=white)

## 📋 Sobre o Projeto

O **Gol Solidário** é uma plataforma de gestão desenvolvida para centralizar o controle de dados de uma ONG. O projeto foi concebido utilizando uma **arquitetura cliente-servidor**, onde o backend funciona como uma API independente, permitindo uma comunicação clara entre a interface e as regras de negócio.

O principal objetivo foi aplicar conceitos fundamentais de desenvolvimento web, como a manipulação de dados via SQL e a integração de front e back de forma dinâmica. Em funcionalidades críticas, como a edição de perfil, utilizei **requisições assíncronas (AJAX)** para garantir que a experiência do usuário fosse fluida, evitando recarregamentos desnecessários de página onde o dinamismo era prioritário.

## 🚀 Diferenciais Técnicos

- **Arquitetura REST:** Separação entre persistência de dados (PHP) e apresentação (HTML/CSS).
- **Interatividade Pontual:** Uso de jQuery e AJAX para atualização de dados em tempo real no módulo de perfil.
- **Modelagem Relacional:** Estruturação de banco de dados MariaDB com foco em integridade e relacionamentos entre entidades.

## 🛠️ Tecnologias e Ferramentas
- **Backend:** PHP puro (Arquitetura de API REST).
- **Frontend:** HTML5, CSS3, JavaScript (jQuery) e AJAX para requisições assíncronas.
- **Banco de Dados:** MariaDB (Modelagem relacional com SQL).
- **Testes de API:** Postman (Validação de status codes e payloads).
- **Ambiente:** XAMPP (Apache & MariaDB).

## ⚙️ Funcionalidades
- [x] **Autenticação de Usuários:** Fluxo completo de Login e Registro.
- [x] **Interatividade Dinâmica (AJAX):** Implementação de atualizações assíncronas via jQuery na seção de Perfil, permitindo a seleção e troca de times sem necessidade de recarregamento da página.
- [x] **Arquitetura de API REST:** Separação entre a lógica de persistência (PHP) e a interface, facilitando a manutenção.
- [x] **Gestão de Perfil:** Visualização e edição de dados cadastrados com foco em UX.


# 📄 API Gol Solidário - Rotas Principais

Esta documentação lista todos os endpoints (URLs) suportados pela API, organizados por recurso.

---

## 1. Recurso: `/usuarios`

| Método | URL | Descrição |
| :--- | :--- | :--- |
| **GET** | `/usuarios` | Lista todos os usuários. |
| **GET** | `/usuarios/{id}` | Busca um usuário específico pelo ID. |
| **POST** | `/usuarios` | Cria um novo usuário. |
| **PUT** | `/usuarios/{id}` | Atualiza um usuário existente. |
| **DELETE** | `/usuarios/{id}` | Deleta um usuário. |

---

## 2. Recurso: `/times`

| Método | URL | Descrição |
| :--- | :--- | :--- |
| **GET** | `/times` | Lista todos os times. |
| **GET** | `/times/{id}/usuarios` | Lista todos os usuários que pertencem a um time. |
| **POST** | `/times` | Cria um novo time. |
| **PUT** | `/times/{id}` | Atualiza um time existente. |
| **DELETE** | `/times/{id}` | Deleta um time. |

---

## 3. Recurso: `/doacao`

| Método | URL | Descrição |
| :--- | :--- | :--- |
| **GET** | `/doacao` | Lista todas as doações. |
| **GET** | `/doacao/{id}` | Busca a doação de um usuário específico (pelo `usuario_id`). |
| **POST** | `/doacao` | Cria uma nova doação (status inicial `PENDENTE`). |
| **PUT** | `/doacao/{id}` | Atualiza o status da doação (ex: para `RECEBIDA`). |
| **PUT** | `/doacao/usuario/{id}` | Atualiza o id do usuario da doação (ex: para `null`). |

---

## 4. Recurso: `/partidas`

| Método | URL | Descrição |
| :--- | :--- | :--- |
| **GET** | `/partidas` | Lista todas as partidas. |
| **GET** | `/partidas/{id}` | Busca uma partida específica pelo ID. |
| **POST** | `/partidas` | Cria uma nova partida. |
| **PUT** | `/partidas/{id}` | Atualiza uma partida (dados gerais). |
| **PUT** | `/partidas/placar/{id}` | Atualiza **apenas o placar** de uma partida. |
| **DELETE** | `/partidas/{id}` | Deleta uma partida. |
