<?php
include("header.html")

?>
<body>
	
		<h1>Jeu du Pendu</h1>
	<div class="container-fluid">
	<div class="centrage center">
		
		<div id="mot"></div>
		<div id ="clavier"></div>
		<div id ="bravo">Trouves le mot<br/>en moins de 10 erreurs.</div>
		<div id="pendu">
			<div id="p1"></div>
			<div id="p2"></div>
			<div id="p3"></div>
			<div id="p4"></div>
			<div id="p5"></div>
			<div id="p6"></div>
			<div id="p7"></div>
			<div id="p8"></div>
			<div id="p9"></div>
			<div id="p10"></div>
		</div>
	</div>
</div>
	<!-- javascript -->
	<script type="text/javascript">
	var score = 0 ;
	
	/* alphabet */
	var alphabet = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];

	function demarre(){
		/* prend un mot au hasard dans une liste grace a math.floor(math.random()*...)*/
		var mots = ["poisson", "haricot", "animal", "chat", "hamster", "fruit", "souris", "dragon", "oiseau", "arbre","plante","concombre", "orange", "bleu", "vert",  "velo",  "train",  "metro", "elephant", "girafe", "rose", "zebre", "fourmi", "kiwi", "ananas", "hibou", "chouette", "balais", "reveil", "clavier", "stylo", "feutre", "bracelet", "feuille", "papier", "castor", "perle", "veste", "bague", "roue", "voiture", "camion", "tortue", "chien", "singe", "cheval", "lit","chaussure", "myrtille", "chocolat", "vanille", "tasse", "cuillere", "assiette","loup","lasagnes", "patte", "cornichon", "oignon", "marron", "arbre", "courgette", "crotte", "main", "pied", "langue", "bonbon", "menthe", "abricot", "gateau", "riz", "poulet", "poney", "yeux", "oeil", "ongle", "bouche", "levre", "lievre", "limace", "escargot", "plante", "herbe", "cactus", "corde", "lait", "grenadine", "jardin", "tomate", "asperge", "concombre", "livre", "serviette", "table", "miroir", "manette","acide", "sucre", "cabane", "cadeau", "chemin", "cochon", "mouton", "laine", "feu", "lumiere", "chevre"];
		var x = Math.floor(Math.random() * mots.length);
		var mot = mots[x];
		return mot;
	}
	mot = demarre();
	
	function tableau_mot(mot){
		/* on fait un tableau avec les lettres du mot */
		var tab_mot = [];
		for (i=0; i<mot.length; i++){
			tab_mot[i]=mot.substr(i,1);
		}
		return tab_mot;
	}
	tab_mot = tableau_mot(mot);
	
	function tableau_mot_decouvert(mot){
	
		/* on fait un nouveau tableau avec des _ à la place de chaque lettre. On changera la valeur à chaque lettre découverte. */
		var tab_mot_decouvert = [];
		for (i=0; i<mot.length; i++){
			tab_mot_decouvert[i]="_";
		}

		/* affichage du mot */
		for (i=0; i<mot.length; i++){
			document.getElementById('mot').innerHTML=document.getElementById('mot').innerHTML+" "+tab_mot_decouvert[i]+" ";
		}
		return tab_mot_decouvert;
	}
	tab_mot_decouvert = tableau_mot_decouvert(mot);
	
	/* affichage du clavier */
	for (a=0; a<alphabet.length; a++){
		document.getElementById('clavier').innerHTML=document.getElementById('clavier').innerHTML+' <span id="'+alphabet[a]+'">'+alphabet[a]+'</a> ';
	}
	
	/* on compte le nombre d'essais */
	var essais = 0;

	/* on cherche si la lettre cliquée est bonne */
	for (a=0; a<alphabet.length; a++){
	var lettre = alphabet[a];
		document.getElementById(lettre).onmousedown = function () {
			lettre = this.id;
			var trouve = "";
			
			for (i=0; i<mot.length; i++){
				
				if (tab_mot[i]==lettre){
					tab_mot_decouvert[i]=lettre;
					document.getElementById('mot').innerHTML="";
					for (k=0; k<mot.length; k++){
						document.getElementById('mot').innerHTML=document.getElementById('mot').innerHTML+" "+tab_mot_decouvert[k]+" ";
						document.getElementById('bravo').innerHTML="Oui, il y a un "+lettre+" !";
						var trouve = "oui";
					}
				}

				/* coloration des lettres déjà cliquées */
				document.getElementById(lettre).style.backgroundColor="#6bc199";
				document.getElementById(lettre).style.color="#ffffff";

			}
			if(trouve==""){ //si la lettre n'est pas dans le mot
					essais++;
					document.getElementById('bravo').innerHTML="Non, pas de "+lettre+" dans ce mot.<br/> Tu as encore "+(10-essais)+" essais.";
					document.getElementById('p'+essais).style.display="block";
				}
			if(tab_mot_decouvert.indexOf("_")==-1){
				score++;
				document.getElementById('bravo').innerHTML="Bravo, tu as trouvé le mot "+mot+" !<br/><a href='index.html'>Rejouer</a>";
				document.getElementById('bravo').style.backgroundColor="#c4c285";
				document.getElementById('mot').innerHTML="";
				mot=demarre();
				tab_mot=tableau_mot(mot);
				tab_mot_decouvert=tableau_mot_decouvert(mot);
				for (a=0; a<alphabet.length; a++){// décoloration du clavier
					document.getElementById(alphabet[a]).style.backgroundColor="#dddddd";
					document.getElementById(alphabet[a]).style.color="#000000";
				}
			}
			if(essais>=10){
				document.getElementById('mot').innerHTML=mot;
				document.getElementById('bravo').innerHTML="Perdu, tu n'as plus d'essais !<br/><a href='index.html'>Rejouer</a>";
				document.getElementById('bravo').style.backgroundColor="#85c4b2";
			}
		}
	}

	
	
	</script>

<?php
include("footer.html")

?>