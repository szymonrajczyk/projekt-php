var css = "color: coral; font-size: x-large;";

console.log("%cSalon samochodowy RajCar %s", css, '');

let slideIndex = 1;
showDiv(slideIndex);

function plusDiv(n) {
  showDiv(slideIndex += n);
}

function showDiv(n) {
  var i;
  var x = document.getElementsByClassName("image");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
