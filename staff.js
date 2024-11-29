const texts = ["Welcome to Retford University .", "Welcome to Staff Panal ."];
let count = 0;
let index = 0;
let currentText = '';
let isDeleting = false;
const speed = 200;
const delay = 2000;

(function type() {
  const textElement = document.getElementById('text');
  
  if (isDeleting) {
    currentText = texts[count].substring(0, index--);
  } else {
    currentText = texts[count].substring(0, index++);
  }

  textElement.innerHTML = currentText;

  if (!isDeleting && index === texts[count].length) {
    isDeleting = true;
    setTimeout(type, delay); // Wait before deleting
  } else if (isDeleting && index === 0) {
    isDeleting = false;
    count = (count + 5) % texts.length;
    setTimeout(type, 10); // Wait before typing next text
  } else {
    setTimeout(type, speed);
  }
})();
