
const form = document.querySelector("form"); 
form.addEventListener("submit", handleSubmit); 

let isDisplaying = false; 
let websiteList = []; 
let currentPageIndex = 0; 
const iframe = document.querySelector("#frame"); 

function handleSubmit(event) { 
  event.preventDefault(); 

  const urlList = document.querySelector("#sites"); 
  const newEntry = document.createElement("div"); 
  newEntry.textContent = event.target[0].value; 

  urlList.appendChild(newEntry); 

  websiteList.push({ url: event.target[0].value, duration: event.target[1].value }); 

  
  if (!isDisplaying) { 
    isDisplaying = true; 
    iframe.src = websiteList[currentPageIndex].url; 

   
    setTimeout(() => {
      currentPageIndex = (currentPageIndex + 1) % websiteList.length; 
      if (isDisplaying) {
        iframe.src = websiteList[currentPageIndex].url; 
        setTimeout(() => {
          currentPageIndex = (currentPageIndex + 1) % websiteList.length; 
          displayNextPage(); 
        }, websiteList[currentPageIndex].duration * 1000); 
      }
    }, websiteList[currentPageIndex].duration * 1000); 
  } 


  event.target.reset(); 
}

