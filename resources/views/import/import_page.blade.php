@extends('layouts.material')

@section('css')
    <link rel="stylesheet" href="{{asset('upload/dropify.min.css')}}">
    <style>
        .progress-list{position:relative;margin-bottom:1.25rem;margin-left:0;padding-left:0;list-style:none;display:-webkit-box;display:-ms-flexbox;display:flex}.progress-list>li{position:relative;width:100%;text-align:center}.progress-list>li:before{content:"";position:absolute;top:50%;left:50%;margin-top:-1px;width:100%;height:3px;background-color:rgba(61,70,79,.125)}.progress-list>li:last-child:before{display:none}.progress-list>li>button{padding:0;position:relative;display:inline-block;width:1rem;height:1rem;background-color:#e9eaeb;color:rgba(61,70,79,.125);border:4px solid #fff;vertical-align:middle;border-radius:1rem;line-height:1;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;white-space:normal;z-index:1}.progress-list>li>button:active,.progress-list>li>button:focus{outline:0;-webkit-box-shadow:0 0 0 2px #346cb0;box-shadow:0 0 0 2px #346cb0}.progress-list>.error>button,.progress-list>.success>button{width:24px;height:24px}.progress-list .progress-indicator{display:none;width:1rem;height:1rem;background-size:cover;background-repeat:no-repeat}.progress-list .progress-label{display:inline-block;position:absolute;top:1.75rem;left:50%;-webkit-transform:translate3d(-50%,0,0);transform:translate3d(-50%,0,0);font-size:.875rem;color:#686f76}.progress-list>.active:before{background-color:#346cb0}.progress-list>.active>button{color:#346cb0;background-color:#346cb0;border-color:#346cb0}.progress-list>.active>button:active,.progress-list>.active>button:focus{-webkit-box-shadow:0 0 0 2px #346cb0;box-shadow:0 0 0 2px #346cb0}.progress-list>.active .progress-indicator{color:#346cb0}.progress-list>.active:before{background-color:rgba(61,70,79,.125)}.progress-list>.active>button{background-color:#fff}.progress-list>.active .progress-label{color:#28313b}.progress-list>.success:before{background-color:#346cb0}.progress-list>.success>button{color:#346cb0;background-color:#fff;border-color:#fff}.progress-list>.success>button:active,.progress-list>.success>button:focus{-webkit-box-shadow:0 0 0 2px #346cb0;box-shadow:0 0 0 2px #346cb0}.progress-list>.success .progress-indicator{color:#346cb0}.progress-list>.success .progress-label{color:#28313b}.progress-list>.error:before{background-color:#ea6759}.progress-list>.error>button{color:#ea6759;background-color:#fff;border-color:#fff}.progress-list>.error>button:active,.progress-list>.error>button:focus{-webkit-box-shadow:0 0 0 2px #ea6759;box-shadow:0 0 0 2px #ea6759}.progress-list>.error .progress-indicator{color:#ea6759}.progress-list>.error:before{background-color:rgba(61,70,79,.125)}.progress-list>.active .progress-indicator,.progress-list>.error .progress-indicator,.progress-list>.success .progress-indicator{display:inline-block}.progress-list>.success .progress-indicator{background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%2300A28A' viewBox='0 0 24 24'%3e%3cpath d='M12 .9C5.9.9.9 5.9.9 12s5 11.1 11.1 11.1 11.1-5 11.1-11.1S18.1.9 12 .9zm6.2 8.3l-7.1 7.2c-.3.3-.7.3-1 0l-3.9-3.9c-.2-.3-.2-.8 0-1.1l1-1c.3-.2.8-.2 1.1 0l2 2.1c.2.2.5.2.7 0l5.2-5.3c.2-.3.7-.3 1 0l1 1c.3.2.3.7 0 1z'%3e%3c/path%3e%3c/svg%3e")}.progress-list>.error .progress-indicator{background-image:url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23EA6759' viewBox='0 0 24 24'%3e%3cpath xmlns='http://www.w3.org/2000/svg' d='M12 .9C5.9.9.9 5.9.9 12s5 11.1 11.1 11.1 11.1-5 11.1-11.1S18.1.9 12 .9zm2.3 11.5l3.6 3.6c.1.2.1.4 0 .6l-1.3 1.3c-.2.2-.5.2-.7 0l-3.6-3.6c-.2-.2-.4-.2-.6 0l-3.6 3.6c-.2.2-.5.2-.7 0l-1.3-1.3c-.1-.2-.1-.4 0-.6l3.6-3.6c.2-.2.2-.5 0-.7L6.1 8.1c-.2-.2-.2-.5 0-.7l1.3-1.3c.2-.1.4-.1.6 0l3.7 3.7c.2.2.4.2.6 0l3.6-3.6c.2-.2.5-.2.7 0l1.3 1.3c.1.2.1.4 0 .6l-3.6 3.6c-.2.2-.2.5 0 .7z'%3e%3c/path%3e%3c/svg%3e")}
    </style>
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

    <div id="step" hidden>
        <ol class="progress-list mb-0 mb-sm-4">
            <li class="active" id="load">
                <button type="button" data-toggle="tooltip" title="Chargement des données..." id="tooltip_load">
                    <span class="progress-indicator"></span>
                </button>
            </li>
            <li id="equipement">
                <button type="button" data-toggle="tooltip" title="Importation des Equipements..." id="tooltip_equipemenr">
                    <span class="progress-indicator"></span>
                </button>
            </li>
            <li id="alarme">
                <button type="button" data-toggle="tooltip" title="Importation des Alarmes..." id="tooltip_alarme">
                    <span class="progress-indicator"></span>
                </button>
            </li>
        </ol>
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
                 //$('#step').removeAttr('hidden').show();
                 $('#loader').removeAttr('hidden').show();
                 if($('#input-file').get(0).files.length !== 0){
                     if($('#fields :selected').length){
                         $.ajax({
                             url:"{{ route('Imports.store') }}",
                             method:"POST",
                             data: new FormData(this),
                             dataType:'JSON',
                             contentType: false,
                             cache: false,
                             processData: false,
                             error: function(){
                                 $('#equipement').removeClass();
                                 $('#alarme').removeClass();
                                 $('#load').removeClass('success').addClass('active');
                                 $('#loader').hide();
                                 $('#step').hide();
                                 swal("Veuillez essayer avec le bon fichier", "Erreur d'importation", "error");
                             }
                         }).done(function (data) {
                             $('#load').addClass('success');
                             $('#equipement').addClass('active');
                             setTimeout(function () {
                                 if (data.equipement){$('#equipement').addClass('active error');}else{$('#equipement').addClass('success');}
                                 $('#alarme').addClass('active');
                                 $("ol").append("<li>list item</li>");
                                 setTimeout(function () {
                                     if (data.alarme){$('#alarme').addClass('active error');}else{$('#alarme').addClass('success');}
                                     setTimeout(function () {
                                         $('#equipement').removeClass();
                                         $('#alarme').removeClass();
                                         $('#load').removeClass('success').addClass('active');
                                         $('#step').hide();
                                         $('#loader').hide();
                                         if(data.equipement || data.alarme){
                                             swal({
                                                 title: "Importation terminée avec certaines erreurs !",
                                                 text: "Veuillez vérifier les données du fichiers excel !",
                                                 icon: "warning"
                                             });
                                         }else {
                                             swal({
                                                 title: "Importation terminée avec succès !",
                                                 text: "Good !",
                                                 icon: "success"
                                             });
                                         }
                                     },1000)
                                 },2000);
                             },2000);
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


