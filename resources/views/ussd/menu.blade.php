<?xml version="1.0" encoding="UTF-8"?> 
<html>
  <head>
    <title>Alerte consutation</title>
  </head>
  <body> 
  	Bienveun sur Sona+<br/>
    {{ __('Telephone: :phone', ['phone' => $telephone]) }}<br>
    {{ __('Session: :session', ['session' => $session]) }}<br>
    <a href="#">1. {{ __('Suivi prenatal') }}</a><br/>
    <a href="#">2. {{ __('Suivi cycle menstruel') }}</a><br/>
    <a href="#">3. {{ __('Tarifs') }}</a><br>
    <a href="#">4. {{ __('Quitter') }}</a><br>
    <input type="text" name="response"/></form>
  </body>
</html>