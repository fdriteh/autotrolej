<html>
<head></head>
<script type='text/javascript'>
	function promjena(proba) {
		document.getElementById('cijena').innerHTML = proba.value;
	}
	function okvir() {
		document.getElementById("img1").style.borderColor="#00FF00";
	}
</script>
<body>
<p>Odaberite kartu</p>
	<select name='zona' form='form' onchange='promjena(this)'>
		<option value='10' onchange='promjena(this)'>Zona 1.</option>
		<option value='15' onchange='promjena(this)'>Zona 2.</option>
		<option value='20' onchange='promjena(this)'>Zona 3.</option>
	</select>
	<p id='cijena'>Cijena: 10kn</p>
	<form action='kupnja.php' method='POST' id='form'>
	<p>Odaberite način plaćanja</p>
	<img src='visa.png' id='img1' class='slika1' width='50' height='55' onclick='okvir()'>
		<input type='hidden' name='karta' value='4'>
		<input type='submit' value='Nastavi'>
	</form>
</body>
</html>