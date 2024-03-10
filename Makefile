restart-rr:
	cd ../../docker && docker compose -f app.yaml exec -it app-service rr reset

test-run:
	cd ../../docker && docker compose -f app.yaml exec -it app-service php bin/phpunit
stan-run:
	cd ../../docker && docker compose -f app.yaml exec -it app-service php vendor/bin/phpstan analyse src/Project/Post