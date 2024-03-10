restart-rr:
	cd ../../docker && docker compose -f app.yaml exec -it app-service rr reset

test-run:
	cd ../../docker && docker compose -f app.yaml exec -it app-service php bin/phpunit