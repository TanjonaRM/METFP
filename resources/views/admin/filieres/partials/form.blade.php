<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    

    @if(!isset($filiere))
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            Options (une par ligne)
        </label>
        <textarea name="options_text" rows="4" class="input-modern"
                  placeholder="Ex:&#10;Génie Logiciel&#10;Réseaux et Télécommunications&#10;Sécurité Informatique"></textarea>
        <p class="text-xs text-gray-400 mt-1">Chaque ligne deviendra une option de la filière.</p>
    </div>
    @endif

</div>