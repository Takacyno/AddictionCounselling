function testCheck(obj){
    document.getElementById("testSubmit").disabled="disabled";
    var ok=1,any;
    var array=[];
    for(var i=0;i<questionNum;i++){
        any=1;
        for(var j=0;j<questionSelectNum[i];j++){
            if(document.getElementById(i+"check"+j).checked){
                any=0;
            }
        }
        if(any==1){
            array.push(i+1);
            ok=0;
        }
    }
    if(ok==1){
        obj.form.submit();
    }else{
        var alertText=array[0];
        for(var i=1;i<array.length;i++){
            alertText+=","+array[i];
        }
        alertText+="問目が選択されていません";
        myAlert(alertText);
    }
    document.getElementById("testSubmit").disabled=null;
}
function testRecordSelectChange(Num){
    for(var i=0;i<testRecordNum;i++){
        if(i==Num){
            if(document.getElementById('Div'+i).classList.contains("none")){
                document.getElementById('Div'+i).classList.remove("none");
            }
        }else{
            if(!document.getElementById('Div'+i).classList.contains("none")){
                document.getElementById('Div'+i).classList.add("none");
            }
        }
    }
}
const myAlert = ((  ) =>{

    let alt=null,p=null,btn=null;

    window.addEventListener( "DOMContentLoaded" , ()=> {
        if( alt !== null ) return;

        alt = document.getElementById("alert");
        p = alt.querySelector("p");
        btn = alt.querySelector("button");
        btn.addEventListener("click",()=>alt.style.display="none");

    });

    return ( text )=>{
        p.textContent = text;
        alt.style.display="block";
    }

})();
