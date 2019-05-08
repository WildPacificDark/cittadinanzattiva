<?php
    
    include '../php/script/editDocument.php';
    
    $request = 'selectNews';
    $xml = loadDocument($request);
    $root = $xml->documentElement;
    
    // Se non c'è nessuna notizia da eliminare
    if($root->getElementsByTagName('news')->item(0) == NULL) 
    {
        echo '<p>Non ci sono notizie da eliminare</p>
					</form>
				</div>
            </div>';
        echo "\r\n";
    }
    //Altrimenti crea l'elenco di notizie da eliminare
    else 
    {
        echo '<select id="delete" name="deleteNews">
									';
        $value = 0;
        $newsId = $n_ele = $xml->getElementsByTagName('news')[0]->getAttribute('id');
    
        for($i = 0; $i < $n_ele; $i += 1) {
            $title = $xml->getElementsByTagName('titolo')[$i];
            echo '<option value="' . $value . '">News #' . $newsId . " - " . $title->nodeValue . '</option>
							';
            $newsId -= 1;
            $value += 1;

        }
        echo '	</select>
							<button type="submit">Elimina</button>
						</div>
					</form>
				</div>
			</div>';
    }
    
?>