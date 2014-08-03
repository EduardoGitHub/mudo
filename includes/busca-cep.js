// JavaScript Document
//------------------ BUSCA ENDEREÇO DO BANCO DE DADOS DO CORREIRO ----------------------------------------//
function addEvent(obj, evt, func) {
  if (obj.attachEvent) {
    return obj.attachEvent(("on"+evt), func);
  } else if (obj.addEventListener) {
    obj.addEventListener(evt, func, true);
    return true;
  }
  return false;
}

function XMLHTTPRequest() {
  try {
    return new XMLHttpRequest(); // FF, Safari, Konqueror, Opera, ...
  } catch(ee) {
    try {
      return new ActiveXObject("Msxml2.XMLHTTP"); // activeX (IE5.5+/MSXML2+)
    } catch(e) {
      try {
        return new ActiveXObject("Microsoft.XMLHTTP"); // activeX (IE5+/MSXML1)
      } catch(E) {
        return false; // doesn't support
      }
    }
  }
}

function buscarEndereco() {
var campos = {
  validpostcode: document.getElementById("validpostcode"),
  postcode: document.getElementById("postcode"),
  street_address: document.getElementById("street_address"),
  street_number: document.getElementById("street_number"),
  suburb: document.getElementById("suburb"),
  city: document.getElementById("city"),
  state: document.getElementById("state")
};

var ajax = XMLHTTPRequest();
ajax.open("GET", ("busca_cep.php?cep=" + campos.postcode.value.replace(/\+/g, "")), true);

  ajax.onreadystatechange = function() {
  if (ajax.readyState == 1) {
  campos.street_address.disabled = true;
  campos.street_address.value = "carregando...";
  campos.suburb.disabled = true;
  campos.suburb.value = "carregando...";
  campos.city.disabled = true;
  campos.city.value = "carregando...";
  campos.state.disabled = true;
  campos.state.value = "UF...";
  } else if (ajax.readyState == 4) {
  if(ajax.responseText == false){
    campos.validpostcode.innerHTML = "<img src='../images/alert.gif'>&nbsp;&nbsp;CEP sem dados em nosso banco de dados. Favor preencher seu endere&ccedil;o.";
    campos.street_address.disabled = false;
    campos.street_address.value = "";
    campos.suburb.disabled = false;
	campos.suburb.value = "";
    campos.city.disabled = false;
    campos.city.value = "";
    campos.state.disabled = false;
    campos.state.value = "";
  }else{
    campos.validpostcode.innerHTML = "";
    var r = ajax.responseText, i, street_address, suburb, city, state, street_number;
    street_address = r.substring(0, (i = r.indexOf(':')));
    campos.street_address.disabled = false;
    campos.street_address.value = unescape(street_address.replace(/\+/g," "));
    r = r.substring(++i);
	
    suburb = r.substring(0, (i = r.indexOf(':')));
    campos.suburb.disabled = false;
    campos.suburb.value = unescape(suburb.replace(/\+/g," "));
    r = r.substring(++i);
	
    city = r.substring(0, (i = r.indexOf(':')));
    campos.city.disabled = false;
    campos.city.value = unescape(city.replace(/\+/g," "));
    r = r.substring(++i);
	
    state = r.substring(0, (i = r.indexOf(';')));
    campos.state.disabled = false;
	campos.state.value = unescape(state.replace(/\+/g," "));
    r = r.substring(++i);
	
	campos.street_number.focus();
  }
  }
};
ajax.send(null);
}

window.addEvent(
  window,
  "load",
  function() {window.addEvent(document.getElementById("buscacep"), "click", buscarEndereco);}
);