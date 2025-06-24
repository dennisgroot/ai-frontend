# Raadhuis Google Places API

Een plugin van [Raadhuis](https://raadhuis.com) welke een koppeling tussen de Google Places API en WordPress verzorgt. De laatste 5 Google Reviews kunnen met deze plugin worden ingeladen binnen WordPress. Daarnaast kun je hiermee de totale review score ophalen en het totaal aantal geplaatste reviews.

## Benodigdheden

1. Google Cloud Console account met ingestelde billing (via Creditcard): <https://console.cloud.google.com/>
2. Geactiveerde Google Places API met aangemaakte API-key gekoppeld aan Google Places API - Restricties ingesteld op (server) IP-adres.
3. Place ID, te vinden op: <https://developers.google.com/maps/documentation/places/web-service/place-id#find-id>

## Installatie

1. Download de laatste versie op: <https://plugins.raadhuis.com/resources/wordpress/plugins/raadhuis/raadhuis-google-places-api/raadhuis-google-places-api.zip> en activeer de plugin.
2. Ga naar instellingen bij menu-item: "Google Reviews".
3. Voer hier de velden in zoals omschreven bij "Benodigdheden", en sla deze op.
4. Klikt op "Google reviews ophalen".
5. Klaar! Bij het succesvol ophalen van de Google Reviews, worden deze ingeladen als (concept) post binnen het post-type "rh-google-reviews".

## Wijzigingen aanbrengen

Deze plugin draait op meerdere domeinen. Daarom hebben we WordPress auto-update functionaliteit toegevoegd aan de plugin. Het is belangrijk dat na een wijziging, de plugin wordt geupdate. Volg hiervoor onderstaande stappen.

1. Maak wijzigingen aan de plugin code.
2. Klaar? Omschrijf jouw wijzigingen onder "changelog" in de info.json binnen de export folder en pas de datum aan.
3. Wijzig binnen info.json de versie onder "version".
4. Wijzig de versie ook binnen het: raadhuis-google-places-api.php bestand. Doe dit bovenin bij "Version", en op regel 40 (defined: RAADHUIS_GOOGLE_PLACES_API_VERSION).
5. Voer commando `yarn && yarn release` uit om de nieuwste versie te builden naar de export folder.
6. Plaats de bestanden binnen de exoprt folder op de server middels SFTP. Locatie: <https://plugins.raadhuis.com/resources/wordpress/plugins/raadhuis/raadhuis-google-places-api/>.
7. Klaar! De nieuwe versie van de plugin zal worden geupdate bij alle klanten, met hierin jouw wijzigingen.
