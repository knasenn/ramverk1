
<h1>Ip validator json</h1>
<form action="" method="post" class="loginBox"><br>
    <input type="text" name="ip" placeholder="Enter ip adress" required><br>
    <input type="submit" value="Submit" >
</form>

<h2>Instruktioner</h2>
Skriv in en ip adress och klicka på "submit" för att kontrollera om den validerar.<br>
(Svaret returneras i JSON)

<h2>Test routes</h2>
<form method="post" class="loginBox">
    <input type="radio" name="ip" value="8.8.8.8" checked> 8.8.8.8<br>
    <input type="radio" name="ip" value="31.153.0.0" > 31.153.0.0<br>
    <input type="radio" name="ip" value="2a03:2880:f21a:e5:face:b00c::4420" > 2a03:2880:f21a:e5:face:b00c::4420<br>
    <input type="submit" value="Submit" >
</form>
