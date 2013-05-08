function printout(){
document.getElementById('printreport').style.display='none';
document.getElementById('closereport').style.display='none';
//document.getElementById('excelreport').style.display='none';
window.print();
document.getElementById('printreport').style.display='';
document.getElementById('closereport').style.display='';
//document.getElementById('excelreport').style.display='';
}