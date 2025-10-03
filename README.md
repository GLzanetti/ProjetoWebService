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