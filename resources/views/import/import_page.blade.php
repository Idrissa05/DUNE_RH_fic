@extends('layouts.material')

@section('css')
    <link rel="stylesheet" href="{{asset('upload/dropify.min.css')}}">
@stop

@section('content')
    <section class="card card-fluid">
        <h3 class="m-b-0 text-white text-center bg-primary">Importation par lots</h3>
        <div class="card-body">
            <a id="download" class="col-md-2 offset-3 btn btn-outline-info" href="{{asset('upload/importation_model.xlsx') }}"><span class="fa fa-download"> Télécharger le modèle</span></a>
            <form action="{{route('Imports.store')}}" id="upload-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col col-md-8 justify-content-center m-t-20">
                        <input type="file" id="input-file" class="dropify" name="input-file"/><br>
                        <button type="submit" class="col-md-4 offset-4 btn btn-primary"><span class="fa fa-upload">  Importer les données</span></button>
                    </div><br>
                    <div class="col col-lg-4 justify-content-center">
                        <div>
                            <h5 class="box-title col-md-8 offset-2">Liste des feuilles à importer :</h5>
                            @include('.import.fields')
                        </div>
                        <div class="col offset-md-1 justify-content-center button-box m-t-10">
                            <a id="select-all" class="btn btn-outline-warning" href="#">Sélectionner Tout</a>
                            <a id="deselect-all" class="btn btn-outline-primary" href="#">Désélectionner Tout</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <div id="loader" class="col-4 offset-4" hidden>
        <img class="col-4 offset-4" src='{{asset('upload/ajax-loader.gif')}}' height="70">
        <h6 style="text-align: center;"  id="state_text">Importation en cours...</h6>
    </div>
@stop

@section('js')
    <script src="{{asset('upload/dropify.min.js')}}"></script>
    <script>
        $('#fields').multiSelect({
            selectableOptgroup: true
        });
        $('#select-all').click(function() {
            $('#fields').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#fields').multiSelect('deselect_all');
            return false;
        });
         $(document).ready(function(){
             $('#upload-form').on('submit', function(event) {
                 event.preventDefault();
                 if($('#input-file').get(0).files.length !== 0){
                     if($('#fields :selected').length){
                         $('#fields :selected').each(function(i, selected) {
                             $("ol").append(`<li id="${$(selected).text()}">
                                     <button type="button" data-toggle="tooltip" title="Importation ${$(selected).text()}..." id="tooltip_${$(selected).text()}">
                                        <span class="progress-indicator"></span>
                                     </button>
                                 </li>`
                             );
                         });
                         $('#loader').removeAttr('hidden').show();
                         $.ajax({
                             url:"{{ route('Imports.store') }}",
                             method:"POST",
                             data: new FormData(this),
                             dataType:'JSON',
                             contentType: false,
                             cache: false,
                             processData: false,
                             error: function(){
                                 $('#loader').hide();
                                 swal("Veuillez essayer avec le bon fichier", "Erreur d'importation", "error");
                             }
                         }).done(function (data) {
                             if(data.success){
                                 swal({
                                     title: "Importation terminée avec succès !",
                                     text: "Good !",
                                     icon: "success"
                                 });
                                 $('#loader').hide();
                             }else {
                                 swal({
                                     title: "Importation terminée avec certaines erreurs ! Les feuilles suivantes n'ont pas été importées",
                                     text: "[ " +  data + " ]",
                                     icon: "warning"
                                 });
                                 $('#loader').hide();
                             }
                         });
                     }else{
                         swal({
                             title: 'Aucune Feuille Sélectionnée...',
                             text: "Veuillez choisir les feuilles à importer !",
                             icon: 'warning',
                             timer: '5000',
                             dangerMode :true
                         });
                     }
                 }else {
                     swal({
                         title: 'Aucun Fichier Sélectionné...',
                         text: "Veuillez sélectionner un fichier !",
                         icon: 'warning',
                         timer: '5000',
                         dangerMode :true
                     });
                 }
             });

             // Translated
             $('.dropify').dropify({
                 messages: {
                     default: '<center>Glissez-déposez un fichier ici ou cliquez</center>',
                     replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                     remove: 'Supprimer',
                     error: 'Désolé, le fichier trop volumineux'
                 }
             });
         });
     </script>
@stop


