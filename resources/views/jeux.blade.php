<meta name="csrf-token" content="{{ csrf_token() }}"> 

<form onsubmit="send()" id="formAjout">
    
    <label for="nom">nom :</label>
    <input name="nom" type="text" id="nom">

    <label for="editeur">Éditeur :</label>
    <input name="editeur" type="text" id="editeur">

    <label for="prix">Prix :</label>
    <input name="prix" type="text" id="prix">

    <label for="description">Description :</label>
    <input name="description" type="text" id="description">

    <input type="submit" id="btn_form" value="Ajouter">
    
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</form>

<p id="donnees"></p>
<p id="temporaire"></p>