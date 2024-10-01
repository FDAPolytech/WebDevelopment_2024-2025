 const urls = [
       "https://my.itmo.ru/",
       "https://i.pinimg.com/736x/27/a9/45/27a9457ca9d512da21abc20c33e985a8.jpg",
       "https://steamuserimages-a.akamaihd.net/ugc/1621850006938404146/EA72DC3C31DED440C024F0DD1D9859C44B1BBDFF/?imw=512&amp;&amp;ima=fit&amp;impolicy=Letterbox&amp;imcolor=%23000000&amp;letterbox=false"
   ];

   let currentIndex = 0;
   const webView = document.getElementById('web-view');
   const timerDisplay = document.getElementById('timer');
   let timer;

   function loadNextPage() {
       webView.src = urls[currentIndex];
       currentIndex = (currentIndex + 1) % urls.length;
       startTimer();
   }

   function startTimer() {
       let timeLeft = 5;
       timerDisplay.textContent = timeLeft;
       clearInterval(timer);
       
       timer = setInterval(() => {
           timeLeft--;
           timerDisplay.textContent = timeLeft;
           if (timeLeft <= 0) {
               clearInterval(timer);
               loadNextPage();
           }
       }, 1000);
   }

   // Запускаем программу
   loadNextPage();

