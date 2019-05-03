var monAjax =  {

    store: function (url, data,table = null) {
        $('#ajaxBtn').html('chargement ...')
        $('#ajaxBtn').prop('disabled', true)
        $('.loader').show()
        axios.post(url, data)
            .then(function (response) {
                $('input[type="text"]').val('')
                if(table) {
                    table.ajax.reload()
                }
                swal({
                    title: "Enregisté !",
                    text: "Opération effectuée!",
                    icon: "success",
                    button: "Ok",
                }).then(function () {

                    return window.location.reload()
                })
            }).
            catch(function (error) {
            let all = '';
            let items = error.response.data.errors
            for(let er in items) {
                all += '\n'+items[er]
            }

            swal({
                title: "Erreur !",
                text: "Opération non  effectuée!"+all,
                icon: "error",
                button: "Ok",
            });
        }).finally(function () {
            $('#ajaxBtn').html('Ajouter')
            $('#ajaxBtn').prop('disabled', false)
            $('.loader').hide()
        })
    },
    storeSale: function(url, data) {
        $('.loader').show()
        axios.post(url, data)
        .then(function (response) {
                swal({
                    title: "Enregisté !",
                    text: "Vente effectuée!",
                    icon: "success",
                    button: "Ok",
                }).then(function () {
                    window.location.href = '/prints/receipt/'+response.data.id
                })
            }).
            catch(function (error) {
                let all = '';
                let items = error.response.data.errors
                for(let er in items) {
                    all += '\n'+items[er]
                }

                swal({
                    title: "Erreur !",
                    text: "Opération non  effectuée!"+all,
                    icon: "error",
                    button: "Ok",
                });
            }).finally(function () {
            $('.loader').hide()
        })
    },
    update: function (url, data) {
        $('.loader').show()
        axios.post(url, data)
            .then(function (response) {
                table.ajax.reload()
                swal({
                    title: "Mise à jour!",
                    text: "Opération effectuée!",
                    icon: "success",
                    button: "Ok",
                });
            }).
            catch(function (error) {
            let all = '';
            let items = error.response ? error.response.data.errors : []
            for(let er in items) {
                all += '\n'+items[er]
            }
            swal({
                title: "Erreur !",
                text: "Opération non  effectuée!"+all,
                icon: "error",
                button: "Ok",
            });
        }).finally(function () {
            $('.loader').hide()
        })
    },

    delete: function (url, table = null) {
        swal({
            title: "êtes-vous sûr ?",
            text: "Confirmation de la suppression",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete(url).then(function () {
                        if(table) {
                            table.ajax.reload()
                        }else {
                            window.location.reload()
                        }
                        swal("Suppression effectuée", {
                            icon: "success",
                        });
                    })

                } else {
                    swal("Suppression annulée!");
                }
            });
    },
    
    confirmation: function (message, form) {
        $(form).submit(function (e) {
            e.preventDefault()
            swal({
                title: "êtes-vous sûr ?",
                text: message,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $(form).unbind("submit").submit();

                    }
                });
        })

    },
    c: function (id, price, rest) {
        if(rest < price || rest === 0) {
            return false
        }
        $('#quantity_'+id).val(Math.round(rest/price))
    },

    formatable: function (selector) {

    }

}
