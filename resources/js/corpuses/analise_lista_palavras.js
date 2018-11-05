//Funções para ordenar tabela
const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;
const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

//adiciona o event handler para ordenar a tabela
document.querySelectorAll('th[data-sort]').forEach(th => th.addEventListener('click', (() => {
  const table = th.closest('table').tBodies[0];
  table.parentElement.style.cursor = 'progress';
  setTimeout(function(){ sortTable(th, table); table.parentElement.style.cursor = ''; }, 400);
})));

//Função para ordenar a table
function sortTable(th, table){
  return new Promise(function(resolve, reject) {
    Array.from(table.querySelectorAll('tr:nth-child(n+1)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr) );
    resolve();
    });
}
