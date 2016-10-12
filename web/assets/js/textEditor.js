function boldSelectedText() {
   var text = document.getSelection();
   document.execCommand('bold');
}

function italiciseSelectedText() {
   var text = document.getSelection();
   document.execCommand('italic');
}

function underlineSelectedText() {
   var text = document.getSelection();
   document.execCommand('underline');
}
