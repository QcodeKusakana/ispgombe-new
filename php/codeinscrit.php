<?php
// Ancien handler d’inscription non utilisé par le routeur actuel. Il contenait un mot de passe étudiant par défaut et des téléversements non sûrs.
http_response_code(404);
exit('Le traitement de préinscription en ligne est désactivé.');
