fos.Router.setData({"base_url":"\/jolicar\/web\/app_dev.php","routes":{"joliecar_accueil":{"tokens":[["text","\/joliecar\/"]],"defaults":[],"requirements":[],"hosttokens":[]},"list_car":{"tokens":[["variable","\/","[^\/]++","page"],["text","\/joliecar\/liste-voitures"]],"defaults":{"page":1},"requirements":[],"hosttokens":[]},"joliecar_detail":{"tokens":[["variable","-","\\d+","id"],["variable","-","[^\/\\-]++","modele"],["variable","\/","[^\/\\-]++","marque"],["text","\/joliecar\/detail"]],"defaults":[],"requirements":{"id":"\\d+"},"hosttokens":[]},"update_car":{"tokens":[["variable","-","\\d+","id"],["variable","-","[^\/\\-]++","modele"],["variable","\/","[^\/\\-]++","marque"],["text","\/joliecar\/update"]],"defaults":[],"requirements":{"id":"\\d+"},"hosttokens":[]},"add_car":{"tokens":[["text","\/joliecar\/ajout"]],"defaults":[],"requirements":[],"hosttokens":[]},"add_marque":{"tokens":[["text","\/joliecar\/ajoutMarque"]],"defaults":[],"requirements":[],"hosttokens":[]},"add_modele":{"tokens":[["text","\/joliecar\/ajoutModele"]],"defaults":[],"requirements":[],"hosttokens":[]},"list_by_user":{"tokens":[["text","\/joliecar\/mes-voitures"]],"defaults":[],"requirements":[],"hosttokens":[]},"jc_search":{"tokens":[["text","\/joliecar\/search"]],"defaults":[],"requirements":[],"hosttokens":[]},"update_user":{"tokens":[["text","\/update-user"]],"defaults":[],"requirements":[],"hosttokens":[]},"update_info_user":{"tokens":[["text","\/update-info-user"]],"defaults":[],"requirements":[],"hosttokens":[]},"update_adresse":{"tokens":[["text","\/update-adresse"]],"defaults":[],"requirements":[],"hosttokens":[]},"update_password":{"tokens":[["text","\/update-userp"]],"defaults":[],"requirements":[],"hosttokens":[]}},"prefix":"","host":"localhost","scheme":"http"});