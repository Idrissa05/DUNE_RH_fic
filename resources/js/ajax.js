var monAjax = (function () {

    function store(url, data, ...fields) {
        axios.post(url, data)
            .then(function (response) {
                table.ajax.reload()
                swal({
                    title: "Enregisté !",
                    text: "Opération effectuée!",
                    icon: "success",
                    button: "Ok",
                });
            }).
        catch(function (error) {
            let all = '';
            fields.forEach(function (field) {
                all += '\n'+error.response.data.errors[field]
            })
            swal({
                title: "Erreur !",
                text: "Opération non  effectuée!"+all,
                icon: "error",
                button: "Ok",
            });
        })
    }


    function update(url, data, ...fields) {
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
            fields.forEach(function (field) {
                all += '\n'+error.response.data.errors[field]
            })
            swal({
                title: "Erreur !",
                text: "Opération non  effectuée!"+all,
                icon: "error",
                button: "Ok",
            });
        })
    }

})
