# UserControlPanel

1. A kezdőoldalon lévő "Új felhasználó hozzáadása" gombhoz nem tartozik funkció, mindössze design.
2. Az app kiegészítve pár hasznos funkcióval (Szűrés és keresés).
3. Szűrés: ABC sorrend, Regisztráció dátuma növekvő és Regisztráció dátuma csökkenő - Controllers/FilterController.php.
4. Keresés lehetőség (névrészlet vagy adott névre - Controllers/SearchController.php).
5. Törlés esetén az app átirányít egy confirmációs panel-re ahol véglegesen törölhetjük az adott felhasználót, annak adatait szintén láthatjuk ezen az oldalon.
6. Szerkesztés esetén a rendszer adatellenőrzést is végez (email frontend és backend oldalon is, név hossza).
7. A notification rendszer jQuery segítségével lett megoldva (egyszerű kis message box).
8. Mysql kapcsolódásért a Database/connection.php felelős (változók tárolják a connection adatokat így azok bármikor változtathatóak, az egész app-ben változni fog egyaránt (require).
