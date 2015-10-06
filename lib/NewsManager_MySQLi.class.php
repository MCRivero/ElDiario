<?php
class NewsManager_MySQLi extends NewsManager
	{
		/*** Attribut contenant l'instance repr�sentant la BDD.
		* @type MySQLi
		*/
		
		protected $db;
		
		/*** Constructeur �tant charg� d'enregistrer l'instance de MySQLi dans l'attribut $db.
		* @param $db MySQLi Le DAO
		* @return void
		*/
		
		public function __construct(MySQLi $db)
			{
				$this->db = $db;
			}
			
		/*** @see NewsManager::add() */
		
		protected function add(News $news)
			{
				
				$requete = $this->db->prepare('INSERT INTO news SET auteur = ?, ' .
												'titre = ?, contenu = ?, photo = ?, enlace = ?, dateAjout = NOW(), dateModif = NOW()');
				$requete->bind_param('sssss', $news->auteur(), $news->titre(), $news->contenu(), $news->photo(), $news->enlace());
				$requete->execute();
			}
			
		/*** @see NewsManager::count() */
		
		public function count()
			{
				return $this->db->query('SELECT id FROM news')->num_rows;
			}
			
		/*** @see NewsManager::delete() */
		
		public function delete($id)
			{
				$id = (int) $id;
				$requete = $this->db->prepare('DELETE FROM news WHERE id = ?');
				$requete->bind_param('i', $id);
				$requete->execute();
			}
			
			/*** @see NewsManager::getList() */
			
			public function getList($debut = -1, $limite = -1)
				{
					$listeNews = array();
					$sql = 'SELECT id, auteur, titre, contenu, photo, enlace, DATE_FORMAT ' .
							'(dateAjout, \' %d/%m/%Y a %Hh%i\') AS dateAjout, DATE_FORMAT ' .
							'(dateModif, \' %d/%m/%Y a %Hh%i\') AS dateModif FROM news ORDER BY ' .
							'id DESC';
							
					// On v�rifie l'int�grit� des param�tres fournis.
					
					if ($debut != -1 || $limite != -1)
						{
							$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
						}
					$requete = $this->db->query($sql);
					while ($news = $requete->fetch_object('News'))
						{
							$listeNews[] = $news;
						}
					return $listeNews;
			}
			
			/*** @see NewsManager::getUnique() */
			
			public function getUnique($id)
				{
					$id = (int) $id;
					$requete = $this->db->prepare('SELECT id, auteur, titre, ' .
								'contenu, photo, enlace, DATE_FORMAT (dateAjout, \' %d/%m/%Y a %Hh%i\') AS ' .
								'dateAjout, DATE_FORMAT (dateModif, \' %d/%m/%Y  a %Hh%i\') AS ' .
                                'dateModif FROM news WHERE id = ?');
					$requete->bind_param('i', $id);
					$requete->execute();
					$requete->bind_result($id, $auteur, $titre, $contenu, $photo, $enlace, $dateAjout, $dateModif);
					$requete->fetch();
					return new News(array('id' => $id, 'auteur' => $auteur, 'titre' => $titre, 'contenu' => $contenu,
											'photo' => $photo, 'enlace' => $enlace, 'dateAjout' => $dateAjout, 'dateModif' => $dateModif ));
			}
			
			/*** @see NewsManager::update() */
			
			protected function update(News $news)
				{
					$requete = $this->db->prepare('UPDATE news SET auteur = ?, titre ' .
													'= ?, contenu = ?, photo = ?, enlace = ?, dateModif = NOW() WHERE id = ?');
					$requete->bind_param('sssssi', $news->auteur(), $news->titre(),
											$news->contenu(), $news->photo(), $news->enlace(), $news->id());
					$requete->execute();
			}
	}