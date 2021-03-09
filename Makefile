DOCKER_COMPOSE := docker-compose
PHP_EXEC := $(DOCKER_COMPOSE) exec -w /var/www/html app-php
# to use args like --unit use : " --unit"
COMMAND_ARGS := $(subst :,\:,$(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS)))


## install
install sgbd:
ifeq "$(sgbd)" "mysql"
	@echo "You choose MySQL as SGBD ! \n"
	$(DOCKER_COMPOSE) -f docker-compose.postgres.yml down
	$(DOCKER_COMPOSE) -f docker-compose.mysql.yml up --build -d
else
	@echo "You choose Postgres as SGBD ! \n"
	$(DOCKER_COMPOSE) -f docker-compose.mysql.yml down
	$(DOCKER_COMPOSE) -f docker-compose.postgres.yml up --build -d
endif

# Start
start:
	$(DOCKER_COMPOSE) down --rmi all
	$(DOCKER_COMPOSE) up --build

# Stop
down:
	$(DOCKER_COMPOSE) -f docker-compose.mysql.yml down
	$(DOCKER_COMPOSE) -f docker-compose.postgres.yml down

# ps
ps:
	$(DOCKER_COMPOSE) ps

# exec php container commands
php:
	$(PHP_EXEC) php $(COMMAND_ARGS)

# exec composer commands inside php container
composer:
	$(PHP_EXEC) composer $(COMMAND_ARGS)
