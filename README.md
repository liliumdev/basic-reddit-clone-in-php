# basic-reddit-clone-in-php

*(osnovne stvari o projektu se nalaze ispod)*

## Spirala 2

### I - Šta je urađeno ?
* (a) Napravljena validacija za login i registracijsku formu. Za Search (trenutno) nema smisla da se pravi validacija.
* (b - 1 bod) Implementiran dropdown na frontpage-u (trenutno samo tu) za Top dugme (to će biti opcija za filtriranje postova).
* (b - 3 boda) Napravljena galerija/lightbox (demonstracija), sa hotkey (ESC) izlazom.
* (c) Što se tiče AJAX-a, urađeno je loadanje sporednih podstranica (iz submenija) za About glavnu podstranicu. Nemoguće je sa AJAX-om izvesti da se čitava stranica POTPUNO izmijeni (glavna prepreka su učitavanje novih CSS i JS fajlova) - bez nekih trikova/hackova oko iframe-ova i slično. Vjerujem da to svakako nije bila poenta ovog zadatka (?).

### II - Šta nije urađeno?
* Nije propušteno ništa što je bilo obavezno.

### III - Bugovi koji su primjećeni, znamo rješenje, ali nisu rješeni
* Nichts

### IV - Bugovi koji su primjećeni, ali ne znamo rješenje
* Nada

### V - Lista fajlova
* *about_why.html* - Why tab za About stranicu (ajax)
* *about_who.html* - Who tab za About stranicu (ajax)
* *about_where.html* - Where tab za About stranicu (ajax)
* *galerija.html* - Demonstracija lightboxa
* *js/ajax_about.js* - Skripta za AJAX
* *js/login_validation.js* - Skripta za validaciju login forme
* *js/register_validation.js* - Skripta za validaciju registracijske forme
* *js/main.js* - Skripta za lightbox i dropdown

## Spirala 1

### I - Šta je urađeno ?
* Napravljeno 5 mockupa (doduše nisu mockupi, nego generalno dizajn stranice i određenih podstranica, shema boja itd., urađeno u Photoshopu)
* Sve stranice su responsivne i imaju 12-kolonski grid
* Prilagođene su stranice za mobile (koliko-toliko)
* Urađene su 3 forme (login, register, search)
* Urađen meni stranice (dvonivoski, top menu i sub menu - ali submenu samo na određenim podstranicama)
* Stranica je simetrična poravnata, simetrična, bez glitcheva (koliko sam ja mogao vidjeti)

### II - Šta nije urađeno?
* Od zahtjeva koji su dati za Spiralu 1, ništa nije ostalo neurađeno.

### III - Bugovi koji su primjećeni, znamo rješenje, ali nisu rješeni
* Nema bugova, možda se eventualno još treba malo prilagoditi stranica za određene manje-srednje i baš male ekrane. Poslije nekad.

### IV - Bugovi koji su primjećeni, ali ne znamo rješenje
* ...nema ih...(nadam se)...

### V - Lista fajlova
* *index.html* - početna stranica, front page
* *about.html* - kratak opis projekta (filler text trenutno)
* *sub_list.html* - lista sub-ova u BRCIP
* *login.html* - login forma
* *register.html* - register forma
* *search.html* - pretraga
* *main.css* - glavni css fajl za većinu stranica (neki bazni layout)
* *reusable.css* - dugmadi sad za sad su ovdje samo
* *forms.css* - stajling za forme
* *grid.css* - grid sa 12 kolona, bez guttera (možda dodam gutter poslije)
* *fonts.css* - offline google fonts za Open Sans font

## O projektu

Šta je zapravo ovaj projekat?

 * Naslov  dovoljno govori.
 * Projekat se radi u sklopu predmeta Web Tehnologije na Elektrotehničkom fakultetu Sarajevo, ak. god. 2016/17

Ko radi na ovome?

 * Ahmed Popović (index 16963)

Šta još?

 * Ništa, vala.
