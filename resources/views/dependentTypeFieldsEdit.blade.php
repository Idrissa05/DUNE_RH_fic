if($("#type").val() == 'Contractuel'){
        $("label[for='matricule']").text("N° Identifiant");
        $('.titulaire, #indices, #salaries, #echelon, #classe, #auxiliaire').hide();
        $('#ref_engagement, #date_engagement, #ref_titularisation, #date_titularisation, #classe_id, #echelon_id, #auxiliaire').removeAttr('required').val('');
        $('#both').removeAttr('hidden').show();
        $('#date_prise_service').attr('required', true).val(data[0].date_prise_service);
        if(data[1] === false) {
            $('#category_id, #category, #corp_id, #corp, #cadre_id, #cadre, #fonction_id, #fonction').attr('hidden', true).attr('disabled', true);
        }else {
            $('#category_id, #category').val(data[1].category_id).removeAttr('disabled').removeAttr('hidden').show();
            $('#corp_id, #corp').val(data[1].corp_id).removeAttr('disabled').removeAttr('hidden').show();
            $('#fonction_id, #fonction').val(data[1].fonction_id).removeAttr('disabled').removeAttr('hidden').show();
            $('#cadre_id, #cadre').val(data[1].cadre_id).removeAttr('disabled').removeAttr('hidden').show();
        }
}else if($("#type").val() == 'Titulaire'){
        $("label[for='matricule']").text("N° Matricule");
        $('#both, #auxiliaire').hide();
        $('#date_prise_service, #auxiliaire').removeAttr('required').val('');
        if(data[1] === false){
            $('#category_id, #category, #classe_id, #classe, #echelon_id, #echelon, #ref_engagement, #date_engagement, #ref_titularisation, #date_titularisation, .titulaire, #indices, #salaries, #category_auxiliaire_id, #indice_id, #corp_id, #corp, #cadre_id, #cadre, #fonction_id, #fonction').attr('hidden', true).attr('disabled', true);
        }else {
            $('.titulaire, #classe, #echelon, #indices, #salaries, #category, #ref_engagement, #date_engagement, #ref_titularisation, #date_titularisation, #classe_id, #echelon_id, #category_id, #corp_id, #corp, #cadre_id, #cadre, #fonction_id, #fonction').attr('required', true).removeAttr('disabled').removeAttr('hidden').show();
            $('#category_id').val(data[1].category_id);
            $('#classe_id').val(data[1].classe_id);
            $('#echelon_id').val(data[1].echelon_id);
            $('#corp_id').val(data[1].corp_id);
            $('#fonction_id').val(data[1].fonction_id);
            $('#cadre_id').val(data[1].cadre_id);
            $('#ref_engagement').val(data[1].ref_engagement);
            $('#date_engagement').val(data[1].date_engagement);
            $('#ref_titularisation').val(data[1].ref_titularisation);
            $('#date_titularisation').val(data[1].date_titularisation);
            $("#indice").val('');
            $("#salary").val('');
            $.get('/api_indice?category_id=' + data[1].category_id + '&classe_id=' + data[1].classe_id + '&echelon_id=' + data[1].echelon_id,function(data) {
                $("#indice").val(data[0].value);
                $("#salary").val(data[0].salary);
            });
        }
}else if($("#type").val() == 'Auxiliaire'){
        $("label[for='matricule']").text("N° Identifiant");
        $('.titulaire, #indices, #salaries, #category ,#echelon, #classe').hide();
        $('#ref_engagement, #date_engagement, #ref_titularisation, #date_titularisation, #category_id, #classe_id, #echelon_id').removeAttr('required').val('');
        $('#both').removeAttr('hidden').show();
        $('#date_prise_service').attr('required', true).val(data[0].date_prise_service);
        if(data[1] === false){
            $('#category_auxiliaire_id, #auxiliaire, #corp_id, #corp, #cadre_id, #cadre, #fonction_id, #fonction').attr('hidden', true).attr('disabled', true);
        }else {
            $('#category_auxiliaire_id, #auxiliaire').val(data[1].category_auxiliaire_id).removeAttr('disabled').removeAttr('hidden').show();
            $('#corp_id, #corp').val(data[1].corp_id).removeAttr('disabled').removeAttr('hidden').show();
            $('#fonction_id, #fonction').val(data[1].fonction_id).removeAttr('disabled').removeAttr('hidden').show();
            $('#cadre_id, #cadre').val(data[1].cadre_id).removeAttr('disabled').removeAttr('hidden').show();
        }
}else $('.titulaire, #both, #classe, #echelon, #indices, #salaries, #auxiliaire, #category, #corp').attr('disabled', true).hide();
