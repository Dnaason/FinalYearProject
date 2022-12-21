<html lang="en" dir="ltr">
   <html lang="en" dir="ltr">
      <head>
         <meta charset="utf-8">
         <title>WebFA</title>
         <link rel="stylesheet" href="./css/loading.css">
      </head>
      <body>
         <div class="circular">
            <div class="inner"></div>
            <div class="outer"></div>
            <div class="numb">
               0%
            </div>
            <div class="circle">
               <div class="dot">
                  <span></span>
               </div>
               <div class="bar left">
                  <div class="progress"></div>
               </div>
               <div class="bar right">
                  <div class="progress"></div>
               </div>
            </div>
         </div>
         <script>
            const numb = document.querySelector(".numb");
            let counter = 0;
            setInterval(()=>{
              if(counter == 100){
                window.location.replace("login.php");
              }else{
                counter+=1;
                numb.textContent = counter + "%";
              }
            }, 80);
         </script>
    </body>
</html>