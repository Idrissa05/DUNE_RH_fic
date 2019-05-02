var room = 1;

function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = '<div class="row"><div class="col-sm-3 nopadding"><div class="form-group"> <select name="operateur_id[]" id="operateur_id'+room+'" class="form-control operateur_id"><option value="1">Orange</option></select></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <select name="product_id[]" id="product_id" class="form-control product_id"><option value=""></option></select></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="number" class="form-control price" id="price" name="price[]" value=""></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <input class="form-control quantity" id="quantity" name="quantity[]"><div class="input-group-append"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i> </button></div></div></div></div><div class="clear"></div></row>';

    objTo.appendChild(divtest)
}

function remove_education_fields(rid) {
    $('.removeclass' + rid).remove();
}
