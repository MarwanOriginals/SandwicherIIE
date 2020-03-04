
<?php include 'header.php';?>

<article id="CreerCompte">
    <section>
        <h3 class="major">Création de compte</h3>
        <?
        $userRepository = new \User\UserRepository(\Db\Connection::get());
        $userService = new \User\UserService($userRepository);
        $newUser = new \User\User();
        $newUser->setFirstname("Noel");
        $newUser->setLastname("Flantier");
        $newUser->setBirthday(new DateTimeImmutable("01/01/1965"));
        $newUser->setMail("bla@bla.fr");
        $pseudo="";
        $password="";
        echo
        "<form name=\"CreateAccount\" method=\"post\" action=\"#\">
										<div class=\"fields\">
											<div class=\"field thrid\">
												<label for=\"pseudo\">Pseudo</label>
												<input type=\"text\" name=\"pseudo\" id=\"pseudo\" value=\"\" placeholder=\"Snitchy\" />
											</div>
											<div class=\"field half\">
												<label for=\"password\">Mot de passe</label>
												<input type=\"password\" name=\"password\" id=\"password\" value=\"\" placeholder=\"**********\" autocomplete=\"off\" />
											</div>
											<div class=\"field half\">
												<label for=\"newmdp2\">Confirmation mot de passe</label>
												<input type=\"password\" name=\"newmdp2\" id=\"newmdp2\" value=\"\" placeholder=\"**********\" autocomplete=\"off\" />
											</div>

										</div>
										<div>
											<ul class=\"actions\">
											<li><button name =\"btnSignUp\" id=\"btnSignUp\" type=\"submit\" value=\"Créer un compte\" class=\"primary\">Créer un compte</button></li>
											</ul>
										</div>
									</form>";
        echo ("<script>console.log('PHP: " . $pseudo . "');</script>");
        $newUser->setPseudo($_POST["pseudo"]);
        $newUser->setPassword($_POST["password"]);
        $userService->createUser($newUser);
        ?>
    </section></article>

<?php include 'footer.php';?>