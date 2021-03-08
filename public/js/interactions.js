/*MODAL*/

function modalClose(ele, id) {
    ele.parentElement.style.display = 'none';
    document.getElementsByClassName('modal-area')[id].style.display = 'none';
    //document.body.style.overflowY = "scroll";
}

function open_modal(modal_name, id) {
    document.getElementsByClassName('modal-area')[id].style.height = screen.height + 'px';
    //document.body.style.overflowY = "hidden";
    document.getElementById(modal_name).style.display = 'flex';
    document.getElementsByClassName('modal-area')[id].style.display = 'block';
}


/*
function open_list(id){
    if(id == 1){
        var height = isNaN(window.innerHeight) ? window.clientHeight : window.innerHeight;
        document.getElementsByClassName('bottom-cart-bar')[0].style.height = height - 55 + "px";
        document.getElementById('mobile-details-fixed').style.display = "none";
        document.getElementById('mobile-details-list').style.display = "block";
        document.getElementById('list-mobile').style.background = "var(--bg-default)";
    }else{
        console.log('oi');
        document.getElementsByClassName('bottom-cart-bar')[0].style.height = 40 + "px";
        document.getElementById('mobile-details-list').style.display = "none";
        document.getElementById('mobile-details-fixed').style.display = "fixed";
        document.getElementById('list-mobile').style.background = "var(--color-same)";
    }
}*/