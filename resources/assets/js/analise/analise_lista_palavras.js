//Funções para ordenar tabela
const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

//adiciona o event handler para ordenar a tabela
document.querySelectorAll('th[data-sort]').forEach(th => th.addEventListener('click', (() => {
  const tbody = th.closest('table').tBodies[0];
  const thead = th.closest('table').tHead;
  thead.firstElementChild.style.cursor = '';
  thead.firstElementChild.style.cursor = 'progress';
  setTimeout(function(){ sortTable(th, tbody); thead.firstElementChild.style.cursor = ''; thead.firstElementChild.style.cursor = 'pointer';}, 400);
})));

//Função para ordenar a table
function sortTable(th, tbody){
  return new Promise(function(resolve, reject) {
    Array.from(tbody.querySelectorAll('tr:nth-child(n+1)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => tbody.appendChild(tr) );
    resolve();
    });
}
