if(searched==1){
    if(nowClassView==0){
        for(var j=0;j<patientNameData[nowAddic].length;j++){
            while(1){
                if(document.getElementById('list'+j).classList.contains("none")){
                    document.getElementById('list'+j).classList.remove("none");
                }else{
                    break;
                }
            }
            for(var k=0;k<patientNameData[nowAddic][j].length;k++){
                if(toHankaku(patientNameData[nowAddic][j][k]).indexOf(searchNameFrom)>=0){
                    while(1){
                        if(document.getElementById(j+'_'+k+'Label').classList.contains("none")){
                            document.getElementById(j+'_'+k+'Label').classList.remove("none");
                        }else{
                            break;
                        }
                    }
                }else{
                    if(!document.getElementById(j+'_'+k+'Label').classList.contains("none")){
                        document.getElementById(j+'_'+k+'Label').classList.add("none");
                    }
                }
            }
        }
    }
}
function pullDown(id){
    if(nowClassView==0){
        if(document.getElementById('list'+id.substr(8)).classList.contains("none")){
            while(1){
                if(document.getElementById('list'+id.substr(8)).classList.contains("none")){
                    document.getElementById('list'+id.substr(8)).classList.remove("none");
                }else{
                    break;
                }
            }
            for(var k=0;k<patientNameData[nowAddic][id.substr(8)].length;k++){
                if(document.getElementById(id.substr(8)+'_'+k+'Label').classList.contains("none")){
                    document.getElementById(id.substr(8)+'_'+k+'Label').classList.remove("none");
                }
            }
        }else{
            document.getElementById('list'+id.substr(8)).classList.add("none");
        }
    }else if(nowClassView==1){
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
}
function displayAllClick(){
    if(nowClassView==0){
        for(var j=0;j<hospitalNum;j++){
            if(document.getElementById('list'+j).classList.contains("none")){
                document.getElementById('list'+j).classList.remove("none");
            }

            for(var k=0;k<patientNameData[nowAddic][j].length;k++){
                if(document.getElementById(j+'_'+k+'Label').classList.contains("none")){
                    document.getElementById(j+'_'+k+'Label').classList.remove("none");
                }
            }
        }
    }else if(nowClassView==1){
        for(var j=0;j<hospitalNum;j++){
            if(document.getElementById('list'+j).classList.contains("none")){
                document.getElementById('list'+j).classList.remove("none");
            }

            for(var k=0;k<counsellors[j].length;k++){
                if(document.getElementById(j+'_'+k).classList.contains("none")){
                    document.getElementById(j+'_'+k).classList.remove("none");
                }
            }
        }
    }
}
function notDisplayAllClick(){
    for(var j=0;j<hospitalNum;j++){
        if(!document.getElementById('list'+j).classList.contains("none")){
            document.getElementById('list'+j).classList.add("none");
        }
    }
}
function updateThisCounsellor(id){
    if(document.getElementById('updateThisCounsellor').classList.contains("none")){
        document.getElementById('updateThisCounsellor').classList.remove("none");
        document.getElementById('updateThisCounsellor').classList.add("inlineBlock");
    }
    var whichCounsellor=id.split('_');
    document.getElementById('counsellorID').value=counsellors[whichCounsellor[0]][whichCounsellor[1]][0];
    document.getElementById('counsellorAllname').value=counsellors[whichCounsellor[0]][whichCounsellor[1]][2];
    document.getElementById('counsellorRank').disabled=null;
    for(var i=0;i<document.getElementById('counsellorRank').options.length;i++){
        document.getElementById('counsellorRank').options[i].disabled=null;
    }

    document.getElementById('counsellorRank').options[counsellors[whichCounsellor[0]][whichCounsellor[1]][1]].selected=true;
    document.getElementById('counsellorUserStatus').disabled=null;
    document.getElementById('counsellorUserStatus').options[counsellors[whichCounsellor[0]][whichCounsellor[1]][7]].selected=true;
    if(document.getElementById('counsellorRank').value<=rank){
        document.getElementById('counsellorRank').disabled=true;
        document.getElementById('counsellorHospital').disabled=true;
        document.getElementById('counsellorUserStatus').disabled=true;
    }else{
        document.getElementById('counsellorRank').disabled=null;
        document.getElementById('counsellorHospital').disabled=null;
        document.getElementById('counsellorUserStatus').disabled=null;
        for(var i=0;i<rank;i++){
            document.getElementById('counsellorRank').options[i].disabled=true;
        }
    }
    if(rank==0){
        document.getElementById('counsellorHospital').options[counsellors[whichCounsellor[0]][whichCounsellor[1]][3]].selected=true;
    }
}
function searchNameCheck(obj){
    var searchName=toHankaku(document.getElementById("searchName").value);
    var found=0;
    if(nowClassView==0){
        for(var j=0;j<patientNameData[nowAddic].length;j++){
            if(document.getElementById('list'+j).classList.contains("none")){
                document.getElementById('list'+j).classList.remove("none");
            }
            for(var k=0;k<patientNameData[nowAddic][j].length;k++){
                if(toHankaku(patientNameData[nowAddic][j][k]).indexOf(searchName)>=0){
                    found=1;
                    while(1){
                        if(document.getElementById(j+'_'+k+'Label').classList.contains("none")){
                            document.getElementById(j+'_'+k+'Label').classList.remove("none");
                        }else{
                            break;
                        }
                    }
                }else{
                    if(!document.getElementById(j+'_'+k+'Label').classList.contains("none")){
                        document.getElementById(j+'_'+k+'Label').classList.add("none");
                    }
                }
            }
        }
        if(found==0){
            for(var i=0;i<patientNameData.length;i++){
                for(var j=0;j<patientNameData[i].length;j++){
                    for(var k=0;k<patientNameData[i][j].length;k++){
                        if(toHankaku(patientNameData[i][j][k]).indexOf(searchName)>=0){
                            document.getElementById("searchAddicNum").value=i;
                            found=2;
                            break;
                        }
                    }
                    if(found>0){
                        break;
                    }
                }    
                if(found>0){
                    break;
                }
            }
        }

        if(found==0){
            myAlert('見つかりませんでした');
        }else if(found==2){
            obj.form.submit();
        }
    }else if(nowClassView==1){
        for(var j=0;j<counsellors.length;j++){
            if(document.getElementById('list'+j).classList.contains("none")){
                document.getElementById('list'+j).classList.remove("none");
            }
            for(var k=0;k<counsellors[j].length;k++){
                if(toHankaku(counsellors[j][k][2]).indexOf(searchName)>=0){
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
}//edit
function FrontCoverBBSClick(id){
    if(document.getElementById('updateThisFrontCoverBBSForm').classList.contains("none")){
        document.getElementById('updateThisFrontCoverBBSForm').classList.remove("none");
    }
    var num=Number(id.substr(13));
    document.getElementById('FrontCoverBBSNum').value=frontCoverBBS[num][0];
    document.getElementById('FrontCoverBBSBBSstatus').options[frontCoverBBS[num][1]].selected=true;
    if(rank==0){
        for(var j=0;j<hospitalNum;j++){
            
            if(frontCoverBBS[num][2].substr(j,1)==1){
                
                document.getElementById('FrontCoverBBSHospital'+j).checked=true;
            }else{
                document.getElementById('FrontCoverBBSHospital'+j).checked=false;
            }
        }
    }
    for(var j=0;j<addicNum;j++){
        if(frontCoverBBS[num][3].substr(j,1)==1){
            document.getElementById('FrontCoverBBSAddiction'+j).checked=true;
        }else{
            document.getElementById('FrontCoverBBSAddiction'+j).checked=false;
        }
    }
    document.getElementById('FrontCoverBBSTextContents').value=frontCoverBBS[num][5];
}
function updateThisFrontCoverBBSClick(obj){
    obj.disabled=true;
    var ok=1,any=0;
    if(document.getElementById('FrontCoverBBSBBSstatus').value==1){
        if(rank==0){
            for(var j=0;j<hospitalNum;j++){
                if(document.getElementById('FrontCoverBBSHospital'+j).checked){
                    any=1;
                }
            }
        }
        for(var j=0;j<addicNum;j++){
            if(document.getElementById('FrontCoverBBSAddiction'+j).checked){
                any=1;
            }
        }
        if(any==0){
            myAlert('何れかの病院または症状を選択してください');
            ok=0;
        }
        if(ok==1){
            if(document.getElementById('FrontCoverBBSTextContents').value==""){
                myAlert('テキストを入力してください');
                ok=0;
            }
        }
    }
    
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function plusFrontCoverBBSClick(obj){
    obj.disabled=true;
    var ok=1,any=0;
        if(rank==0){
            for(var j=0;j<hospitalNum;j++){
                if(document.getElementById('plusFrontCoverBBSHospital'+j).checked){
                    any=1;
                }
            }
        }
        for(var j=0;j<addicNum;j++){
            if(document.getElementById('plusFrontCoverBBSAddiction'+j).checked){
                any=1;
            }
        }
        if(any==0){
            myAlert('何れかの病院または症状を選択してください');
            ok=0;
        }
        if(ok==1){
            if(document.getElementById('plusFrontCoverBBSTextContents').value==""){
                myAlert('テキストを入力してください');
                ok=0;
            }
        }
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}
function passCheck(obj){
    obj.disabled=true;
    var ok=1;
    var pass=document.getElementById("password").value;
    if(pass!=document.getElementById("password2").value){
        myAlert('パスワードが一致しません');
        ok=0;
    }
    if(ok==1){
        if(pass.length<6){
            myAlert('６文字以上にしてください');
            ok=0;
        }    
    }
    if(ok==1){
        if(pass.length>50){
            myAlert('５０文字以下にしてください');
            ok=0;
        }    
    }
    if(ok==1){
        if(!pass.match(/^[a-zA-Z0-9]+$/)){
            myAlert('英数字で入力してください');
            ok=0;
        }    
    }
    if(ok==1){
        if(pass.match(/^[0-9a-z]+$/)||pass.match(/^[0-9A-Z]+$/)||pass.match(/^[a-zA-Z]+$/)){
            myAlert('アルファベットの大文字小文字と数字を含めてください');
            ok=0;
        }    
    }
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}

function counsellorCheck(obj){
    obj.disabled=true;
    var ok=1;
    if(document.getElementById("infoUpdateAllname").value==''){
        myAlert('名前を入力してください');
        ok=0;
    }
    if(ok==1){
        if(document.getElementById("infoUpdateEmail").value==''){
            myAlert('メールアドレスを入力してください');
            ok=0;
        }
    }
    if(ok==1){
        if(!document.getElementById("infoUpdateEmail").value.match(/[a-zA-Z0-9]+[a-zA-Z0-9\._-]*@[a-zA-Z0-9_-]+[a-zA-Z0-9\._-]+/)){
            myAlert('メールアドレスを確認してください');
            ok=0;
        }
    }
    if(ok==1){
        var email=document.getElementById("infoUpdateEmail").value;
        for(var j=0;j<Emails.length;j++){
            if(email==Emails[j]){
                myAlert('メールアドレスを確認してください');
                ok=0;
                break;
            }
        }
    }
    if(ok==1){
        obj.form.submit();
    }else{
        obj.disabled=null;
    }
}

function toHankaku(str){
    return (str.replace(/[！-～]/g,function(s){
        return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
    })).toLowerCase();
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
