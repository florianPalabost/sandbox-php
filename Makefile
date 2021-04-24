.PHONY: install


DOCKER_COMPOSE := docker-compose
## ?= if not define
SGBD?=postgres

MYSQL_FILE := docker-compose.mysql.yml
POSTGRES_FILE := docker-compose.postgres.yml

PHP_EXEC := $(DOCKER_COMPOSE) -f $(POSTGRES_FILE) exec -w /var/www/html app-php

# to use args like --unit use : " --unit"
COMMAND_ARGS := $(subst :,\:,$(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS)))


## install
install:
ifeq "$(SGBD)" "mysql"
	@echo "You choose MySQL as SGBD ! \n"
	$(DOCKER_COMPOSE) -f $(POSTGRES_FILE) down --remove-orphans
	$(DOCKER_COMPOSE) -f $(MYSQL_FILE) up --build -d
else
	@echo "You choose Postgres as SGBD ! \n"
	$(DOCKER_COMPOSE) -f $(MYSQL_FILE) down --remove-orphans
	$(DOCKER_COMPOSE) -f $(POSTGRES_FILE) up --build -d
endif

# Start
start: install
	$(DOCKER_COMPOSE)  down --rmi all --remove-orphans
	$(DOCKER_COMPOSE)  up --build

# Stop
down:
	$(DOCKER_COMPOSE) -f $(MYSQL_FILE) down --remove-orphans
	$(DOCKER_COMPOSE) -f $(POSTGRES_FILE) down --remove-orphans

# ps
ps:
ifeq "$(SGBD)" "postgres"
	$(DOCKER_COMPOSE) -f $(POSTGRES_FILE) ps
else
	$(DOCKER_COMPOSE) -f $(MYSQL_FILE) ps
endif

# exec php container commands
php:
	$(PHP_EXEC) php $(COMMAND_ARGS)

# exec composer commands inside php container
composer:
	$(PHP_EXEC) composer $(COMMAND_ARGS)

test:
	$(PHP_EXEC) composer_vendor/bin/phpunit tests