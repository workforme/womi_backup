(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
totaltime=parseInt(wait.innerHTML);
var interval = setInterval(function(){
    var time = --totaltime;
        wait.innerHTML=""+time;
    if(time === 0) {
        location.href = href;
        clearInterval(interval);
    };
}, 1000);
})();
