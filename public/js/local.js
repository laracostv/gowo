/*
$(document).ready(function(){
    $("#txtCep").focusout(function(){
        consultCep();
    });
});
*/

var listEnd = []

function callFunctionCep() {
    var size = $('#txtCep').val().length;
    console.log('chamou');
    if (size == 9) {
        consultCep();
        $('#txtCep').blur();
    }
    if (size < 9) {
        $('#hidden-before-cep').fadeOut();
    }
}

function consultCep() {
    $('#loading-div').show()
    var cep = $("#txtCep").val();
    /*var cep2 = $("#cep-searched").val();
    if (cep.length == 0) {
        cep = cep2;
    }*/
    cep = cep.replace("-", "");
    var urlStr = "https://viacep.com.br/ws/" + cep + "/json/";

    $.ajax({
        url: urlStr,
        type: "get",
        dataType: "json",
        success: function (data) {
            if (data.erro) {
                errorCepReturn();
            } else {
                var lograd = data.logradouro;
                var bair = data.bairro;
                $('#loading-div').hide();
                $('#incorret-cep').hide();
                $('#hidden-before-cep').fadeIn();
                $('#txtCep').removeClass('invalid-feedback-box')
                $('#instructions').hide()
                if (lograd != '') {
                    $("#address").prop("readonly", true);
                    $('#number').focus();
                    clickFocus(1);
                } else {
                    $("#address").prop("readonly", false);
                    $('#address').focus();
                    clickFocus(2);
                }
                if (bair != '') {
                    $("#nbh").prop("readonly", true);
                    //console.log('save')
                } else {
                    $("#nbh").prop("readonly", false);
                    //console.log('save')
                }

                $("#city").prop("readonly", true);
                $("#state").prop("readonly", true);

                $("#address").val(data.logradouro);
                $("#nbh").val(data.bairro);
                $("#city").val(data.localidade);
                $("#state").val(data.uf);
                $("#compl").val(data.complemento);
            }
        },
        error: function (erro) {
            console.log(erro);
            errorCepReturn();
        }
    });
}

function clickFocus(id) {
    if (id == 1) {
        document.getElementById('myHiddenButtonNmr').click();
    }
    if (id == 2) {
        document.getElementById('myHiddenButtonEnd').click();
    }
}

function doFocus(id) {
    if (id == 1) {
        var focusElementId = "end"
        var textBox = document.getElementById(focusElementId);
        //textBox.focus();
    }
    if (id == 2) {
        var focusElementId = "nmr"
        var textBox = document.getElementById(focusElementId);
        //textBox.focus();
    }
}

function errorCepReturn() {
    $('#loading-div').hide();
    $('#incorret-cep').show();
    $('#hidden-before-cep').fadeOut();
    $('#txtCep').addClass('invalid-feedback-box')
}

function onlyNumbers(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    // charCode 8 = backspace   
    // charCode 9 = tab
    if (charCode != 8 && charCode != 9) {
        // charCode 48 equivale a 0   
        // charCode 57 equivale a 9
        if (charCode < 48 || charCode > 57) {
            return false;
        }
    }
}

function discoverCEP_input() {
    $('#address_form').slideUp();
    $('.adr_search_form').show();
}

$(document).keyup(function () {
    allCompleted();
    allCompletedSearch()
});

function allCompleted() {
    var tcep = $("#txtCep").val().length;
    var end = $("#address").val().length;
    var nmr = $("#number").val().length;
    var bir = $("#nbh").val().length;
    var cit = $("#city").val().length;
    var est = $("#state").val().length;

    if (tcep == 9 && end > 0 && nmr > 0 && bir > 0 && cit > 0 && est == 2) {
        $("#addAddress").prop("disabled", false);
        //console.log('libera');
    } else {
        $("#addAddress").prop("disabled", true);
        //console.log('block');
    }
}

function allCompletedSearch() {
    var s_est = $("#state_search").val().length;
    var s_cit = $("#city_search").val().length;
    var s_end = $("#nbh_search").val().length;

    if (s_est == 2 && s_cit > 0 && s_end > 0) {
        $("#btn-consult").prop("disabled", false);
    } else {
        $("#btn-consult").prop("disabled", true);
    }
}

function searchCEP() {
    $('#point-loader').show();
    $('#results').hide();
    var uf = $("#state_search").val();
    var ci = $("#city_search").val();
    var lo = $("#nbh_search").val();
    var urlStrCep = "https://viacep.com.br/ws/" + uf + "/" + ci + "/" + lo + "/json/";

    $.ajax({
        url: urlStrCep,
        type: "get",
        dataType: "json",
        success: function (data) {
            $('#results').show();
            if (data.length == 0) {
                $('#point-loader').hide();
                $('#error-mensage-search').show();
                $('#results').hide();
            } else {
                listEnd = [];
                //console.log(data)
                $('#error-mensage-search').hide();
                $('#point-loader').hide();
                $('#result-text').fadeIn();
                if (data.length == 1) {
                    $('#result-text').html('1 resultado encontrado');
                } else {
                    $('#result-text').html(data.length + ' resultados encontrados');
                }
                $('#list_results').html('')
                for (var i = 0; i < data.length; i++) {
                    var cep = data[i].cep;
                    var log = data[i].logradouro;
                    var loc = data[i].localidade;
                    var est = data[i].uf;
                    var bai = data[i].bairro;

                    var endItem = [];
                    endItem.push(cep);
                    endItem.push(log);
                    endItem.push(loc);
                    endItem.push(est);
                    endItem.push(bai);

                    listEnd.push(endItem);

                    if (log.length > 0) {
                        log = log + ', '
                    }
                    listResults(i, cep, log, loc, est, bai);
                }
            }
        },
        error: function (erro) {
            console.log(erro);
            $('#point-loader').hide();
            $('#error-mensage-search').show();
            $('#results').hide();
        }
    });
}

function listResults(id, cep, log, loc, uf, bai) {
    $('#list_results').append('<div class="adress-select" id="r' + id + '" onclick="completeEnd(' + id + ')">' +
        '<i data-feather="map-pin" class="local-icon"></i>' +
        '<div class="adress-description">' +
        '<div class="adress-title">' +
        cep +
        '</div>' +
        '<div class="adress-complete">' +
        log + loc + ' - ' + uf +
        '</div>' +
        '<div class="adress-complement">' +
        bai +
        '</div>' +
        '</div>' +
        '</div>')
    feather.replace();
}

function completeEnd(id) {
    $('#cep-searched').show();
    $('.adr_search_form').hide();
    $('#address_form').show();
    $("#txtCep").val(listEnd[id][0]);
    $("#txtCep").prop('readonly', true);
    consultCep();
    //console.log(listEnd[id])
    $('#hidden-before-cep').show();
}