$(function () {
    $('#corp_id').on('change', function(e){
        let corp_id = $("#corp_id option:selected").val();
        $.get('/api_category?corp_id=' + corp_id,function(data) {
            $("#category_id").val(data.id)
        });
    });

    $('#category_id').on('change', function () {
        $('#classe_id').val('');
        $('#echelon_id').empty().append('<option value selected="selected">Sélectionner</option>');
        $("#indice").val('');
        $("#salary").val('');
    });

    $('#classe_id').on('change', function(e){
        let classe_id = $("#classe_id option:selected").val();
        $.get('/api_echelon?classe_id=' + classe_id,function(data) {
            $('#echelon_id').empty().append('<option value selected="selected">Sélectionner</option>');
            $("#indice").val('');
            $("#salary").val('');
            $.each(data, function(index, echelon){
                $('#echelon_id').append('<option value="'+ echelon.id +'">'+ echelon.name +'</option>');
            })
        });
    });

    $('#echelon_id').on('change', function(e){
        $("#indice").val('');
        $("#salary").val('');
        $("#indice_id").val('');
        let category_id = $("#category_id option:selected").val();
        let classe_id = $("#classe_id option:selected").val();
        let echelon_id = $("#echelon_id option:selected").val();
        $.get('/api_indice?category_id=' + category_id + '&classe_id=' + classe_id + '&echelon_id=' + echelon_id,function(data) {
            $("#indice").val(data[0].value);
            $("#salary").val(data[0].salary);
            $("#indice_id").val(data[0].id);
        });
    });

    $("#indice").val('');
    $("#salary").val('');
    $.get('/api_indice?category_id=' + $("#category_id option:selected").val() + '&classe_id=' + $("#classe_id option:selected").val() + '&echelon_id=' + $("#echelon_id option:selected").val(),function(data) {
        if(data[0]){
            $("#indice").val(data[0].value);
            $("#salary").val(data[0].salary);
        }
    });
})
