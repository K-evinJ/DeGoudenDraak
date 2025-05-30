## Hoe moet de OTAP-omgeving lokaal opgezet worden?

1. Clone deze repository vier keer, zodat je vier folders krijgt:
    - `DeGoudenDraak-dev`
    - `DeGoudenDraak-test`
    - `DeGoudenDraak-accept`
    - `DeGoudenDraak-production`

2. Doe dit voor iedere omgeving:
    1. Voer `composer install` uit.
    2. Kopieer het bestand `.env.example` naar `.env`.
    3. Voer `php artisan key:generate` uit.
    4. Vul een unieke databasenaam in en pas de database-inloggegevens aan (bijv. `degoudendraak-dev`, `degoudendraak-test`, enz.).
    5. Stel `APP_ENV` in op `dev`, `test`, `accept` of `production` (afhankelijk van de omgeving).
    6. Zet bij **accept** en **production** `APP_DEBUG=false`.

3. Zorg dat de verschillende folders zichtbaar zijn voor Laravel Herd  
   (voeg eventueel de map waarin de folders staan toe aan Herd bij *General > Paths*).
