function openpietro(evt, pietro) 
{
    // Declare all variables
    var i, tabcontent, tablinks;

    // Hide textBox
    document.getElementById("textBox").innerHTML = "";
    document.getElementById("textBox").style.display = "none";
  
    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) 
    {
      tabcontent[i].style.display = "none";
    }
  
    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) 
    {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(pietro).style.display = "block";
    evt.currentTarget.className += " active";
} 

//do something when cursor is above element
function roomClicked(element){
  var id = element.getAttribute('value');
  const room = document.getElementById(id);

  room.style.fontSize = 40 + "px";
  room.style.fontWeight = "bolder";
  room.style.textShadow = "1px 1px 2px black";
  room.style.textDecoration = "underline";
  room.style.textDecorationSkipInk = "none";
  //document.getElementById(id).style.fontSize = 50 + "px";
}

//do something when cursor leaves element
function roomUnclicked(element){
  var id = element.getAttribute('value');

  const room = document.getElementById(id);

  room.style.fontSize = 21 + "px";
  room.style.fontWeight = "unset";
  room.style.textShadow = "unset";
  room.style.textDecoration = "none";
}


function clicked(element){
  let id = element.getAttribute('id');
  const room = document.querySelector("[value='" +id+ "']");
  const pin = document.getElementById("pin" + id.charAt(0));
  let top = parseInt(room.style.top || 0);
  let left = parseInt(room.style.left || 0);

  if(pin.getAttribute('class')=="pin0")
  {
    pin.style.top = (top-70) + "px";
    pin.style.left = (left+20) + "px"; 
  }
  else{
    pin.style.top = (top-40) + "px";
    pin.style.left = (left+5) + "px"; 
  }
  pin.style.display = "block"; 

}

function unclicked(element){
  let id = element.getAttribute('id');
  const room = document.querySelector("[value='" +id+ "']");
  const pin = document.getElementById("pin" + id.charAt(0));

  pin.style.display = "none";
}
  
  