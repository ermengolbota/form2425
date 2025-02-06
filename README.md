Codi per a la gestió d'un formulari bàsic en php.

Les diverses solucions estan en diverses branques. Podeu canviar de branca des del menú de dalt a l'esquerra, que diu "main"

  * main, un html molt simple
  * php, un html més complet i un php senzill per a obtenir les dades
  * php_unic. Un sol fitxer index.php que mostra el formulari i també valida les dades, reomplint la part correcta del formulari i avisant dels errors.
  * php_bd. El php_unic, però connectant-se a un BBDD per a guardar la informació i creant un enllaç per poder esborrar elements
  * CURD. Versió completa de l'aplicació, però no òptima
    * index.php:
       * Si no rep res --> Mostrar el formulari
       * Si rep una petició POST però falta algun paràmetre --> Comprova els paràmetres i si hi ha error, reomple el formulari amb els camps bons, i avisa del dolent
       * Si rep una petició POST i està tot correcte --> INSERT a la BBDD
       * Si rep una petició GET amb un id --> Mostra el formulari amb les dades de la persona ID, i afegeix camp ocult ID
       * Si rep una petició POST i està tot correcte, i hi ha camp ID --> UPDATE a la BBDD
    * llistat.php
      * Mostra un llistat de totes les persones
      * Per cada persona afegeix un enllaç per editar-la (./index.php?id=XX)
      * Per cada persona afegeix un enllaç per esborrar-la (./delete.php?id=XX)
    * delete.php
      * Si rep una petició per GET amb un id --> DELETE de la persona amb id
