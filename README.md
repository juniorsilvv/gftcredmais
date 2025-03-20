
# Teste Backend GFT

Segue o teste prático como solicitado.


# Instruções para Rodar o Projeto

## Pré-requisitos
Certifique-se de ter os seguintes softwares instalados:

- PHP (recomendado versão 8.0 ou superior)
- Composer (para gerenciar dependências PHP)
- Postgres (ou outro banco de dados compatível)
- Postman ou ferramenta similar (para testar a API)

#### 1. Clonar o Repositório
Clone o repositório do projeto:
```https://github.com/juniorsilvv/gftcredmais.git```

#### 2. Instalar Dependências
Entre na pasta do projeto e instale as dependências do PHP usando o Composer:

```composer install```

#### 3. Configuração do Ambiente
Crie o arquivo .env na raiz do projeto, baseado no arquivo .env.example. Abra o arquivo .env e configure as variáveis de ambiente:

Linux: 
```cp .env.example .env```

Windows: ```copy .env.example .env```

#### 4. Gerar a Chave JWT
Execute o seguinte comando para gerar a chave secreta para a autenticação JWT:

```php artisan jwt:secret```

#### 5. Rodar as Migrações
Execute as migrações do banco de dados para criar as tabelas necessárias:

```php artisan migrate```

#### 6. Iniciar o Servidor
Para rodar o servidor de desenvolvimento, use o seguinte comando:

```php artisan serve```




## Documentação da API

#### Rota de login
```http
  POST /api/login
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `email` | `string` | **Obrigatório**|
| `password` | `string` | **Obrigatório**|

#### Rota para cadatrar um usuário

```http
  POST /api/register
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`      | `string` | **Obrigatório**.|
| `email` | `string` | **Obrigatório**|
| `password` | `string` | **Obrigatório**|


### Todas as rotas a seguir são autenticadas.
Necessário informar o **Bearer Token** para acessa-lás

#### Rota para realizar logout
```http
  GET /api/logout
```

#### Rota para atualizar o token
```http
  GET /api/refresh-token
```

#### Rota para retornar todos os contratos
```http
  GET /api/contracts
```

#### Rota para retornar um contrato específico
```http
  GET /api/contracts/${id}
```

#### Rota para cadatrar um novo contrato
```http
  POST /api/contracts/
```
| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `client_id`      | `integer` | **Obrigatório**. É realizada verificação se o client existe na api externa.|
| `amount` | `numeric` | **Obrigatório**. O valor deve ser maior que 0.1.|
| `commercial_manager_id` | `integer` | **Obrigatório**. É realiazada a verificação se o usuário existe na base de dados.|
| `regional_manager_id` | `integer` | **Obrigatório**. O valor deve ser maior que 0.1.|
| `superintendent_id` | `integer` | **Obrigatório**. É realiazada a verificação se o usuário existe na base de dados.|
| `status` | `string` | **Obrigatório**. O status precisa ser pending,approved ou rejected.|

#### Rota para atualizar um contrato
```http
  PUT /api/contracts/${id}
```
| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `client_id`      | `integer` | **Obrigatório**. É realizada verificação se o client existe na api externa.|
| `amount` | `numeric` | **Obrigatório**. O valor deve ser maior que 0.1.|
| `commercial_manager_id` | `integer` | **Obrigatório**. É realiazada a verificação se o usuário existe na base de dados.|
| `regional_manager_id` | `integer` | **Obrigatório**. O valor deve ser maior que 0.1.|
| `superintendent_id` | `integer` | **Obrigatório**. É realiazada a verificação se o usuário existe na base de dados.|
| `status` | `string` | **Obrigatório**. O status precisa ser pending,approved ou rejected.|

#### Rota para deletar um contrato
```http
  DELETE /api/contracts/${id}
```


### Arquitetura do projeto
Para a arquitetura do projeto foi pensado em separação de camadas.

#### RequestForms

Foi usado as requetsforms para conter todas as regras e validações antes de chegar no controller, deixando o controle somente para as ações necessárias.

#### Traits
Foi criada Traits para adicionar funções padrões que todas os requests forms tem, para não haver duplicidade de código.


#### Repository
Foi usada repositories para ter uma camada a mais para abstração de banco de dados.

#### Services
Foi usada services para separar partes de codigo que poderiam ser usadas em outras estruturas do código.

#### Resoruces
Foi usada Resources para ter uma padronização no retorno dos dados.