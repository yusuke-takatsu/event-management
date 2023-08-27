init:
	make build
	cp .env.local.example .env.local
	make up
	docker compose exec node npm install

build:
	docker compose build

up:
	docker compose up -d

stop:
	docker compose stop

down:
	docker compose down

docker-build:
	docker compose build

ps:
	docker compose ps

restart:
	docker compose -f compose.yml kill && \
	docker compose -f compose.yml rm -f && \
	docker compose -f compose.yml up -d

app:
	docker exec -it event-management-node /bin/sh

story:
	docker exec -it event-management-node /bin/sh -c "npm run storybook"

eslint:
	docker compose exec node npm run eslint

eslint-fix:
	docker compose exec node npm run eslint-fix

format:
	docker compose exec node npm run format

generate-type:
	docker compose exec node npm run generate-type
	docker compose exec node npm run format-typescript-axios