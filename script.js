const header = document.querySelector("header");

window.addEventListener ("scroll", function () {
	header.classList.toggle ("sticky", window.scrollY > 0);
});

const carRadio = document.querySelector("#car-radio");
const truckRadio = document.querySelector("#truck-radio");
const femaleRadio = document.querySelector("#female-radio");
const maleRadio = document.querySelector("#male-radio");

document.querySelector("#icon-car").addEventListener("click", function() {
  carRadio.checked = true;
});

document.querySelector("#icon-truck").addEventListener("click", function() {
  truckRadio.checked = true;
});

document.querySelector("#icon-female").addEventListener("click", function() {
  femaleRadio.checked = true;
});

document.querySelector("#icon-male").addEventListener("click", function() {
  maleRadio.checked = true;
});

// Ajouter un écouteur d'événement sur chaque radio pour détecter les changements

carRadio.addEventListener('change', function() {
  if (carRadio.checked) {
    document.getElementById('icon-car').classList.add('selected');
  } else {
    document.getElementById('icon-car').classList.remove('selected');
  }
});

const carRadio = document.getElementById('car-radio');
const truckRadio = document.getElementById('truck-radio');
const femaleRadio = document.getElementById('female-radio');
const maleRadio = document.getElementById('male-radio');

truckRadio.addEventListener('change', function() {
  if (truckRadio.checked) {
    document.getElementById('icon-truck').classList.add('selected');
    alert('oh la d');
  } else {
    document.getElementById('icon-truck').classList.remove('selected');
  }
});

femaleRadio.addEventListener('change', function() {
  if (femaleRadio.checked) {
    document.getElementById('icon-female').classList.add('selected');
  } else {
    document.getElementById('icon-female').classList.remove('selected');
  }
});

maleRadio.addEventListener('change', function() {
  if (maleRadio.checked) {
    document.getElementById('icon-male').classList.add('selected');
  } else {
    document.getElementById('icon-male').classList.remove('selected');
  }
});


document.querySelector('#button-go').addEventListener('click', function(event) {
	if (document.querySelector('#address-input').value.trim() === '' || document.querySelector('#address-input-1').value.trim() === '') {
  		event.preventDefault();
  		document.querySelector('#error-message').style.display = 'block';
	} else {
  		document.querySelector('#error-message').style.display = 'none';
	}
});
