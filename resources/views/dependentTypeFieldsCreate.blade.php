 if($("#type option:selected").val() == 'Contractuel'){
        $("label[for='matricule']").text("N° Identifiant");
        $('#titulaire, #indices, #salaries, #echelon, #classe, #auxiliaire').hide();
        $('#ref_engagement, #date_engagement, #ref_titularisation, #date_titularisation, #classe_id, #echelon_id, #auxiliaire').removeAttr('required').val('');
        $('#both, #category').removeAttr('hidden').show();
        $('#date_prise_service, #category_id').attr('required', true);
}else if($("#type option:selected").val() == 'Titulaire'){
        $("label[for='matricule']").text("N° Matricule");
        $('#both, #auxiliaire').hide();
        $('#date_prise_service, #auxiliaire').removeAttr('required').val('');
        $('#titulaire, #classe, #echelon, #indices, #salaries, #category').removeAttr('hidden').show();
        $('#ref_engagement, #date_engagement, #ref_titularisation, #date_titularisation, #classe_id, #echelon_id, #category_id').attr('required', true);
}else if($("#type option:selected").val() == 'Auxiliaire'){
        $("label[for='matricule']").text("N° Identifiant");
        $('#titulaire, #indices, #salaries,#category, #echelon, #classe').hide();
        $('#ref_engagement, #date_engagement, #ref_titularisation, #date_titularisation, #classe_id, #echelon_id').removeAttr('required').val('');
        $('#both, #auxiliaire').removeAttr('hidden').show();
        $('#date_prise_service, #auxiliaire').attr('required', true);
}else $('#titulaire, #both, #classe, #echelon, #indices, #salaries, #auxiliaire').hide();
