var myHelpers =  {
    deleteConfirmation: function(target) {
    swal({
        'title': 'êtes-vous sûr ?',
        'text': 'Voulez-vous bien supprimer cet enregistrement',
        'icon': 'warning',
        'buttons':  {
            'cancel': 'Annuler',
            'confirm': true
        },
        'dangerMode': true
    }).then((willDelete) => {
        if(willDelete) {
            document.getElementById(target).submit();
        }
    })
}
}
