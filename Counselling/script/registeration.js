function newPatientCheck(obj){
    obj.disabled=true;
    var ok=1;
    if(document.getElementById("Allname").value==''){
        myAlert('名前を入力してください');
        ok=0;
    }
    if(ok==1){
        if(document.getElementById("Email").value==''){
            myAlert('メールアドレスを入力してください');
            ok=0;
        }
    }
    if(ok==1){
        if(!document.getElementById("Email").value.match(/[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+[a-zA-Z0-9\._-]+/)){
            myAlert('メールアドレスを確認してください');
            ok=0;
        }
    }
    if(ok==1){
        var email=document.getElementById("Email").value;
        for(var j=0;j<Emails.length;j++){
            if(email==Emails[j]){
                myAlert('メールアドレスを確認してください');
                ok=0;
                break;
            }
        }
    }
    if(ok==1){
        if(document.getElementById("Hospital").value==0){
            myAlert('病院を選択してください');
            ok=0;
        }
    }
    if(ok==1){
        var selected=0;
        for(var j=0;j<addicNum;j++){
            if(document.getElementById("addicCheck"+j).checked){
                selected=1;
                break;
            }
        }
        if(selected==0){
            myAlert('少なくとも1つ症状を選択してください');
            ok=0;
        }
    }
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function newCounsellorCheck(obj){
    obj.disabled=true;
    var ok=1;
    if(ok==1){
        if(document.getElementById("counsellorRank").value==0){
            myAlert('役職を選択してください');
            ok=0;
        }
    }

    if(ok==1){
        if(document.getElementById("counsellorAllname").value==''){
            myAlert('名前を入力してください');
            ok=0;
        }
    }
    if(ok==1){
        if(!document.getElementById("counsellorEmail").value.match(/[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+[a-zA-Z0-9\._-]+/)){
            myAlert('メールアドレスを確認してください');
            ok=0;
        }
    }
    if(ok==1){
        var email=document.getElementById("counsellorEmail").value;
        for(var j=0;j<Emails.length;j++){
            if(email==Emails[j]){
                myAlert('メールアドレスを確認してください');
                ok=0;
                break;
            }
        }
    }
    if(ok==1){
        if(document.getElementById("counsellorHospital").value==0){
            myAlert('病院を選択してください');
            ok=0;
        }
    }

    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function pullDown(id){
    if(document.getElementById('list'+id.substr(8)).classList.contains("none")){
        while(1){
            if(document.getElementById('list'+id.substr(8)).classList.contains("none")){
                document.getElementById('list'+id.substr(8)).classList.remove("none");
            }else{
                break;
            }
        }
        for(var k=0;k<counsellors[id.substr(8)].length;k++){
            if(document.getElementById(id.substr(8)+'_'+k).classList.contains("none")){
                document.getElementById(id.substr(8)+'_'+k).classList.remove("none");
            }
        }
    }else{
        document.getElementById('list'+id.substr(8)).classList.add("none");
    }
}
function searchNameCheck(){
    var searchName=document.getElementById("searchName").value;
    var found=0;
    for(var j=0;j<counsellors.length;j++){
        while(1){
            if(document.getElementById('list'+j).classList.contains("none")){
                document.getElementById('list'+j).classList.remove("none");
            }else{
                break;
            }
        }
        for(var k=0;k<counsellors[j].length;k++){
            if(toHankaku(counsellors[j][k][1]).indexOf(searchName)>=0){
                found=1;
                while(1){
                    if(document.getElementById(j+'_'+k).classList.contains("none")){
                        document.getElementById(j+'_'+k).classList.remove("none");
                    }else{
                        break;
                    }
                }
            }else{
                if(!document.getElementById(j+'_'+k).classList.contains("none")){
                    document.getElementById(j+'_'+k).classList.add("none");
                }
            }
        }
    }

    if(found==0){
        myAlert('見つかりませんでした');
    }
}
function toHankaku(str){
    return (str.replace(/[！-～]/g,function(s){
        return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
    })).toLowerCase();
}
function addCounsellor(name,value){
    var newButton = document.createElement('input'); 
    newButton.setAttribute("type","button");
    newButton.setAttribute("id","counsellor"+name);
    newButton.classList.add("none");
    var newLabel=document.createElement('label'); 
    newLabel.setAttribute("id","counsellor"+name+"Label");
    newLabel.setAttribute("for","counsellor"+name);
    newLabel.classList.add("canPush");
    newLabel.classList.add("z6");
    newLabel.appendChild(document.createTextNode(value));
    var newText=document.createElement('input'); 
    newText.setAttribute("type","text");
    newText.setAttribute("id","counsellor"+name+"Text");
    newText.setAttribute("name","counsellorIDs[]");
    newText.appendChild(document.createTextNode(name));
    newText.classList.add("none");
    newButton.onclick=function(){
        deleteCounsellor(newButton.id);
    };

    document.getElementById("BasicInfoCounsellors").appendChild(newButton);
    document.getElementById("BasicInfoCounsellors").appendChild(newLabel);
    document.getElementById("BasicInfoCounsellors").appendChild(newText);
}
function deleteCounsellor(id){
    document.getElementById('okORcancel').value=id;
    myConfirm("取り消しますか");
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
function ok_click(){
    var alt = document.getElementById("confirm");
    if(!alt.classList.contains("none")){
        alt.classList.add("none");    
    }
    id=document.getElementById("okORcancel").value;
    document.getElementById(id).remove();
    document.getElementById(id+"Label").remove();
    document.getElementById(id+"Text").remove();
}
function cancel_click(){
    var alt = document.getElementById("confirm");
    if(!alt.classList.contains("none")){
        alt.classList.add("none");    
    }
}
function myConfirm(text){
    var alt=null,p=null;
    alt = document.getElementById("confirm");
    p = alt.querySelector("p");
    p.textContent = text;
    if(alt.classList.contains("none")){
        alt.classList.remove("none");    
    }
}

