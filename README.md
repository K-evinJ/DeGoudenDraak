## Hoe moet de OTAP-omgeving lokaal opgezet worden?

1. Clone deze repository vier keer, zodat je vier folders krijgt:
    - `DeGoudenDraak-dev`
    - `DeGoudenDraak-test`
    - `DeGoudenDraak-accept`
    - `DeGoudenDraak-production`

2. Op de dev branch

    1. Voer `composer install` uit.
    2. Kopieer het bestand `.env.example` naar `.env`.
    3. Voer `php artisan key:generate` uit.

2. Voor iedere omgeving:

    1. Vul een unieke databasenaam in en pas de database-inloggegevens aan (bijv. `degoudendraak-dev`, `degoudendraak-test`, enz.).
    2. Stel `APP_ENV` in op `dev`, `test`, `accept` of `production` (afhankelijk van de omgeving).
    3. Zet bij **accept** en **production** `APP_DEBUG=false`.

4. Zorg dat de verschillende folders zichtbaar zijn voor Laravel Herd  
   (voeg eventueel de map waarin de folders staan toe aan Herd bij *General > Paths*).
