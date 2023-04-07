require('./bootstrap');

var dialog = document.querySelector('dialog');
document.querySelector('#closeDialog').onclick = function() {
 dialog.close();
}