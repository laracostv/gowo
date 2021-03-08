var email_check = false;
var pasw_check = false;

function signup_mobile(id) {
    if (id == '1') {
        window.location.href = "../signup/partners/";
    } else {
        document.getElementById("signup_box").style.display = 'flex';
        document.getElementById("mobile-option").style.display = 'none';
    }
}

function pasw_val() {
    document.getElementById("pwd-req").style.display = "block";
    var pwd = document.getElementById('pasw').value;
    var regexA = /^(?=(?:.*?[A-Z]))(?=(?:.*?[a-z]))/;
    var regexNum = /^(?=(?:.*?[0-9]))/;;

    if (pwd.length < 6) {
        document.getElementById('checkIcon1').style.display = "none";
        document.getElementById('icon1').style.display = "inline-block";
        document.getElementById('check1').style.color = '#ff6767'
    }
    if (!regexA.exec(pwd)) {
        document.getElementById('checkIcon2').style.display = "none";
        document.getElementById('icon2').style.display = "inline-block";
        document.getElementById('check2').style.color = '#ff6767'
    }
    if (!regexNum.exec(pwd)) {
        document.getElementById('checkIcon3').style.display = "none";
        document.getElementById('icon3').style.display = "inline-block";
        document.getElementById('check3').style.color = '#ff6767'
    }

    if (pwd.length >= 6) {
        document.getElementById('icon1').style.display = "none";
        document.getElementById('checkIcon1').style.display = "inline-block";
        document.getElementById('check1').style.color = '#00a508'
    }
    if (regexA.exec(pwd)) {
        document.getElementById('icon2').style.display = "none";
        document.getElementById('checkIcon2').style.display = "inline-block";
        document.getElementById('check2').style.color = '#00a508'
    }
    if (regexNum.exec(pwd)) {
        document.getElementById('icon3').style.display = "none";
        document.getElementById('checkIcon3').style.display = "inline-block";
        document.getElementById('check3').style.color = '#00a508'
    }

    return true;
}

function validacaoEmail(field) {
    user = field.value.substring(0, field.value.indexOf("@"));
    domain = field.value.substring(field.value.indexOf("@") + 1, field.value.length);

    if ((user.length >= 1) &&
        (domain.length >= 3) &&
        (user.search("@") == -1) &&
        (domain.search("@") == -1) &&
        (user.search(" ") == -1) &&
        (domain.search(" ") == -1) &&
        (domain.search(".") != -1) &&
        (domain.indexOf(".") >= 1) &&
        (domain.lastIndexOf(".") < domain.length - 1)) {
        //document.getElementById("msgemail").innerHTML="E-mail válido";
        //alert("E-mail valido");
        email_check = true;
        document.getElementById("email").style.border = "3px solid #f1f1f1"
    }
    else {
        //document.getElementById("msgemail").innerHTML="<font color='red'>E-mail inválido </font>";
        document.getElementById("email").style.border = "3px solid #ffa8a8"
        //alert("E-mail invalido");
        email_check = false;
    }
}

function input_check() {
    var name = document.getElementById("name").value.length;
    var last_name = document.getElementById("last_name").value.length;
    var cel = document.getElementById("cel").value.length;
    var bdate = document.getElementById("bdate").value.length;
    var check_terms = document.getElementById("check_terms").checked;

    if (name >= 2 && last_name >= 2 && email_check == true && pasw_check == true && cel == 15 && bdate == 10 && check_terms == true) {
        alert('validate');
        //document.getElementById("signup_form").submit();
    } else {
        if (name < 2) {
            document.getElementById("name").style.border = "3px solid #ffa8a8"
        }
        if (last_name < 2) {
            document.getElementById("last_name").style.border = "3px solid #ffa8a8"
        }
        if (email_check == false) {
            document.getElementById("email").style.border = "3px solid #ffa8a8"
        }
        if (pasw_check == false) {
            document.getElementById("pasw").style.border = "3px solid #ffa8a8"
        }
        if (cel < 15) {
            document.getElementById("cel").style.border = "3px solid #ffa8a8"
        }
        if (bdate < 10) {
            document.getElementById("bdate").style.border = "3px solid #ffa8a8"
        }
        if (check_terms == false) {
            document.getElementById("check_terms").style.border = "3px solid #ffa8a8"
        }
    }
}