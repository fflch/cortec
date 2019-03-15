let collapses = document.querySelectorAll('[id^="occrExp"]');
let td_collapses = document.querySelectorAll('[id^="td_occrExp"]');

collapses.forEach((elem) => {
    elem.addEventListener('show.bs.collapse', () => {
        td_collapses.forEach(alignCenterTd);
    })
    elem.addEventListener('hidden.bs.collapse', () => {
        td_collapses.forEach(alignLeftTd);
    })
})

function alignCenterTd(elem) {
    elem.classList.add('text-center');
}

function alignLeftTd(elem) {
    elem.classList.remove('text-center');
}
