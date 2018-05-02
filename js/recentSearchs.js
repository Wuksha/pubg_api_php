function autocomplete(arr) {

        var c1 = document.getElementById("c1");
        var c2 = document.getElementById("c2");
        var c3 = document.getElementById("c3");
        var xy = 0;
        for (i = 0; i < arr.length; i++) {
            b = document.createElement("div");
            b.setAttribute("class", "item-player");
            p = document.createElement('a')
            p.setAttribute("data-player-name", arr[i]);
            p.href =  'matches.php/'+arr[i];
            p.innerHTML = arr[i];
            b.appendChild(p);
            if(xy < 3)
            {
            c1.appendChild(b);
            xy++;
            }
            else if(xy < 6)
            {
            c2.appendChild(b);
            xy++;
            }
            else
            {
            c3.appendChild(b);
            xy++;
            }
  
  }
}

  
var x = getCookie("recentSearches");
autocomplete(x);
