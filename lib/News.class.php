<?php

/**
* Classe repr�sentant une news, cr��e � l'occasion d'un TP du
*tutoriel � La programmation orient�e objet en PHP � disponible sur
*http://www.siteduzero.com/
* @author Victor T.
* @version 2.0
*/

class News
	{
		protected $erreurs = array(),
		$id,
		$auteur,
		$titre,
		$contenu,
		$dateAjout,
		$dateModif,
		$photo,
		$enlace;
		
		/*** Constantes relatives aux erreurs possibles rencontr�es lors de l'ex�cution de la m�thode. */
		const AUTEUR_INVALIDE = 1;
		const TITRE_INVALIDE = 2;
		const CONTENU_INVALIDE = 3;
		const PHOTO_INVALIDE = 4;
		const ENLACE_INVALIDE = 5;
		
		/*** Constructeur de la classe qui assigne les donn�es sp�cifi�es en param�tre aux attributs correspondants.
		* @param $valeurs array Les valeurs � assigner
		* @return void
		*/
		
		public function __construct($valeurs = array())
			{
				if (!empty($valeurs)) // Si on a sp�cifi� des valeurs, alors on hydrate l'objet.
					{
						$this->hydrate($valeurs);
					}
			}
			
		/** * M�thode assignant les valeurs sp�cifi�es aux attributs correspondant.
		* @param $donnees array Les donn�es � assigner
		* @return void
		*/
		
		public function hydrate($donnees)
			{
				foreach ($donnees as $attribut => $valeur)
					{
						$methode = 'set'.ucfirst($attribut);
						if (is_callable(array($this, $methode)))
							{
								$this->$methode($valeur);
							}
					}
			}
			
		/**
		* M�thode permettant de savoir si la news est nouvelle.
		* @return bool
		*/
		
		public function isNew()
			{
				return empty($this->id);
			}
			
		/**  M�thode permettant de savoir si la news est valide.
		* @return bool
		*/
		
		public function isValid()
			{

				
				return !(empty($this->auteur) || empty($this->titre) ||
				empty($this->contenu) || empty($this->photo) || empty($this->enlace));
			}
			
// SETTERS //

	public function setId($id)
		{
			$this->id = (int) $id;
		}
		
	public function setAuteur($auteur)
		{
			if (!is_string($auteur) || empty($auteur))
				{
					$this->erreurs[] = self::AUTEUR_INVALIDE;
				}
			else
				{
					$this->auteur = $auteur;
			}
		}
		
	public function setTitre($titre)
		{
			if (!is_string($titre) || empty($titre))
				{
					$this->erreurs[] = self::TITRE_INVALIDE;
				}
			else
				{
					$this->titre = $titre;
				}
		}
	public function setContenu($contenu)
		{
			if (!is_string($contenu) || empty($contenu))
				{
					$this->erreurs[] = self::CONTENU_INVALIDE;
				}
			else
				{
					$this->contenu = $contenu;
				}
		}

	public function setPhoto($photo)
		{
			if (!is_string($photo) || empty($photo))
				{
					$this->erreurs[] = self::PHOTO_INVALIDE;
				}
			else
				{
					$this->photo = $photo;
				}
		}
	
	public function setEnlace($enlace)
		{
			if (!is_string($enlace) || empty($enlace))
				{
					$this->erreurs[] = self::ENLACE_INVALIDE;
				}
			else
				{
					$this->enlace = $enlace;
				}
		}
		
	public function setDateAjout($dateAjout)
		{
			if (is_string($dateAjout) && preg_match('"el [0-9]{2}/[0-9]{2}/[0-9]{4} � [0-9]{2}h[0-9]{2}"', $dateAjout))
				{
					$this->dateAjout = $dateAjout;
				}
		}
		
	public function setDateModif($dateModif)
		{
			if (is_string($dateModif) && preg_match('"el [0-9]{2}/[0-9]{2}/[0-9]{4} � [0-9]{2}h[0-9]{2}"', $dateModif))
				{
					$this->dateModif = $dateModif;
				}
		}
		
// GETTERS //

	public function erreurs()
		{
			return $this->erreurs;
		}
		
	public function id()
		{
			return $this->id;
		}
		
	public function auteur()
		{
			return $this->auteur;
		}
		
	public function titre()
		{
			return $this->titre;
		}
		
	public function contenu()
		{
			return $this->contenu;
		}
		
	public function photo()
		{
			return $this->photo;
		}
		
	public function enlace()
		{
			return $this->enlace;
		}
		
	public function dateAjout()
		{
			return $this->dateAjout;
		}
		
	public function dateModif()
		{
			return $this->dateModif;
		}
}

