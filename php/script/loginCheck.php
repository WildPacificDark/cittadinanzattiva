<?php 

	echo '
			<div>
				<h2>Accedi</h2>
				';
	//L'UTENTE HA CERCATO DI FARE L'ACCESSO?
	if(isset($_GET['loginStatus']))
	{
		//PRELIEVA RISULTATO LOGIN
		$loginStatus = $_GET['loginStatus'];
	}
	//ALTRIMENTI IMPOSTA A 1, NESSUN TENTATIVO DI ACCESSO EFFETTUATO
	else $loginStatus = 1;

	//CONTROLLA SE L'UTENTE HA PROVATO AD EFFETTUARE L'ACCESSO
	//MA LE CREDENZIALI ERANO ERRATE
	if($loginStatus == 0) echo '<h4 id="loginStatus">Errore: Username o Password Errati</h4>
			';
	echo '	<form class="contenuto-modulo animato" action="../php/form/Login.php" method="post">
					<div class="container">
						<fieldset>
							<legend>Login</legend>
							<label for="username">Username</label>
							<input type="text" id="username" name="username" placeholder="Username" required="required" />
							<label for="password">Password</label>
							<input type="password" id="password" name="password"  maxlength="16" placeholder="Password" required="required" />
							<button type="submit">Accedi</button>
						</fieldset>
					</div>
				</form>
			</div>
';
?>
