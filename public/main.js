// PC Toggle
const settingsBtn = document.getElementById('settingsBtn');
const settingsSection = document.getElementById('settingsSection');



settingsBtn.addEventListener("click", function () {
    settingsSection.classList.remove("hidden");
  if (settingsSection.classList.contains("slided")) {
    settingsSection.classList.remove("slided");
  } else {
    settingsSection.classList.add("slided");
  }

});

function closeWindow(element){
  element.parentElement.style.display = "none";
}

function openWindow(window){
  if(document.getElementById(window).style.display == "none")
      document.getElementById(window).style.display = "block";
  else
      document.getElementById(window).style.display = "none";
}


function changePhoto(){
  if(document.getElementById("profPic").src == "http://localhost/mymess/my-mess-production/public/profPics/user.png"){
      if(document.getElementById("changePhoto").style.display == "none")
          document.getElementById("changePhoto").style.display = "block";
      else
          document.getElementById("changePhoto").style.display = "none";
  }
  else{  
      location.href = "../private/returnToBasic.php";   
      console.log(document.getElementById("profPic").src);
  }
  
}

function showMessageInfo(id){
  element = document.getElementById("ms" + id)

  element.classList.toggle('-translate-x-full')
  // if(element.classList.contains("hidden")){
  //     element.classList.remove("hidden")
  //     element.classList.add("block")
  //     element.classList.remove("translate-y-full")
  //     element.classList.add("-translate-y-full transition-all")
  // }else{
  //     element.classList.toggle("hidden");
  // }
}

new FgEmojiPicker({
  trigger: ['x', 'textArea1'],
  position: ['top', 'right'],
  emit(obj, triggerElement) {
  const emoji = obj.emoji;
  document.getElementById('textArea1').value += emoji;
  }
});




// settingsBtn.addEventListener('click', () => {
//     anime({
//         targets: '#settingsBtn',
//         scale: 1.2,
//         rotateZ: 100
//     }) 

//     // anime({
//     //     targets: settingsSection,
//     //     translateY: 500
//     // })
// })

