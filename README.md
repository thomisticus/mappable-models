## Mappable Models

Esse é um repositório para manter as classes necessárias que adicionam o mapeamento de model dinâmico ao Eloquent (Laravel).

### Instalação

Adicionar a seguinte chave ao arquivo `composer.json` do seu projeto:

```json
{
    "repositories": [
        {
          "type": "vcs",
          "url": "git@github.com:thomisticus/mappable-models.git"
        }
    ]
}
```

Adicione o pacote à sua lista de dependências também no arquivo `composer.json`:

```json
{
    "dependencies": {
        "thomisticus/mappable-models": "dev-master"
    }
}
```

Rode o comando:

`composer update`

Após a instalação do pacote, rode o seguinte comando para publicar as configurações:

`php artisan vendor:publish`

## Configuração

As configurações são encontradas no arquivo: 

`PROJETO/config/mappable-models.php`

## Variáveis de ambiente
As seguintes opções pode ser definidas por variáveis de ambiente:

`MODEL_MAPPING` - Ativa o mapeamento automático

`MODEL_MAPPING_UPPERCASE` - Ativa a transformação dos nomes das colunas automaticamente para caixa alta.

`MODEL_MAPPING_FILE` - Arquivo que o mapeamento automático irá carregar. 

## Model

Após a configuração do pacote, é necessário que os Models do Laravel extendam da seguinte classe:

`Thomisticus\MappableModels\MappableModel` 

Também, caso necessário (quando for preciso salvar nested models), usem a seguinte trait:

`Thomisticus\MappableModels\Traits\HasNestedAttributes`

Exemplo:

```php
<?php

namespace App\Models;

use Thomisticus\MappableModels\MappableModel;
use Thomisticus\MappableModels\Traits\HasNestedAttributes;

class Event extends MappableModel
{
    use HasNestedAttributes;

    protected $fillable = [
        // your fields
    ];

    // Nested attributes
    protected $nested = [
        // your nested models
    ];

    public function nested()
    {
        // your relation with nested model
    }
}

```

## Mapeamento
Os arquivos mapeamentos se encontram na pasta:

`PROJETO/database/mappings`

O arquivo de exemplo é auto explicativo, para cada model é necessário adicionar uma chave no array de mapeamentos com as configurações necessárias de acordo com o projeto.

Arquivo de exemplo:

```php
<?php
// This is a example of model mapping. Just edit to fit your model case
return [
    'model_name' => [
        'table' => 'modified_model_name',
        'primary' => 'modified_primary_key',
        'sequence' => 'modified_sequence_if_exists',
        'columns' => [
            'default_column_name' => 'modified_column_name',
        ]
    ]
];
```
