<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Les 5 pages</title>
	<link rel="stylesheet" href="5pages.css" />
	<script src="folding.js"></script>
</head>

<body><input type="checkbox" id="toutafficher" /><input type="checkbox" id="numeroter" />
	<div class="interface">
	<div class="options">
	<label for="toutafficher">Tout afficher</label>
<!--	<label for="numeroter">Numéroter</label>-->
	</div>
		<h1>Les 5 pages</h1>
		<div class="instructions">
			<p>Pour chacune des 5 pages-types de traitement d'une base de données, les instructions cochées doivent se retrouver dans l'ordre suivant.</p>
			<p>Ce n'est pas une mauvaise idée de créer une fonction ou une méthode d'objet permettant de les exécuter.</p>
		</div>
		<table class="cinqpages">
			<col class="nom" />
			<colgroup class="coches">
				<col class="liste" />
				<col class="details" />
				<col class="ajout" />
				<col class="modif" />
				<col class="suppr" />

			</colgroup>
			<thead>
				<tr>
					<th></th>
					<th class="liste"><span><em>Liste</em></span></th>
					<th class="details"><span><em>Détails</em></span></th>
					<th class="ajout"><span><em>Ajout</em></span></th>
					<th class="modif"><span><em>Modif.</em></span></th>
					<th class="suppr"><span><em>Suppr.</em></span></th>
				</tr>
			</thead>
			<tbody class="connexion">
				<tr class="entete"><th>Section connexion</th></tr>
				<tr class="liste details ajout modif suppr">
					<td>Connexion
						<div>
							<p>Création d'un objet PDO</p>
							<p><strong>MySql</strong> : <code>$pdo = new PDO($dsn, $username, $password);</code></p>
							<p><strong>SQLite</strong> : <code>$pdo = new PDO("sqlite:" . $chemin_bd);</code></p>
							<p>Prendre soin de donner les bonnes valeurs aux variables.</p>
							<p>Optionnel : <code>$pdo-&gt;<a target="_blank" href="https://www.php.net/manual/fr/pdo.setattribute.php">setAttribute</a>(PDO::ERRMODE_WARNING);</code></p>
						</div>
					</td>
				</tr>
			</tbody>
			<tbody class="traitement">
				<tr class="entete"><th>Section traitement</th></tr>
				<tr class="ajout modif suppr">
					<td>Vérification de réception d’un formulaire
						<div>
							<p>Vérifier si le champ caché témoin a été reçu.</p>
							<p>Mot-clé : <code>isset</code></p>
							<p>Toute cette section ne doit s'exécuter que si le témoin est présent.</p>
						</div>
					</td>
				</tr>
				<tr class="modif suppr">
					<td>Récupération de la clé primaire (POST)
						<div>
							<p>Est récupérée avant le reste du formulaire pour être utilisée lors de l'annulation.</p>
							<p>Mot-clé : <code>$_POST</code></p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif suppr">
					<td>Annulation de l'opération au besoin
						<div>
							<p>Vérifier si le bouton "annuler" a été cliqué (reçu).</p>
							<p>Dans un tel cas, on retourne habituellement à la page de liste ou à la page de détails.</p>
							<p>Mots-clés : <code>isset</code>, <code>header</code></p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif">
					<td>Récupération des données du formulaire
						<div>
							<p>Mettre la valeur de chaque champ de formulaire dans une variable locale portant le même nom.</p>
							<p><code>$donnee = $_POST['donnee'];</code></p>
							<p>À l'occasion, on fait un traitement sommaire comme supprimer les espaces au début et à la fin de la chaine.</p>
							<p>Mots-clés : <code>$_POST</code>, <code>trim</code></p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif">
					<td>Validation des données
						<div>
							<p>S'assurer que l'on a bien reçu les données attendues avec le format attendu.</p>
							<p>Cette pratique sera détaillée ultérieurement.</p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif">
					<td>Traitement des données
						<div>
							<p>Faire en sorte que les données aient le type et le format attendu. Plusieurs techniques peuvent alors employées</p>
							<p>Quelques mots-clés : <code>strtoupper</code>, <code>str_replace</code>, <code>addslashes</code>, <code>intval</code>...</p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif suppr">
					<td>Composition du SQL de traitement
						<div>
							<p>Composition d'une commande SQL de modification de bd en y incluant des paramètres PDO. Un paramètre PDO est un identifiant choisi par vous précédé d'un deux-points. Exemple : <code style="border:1px solid black;">... WHERE id=:id</code></p>
							<p>Les commandes pour l'ajout, la modification et la suppression :</p>
							<ul>
								<li><code>INSERT INTO table (champ1, champ2) VALUES (:champ1, :champ2)</code></li>
								<li><code>UPDATE table SET champ1=:champ1, champ2=:champ2 WHERE id=:id</code></li>
								<li><code>DELETE FROM table WHERE id=:id</code></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr class="ajout modif suppr">
					<td>Préparation du statement
						<div>
							<p>Création d'un objet PDOStatement pour notre SQL.</p>
							<p><code>$stmt = $pdo-&gt;<a target="_blank" href="http://php.net/manual/fr/pdo.prepare.php">prepare</a>($sql);</code></p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif suppr">
					<td>Liaison de paramètres à des variables
						<div>
							<p>Établir un lien entre les variables contenant les données et les paramètres PDO de notre SQL.</p>
							<p><code>$stmt-&gt;<a target="_blank" href="http://php.net/manual/fr/pdostatement.bindparam.php">bindParam</a>(":champ", $champ);</code></p>
							<p>Sous certaines conditions, cette fonction peut être accomplie directement lors du <code>execute</code>. Voir ci-dessous.</p>
							<p>Voir aussi : <a target="_blank" href="http://php.net/manual/fr/pdostatement.bindvalue.php">bindValue</a>.</p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif suppr">
					<td>Exécution de la requête
						<div>
							<p><code>$stmt-&gt;<a target="_blank" href="http://php.net/manual/fr/pdostatement.execute.php">execute</a>();</code></p>
							<p>On peut également fournir les valeurs des paramètres et éviter le <code>bindParam</code> : Ex.: <code>$stmt-&gt;execute([':param1'=&gt;'valeur1'])</code></p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif suppr">
					<td>Redirection vers une autre page
						<div>
							<p>Habituellement, on n'a pas besoin de rafficher le formulaire. On fait donc une redirection.</p>
							<p>On peut rediriger vers la page de liste ou bien vers la page de détails en incluant la clé primaire dans l'adresse.</p>
							<p>Mot-clé : <code><a target="_blank" href="http://php.net/manual/fr/function.header.php">header</a></code></p>
						</div>
					</td>
				</tr>
			</tbody>
			<tbody class="composition">
				<tr class="entete"><th>Section composition</th></tr>
				<tr class="details modif suppr">
					<td>Récupération de la clé primaire (GET)<br/>avec renvoi en cas d’absence.
						<div>
							<p>Pour fonctionner, ces pages doivent recevoir par l'adresse la clé primaire d'un enregistrement.</p>
							<p>Si celle-ci n'est pas fournie, soit on affiche un message 404, soit on retourne directement vers la page d'accueil.</p>
							<p>Mots-clés : <code>$_GET</code>, <code><a target="_blank" href="http://php.net/manual/fr/function.header.php">header</a></code></p>
						</div>
					</td>
				</tr>
				<tr class="liste details modif">
					<td>Composition du SQL d'affichage
						<div>
							<p>Composition d'une commande SQL pour récupérer des données (SELECT).</p>
							<p>Les commandes SQL pour l'affichage :</p>
							<ul>
								<li><code>SELECT champ1, champ2 FROM table</code></li>
								<li><code>SELECT * FROM table WHERE id=:id</code></li>
							</ul>
						</div>
					</td>
				</tr>
				<tr class="liste details modif">
					<td>Composition et préparation du SQL (SELECT)
						<div>
							<p>Composition d'une commande SQL pour récupérer des données (SELECT).</p>
							<p>Création d'un objet PDOStatement pour notre SQL.</p>
							<p><code>$stmt = $pdo-&gt;<a target="_blank" href="http://php.net/manual/fr/pdo.prepare.php">prepare</a>($sql);</code></p>
							<p>Optionnel : <code>$stmt-&gt;<a target="_blank" href="https://www.php.net/manual/fr/pdostatement.setfetchmode.php">setFetchMode</a>(PDO::FETCH_CLASS, MaClasse::class);</code></p>
						</div>
					</td>
				</tr>
				<tr class="liste details modif">
					<td>Liaison de paramètres à des variables
						<div>
							<p>Établir un lien entre les variables contenant les données et les paramètres PDO de notre SQL.</p>
							<p><code>$stmt-&gt;<a target="_blank" href="http://php.net/manual/fr/pdostatement.bindparam.php">bindParam</a>(":champ", $champ);</code></p>
							<p>Sous certaines conditions, cette fonction peut être accomplie directement lors du <code>execute</code>. Voir ci-dessous.</p>
							<p>Voir aussi : <a target="_blank" href="http://php.net/manual/fr/pdostatement.bindvalue.php">bindValue</a>.</p>
						</div>
					</td>
				</tr>
<!--
				<tr class="liste details modif">
					<td>Liaison de colonnes à des variables
						<div>
							<p>Établir un lien entre les colonnes de notre requête et des variables créées pour l'occasion.</p>
							<p><code>$stmt-&gt;bindColumn("champ", $champ);</code></p>
							<p>Mot-clé : <code><a target="_blank" href="http://php.net/manual/fr/pdostatement.bindcolumn.php">bindColumn</a></code>, une méthode de l'objet PDOStatement.</p>
						</div>
					</td>
				</tr>
-->
				<tr class="liste details modif">
					<td>Exécution de la requête
						<div>
							<p><code>$stmt-&gt;<a target="_blank" href="http://php.net/manual/fr/pdostatement.execute.php">execute</a>();</code></p>
							<p>On peut également fournir les valeurs des paramètres et éviter le <code>bindParam</code> : Ex.: <code>$stmt-&gt;execute([':param1'=&gt;'valeur1'])</code></p>
						</div>
					</td>
				</tr>
			</tbody>
			<tbody class="affichage">
				<tr class="entete"><th>Section affichage</th></tr>
				<tr class="liste">
					<td>Récupération des enregistrements avec boucle
						<div>
							<p>Lorsqu'on a besoin de plusieurs enregistrements, on doit parcourir ceux-ci à l'aide d'une boucle.</p>
							<p>Mot-clé : <code><a target="_blank" href="http://php.net/manual/fr/pdostatement.fetch.php">fetch</a></code>, une méthode de l'objet PDOStatement, <code>while</code>.</p>
							<p>La boucle permettant de parcourir tous les enregistrements ressemble à ceci : <code>while ($enregistrement = $stmt-&gt;fetch()) {...}</code></p>
							<p>Noter le égal d'attribution (=) plutôt que de comparaison (==). Ce n'est pas une erreur.</p>
						</div>
					</td>
				</tr>
				<tr class="details modif">
					<td>Récupération de l’enregistrement sans boucle
						<div>
							<p>Lorsqu'on n'a besoin que d'un seul enregistrement, la boucle n'est pas nécessaire.</p>
							<p>Mot-clé : <code><a target="_blank" href="http://php.net/manual/fr/pdostatement.fetch.php">fetch</a></code>, une méthode de l'objet PDOStatement.</p>
						</div>
					</td>
				</tr>
				<tr class="liste details modif">
					<td>Affichage des données
						<div>
							<p>Dans ces pages, on doit inclure, dans l'affichage, des données provenant de la base de données. Soit dans une mise en page normale, soit comme valeurs d'un formulaire.</p>
						</div>
					</td>
				</tr>
				<tr class="ajout modif suppr">
					<td>Utilisation d'un formulaire
						<div>
							<p>Ces pages utilisent un formulaire.</p>
						</div>
					</td>
				</tr>
				<tr class="modif suppr">
					<td>Clé primaire dans le formulaire
						<div>
							<p>Dans le formulaire de ces pages, on doit inclure un champ caché (hidden) représentant la clé primaire de l'enregistrement.</p>
							<p>Cette donnée provient habituellement de l'adresse.</p>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
