# basic-reddit-clone-in-php

*(osnovne stvari o projektu se nalaze ispod)*

## Spirala 3

### I - Šta je urađeno ?
* Napravljen je osnovni MVC framework sa automatskim (primitivnim) rutiranjem i mini ORM-om za XML fajlove, ne baš naročito efikasnim što se tiče performansi, ali vrlo praktičnim za brzi razvoj aplikacije.
* (1) Serijalizuje se User i Subreddit model (u users.xml i subreddits.xml respektivno, u /application/persistence folder). Moguće se registrovati, login-ovati. Ako se korisnik loguje kao admin (pw: admin123456), na listi subreddita mu se otvaraju dodatne mogućnosti poput kreiranja novih subreddita, te brisanja i editovanja postojećih.
* (2) Admin korisniku se na vrhu podstranice listi subreddita omogućuje export osnovnih podataka o subredditima u .csv fajl.
* (3) Generiše se lista svih subreddita i broja njihovih pretplatnika i exportuje u PDF fajl.
* (4) Napravljena je pretraga subreddita sa live preporukama po dva polja (title i description). Stranica se nikako ne reloada.

### II - Šta nije urađeno?
* (5) Trenutno čekam account na OpenShift.

### III - Bugovi koji su primjećeni, znamo rješenje, ali nisu rješeni
* Trenutno nema bugova koje sam primjetio.

### IV - Bugovi koji su primjećeni, ali ne znamo rješenje
* Trenutno nema bugova koje sam primjetio.

### V - Lista fajlova

Poptuno je promjenjena struktura projekta u odnosu na prošlu spiralu.

## Malo o tom osnovnom MVC frameworku

Potrebno je projekat raspakovati u htdocs i u /application/config/config.php promijeniti odgovarajuće parametre poput baznog URL-a, te postaviti siguran chmod na sve fajlove osim one u /static folderu koji nisu problem ako ih browser može vidjeti. "Entry point" je index.php u / folderu koji poziva setup_framework() funkciju iz /framework/framework.php. Ova funkcija parsira traženi URL, dijeli ga na segmente, automatski rutira prema kontroleru i akciji određenim putem prvog i drugog segmenta, te request metode. Akcije u kontrolerima su imenovane proizvoljno, s tim sto moraju zavrsavati na _post, _get ili generalno _HTTPMETODA. Framework ne koristi nikakve namespace niti ima autoloader, već se ručno include-aju i require-aju određeni fajlovi (što je bila greška pri osnovnom dizajnu frameworka, ali kasno mi je sad da mijenjam i svakako je ovo OK za jednostavan, minimalan framework). Nazivi fajlova kontrolera i modela se moraju poklapati, kao i utility klasa. XML fajlovi se čuvaju u /application/persistance folderu i moraju se ručno kreirati sa root elementom, ali unutar mogu biti prazni. Modeli (sa perzistencijom u XML) se lahko manipulišu kroz Model klasu i sve izmjene, nove instance modela, brisana itd. automatski se snimaju u odgovarajući XML fajl. Ideju da uopšte pravim MVC framework sam 'ukrao' od Sanila (https://github.com/sanilmusic/wt-twitter), s tim što je ovaj framework ipak jednostavniji i primitivniji nego li njegov (prvenstveno zbog toga što Sanilov framework ima router i autoloader klasa).

Evo par "highlights" šta se može raditi sa frameworkom:

** Validacija elemenata forme, prosljeđivanja varijabli pogledu i render pogleda **
```php
$v = $this->validator($this->post(), array(
	'username' => 'required',
	'password' => 'required|min:8|max:16'
	)
);

if(!$v->validate())
{
	$this->view('login')->set('errors', $v->errors)->render();
	return;
}
```

** Traženje korisnika u users.xml fajlu **
```php
$user = $this->model('User')->first(array('username' => $this->post('username'))); // vraća null ako nema korisnika sa ovim username-om
```

** U biti je ovo OR upit nad XML fajlom **
```php
// Je li vec postoji acc sa ovim username-om ili e-mailom ?
if($this->model('User')->first(array('username' => $this->post('username'), 'email' => $this->post('email')), 'or') !== null)
```

** Kreiranje novog usera i njegovo snimanje users.xml fajl **
```php
$korisnik           = $this->model('User');
$korisnik->username = $this->post('username');
$korisnik->password = password_hash($this->post('password'), PASSWORD_DEFAULT);
$korisnik->email    = $this->post('email');
$korisnik->save();
```

** Pretraga po username-u gdje nam odgovara više username-a **
```php
$korisnici_sa_brojem_99_ili_101_ili_103_u_imenu = $this->model('User')->find(array('username' => array('99', '101', '103')), 'in');

```

** Kontroler akcija koja se poziva kada se uradi GET /main/hello **
```php
class Main extends Controller
{
	function main_get()
	{
		echo "hai";		
	}
}
```

** Kontroler akcija koja se poziva kada se uradi GET /subreddit/delete/10 sa provjerom je li korisnik admin, brisanje elementa iz XML fajla sa odgovarajućim ID navedenim u URLu **
```php
class Subs extends Controller
{
	function delete_get($id)
	{
		if(!$this->isAdmin())
	        $this->redirect('');

	    $subreddit = $this->model('Subreddit')->getById($id);
	    $subreddit->delete();
        $this->redirect('/main/subreddits');
	}  
}
```

** itd, itd, itd.. *

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
* *css/main.css* - glavni css fajl za većinu stranica (neki bazni layout)
* *css/reusable.css* - dugmadi sad za sad su ovdje samo
* *css/forms.css* - stajling za forme
* *css/grid.css* - grid sa 12 kolona, bez guttera (možda dodam gutter poslije)
* *css/fonts.css* - offline google fonts za Open Sans font

## O projektu

Šta je zapravo ovaj projekat?

 * Naslov  dovoljno govori.
 * Projekat se radi u sklopu predmeta Web Tehnologije na Elektrotehničkom fakultetu Sarajevo, ak. god. 2016/17

Ko radi na ovome?

 * Ahmed Popović (index 16963)

Šta još?

 * Ništa, vala.
