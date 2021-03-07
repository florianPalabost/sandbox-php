DOCKER_COMPOSE := docker-compose
PHP_EXEC := $(DOCKER_COMPOSE) exec -w /var/www/html app-php
# to use args like --unit use : " --unit"
COMMAND_ARGS := $(subst :,\:,$(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS)))


# install
install:
	@echo "Check .env in .docker/db \n";
	$(DOCKER_COMPOSE) up --build -d
	@echo "You can play with the sandbox ! \n";

# Start
start:
	$(DOCKER_COMPOSE) down --rmi all
	$(DOCKER_COMPOSE) up --build

# Stop
down:
	$(DOCKER_COMPOSE) down

# ps
ps:
	$(DOCKER_COMPOSE) ps

# exec php container commands
php:
	$(PHP_EXEC) php $(COMMAND_ARGS)

# exec composer commands inside php container
composer:
	$(PHP_EXEC) composer $(COMMAND_ARGS)
