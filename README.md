Hoe moet de OTAP-omgeving lokaal opgezet worden?

1. Clone deze repositoy vier keer, zodat je vier folders krijgt:
    -DeGoudenDraak-dev,
    -DeGoudenDraak-test,
    -DeGoudenDraak-accept,
    -DeGoudenDraak-production,
   
Doe dit voor iedere omgeving:
3. Voer composer install uit.
4. Kopieër de .env.example.
5. Voer php artisan key:generate uit.
6. Vul unieke databasenaam in en vul db inlog in (bijv. degoudendraak-dev en degoudendraak-test).
7. Maak app_env dev, test, accept of production (afhankelijk van omgeving).

8. Zet bij accept en production app_debug op false.
9. Zorg dat de verschillende folders zichtbaar zijn voor Laravel Herd (eventueel door de locatie waar de folders zich in bevinden toe te voegen in Herd als path bij General).
