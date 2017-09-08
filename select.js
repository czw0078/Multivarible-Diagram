//keep selected remember

function setSelectSqure2(){
    var s1=document.getElementById("SelectSquare1");
    var val1=parseFloat(s1.options[s1.selectedIndex].value);

    var s2=document.getElementById("SelectSquare2");
    if (val1==-1){
        s2.options.length=0;
        s2.options.add(new Option("Set left value first",-1));
    } else {
        var max = val1;
        s2.options.length =0;
        s2.options.add(new Option("Choose",-1));
        for (i=max*20;i>=0;i--){
            s2.options.add(new Option((i*0.05).toFixed(2)));
        }
    }
}

function setSelectSqure3(){
    var s1=document.getElementById("SelectSquare1");
    var s2=document.getElementById("SelectSquare2");
    var s3=document.getElementById("SelectSquare3");
    var val1=parseFloat(s1.options[s1.selectedIndex].value);
    var val2=parseFloat(s2.options[s2.selectedIndex].value);
    var min=val2;
    var max=1-val1+val2;
    //alert(max);
    if(val1==-1 || val2==-1){
        s3.options.length=0;
        s3.options.add(new Options("Set left value first",-1));
    } else {
        s3.options.length =0;
        s3.options.add(new Option("Choose",-1));
        for (i=Math.round((max-min)*20);i>=0;i--){
            s3.options.add(new Option((min+i*0.05).toFixed(2)));
        }
    }
}

