[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/grupocoqueiro/console/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/grupocoqueiro/console/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/grupocoqueiro/console/badges/build.png?b=master)](https://scrutinizer-ci.com/g/grupocoqueiro/console/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/grupocoqueiro/console/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/grupocoqueiro/console/?branch=master)

### Cria Um Esqueleto de Modulo no estilo DDD

- Cria uma estrutura de pastas:
	- App
		- Application
		- Domain
		- Infrastructure
		- UseCases
- Cria as classes Mapping.php e a ServiceProvider.php
- Cria as classes de Command e CommandHandler e adiciona no Mapping.php 


### Instalação

`$ composer require grupocoqueiro/console`

#### Criar um novo modulo

`$ php saci create:module NomeDoModulo "Caminho onde o modulo será criado"`

#### Criar uma nova command

`$ php saci create:command NomeDoCommand "Caminho onde o command será criado" NomeDoModulo`