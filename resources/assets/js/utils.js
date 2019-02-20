window.createOption = function(target, obj){
    let opt = document.createElement('option');
    opt.value = obj.value;
    opt.innerHTML = obj.text;
    target.appendChild(opt);
}

window.clearOptions = function(select, expFirst){
    end = (expFirst) ? 1 : 0;
    for (i = select.options.length - 1 ; i >= end ; i--) {
        select.remove(i);
    }
}

window.toggleElm = function(target, toggle) {
    target.style.display = toggle;
}
