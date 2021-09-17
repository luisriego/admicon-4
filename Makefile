.PHONY: help start-all stop-all build-all restart-all ssh-app ssh-mailer

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

start-all: ## Runs all services: RabbitMQ, App and Mailer
	make -C rabbitmq start
	make -C app start
	make -C mailer start
	#$(MAKE) prepare-all

prepare-all: ## Install dependencies and run migrations in all services
	make -C app prepare
	make -C mailer prepare

stop-all: ## Stops all services: RabbitMQ, App and Mailer
	make -C app stop
	make -C mailer stop

build-all: ## Build all services: RabbitMQ, App and Mailer
	make -C app build
	make -C mailer build

restart-all: ## Restarts all services: RabbitMQ, Register, Application and Mailer
	make -C rabbitmq restart
	make -C app restart
	make -C mailer restart

ssh-app: ## bash into App Service PHP container
	make -C app ssh-be

ssh-mailer: ## bash into Mailer Service PHP container
	make -C mailer ssh-be
